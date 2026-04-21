@extends('admin.layout.layout')

@section('content')

<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-white">Add Showtime</h2>
    <a href="{{ route('admin.showtimes.index') }}" class="text-gray-400 hover:text-white text-sm transition">← Back</a>
</div>

<form action="{{ route('admin.showtimes.store') }}" method="POST" id="showtimeForm">
@csrf

<div class="grid grid-cols-3 gap-6">

    {{-- FORM --}}
    <div class="col-span-2 bg-[#11161c] p-6 rounded-2xl space-y-5">

        {{-- Movie --}}
        <div>
            <label class="text-sm text-gray-400">Select Movie</label>
            <select name="movie_id" id="selMovie" class="w-full mt-2 px-4 py-2 bg-black rounded text-white border border-gray-700 focus:border-yellow-400 outline-none" onchange="updatePreview()">
                <option value="">-- Choose a movie --</option>
                @foreach($movies as $movie)
                    <option value="{{ $movie->id }}" data-title="{{ $movie->title }}" data-poster="{{ $movie->poster ? asset('uploads/'.$movie->poster) : '' }}">
                        {{ $movie->title }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Cinema + Room --}}
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="text-sm text-gray-400">Cinema</label>
                <select name="cinema_id" id="selCinema"
                    class="w-full mt-2 px-4 py-2 bg-black rounded text-white border border-gray-700 focus:border-yellow-400 outline-none"
                    onchange="loadRooms(this.value)">
                    <option value="">-- Choose cinema --</option>
                    @foreach($cinemas as $cinema)
                        <option value="{{ $cinema->cinema_id }}">{{ $cinema->cinema_name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="text-sm text-gray-400">Room</label>
                <select name="room_id" id="selRoom"
                    class="w-full mt-2 px-4 py-2 bg-black rounded text-white border border-gray-700 focus:border-yellow-400 outline-none">
                    <option value="">-- Select cinema first --</option>
                </select>
            </div>
        </div>

        {{-- Date --}}
        <div>
            <label class="text-sm text-gray-400">Date</label>
            <input type="hidden" name="date" id="selDate">

            {{-- Calendar --}}
            <div class="mt-2 bg-black rounded-xl p-4 border border-gray-700">
                <div class="flex justify-between items-center mb-3">
                    <button type="button" onclick="changeMonth(-1)" class="text-gray-400 hover:text-white px-2">‹</button>
                    <span id="calMonthLabel" class="text-sm font-bold text-white"></span>
                    <button type="button" onclick="changeMonth(1)" class="text-gray-400 hover:text-white px-2">›</button>
                </div>
                <div class="grid grid-cols-7 text-center text-xs text-gray-500 mb-2">
                    @foreach(['Mo','Tu','We','Th','Fr','Sa','Su'] as $d)
                        <div>{{ $d }}</div>
                    @endforeach
                </div>
                <div id="calDays" class="grid grid-cols-7 text-center text-xs gap-y-1"></div>
            </div>
        </div>

        {{-- Time --}}
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="text-sm text-gray-400">Start Time</label>
                <input type="time" name="time" id="selStart"
                    class="w-full mt-2 px-4 py-2 bg-black rounded text-white border border-gray-700 focus:border-yellow-400 outline-none"
                    onchange="updatePreview()">
            </div>
            <div>
                <label class="text-sm text-gray-400">End Time (auto)</label>
                <input type="time" id="selEnd" disabled
                    class="w-full mt-2 px-4 py-2 bg-black/50 rounded text-gray-500 border border-gray-800 outline-none">
            </div>
        </div>

        {{-- Buttons --}}
        <div class="flex justify-end gap-3 pt-4">
            <a href="{{ route('admin.showtimes.index') }}"
               class="px-4 py-2 bg-gray-700 hover:bg-gray-600 rounded text-white transition">Cancel</a>
            <button type="submit"
               class="px-6 py-2 bg-yellow-400 hover:bg-yellow-300 text-black rounded font-semibold transition">
                Save Showtime
            </button>
        </div>
    </div>

    {{-- PREVIEW --}}
    <div class="bg-[#11161c] p-6 rounded-2xl">
        <h3 class="font-semibold text-white mb-4">Preview</h3>

        <div class="bg-black p-4 rounded-xl space-y-4">
            <div class="flex gap-3 items-center">
                <div id="previewPoster" class="w-12 h-16 bg-gray-700 rounded overflow-hidden flex-shrink-0">
                    <img id="previewPosterImg" src="" class="w-full h-full object-cover hidden">
                    <div id="previewPosterPlaceholder" class="w-full h-full flex items-center justify-center">
                        <i class="fa fa-film text-gray-500"></i>
                    </div>
                </div>
                <div>
                    <p id="previewTitle" class="font-semibold text-white">Movie Title</p>
                </div>
            </div>

            <div id="previewDate" class="text-sm text-gray-300">Date: —</div>

            <div class="flex gap-2 flex-wrap">
                <span id="previewStart" class="bg-yellow-400 text-black px-3 py-1 rounded text-sm font-bold">—</span>
                <span id="previewEnd" class="bg-gray-700 text-white px-3 py-1 rounded text-sm">—</span>
            </div>
        </div>
    </div>

</div>
</form>

<script>
let calYear = new Date().getFullYear();
let calMonth = new Date().getMonth();
let selectedDate = '';

function renderCalendar() {
    const months = ['January','February','March','April','May','June','July','August','September','October','November','December'];
    document.getElementById('calMonthLabel').textContent = months[calMonth] + ' ' + calYear;

    const firstDay = new Date(calYear, calMonth, 1).getDay(); // 0=Sun
    const offset = (firstDay === 0) ? 6 : firstDay - 1; // Mon=0
    const daysInMonth = new Date(calYear, calMonth + 1, 0).getDate();
    const today = new Date(); today.setHours(0,0,0,0);

    let html = '';
    for (let i = 0; i < offset; i++) html += '<div></div>';

    for (let d = 1; d <= daysInMonth; d++) {
        const date = new Date(calYear, calMonth, d);
        const dateStr = calYear + '-' + String(calMonth+1).padStart(2,'0') + '-' + String(d).padStart(2,'0');
        const isPast = date < today;
        const isSelected = dateStr === selectedDate;
        const isToday = date.getTime() === today.getTime();

        html += `<div onclick="${isPast ? '' : `selectDay('${dateStr}')`}"
            class="p-1.5 rounded cursor-pointer transition
            ${isPast ? 'text-gray-700 cursor-not-allowed' : 'hover:bg-gray-700 text-gray-300'}
            ${isSelected ? 'bg-yellow-400 text-black font-bold hover:bg-yellow-300' : ''}
            ${isToday && !isSelected ? 'ring-1 ring-yellow-400' : ''}">
            ${d}
        </div>`;
    }
    document.getElementById('calDays').innerHTML = html;
}

function changeMonth(dir) {
    calMonth += dir;
    if (calMonth > 11) { calMonth = 0; calYear++; }
    if (calMonth < 0)  { calMonth = 11; calYear--; }
    renderCalendar();
}

function selectDay(dateStr) {
    selectedDate = dateStr;
    document.getElementById('selDate').value = dateStr;
    renderCalendar();
    updatePreview();
}

function updatePreview() {
    const movieSel = document.getElementById('selMovie');
    const selected = movieSel.options[movieSel.selectedIndex];

    document.getElementById('previewTitle').textContent = selected.dataset.title || 'Movie Title';

    const poster = selected.dataset.poster;
    if (poster) {
        document.getElementById('previewPosterImg').src = poster;
        document.getElementById('previewPosterImg').classList.remove('hidden');
        document.getElementById('previewPosterPlaceholder').classList.add('hidden');
    } else {
        document.getElementById('previewPosterImg').classList.add('hidden');
        document.getElementById('previewPosterPlaceholder').classList.remove('hidden');
    }

    const date = document.getElementById('selDate').value;
    document.getElementById('previewDate').textContent = date ? 'Date: ' + date : 'Date: —';

    const start = document.getElementById('selStart').value;
    document.getElementById('previewStart').textContent = start || '—';

    if (start) {
        const [h, m] = start.split(':').map(Number);
        const endH = String((h + 2) % 24).padStart(2, '0');
        const endTime = endH + ':' + String(m).padStart(2, '0');
        document.getElementById('selEnd').value = endTime;
        document.getElementById('previewEnd').textContent = endTime;
    }
}

document.getElementById('showtimeForm').onsubmit = function(e) {
    const date = document.getElementById('selDate').value;
    const time = document.getElementById('selStart').value;
    const movie = document.getElementById('selMovie').value;
    if (!date || !time || !movie) {
        alert('Please fill in all required fields.');
        e.preventDefault();
    }
};

renderCalendar();

async function loadRooms(cinemaId) {
    const sel = document.getElementById('selRoom');
    sel.innerHTML = '<option>Loading...</option>';
    if (!cinemaId) { sel.innerHTML = '<option value="">-- Select cinema first --</option>'; return; }
    const res = await fetch(`/admin/rooms?cinema_id=${cinemaId}`);
    const rooms = await res.json();
    sel.innerHTML = '<option value="">-- Choose room --</option>';
    rooms.forEach(r => {
        sel.innerHTML += `<option value="${r.id}">${r.name}</option>`;
    });
}
</script>

@endsection
