<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Coming Soon - Cinebook</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#121212] text-white">

@include('components.header')

<div class="pt-20 pb-16 px-4 md:px-10 max-w-6xl mx-auto">

    <h2 class="text-3xl font-black uppercase italic mb-2">Coming Soon</h2>
    <p class="text-gray-400 text-sm mb-8">Upcoming movies hitting the big screen</p>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-5">
        @forelse($movies as $movie)
        @php
            $isObj = is_object($movie);
            $title = $isObj ? $movie->title : $movie['title'];
            $genre = $isObj ? ($movie->genre ?? '') : ($movie['genre'] ?? '');
            $image = $isObj
                ? (isset($movie->poster) && $movie->poster ? asset('uploads/'.$movie->poster) : ($movie->image ?? 'https://via.placeholder.com/300x450?text=No+Image'))
                : ($movie['image'] ?? '');
            $releaseDate = $isObj
                ? ($movie->release_date ? \Carbon\Carbon::parse($movie->release_date)->format('M Y') : '')
                : ($movie['release_date'] ?? '');
            $id = $isObj ? ($movie->id ?? null) : null;
        @endphp
        <div class="group cursor-pointer">
            <a href="{{ $id ? route('movie.detail', $id) : '#' }}">
                <div class="relative aspect-[3/4] rounded-2xl overflow-hidden mb-3 bg-gray-800">
                    <img src="{{ $image }}"
                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                         alt="{{ $title }}">
                    @if($releaseDate)
                    <div class="absolute top-3 left-3 bg-[#E50914] text-white text-[10px] font-bold uppercase tracking-widest px-2 py-1 rounded-full">
                        {{ $releaseDate }}
                    </div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-4">
                        <span class="text-white text-xs font-bold uppercase tracking-widest">View Details →</span>
                    </div>
                </div>
            </a>
            <h4 class="font-bold text-sm uppercase leading-tight mb-1 line-clamp-2">{{ $title }}</h4>
            <p class="text-[#E9BCB6]/50 text-xs font-bold uppercase tracking-widest">{{ $genre }}</p>
        </div>
        @empty
        <div class="col-span-4 text-center text-gray-500 py-20">
            No upcoming movies at the moment.
        </div>
        @endforelse
    </div>

</div>

</body>
</html>
