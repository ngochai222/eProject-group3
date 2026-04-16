<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Models\Showtime;
use App\Models\Review;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalMovies = Movie::count();
        $totalShowtimes = Showtime::count();
        $totalReviews = Review::count();
        $avgRating = Review::avg('rating');

        $topMovies = Movie::withAvg('reviews', 'rating')
            ->orderByDesc('reviews_avg_rating')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalMovies',
            'totalShowtimes',
            'totalReviews',
            'avgRating',
            'topMovies'
        ));
    }
}