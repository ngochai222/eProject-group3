@extends('admin.layout.layout')

@section('content')

<div class="flex justify-between items-center mb-8">
    <h2 class="text-2xl font-bold">🎬 Dashboard</h2>
    <span class="text-gray-400 text-sm">{{ session('admin_email') }}</span>
</div>

{{-- STATS --}}
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
    <div class="card-dark text-center">
        <p class="text-gray-400 text-sm">TOTAL MOVIES</p>
        <h2 class="text-2xl font-bold mt-1">{{ $totalMovies ?? 0 }}</h2>
    </div>
    <div class="card-dark text-center">
        <p class="text-gray-400 text-sm">SHOWTIMES</p>
        <h2 class="text-2xl font-bold mt-1">{{ $totalShowtimes ?? 0 }}</h2>
    </div>
    <div class="card-dark text-center">
        <p class="text-gray-400 text-sm">REVIEWS</p>
        <h2 class="text-2xl font-bold mt-1">{{ $totalReviews ?? 0 }}</h2>
    </div>
    <div class="card-dark text-center">
        <p class="text-gray-400 text-sm">AVG RATING</p>
        <h2 class="text-2xl font-bold mt-1 text-cyan-400">{{ $avgRating ? number_format($avgRating, 1) : '—' }}</h2>
    </div>
</div>

{{-- TOP MOVIES --}}
<div class="card-dark">
    <h3 class="font-bold mb-4">🏆 Top Rated Movies</h3>
    <table class="table table-dark table-bordered text-center align-middle w-full">
        <thead>
            <tr>
                <th>Title</th>
                <th>Genre</th>
                <th>Avg Rating</th>
            </tr>
        </thead>
        <tbody>
            @forelse($topMovies ?? [] as $movie)
            <tr>
                <td>{{ $movie->title }}</td>
                <td>{{ $movie->genre ?? '—' }}</td>
                <td class="text-yellow-400">{{ $movie->reviews_avg_rating ? number_format($movie->reviews_avg_rating, 1) : '—' }}</td>
            </tr>
            @empty
            <tr><td colspan="3" class="text-gray-500">No movies yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
