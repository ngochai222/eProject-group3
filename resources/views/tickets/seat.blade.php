<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Select Seat - Cinebook</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        .seat { width: 36px; height: 36px; border-radius: 8px 8px 4px 4px; cursor: pointer; transition: all 0.2s; }
        .seat-available { background: #3a3a3a; }
        .seat-available:hover { background: #facc15; transform: scale(1.1); }
        .seat-selected { background: #facc15 !important; border: none !important; }
        .seat-vip { background: #3a1a0a; border: 2px solid #7c3a1e; }
        .seat-vip:hover { background: #facc15; border-color: #facc15; transform: scale(1.1); }
        .seat-booked { background: #7f1d1d; cursor: not-allowed; opacity: 0.8; }
    </style>
</head>
<body class="bg-black text-white min-h-screen">

@include('components.header')

<div class="pt-20 pb-16 px-6 max-w-6xl mx-auto">

    {{-- Progress bar --}}
    <div class="w-full h-1 bg-gray-800 rounded-full mb-10">
        <div class="h-1 bg-cyan-400 rounded-full" style="width: 66%"></div>
    </div>

    <div class="flex gap-8">

        {{-- SEAT MAP --}}
        <div class="flex-1">
            {{-- Screen --}}
            <div class="text-center mb-8">
                <div class="w-3/4 mx-auto h-1 bg-gray-600 rounded-full mb-2"></div>
                <p class="text-gray-500 text-xs uppercase tracking-widest">Screen</p>
            </div>

            {{-- Seats grid --}}
            @if(isset($dbSeats) && $dbSeats->isNotEmpty())
                {{-- From DB --}}
                @php $grouped = $dbSeats->groupBy('row'); @endphp
                <div class="space-y-3 mb-8">
                    @foreach($grouped as $row => $rowSeats)
                    <div class="flex items-center gap-2 justify-center">
                        <span class="text-gray-600 text-xs w-4">{{ $row }}</span>
                        <div class="flex gap-2">
                            @foreach($rowSeats as $seat)
                                @php
                                    $isBooked = in_array($seat->seat_number, $bookedSeats ?? []);
                                    $isVip = $seat->seat_type == 'vip';
                                @endphp
                                <div class="seat {{ $isBooked ? 'seat-booked' : ($isVip ? 'seat-vip' : 'seat-available') }}"
                                     id="seat-{{ $seat->seat_number }}"
                                     data-seat="{{ $seat->seat_number }}"
                                     data-vip="{{ $isVip ? '1' : '0' }}"
                                     @if(!$isBooked) onclick="toggleSeat(this)" @endif>
                                </div>
                            @endforeach
                        </div>
                        <span class="text-gray-600 text-xs w-4">{{ $row }}</span>
                    </div>
                    @endforeach
                </div>
            @else
                {{-- Fallback hardcode --}}
                @php
                    $rows = ['A','B','C','D','E','F'];
                    $cols = 8;
                    $vipRow = 'F';
                @endphp
                <div class="space-y-3 mb-8">
                    @foreach($rows as $row)
                    <div class="flex items-center gap-2 justify-center">
                        <span class="text-gray-600 text-xs w-4">{{ $row }}</span>
                        <div class="flex gap-2">
                            @for($col = 1; $col <= $cols; $col++)
                                @php
                                    $seatId = $row . $col;
                                    $isBooked = in_array($seatId, $bookedSeats ?? []);
                                    $isVip = $row === $vipRow;
                                @endphp
                                @if($col == 5) <div class="w-4"></div> @endif
                                <div class="seat {{ $isBooked ? 'seat-booked' : ($isVip ? 'seat-vip' : 'seat-available') }}"
                                     id="seat-{{ $seatId }}"
                                     data-seat="{{ $seatId }}"
                                     data-vip="{{ $isVip ? '1' : '0' }}"
                                     @if(!$isBooked) onclick="toggleSeat(this)" @endif>
                                </div>
                            @endfor
                        </div>
                        <span class="text-gray-600 text-xs w-4">{{ $row }}</span>
                    </div>
                    @endforeach
                </div>
            @endif

            {{-- Legend --}}
            <div class="flex items-center justify-center gap-6 text-xs text-gray-400">
                <div class="flex items-center gap-2">
                    <div class="seat seat-available w-5 h-5"></div> Available
                </div>
                <div class="flex items-center gap-2">
                    <div class="seat seat-selected w-5 h-5"></div> Selected
                </div>
                <div class="flex items-center gap-2">
                    <div class="seat seat-vip w-5 h-5"></div> VIP
                </div>
                <div class="flex items-center gap-2">
                    <div class="seat seat-booked w-5 h-5"></div> Booked
                </div>
            </div>
        </div>

        {{-- BOOKING SUMMARY --}}
        <div class="w-72 flex-shrink-0 space-y-4">

            {{-- Movie card --}}
            <div class="bg-[#11161c] rounded-2xl overflow-hidden">
                <div class="relative h-36">
                    <img src="{{ $showtime->movie->poster ? asset('uploads/'.$showtime->movie->poster) : 'https://via.placeholder.com/300x150?text=No+Image' }}"
                         class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent flex items-end p-3">
                        <div>
                            <p class="font-black text-sm uppercase">{{ $showtime->movie->title }}</p>
                            <p class="text-xs text-gray-400">{{ $showtime->movie->genre }}</p>
                        </div>
                    </div>
                </div>

                <div class="p-4 space-y-3">
                    <div class="grid grid-cols-2 gap-3 text-xs">
                        <div>
                            <p class="text-gray-500 uppercase tracking-widest mb-1">Cinema</p>
                            <p class="font-bold text-white">{{ $cinema->cinema_name ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500 uppercase tracking-widest mb-1">Date & Time</p>
                            <p class="font-bold text-white">{{ \Carbon\Carbon::parse($showtime->start_time)->format('M d, Y') }}</p>
                            <p class="text-cyan-400 font-bold">{{ \Carbon\Carbon::parse($showtime->start_time)->format('H:i') }}</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-3 text-xs border-t border-gray-700 pt-3">
                        <div>
                            <p class="text-gray-500 uppercase tracking-widest mb-1">Seats</p>
                            <p id="selectedSeatsLabel" class="font-bold text-white">—</p>
                        </div>
                        <div>
                            <p class="text-gray-500 uppercase tracking-widest mb-1">Total Price</p>
                            <p id="totalPriceLabel" class="font-black text-yellow-400 text-lg">$0.00</p>
                        </div>
                    </div>

                    <form action="{{ route('tickets.confirm') }}" method="POST">
                        @csrf
                        <input type="hidden" name="showtime_id" value="{{ $showtime->id }}">
                        <input type="hidden" name="quantity" id="quantityInput" value="0">
                        <input type="hidden" name="price_per_ticket" value="{{ $price }}">
                        <input type="hidden" name="seats" id="seatsInput" value="">
                        <input type="hidden" name="promo_code" id="promoCodeInput" value="">
                        <input type="hidden" name="discount_amount" id="discountAmountInput" value="0">

                        {{-- Promo Code --}}
                        <div class="mb-3">
                            <label class="text-xs text-gray-400 block mb-1">Promo Code</label>
                            <div class="flex gap-2">
                                <input type="text" id="promoInput" placeholder="Enter code..."
                                    class="flex-1 px-3 py-2 bg-[#0f172a] rounded-lg text-white border border-gray-700 focus:border-yellow-400 outline-none text-sm uppercase">
                                <button type="button" onclick="applyPromo()"
                                    class="px-3 py-2 bg-gray-700 hover:bg-gray-600 text-white text-xs rounded-lg transition">Apply</button>
                            </div>
                            <p id="promoMsg" class="text-xs mt-1 hidden"></p>
                        </div>

                        <button type="submit" id="confirmBtn" disabled
                            class="w-full py-3 rounded-xl font-black text-sm uppercase tracking-widest transition
                            bg-gray-700 text-gray-500 cursor-not-allowed"
                            onclick="return validateSeats()">
                            Confirm & Pay
                        </button>
                    </form>

                    <p class="text-center text-xs text-gray-600">Or cancel without financial obligation</p>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
let selectedSeats = [];
const pricePerSeat = {{ $price }};

function toggleSeat(el) {
    const seatId = el.dataset.seat;
    const isVip = el.dataset.vip === '1';

    if (selectedSeats.includes(seatId)) {
        selectedSeats = selectedSeats.filter(s => s !== seatId);
        el.className = 'seat ' + (isVip ? 'seat-vip' : 'seat-available');
    } else {
        selectedSeats.push(seatId);
        el.className = 'seat seat-selected';
    }

    updateSummary();
}

function updateSummary() {
    const count = selectedSeats.length;
    const subtotal = count * pricePerSeat;
    const discount = parseFloat(document.getElementById('discountAmountInput').value) || 0;
    const total = Math.max(0, subtotal - discount);

    document.getElementById('selectedSeatsLabel').textContent = count > 0 ? selectedSeats.join(', ') : '—';
    document.getElementById('totalPriceLabel').textContent = '$' + total.toFixed(2);$' + total.toFixed(2);
    document.getElementById('quantityInput').value = count;
    document.getElementById('seatsInput').value = selectedSeats.join(',');

    const btn = document.getElementById('confirmBtn');
    if (count > 0) {
        btn.disabled = false;
        btn.className = 'w-full py-3 rounded-xl font-black text-sm uppercase tracking-widest transition bg-yellow-400 text-black hover:bg-yellow-300 cursor-pointer';
    } else {
        btn.disabled = true;
        btn.className = 'w-full py-3 rounded-xl font-black text-sm uppercase tracking-widest transition bg-gray-700 text-gray-500 cursor-not-allowed';
    }
}

let promoData = null;

async function applyPromo() {
    const code = document.getElementById('promoInput').value.trim();
    const msg = document.getElementById('promoMsg');
    if (!code) return;

    const res = await fetch('{{ route("promo.validate") }}', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
        body: JSON.stringify({ code })
    });
    const data = await res.json();

    msg.classList.remove('hidden');
    if (data.valid) {
        promoData = data;
        document.getElementById('promoCodeInput').value = data.code;

        const count = selectedSeats.length;
        const subtotal = count * pricePerSeat;
        let discount = 0;
        if (data.type === 'Percentage') {
            discount = subtotal * (data.value / 100);
        } else {
            discount = parseFloat(data.value);
        }
        document.getElementById('discountAmountInput').value = discount.toFixed(2);

        msg.className = 'text-xs mt-1 text-green-400';
        msg.textContent = '✓ Code applied! -' + (data.type === 'Percentage' ? data.value + '%' : '$' + data.value);$' + data.value);
        updateSummary();
    } else {
        promoData = null;
        document.getElementById('promoCodeInput').value = '';
        document.getElementById('discountAmountInput').value = '0';
        msg.className = 'text-xs mt-1 text-red-400';
        msg.textContent = '✗ Invalid or expired code';
        updateSummary();
    }
}

    document.getElementById('selectedSeatsLabel').textContent =
        count > 0 ? selectedSeats.join(', ') : '—';
    document.getElementById('totalPriceLabel').textContent =
        '$' + total.toFixed(2);
    document.getElementById('quantityInput').value = count;
    document.getElementById('seatsInput').value = selectedSeats.join(',');

    const btn = document.getElementById('confirmBtn');
    if (count > 0) {
        btn.disabled = false;
        btn.className = 'w-full py-3 rounded-xl font-black text-sm uppercase tracking-widest transition bg-yellow-400 text-black hover:bg-yellow-300 cursor-pointer';
    } else {
        btn.disabled = true;
        btn.className = 'w-full py-3 rounded-xl font-black text-sm uppercase tracking-widest transition bg-gray-700 text-gray-500 cursor-not-allowed';
    }
}

function validateSeats() {
    return selectedSeats.length > 0;
}
</script>

</body>
</html>
