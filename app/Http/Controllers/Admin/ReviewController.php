<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Movie;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with('movie')->latest()->get();
        $totalReviews = $reviews->count();
        $avgRating = $reviews->avg('rating');
        $fiveStars = $reviews->where('rating', 5)->count();
        return view('managers.reviews.index', compact('reviews', 'totalReviews', 'avgRating', 'fiveStars'));
    }

    public function destroy($id)
    {
        Review::findOrFail($id)->delete();
        return back()->with('success', 'Review deleted.');
    }
}

