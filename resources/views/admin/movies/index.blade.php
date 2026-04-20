@extends('admin.layout.layout')

@section('content')

{{-- HEADER --}}
<div class="flex justify-between items-center mb-2">
    <div>
        <h2 class="text-2xl font-bold text-white">Movie Library</h2>
        <p class="text-sm mt-1 flex items-center gap-2">
            <span class="w-2 h-2 rounded-full bg-cyan-400 inline-block"></span>
            <span class="text-cyan-400">Shift Active: Morning Matinee (08:00 - 16:00)</span>
        </p>
    </div>
    <div class="flex items-center gap-3">
        <span class="text-gray-400 text-sm">User</span>
        <div class="w-10 h-10 rounded-full bg-gray-600 flex items-center justify-center">
            <i class="fa fa-user text-white"></i>
        </div>
    </div>
</div>

{{-- STATS --}}
<div class="grid grid-cols-3 gap-4 mb-6">
    <div class="bg-[#11161c] rounded-xl p-5">
        <p class="text-xs text-gray-500 uppercase tracking-widest mb-1">Total Movies</p>
        <h2 class="text-3xl font-black text-yellow-400">{{ str_pad($movies->count(), 2, '0', STR_PAD_LEFT) }}</h2>
    </div>
    <div class="bg-[#11161c] rounded-xl p-5">
        <p class="text-xs text-gray-500 uppercase tracking-widest mb-1">Currently Showing</p>
        <h2 class="text-3xl font-black text-cyan-400">
            {{ str_pad($movies->filter(function($m) {
                $release = $m->release_date ? \Carbon\Carbon::parse($m->release_date) : null;
                return $release && $release->between(now(), now()->addMonth());
            })->count(), 2, '0', STR_PAD_LEFT) }}
        </h2>
    </div>
    <div class="bg-[#11161c] rounded-xl p-5">
        <p class="text-xs text-gray-500 uppercase tracking-widest mb-1">Coming soon
            
        </p>
        <h2 class="text-3xl font-black text-white">142</h2>
    </div>
</div>

{{-- ADD BUTTON --}}
<a href="{{ route('admin.movies.create') }}"
   class="inline-block bg-yellow-400 text-black font-bold px-5 py-2 rounded-lg hover:bg-yellow-300 transition mb-6">
    + Add New Movie
</a>

{{-- TABLE CARD --}}
<div class="bg-[#11161c] rounded-2xl overflow-hidden">

    {{-- SEARCH & FILTER --}}
    <div class="flex gap-3 p-4 border-b border-gray-800">
        <div class="relative flex-1 max-w-sm">
            <i class="fa fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-xs"></i>
            <input type="text" id="searchInput" placeholder="Search by title, genre, or director..."
                class="w-full bg-[#0f172a] text-white text-sm pl-8 pr-4 py-2 rounded-lg border border-gray-700 focus:border-yellow-400 outline-none">
        </div>
        <div class="relative">
            <i class="fa fa-filter absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-xs"></i>
            <select id="genreFilter"
                class="bg-[#0f172a] text-gray-300 text-sm pl-8 pr-4 py-2 rounded-lg border border-gray-700 focus:border-yellow-400 outline-none appearance-none">
                <option value="">Genre: All</option>
                @foreach($movies->pluck('genre')->filter()->unique() as $genre)
                    <option value="{{ strtolower($genre) }}">{{ $genre }}</option>
                @endforeach
            </select>
        </div>
        <div class="relative">
            <i class="fa fa-calendar absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-xs"></i>
            <select id="yearFilter"
                class="bg-[#0f172a] text-gray-300 text-sm pl-8 pr-4 py-2 rounded-lg border border-gray-700 focus:border-yellow-400 outline-none appearance-none">
                <option value="">Release Year</option>
                @foreach($movies->pluck('release_date')->filter()->map(fn($d) => \Carbon\Carbon::parse($d)->year)->unique()->sortDesc() as $year)
                    <option value="{{ $year }}">{{ $year }}</option>
                @endforeach
            </select>
        </div>
    </div>

    {{-- TABLE --}}
    <table class="w-full text-sm">
        <thead>
            <tr class="text-gray-500 text-xs uppercase tracking-widest border-b border-gray-800">
                <th class="px-5 py-3 text-left">Movie Poster & Title</th>
                <th class="px-4 py-3 text-center">Genre</th>
                <th class="px-4 py-3 text-center">Release Date</th>
                <th class="px-4 py-3 text-center">Status</th>
                <th class="px-4 py-3 text-center">Rating</th>
                <th class="px-4 py-3 text-center">Actions</th>
            </tr>
        </thead>
        <tbody id="movieTableBody">
            @forelse($movies as $movie)
            @php
                $now = now();
                $oneMonthLater = $now->copy()->addMonth();
                $release = $movie->release_date ? \Carbon\Carbon::parse($movie->release_date) : null;

                if ($release && $release->between($now, $oneMonthLater)) {
                    $status = 'Currently Showing';
                } elseif ($release && $release->isFuture()) {
                    $status = 'Coming Soon';
                } else {
                    $status = 'Ended';
                }
                $year = $release ? $release->year : '';
            @endphp
            <tr class="movie-row border-b border-gray-800/50 hover:bg-white/5 transition"
                data-title="{{ strtolower($movie->title) }}"
                data-genre="{{ strtolower($movie->genre ?? '') }}"
                data-year="{{ $year }}">

                <td class="px-5 py-3">
                    <div class="flex items-center gap-3">
                        @if($movie->poster)
                            <img src="{{ asset('uploads/'.$movie->poster) }}"
                                 class="w-10 h-14 rounded object-cover flex-shrink-0">
                        @else
                            <div class="w-10 h-14 bg-gray-700 rounded flex-shrink-0 flex items-center justify-center">
                                <i class="fa fa-film text-gray-500 text-xs"></i>
                            </div>
                        @endif
                        <div>
                            <p class="font-semibold text-white">{{ $movie->title }}</p>
                            @if($movie->cast)
                                <p class="text-xs text-gray-500 mt-0.5">{{ Str::limit($movie->cast, 30) }}</p>
                            @endif
                        </div>
                    </div>
                </td>

                <td class="px-4 py-3 text-center">
                    @if($movie->genre)
                        <div class="flex flex-wrap gap-1 justify-center">
                            @foreach(explode(',', $movie->genre) as $g)
                                <span class="px-2 py-0.5 bg-cyan-500/10 text-cyan-400 text-xs rounded-full border border-cyan-500/20 whitespace-nowrap">
                                    {{ trim($g) }}
                                </span>
                            @endforeach
                        </div>
                    @else
                        <span class="text-gray-600">—</span>
                    @endif
                </td>

                <td class="px-4 py-3 text-center text-gray-400 text-xs">
                    {{ $movie->release_date ?? '—' }}
                </td>

                <td class="px-4 py-3 text-center">
                    @if($status == 'Currently Showing')
                        <span class="inline-flex items-center gap-1 text-xs text-green-400">
                            <span class="w-1.5 h-1.5 rounded-full bg-green-400"></span> Currently Showing
                        </span>
                    @elseif($status == 'Coming Soon')
                        <span class="inline-flex items-center gap-1 text-xs text-yellow-400">
                            <span class="w-1.5 h-1.5 rounded-full bg-yellow-400"></span> Coming Soon
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1 text-xs text-gray-500">
                            <span class="w-1.5 h-1.5 rounded-full bg-gray-500"></span> Ended
                        </span>
                    @endif
                </td>

                <td class="px-4 py-3 text-center text-yellow-400 font-bold text-sm">
                    ★ {{ number_format($movie->reviews_avg_rating ?? 0, 1) }}
                </td>

                <td class="px-4 py-3 text-center">
                    <div class="flex items-center justify-center gap-3">
                        <a href="{{ route('admin.movies.edit', $movie->id) }}"
                           class="text-gray-400 hover:text-yellow-400 transition" title="Edit">
                            <i class="fa fa-pencil"></i>
                        </a>
                        <form action="{{ route('admin.movies.destroy', $movie->id) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-gray-400 hover:text-red-400 transition"
                                onclick="return confirm('Delete this movie?')" title="Delete">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="px-5 py-10 text-center text-gray-500">No movies found.</td></tr>
            @endforelse
        </tbody>
    </table>

    {{-- PAGINATION --}}
    <div class="flex justify-between items-center px-5 py-4 border-t border-gray-800 text-sm text-gray-500">
        <p>Showing 1 to {{ $movies->count() }} movies</p>
    </div>
</div>

<script>
document.getElementById('searchInput').addEventListener('input', filterTable);
document.getElementById('genreFilter').addEventListener('change', filterTable);
document.getElementById('yearFilter').addEventListener('change', filterTable);

function filterTable() {
    const search = document.getElementById('searchInput').value.toLowerCase();
    const genre  = document.getElementById('genreFilter').value.toLowerCase();
    const year   = document.getElementById('yearFilter').value;

    document.querySelectorAll('.movie-row').forEach(row => {
        const matchSearch = !search || row.dataset.title.includes(search) || row.dataset.genre.includes(search);
        const matchGenre  = !genre  || row.dataset.genre.includes(genre);
        const matchYear   = !year   || row.dataset.year === year;
        row.style.display = (matchSearch && matchGenre && matchYear) ? '' : 'none';
    });
}
</script>

@endsection
