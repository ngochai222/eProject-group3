<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cinebook Showtime</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black text-white">

@include('components.header')

<div class="pt-20 px-6 md:px-10 pb-16">

    <h2 class="text-2xl md:text-3xl font-black uppercase italic mb-8">Show Times</h2>

    @if($showtimes->isEmpty())
        <div class="text-center text-gray-500 py-20">
            <p class="text-lg">No showtimes available at the moment.</p>
        </div>
    @else
        @foreach($showtimes as $date => $items)
            <div class="mb-10">
                <h3 class="text-[#E50914] font-bold uppercase tracking-widest text-sm mb-4">
                    {{ \Carbon\Carbon::parse($date)->format('l, F j, Y') }}
                </h3>

                <div class="space-y-6">
                    @foreach($items as $showtime)
                    <div class="flex gap-6 bg-white/5 rounded-2xl p-4 border border-white/10">
                        {{-- Poster --}}
                        <img
                            src="{{ $showtime->movie->poster ? asset('uploads/' . $showtime->movie->poster) : 'https://via.placeholder.com/100x140?text=No+Image' }}"
                            class="w-20 h-28 rounded-lg object-cover flex-shrink-0"
                            alt="{{ $showtime->movie->title }}"
                        >

                        <div class="flex-1">
                            <h4 class="text-lg font-bold mb-1">{{ $showtime->movie->title }}</h4>
                            <div class="flex gap-4 text-sm text-gray-400 mb-3">
                                @if($showtime->movie->genre)
                                    <span>🎬 {{ $showtime->movie->genre }}</span>
                                @endif
                                @if($showtime->movie->duration)
                                    <span>⏱ {{ $showtime->movie->duration }} min</span>
                                @endif
                            </div>

                            <div class="flex flex-wrap gap-3">
                                <a href="{{ route('movie.detail', $showtime->movie->id) }}"
                                   class="bg-gray-800 hover:bg-[#E50914] px-4 py-2 rounded-lg text-sm font-bold transition">
                                    {{ \Carbon\Carbon::parse($showtime->start_time)->format('H:i') }}
                                    @if($showtime->end_time)
                                        – {{ \Carbon\Carbon::parse($showtime->end_time)->format('H:i') }}
                                    @endif
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    @endif

</div>

</body>
</html>
