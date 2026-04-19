<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Models\Showtime;
use App\Models\Review;
use Illuminate\Http\Request;

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

        return view('admin.layout.dashboard', compact(
            'totalMovies',
            'totalShowtimes',
            'totalReviews',
            'avgRating',
            'topMovies'
        ));
    }
    public function showLogin()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $email = trim($request->input('email'));
        $password = $request->input('password');

        \Log::info('Admin login attempt', ['email' => $email, 'password' => $password, 'match' => ($email === 'admin@gmail.com' && $password === '123456')]);

        if ($email === 'admin@gmail.com' && $password === '123456') {
            session(['admin_logged_in' => true, 'admin_email' => $email]);
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'email' => 'Thông tin đăng nhập không chính xác.',
        ]);
    }


    public function logout(Request $request)
    {
        // Clear admin session
        $request->session()->forget(['admin_logged_in', 'admin_email']);

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
    
}