<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Buy Ticket - {{ $showtime->movie->title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body class="bg-black text-white">

@include('components.header')

<div class="pt-20 pb-16 px-6 md:px-10 max-w-3xl mx-auto">

    {{-- Movie Info --}}
    <div class="flex gap-5 mb-8">
        <img src="{{ $showtime->movie->poster ? asset('uploads/'.$showtime->movie->poster) : 'https://via.placeholder.com/100x150?text=No+Image' }}"
             class="w-24 rounded-xl object-cover flex-shrink-0">
        <div>
            <h2 class="text-2xl font-black uppercase">{{ $showtime->movie->title }}</h2>
            <p class="text-gray-400 text-sm mt-1">
                {{ \Carbon\Carbon::parse($showtime->start_time)->format('l, F j, Y') }}
                &bull;
                {{ \Carbon\Carbon::parse($showtime->start_time)->format('H:i') }}
                @if($showtime->end_time)
                    – {{ \Carbon\Carbon::parse($showtime->end_time)->format('H:i') }}
                @endif
            </p>
            @if($showtime->movie->genre)
                <p class="text-gray-500 text-xs mt-1">{{ $showtime->movie->genre }}</p>
            @endif
        </div>
    </div>

    @guest('customer')
    {{-- Not logged in --}}
    <div class="bg-yellow-400/10 border border-yellow-400/30 rounded-2xl p-6 text-center mb-6">
        <p class="text-yellow-400 font-bold mb-3">You need to be logged in to buy tickets</p>
        <a href="{{ route('login') }}" class="bg-[#E50914] hover:bg-red-700 text-white font-bold px-6 py-2 rounded-full transition">
            Login to Continue
        </a>
    </div>
    @else
    {{-- Booking Form --}}
    <form action="{{ route('tickets.confirm') }}" method="POST" class="space-y-5">
        @csrf
        <input type="hidden" name="showtime_id" value="{{ $showtime->id }}">
        <input type="hidden" name="price_per_ticket" value="{{ $price }}">

        <div class="bg-white/5 rounded-2xl p-5">
            <label class="text-sm text-gray-400 block mb-2">Number of Tickets</label>
            <div class="flex items-center gap-4">
                <button type="button" onclick="changeQty(-1)"
                    class="w-10 h-10 rounded-full bg-gray-700 hover:bg-gray-600 text-xl font-bold transition">−</button>
                <span id="qtyDisplay" class="text-2xl font-black w-8 text-center">1</span>
                <button type="button" onclick="changeQty(1)"
                    class="w-10 h-10 rounded-full bg-gray-700 hover:bg-gray-600 text-xl font-bold transition">+</button>
                <input type="hidden" name="quantity" id="qtyInput" value="1">
            </div>
        </div>

        <div class="bg-white/5 rounded-2xl p-5">
            <div class="flex justify-between text-sm text-gray-400 mb-2">
                <span>Price per ticket</span>
                <span>${{ number_format($price, 2) }}</span>
            </div>
            <div class="flex justify-between font-black text-lg">
                <span>Total</span>
                <span id="totalPrice" class="text-yellow-400">${{ number_format($price, 2) }}</span>
            </div>
        </div>

        <button type="submit"
            class="w-full bg-[#E50914] hover:bg-red-700 text-white font-black py-4 rounded-2xl text-lg transition flex items-center justify-center gap-2">
            <span class="material-icons">confirmation_number</span>
            Confirm Purchase
        </button>
    </form>
    @endguest

</div>

<script>
let qty = 1;
const price = {{ $price }};

function changeQty(delta) {
    qty = Math.max(1, Math.min(10, qty + delta));
    document.getElementById('qtyDisplay').textContent = qty;
    document.getElementById('qtyInput').value = qty;
    document.getElementById('totalPrice').textContent = '$' + (qty * price).toFixed(2);
}
</script>

</body>
</html>
