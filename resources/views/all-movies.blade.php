<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Movies - Cinebook</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body class="bg-[#121212] text-white">

@include('components.header')

<div class="pt-20 pb-16 px-4 md:px-10 max-w-7xl mx-auto">

    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-3xl font-black uppercase italic">All Movies</h2>
            <p class="text-gray-500 text-sm mt-1">{{ $allMovies->count() }} movies</p>
        </div>

        {{-- Filter tabs --}}
        <div class="flex gap-2">
            <button onclick="filterMovies('all')" id="tab-all"
                class="px-4 py-1.5 rounded-full text-xs font-bold {{ $filter == 'all' ? 'bg-[#E50914] text-white' : 'bg-white/10 text-gray-300 hover:bg-white/20 transition' }}">All</button>
            <button onclick="filterMovies('Now Showing')" id="tab-now"
                class="px-4 py-1.5 rounded-full text-xs font-bold {{ $filter == 'Now Showing' ? 'bg-[#E50914] text-white' : 'bg-white/10 text-gray-300 hover:bg-white/20 transition' }}">Now Showing</button>
            <button onclick="filterMovies('Coming Soon')" id="tab-soon"
                class="px-4 py-1.5 rounded-full text-xs font-bold {{ $filter == 'Coming Soon' ? 'bg-[#E50914] text-white' : 'bg-white/10 text-gray-300 hover:bg-white/20 transition' }}">Coming Soon</button>
        </div>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-5" id="movieGrid">
        @forelse($allMovies as $movie)
        <div class="movie-card group cursor-pointer" data-status="{{ $movie['status'] }}">
            <a href="{{ route('movie.detail', $movie['id']) }}">
                <div class="relative aspect-[3/4] rounded-2xl overflow-hidden mb-3 bg-gray-800">
                    <img src="{{ $movie['image'] }}"
                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                         alt="{{ $movie['title'] }}">

                    {{-- Status badge --}}
                    <div class="absolute top-2 left-2">
                        @if($movie['status'] == 'Now Showing')
                            <span class="bg-green-500 text-white text-[9px] font-bold px-2 py-0.5 rounded-full uppercase">Now Showing</span>
                        @elseif($movie['status'] == 'Coming Soon')
                            <span class="bg-[#E50914] text-white text-[9px] font-bold px-2 py-0.5 rounded-full uppercase">Coming Soon</span>
                        @else
                            <span class="bg-gray-600 text-white text-[9px] font-bold px-2 py-0.5 rounded-full uppercase">Ended</span>
                        @endif
                    </div>

                    {{-- Price --}}
                    <div class="absolute bottom-2 right-2 bg-black/70 backdrop-blur px-2 py-0.5 rounded-full text-xs font-bold text-yellow-400">
                        ${{ number_format($movie['base_price'], 2) }}
                    </div>

                    {{-- Hover overlay --}}
                    <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                        <span class="text-white text-xs font-bold uppercase tracking-widest">View Details</span>
                    </div>
                </div>
            </a>
            <h4 class="font-bold text-sm uppercase leading-tight mb-1 line-clamp-2">{{ $movie['title'] }}</h4>
            <p class="text-[#E9BCB6]/50 text-xs font-bold uppercase tracking-widest line-clamp-1">
                {{ $movie['genre'] }}
                @if($movie['duration']) • {{ $movie['duration'] }} @endif
            </p>
        </div>
        @empty
        <div class="col-span-5 text-center text-gray-500 py-20">No movies found.</div>
        @endforelse
    </div>

</div>

<script>
const initialFilter = '{{ $filter }}';
if (initialFilter !== 'all') {
    document.addEventListener('DOMContentLoaded', () => filterMovies(initialFilter));
}

function filterMovies(status) {
    // Update tabs
    ['all','now','soon'].forEach(t => {
        document.getElementById('tab-' + t).className =
            'px-4 py-1.5 rounded-full text-xs font-bold bg-white/10 text-gray-300 hover:bg-white/20 transition';
    });
    const map = {'all':'all','Now Showing':'now','Coming Soon':'soon'};
    document.getElementById('tab-' + (map[status] || 'all')).className =
        'px-4 py-1.5 rounded-full text-xs font-bold bg-[#E50914] text-white';

    document.querySelectorAll('.movie-card').forEach(card => {
        card.style.display = (status === 'all' || card.dataset.status === status) ? '' : 'none';
    });
}
</script>

</body>
</html>
