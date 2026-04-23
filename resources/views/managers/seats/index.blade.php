@extends('managers.layout.layout')

@section('content')

<style>
.seat-tooltip { display: none; }
.seat-tooltip.active { display: flex; }
</style>

<div class="flex justify-between items-center mb-6">
    <div>
        <h2 class="text-2xl font-bold text-white">Seat Management</h2>
        <p class="text-sm text-gray-500 mt-1">Manage seats per room</p>
    </div>
</div>

<div class="grid grid-cols-3 gap-6">

    {{-- LEFT: Room selector + Generate --}}
    <div class="space-y-4">

        {{-- Select Cinema + Room --}}
        <div class="bg-[#11161c] rounded-2xl p-5">
            <h3 class="font-bold text-white mb-4">Select Room</h3>

            <div class="mb-3">
                <label class="text-xs text-gray-400 mb-1 block">Cinema</label>
                <select id="cinemaSelect"
                    class="w-full px-4 py-2 bg-black rounded-lg text-white border border-gray-700 focus:border-yellow-400 outline-none text-sm"
                    onchange="loadRooms(this.value)">
                    <option value="">-- Choose a cinema --</option>
                    @foreach($cinemas as $cinema)
                        <option value="{{ $cinema->cinema_id }}" {{ request('cinema_id') == $cinema->cinema_id ? 'selected' : '' }}>
                            {{ $cinema->cinema_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <form method="GET" action="{{ route('admin.seats.index') }}" id="roomForm">
                <input type="hidden" name="cinema_id" id="cinemaIdInput" value="{{ request('cinema_id') }}">
                <label class="text-xs text-gray-400 mb-1 block">Room</label>
                <select name="room_id" id="roomSelect" onchange="document.getElementById('roomForm').submit()"
                    class="w-full px-4 py-2 bg-black rounded-lg text-white border border-gray-700 focus:border-yellow-400 outline-none text-sm">
                    <option value="">-- Choose a room --</option>
                    @foreach($rooms as $room)
                        <option value="{{ $room->id }}" {{ request('room_id') == $room->id ? 'selected' : '' }}>
                            {{ $room->name }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>

        {{-- Generate Seats --}}
        @if(request('room_id'))
        <div class="bg-[#11161c] rounded-2xl p-5">
            <h3 class="font-bold text-white mb-4">Generate Seats</h3>
            <form action="{{ route('admin.seats.generate') }}" method="POST" class="space-y-3">
                @csrf
                <input type="hidden" name="room_id" value="{{ request('room_id') }}">
                <div>
                    <label class="text-xs text-gray-400">Number of Rows</label>
                    <input type="number" name="rows" value="6" min="1" max="26"
                        class="w-full mt-1 px-3 py-2 bg-black rounded-lg text-white border border-gray-700 outline-none text-sm">
                </div>
                <div>
                    <label class="text-xs text-gray-400">Seats per Row</label>
                    <input type="number" name="cols" value="8" min="1" max="20"
                        class="w-full mt-1 px-3 py-2 bg-black rounded-lg text-white border border-gray-700 outline-none text-sm">
                </div>
                <div>
                    <label class="text-xs text-gray-400">VIP Rows (e.g. E,F)</label>
                    <input type="text" name="vip_rows" placeholder="F"
                        class="w-full mt-1 px-3 py-2 bg-black rounded-lg text-white border border-gray-700 outline-none text-sm">
                </div>
                <button type="submit"
                    class="w-full py-2 bg-yellow-400 hover:bg-yellow-300 text-black font-bold rounded-lg text-sm transition"
                    onclick="return confirm('This will delete existing seats. Continue?')">
                    Generate Seats
                </button>
            </form>
        </div>
        @endif

    </div>

    {{-- RIGHT: Seat map --}}
    <div class="col-span-2">
        @if($selectedRoom)
        <div class="bg-[#11161c] rounded-2xl p-5">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-bold text-white">{{ $selectedRoom->name }} — {{ $seats->count() }} seats</h3>
            </div>

            @if($seats->isEmpty())
                <p class="text-gray-500 text-center py-8">No seats yet. Generate seats using the form.</p>
            @else
                @php $grouped = $seats->groupBy('row'); @endphp

                {{-- Screen --}}
                <div class="text-center mb-6">
                    <div class="w-2/3 mx-auto h-1 bg-gray-600 rounded-full mb-1"></div>
                    <p class="text-gray-600 text-xs uppercase tracking-widest">Screen</p>
                </div>

                <div class="space-y-2 mb-6">
                    @foreach($grouped as $row => $rowSeats)
                    <div class="flex items-center gap-2 justify-center">
                        <span class="text-gray-600 text-xs w-4">{{ $row }}</span>
                        <div class="flex gap-1.5 flex-wrap justify-center">
                            @foreach($rowSeats as $seat)
                            <div class="relative seat-group">
                                <div class="w-8 h-8 rounded-t-lg cursor-pointer flex items-center justify-center text-[9px] font-bold
                                    {{ $seat->seat_type == 'vip' ? 'bg-amber-900 border border-amber-600 text-amber-400' : 'bg-gray-700 text-gray-400' }}
                                    hover:opacity-80 transition"
                                    onclick="toggleTooltip('tip-{{ $seat->id }}')">
                                    {{ $seat->column }}
                                </div>
                                {{-- Tooltip --}}
                                <div id="tip-{{ $seat->id }}" class="seat-tooltip absolute bottom-full left-1/2 -translate-x-1/2 mb-1 bg-[#1f2937] border border-gray-700 rounded-lg p-2 text-xs whitespace-nowrap z-20 flex-col gap-1 shadow-xl">
                                    <span class="text-white font-bold">{{ $seat->seat_number }}</span>
                                    <span class="text-gray-400">{{ ucfirst($seat->seat_type) }}</span>
                                    <form action="{{ route('admin.seats.update', $seat->id) }}" method="POST" class="flex gap-1 mt-1">
                                        @csrf @method('PATCH')
                                        <select name="seat_type" onchange="updateSeatType({{ $seat->id }}, this.value, this)"
                                            class="bg-gray-800 text-white text-xs rounded px-1 py-0.5 outline-none">
                                            <option value="standard" {{ $seat->seat_type == 'standard' ? 'selected' : '' }}>Standard</option>
                                            <option value="vip" {{ $seat->seat_type == 'vip' ? 'selected' : '' }}>VIP</option>
                                        </select>
                                    </form>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <span class="text-gray-600 text-xs w-4">{{ $row }}</span>
                    </div>
                    @endforeach
                </div>

                {{-- Legend --}}
                <div class="flex gap-6 justify-center text-xs text-gray-400">
                    <div class="flex items-center gap-2">
                        <div class="w-5 h-5 rounded-t-md bg-gray-700"></div> Standard
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-5 h-5 rounded-t-md bg-amber-900 border border-amber-600"></div> VIP
                    </div>
                </div>
            @endif
        </div>
        @else
        <div class="bg-[#11161c] rounded-2xl p-12 text-center text-gray-500">
            Select a room to manage its seats.
        </div>
        @endif
    </div>

</div>

<script>
async function loadRooms(cinemaId) {
    const sel = document.getElementById('roomSelect');
    sel.innerHTML = '<option value="">-- Choose a room --</option>';
    document.getElementById('cinemaIdInput').value = cinemaId;

    if (!cinemaId) return;

    const res = await fetch(`/admin/seats/rooms?cinema_id=${cinemaId}`);
    const rooms = await res.json();
    rooms.forEach(r => {
        sel.innerHTML += `<option value="${r.id}">${r.name}</option>`;
    });
}

function toggleTooltip(id) {
    // Close all others
    document.querySelectorAll('.seat-tooltip.active').forEach(t => {
        if (t.id !== id) t.classList.remove('active');
    });
    document.getElementById(id)?.classList.toggle('active');
}

// Close tooltip when clicking outside
document.addEventListener('click', function(e) {
    if (!e.target.closest('.seat-group')) {
        document.querySelectorAll('.seat-tooltip.active').forEach(t => t.classList.remove('active'));
    }
});

function updateSeatType(id, type, selectEl) {
    const seatEl = selectEl.closest('.seat-group').querySelector('.w-8');

    fetch(`/admin/seats/${id}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'X-HTTP-Method-Override': 'PATCH',
        },
        body: JSON.stringify({ seat_type: type })
    }).then(res => {
        if (res.ok) {
            if (type === 'vip') {
                seatEl.setAttribute('class', 'w-8 h-8 rounded-t-lg cursor-pointer flex items-center justify-center text-[9px] font-bold bg-amber-900 border border-amber-600 text-amber-400 hover:opacity-80 transition');
            } else {
                seatEl.setAttribute('class', 'w-8 h-8 rounded-t-lg cursor-pointer flex items-center justify-center text-[9px] font-bold bg-gray-700 text-gray-400 hover:opacity-80 transition');
            }
            seatEl.style.outline = '2px solid #facc15';
            setTimeout(() => seatEl.style.outline = '', 800);
        }
    });
}
</script>

@endsection
