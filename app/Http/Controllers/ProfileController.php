<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function profile()
    {
        $user = auth()->guard('customer')->user();

        $totalTickets = \DB::table('bookings')->where('user_id', $user->customer_id)->count();

        // Upcoming tickets (showtime in the future)
        $unusedTickets = \DB::table('bookings')
            ->join('showtimes', 'bookings.showtime_id', '=', 'showtimes.id')
            ->join('movies', 'showtimes.movie_id', '=', 'movies.id')
            ->where('bookings.user_id', $user->customer_id)
            ->where('showtimes.start_time', '>=', now())
            ->select('movies.title', 'movies.poster', 'showtimes.start_time', 'bookings.seats', 'bookings.total_price')
            ->orderBy('showtimes.start_time')
            ->get();

        // Recently watched (showtime in the past)
        $recentlyWatched = \DB::table('bookings')
            ->join('showtimes', 'bookings.showtime_id', '=', 'showtimes.id')
            ->join('movies', 'showtimes.movie_id', '=', 'movies.id')
            ->where('bookings.user_id', $user->customer_id)
            ->where('showtimes.start_time', '<', now())
            ->select('movies.title', 'movies.poster', 'showtimes.start_time')
            ->orderByDesc('showtimes.start_time')
            ->distinct('movies.title')
            ->limit(6)
            ->get();

        return view('layout.customer.profile', compact('user', 'totalTickets', 'unusedTickets', 'recentlyWatched'));
    }

    public function update(Request $request)
    {
        $user = auth()->guard('customer')->user();

        $validated = $request->validate([
            'customer_name'          => 'required|string|max:255',
            'customer_phone'         => 'nullable|string|max:20',
            'customer_address'       => 'nullable|string|max:255',
            'customer_gender'        => 'nullable|in:Male,Female,Other',
            'customer_date_of_birth' => 'nullable|date|before:today',
            'customer_avatar'        => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('customer_avatar')) {
            $file = $request->file('customer_avatar');
            $filename = time() . '_' . preg_replace('/[^A-Za-z0-9_.-]/', '_', $file->getClientOriginalName());
            $destination = public_path('customer_avatars');
            if (!file_exists($destination)) mkdir($destination, 0755, true);
            $file->move($destination, $filename);
            $validated['customer_avatar'] = 'customer_avatars/' . $filename;
        }

        $user->update([
            'customer_name'          => $validated['customer_name'],
            'customer_phone'         => $validated['customer_phone'] ?? $user->customer_phone,
            'customer_address'       => $validated['customer_address'] ?? $user->customer_address,
            'customer_gender'        => $validated['customer_gender'] ?? $user->customer_gender,
            'customer_date_of_birth' => $validated['customer_date_of_birth'] ?? $user->customer_date_of_birth,
            'customer_avatar'        => $validated['customer_avatar'] ?? $user->customer_avatar,
        ]);

        return redirect()->route('profile')->with('success', 'Profile updated successfully.');
    }
}

