@extends('admin.layout.layout')

@section('content')

<h2 class="text-2xl font-bold text-white mb-6">🎬 Admin Dashboard</h2>

<!-- CARDS -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-4">

    <!-- Movies -->
    <div class="card-dark text-center">
        <div class="icon-box icon-blue mx-auto mb-3">🎬</div>
        <p class="text-gray-400">Movies</p>
        <h2 class="text-2xl font-bold">{{ $totalMovies ?? 0 }}</h2>
    </div>

    <!-- Showtimes -->
    <div class="card-dark text-center">
        <div class="icon-box icon-green mx-auto mb-3">⏰</div>
        <p class="text-gray-400">Showtimes</p>
        <h2 class="text-2xl font-bold">{{ $totalShowtimes ?? 0 }}</h2>
    </div>

    <!-- Reviews -->
    <div class="card-dark text-center">
        <div class="icon-box icon-yellow mx-auto mb-3">⭐</div>
        <p class="text-gray-400">Reviews</p>
        <h2 class="text-2xl font-bold">{{ $totalReviews ?? 0 }}</h2>
    </div>

    <!-- Rating -->
    <div class="card-dark text-center">
        <div class="icon-box icon-red mx-auto mb-3">📊</div>
        <p class="text-gray-400">Avg Rating</p>
        <h2 class="text-2xl font-bold">
            {{ $avgRating ? number_format($avgRating,1) : 0 }}
        </h2>
    </div>

</div>


<!-- TOP MOVIES -->
<div class="mt-8">

    <h3 class="text-xl font-semibold text-white mb-4">🔥 Top Movies</h3>

    @foreach($topMovies as $movie)
    <div class="card-dark flex items-center justify-between mb-3">

        <div class="flex items-center">
            <img src="https://via.placeholder.com/60x80" class="rounded mr-3">

            <div>
                <p class="font-semibold">{{ $movie->title }}</p>
                <p class="text-gray-400 text-sm">
                    ⭐ {{ number_format($movie->reviews_avg_rating,1) }}
                </p>
            </div>
        </div>

        <span class="bg-yellow-400 text-black px-3 py-1 rounded-lg text-sm">
            Hot
        </span>

    </div>
    @endforeach

</div>

@endsection