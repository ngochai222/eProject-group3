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

        // Tasks assigned to this manager
        $managerId = session('manager_id');
        $myTasks = $managerId
            ? \DB::table('manager_tasks')
                ->where('manager_id', $managerId)
                ->orderBy('date')->orderByDesc('created_at')
                ->get()
            : collect();

        // Revenue by day of week (last 7 days)
        $revenueByDay = [];
        $days = ['Mon','Tue','Wed','Thu','Fri','Sat','Sun'];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $revenue = \DB::table('bookings')
                ->whereDate('created_at', $date->toDateString())
                ->sum('total_price');
            $revenueByDay[] = [
                'day'     => $date->format('D'),
                'revenue' => (float) $revenue,
                'isWeekend' => in_array($date->dayOfWeek, [0, 6]),
            ];
        }
        $maxRevenue = max(array_column($revenueByDay, 'revenue')) ?: 1;

        return view('managers.layout.dashboard', compact(
            'totalMovies', 'totalShowtimes', 'totalReviews', 'avgRating', 'topMovies', 'myTasks', 'revenueByDay', 'maxRevenue'
        ));
    }
    public function showLogin()
    {
        return view('managers.login');
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

