<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $movie['title'] ?? 'Movie Detail' }} - Cinebook</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black text-white">

@include('components.header')

<div class="pt-20 pb-16 px-6 md:px-10 max-w-5xl mx-auto">

    {{-- Banner --}}
    <div class="flex flex-col md:flex-row gap-8 mb-10">
        <img src="{{ $movie['image'] }}" class="w-48 rounded-xl object-cover flex-shrink-0" alt="{{ $movie['title'] }}">

        <div class="flex-1">
            <h2 class="text-3xl font-black uppercase mb-2">{{ $movie['title'] }}</h2>

            <div class="flex flex-wrap gap-2 text-sm text-gray-400 mb-4">
                @if(!empty($movie['genre']))
                    <span> {{ $movie['genre'] }}</span>
                @endif
                @if(!empty($movie['duration']))
                    <span> {{ $movie['duration'] }}</span>
                @endif
                @if(!empty($movie['release_date']))
                    <span> {{ $movie['release_date'] }}</span>
                @endif
            </div>

            <div class="flex gap-3 flex-wrap">
                
                <a href="{{ isset($movie['id']) ? route('showtime.detail', $movie['id']) : route('showtime') }}"
                   class="bg-gray-700 hover:bg-gray-600 px-5 py-2 rounded-full font-bold text-sm transition">
                     Buy Tickets
                </a>
                @if(!empty($movie['trailer']))
                    <a href="{{ $movie['trailer'] }}" target="_blank"
                       class="bg-[#E50914] hover:bg-red-700 px-5 py-2 rounded-full font-bold text-sm transition flex items-center gap-2">
                        <span class="material-icons text-base">play_circle</span> Watch Trailer
                    </a>
                @endif
            </div>
        </div>
    </div>

    {{-- Description --}}
    @if(!empty($movie['description']))
    <div class="mb-8">
        <h3 class="text-xl font-bold mb-3">Description</h3>
        <p class="text-gray-400 leading-relaxed">{{ $movie['description'] }}</p>
    </div>
    @endif

    {{-- Cast --}}
    @if(!empty($movie['cast']))
    <div class="mb-8">
        <h3 class="text-xl font-bold mb-3">Cast</h3>
        <p class="text-gray-400">{{ $movie['cast'] }}</p>
    </div>
    @endif

    {{-- Details --}}
    <div class="mb-8">
        <h3 class="text-xl font-bold mb-3">Details</h3>
        <ul class="text-gray-400 space-y-1 text-sm">
            @if(!empty($movie['release_date']))
                <li><strong class="text-white">Release:</strong> {{ $movie['release_date'] }}</li>
            @endif
            @if(!empty($movie['genre']))
                <li><strong class="text-white">Genre:</strong> {{ $movie['genre'] }}</li>
            @endif
            @if(!empty($movie['duration']))
                <li><strong class="text-white">Duration:</strong> {{ $movie['duration'] }}</li>
            @endif
        </ul>
    </div>

</div>

</body>
</html>
