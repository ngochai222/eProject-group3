<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $movie->title }} - Showtimes</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body class="bg-black text-white font-sans">

@include('components.header')

<div class="pt-20 pb-16 px-6 md:px-10 max-w-5xl mx-auto">

    {{-- Movie Info --}}
    <div class="flex gap-6 mb-10">
        <img src="{{ $movie->poster ? asset('uploads/'.$movie->poster) : 'https://via.placeholder.com/150x220?text=No+Image' }}"
             class="w-32 rounded-xl object-cover flex-shrink-0" alt="{{ $movie->title }}">
        <div>
            <h2 class="text-2xl font-black uppercase mb-2">{{ $movie->title }}</h2>
            <div class="flex gap-4 text-sm text-gray-400 mb-2">
                @if($movie->genre)<span class="flex items-center gap-1"><span class="material-icons text-sm">movie</span> {{ $movie->genre }}</span>@endif
                @if($movie->duration)<span class="flex items-center gap-1"><span class="material-icons text-sm">schedule</span> {{ $movie->duration }} min</span>@endif
            </div>
        </div>
    </div>

    {{-- Select Cinema --}}
    <h3 class="text-lg font-bold uppercase tracking-widest mb-4 text-[#E50914]">Select Cinema</h3>

    @if(isset($cinemas) && $cinemas->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-10">
        @foreach($cinemas as $cinema)
        <div class="cinema-card bg-white/5 border border-white/10 hover:border-[#E50914] rounded-2xl p-4 cursor-pointer transition"
             onclick="selectCinema(this, {{ $cinema->cinema_id }})">
            <h4 class="font-bold text-white mb-1">{{ $cinema->cinema_name }}</h4>
            <p class="text-sm text-gray-400 flex items-center gap-1">
                <span class="material-icons text-xs">location_on</span> {{ $cinema->cinema_address }}
            </p>
        </div>
        @endforeach
    </div>
    @else
    <div class="bg-white/5 rounded-2xl p-6 text-center text-gray-500 mb-10">No cinemas available.</div>
    @endif

    {{-- Showtimes --}}
    <h3 class="text-lg font-bold uppercase tracking-widest mb-4 text-[#E50914]">Available Showtimes</h3>

    @if($movie->showtimes->isEmpty())
        <div class="bg-white/5 rounded-2xl p-8 text-center text-gray-500">No showtimes available for this movie.</div>
    @else
        @php
            $grouped = $movie->showtimes->groupBy(fn($s) => \Carbon\Carbon::parse($s->start_time)->format('Y-m-d'));
        @endphp

        @foreach($grouped as $date => $times)
        <div class="mb-6">
            <p class="text-sm font-bold text-gray-400 uppercase tracking-widest mb-3">
                {{ \Carbon\Carbon::parse($date)->format('l, F j, Y') }}
            </p>
            <div class="flex flex-wrap gap-3">
                @foreach($times as $showtime)
                <div class="showtime-slot bg-gray-800 hover:bg-[#E50914] cursor-pointer px-5 py-3 rounded-xl text-center transition"
                     onclick="selectShowtime(this, {{ $showtime->id }})">
                    <p class="font-bold">{{ \Carbon\Carbon::parse($showtime->start_time)->format('H:i') }}</p>
                    @if($showtime->end_time)
                        <p class="text-xs text-gray-400">– {{ \Carbon\Carbon::parse($showtime->end_time)->format('H:i') }}</p>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
        @endforeach
    @endif

    {{-- Buy Ticket Button --}}
    <div id="buySection" class="hidden mt-8">
        <div class="bg-white/5 border border-white/10 rounded-2xl p-5 flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-400">Selected</p>
                <p id="selectedSummary" class="font-bold text-white mt-1">—</p>
            </div>
            <a id="buyBtn" href="#"
               class="bg-[#E50914] hover:bg-red-700 text-white font-bold px-8 py-3 rounded-full transition flex items-center gap-2">
                <span class="material-icons text-base">confirmation_number</span>
                Buy Ticket
            </a>
        </div>
    </div>

</div>

<script>
let selectedCinemaName = '';
let selectedCinemaId = null;
let selectedTime = '';
let selectedShowtimeId = null;

function selectCinema(el, id) {
    document.querySelectorAll('.cinema-card').forEach(c => {
        c.classList.remove('border-[#E50914]', 'bg-[#E50914]/10');
    });
    el.classList.add('border-[#E50914]', 'bg-[#E50914]/10');
    selectedCinemaName = el.querySelector('h4').textContent;
    selectedCinemaId = id;
    updateBuySection();
}

function selectShowtime(el, id) {
    document.querySelectorAll('.showtime-slot').forEach(s => {
        s.classList.remove('bg-[#E50914]');
        s.classList.add('bg-gray-800');
    });
    el.classList.remove('bg-gray-800');
    el.classList.add('bg-[#E50914]');
    selectedTime = el.querySelector('p').textContent;
    selectedShowtimeId = id;
    updateBuySection();
}

function updateBuySection() {
    if (selectedCinemaName && selectedTime) {
        document.getElementById('buySection').classList.remove('hidden');
        document.getElementById('selectedSummary').textContent =
            selectedCinemaName + ' — ' + selectedTime;
        document.getElementById('buyBtn').href = '/tickets/seat?showtime=' + selectedShowtimeId + '&cinema=' + selectedCinemaId;
    }
}
</script>

</body>
</html>
