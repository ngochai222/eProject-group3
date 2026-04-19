<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function profile()
    {
        $user = auth()->guard('customer')->user();

        // Thống kê
        $watched = 23;
        $rated = 5;
        $comments = 0;

        // Danh sách phim vừa xem (ví dụ)
        $recentlyWatched = [
            ['title' => 'Neon Horizon', 'date' => 'Nov 12, 2023', 'poster' => 'neon-horizon.jpg'],
            ['title' => 'The Last Reel', 'date' => 'Oct 28, 2023', 'poster' => 'last-reel.jpg'],
        ];

        return view('layout.customer.profile', compact('user', 'watched', 'rated', 'comments', 'recentlyWatched'));
    }

    public function update(Request $request)
    {
        $user = auth()->guard('customer')->user();

        $validated = $request->validate([
            'customer_address' => 'nullable|string|max:255',
            'customer_avatar' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('customer_avatar')) {
            $file = $request->file('customer_avatar');
            $filename = time() . '_' . preg_replace('/[^A-Za-z0-9_.-]/', '_', $file->getClientOriginalName());
            $destination = public_path('customer_avatars');

            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }

            $file->move($destination, $filename);
            $validated['customer_avatar'] = 'customer_avatars/' . $filename;
        }

        $user->update([
            'customer_address' => $validated['customer_address'] ?? $user->customer_address,
            'customer_avatar' => $validated['customer_avatar'] ?? $user->customer_avatar,
        ]);

        return redirect()->route('profile')->with('success', 'Profile updated successfully.');
    }
}
