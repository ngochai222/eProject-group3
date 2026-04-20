<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $movie->title }} - Showtimes</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
            <div class="flex gap-4 text-sm text-gray-400">
                @if($movie->genre)<span>🎬 {{ $movie->genre }}</span>@endif
                @if($movie->duration)<span>⏱ {{ $movie->duration }} min</span>@endif
            </div>
        </div>
    </div>

    {{-- Showtimes --}}
    <h3 class="text-lg font-bold uppercase tracking-widest mb-4 text-[#E50914]">Available Showtimes</h3>

    @if($movie->showtimes->isEmpty())
        <div class="bg-white/5 rounded-2xl p-8 text-center text-gray-500">
            No showtimes available for this movie.
        </div>
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
                <div class="bg-gray-800 hover:bg-[#E50914] cursor-pointer px-5 py-3 rounded-xl text-center transition">
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

</div>

</body>
</html>
