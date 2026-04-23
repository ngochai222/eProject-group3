<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Showtime;
use App\Http\Controllers\Admin\PricingController;

class TicketBuyController extends Controller
{
    public function myTickets()
    {
        $customer = auth()->guard('customer')->user();
        $bookings = \DB::table('bookings')
            ->join('showtimes', 'bookings.showtime_id', '=', 'showtimes.id')
            ->join('movies', 'showtimes.movie_id', '=', 'movies.id')
            ->where('bookings.user_id', $customer->customer_id)
            ->select(
                'bookings.id',
                'bookings.seats',
                'movies.title',
                'movies.poster',
                'movies.genre',
                'showtimes.start_time',
                'showtimes.end_time',
                'bookings.total_price',
                'bookings.status',
                'bookings.created_at'
            )
            ->orderByDesc('bookings.created_at')
            ->get();

        return view('tickets.my', compact('bookings'));
    }

    public function seat(\Illuminate\Http\Request $request)
    {
        $showtimeId = $request->query('showtime');
        $cinemaId   = $request->query('cinema');
        $showtime   = Showtime::with('movie')->findOrFail($showtimeId);
        $cinema     = \DB::table('cinema')->where('cinema_id', $cinemaId)->first();
        $price      = PricingController::getPriceForDate($showtime->start_time, $showtime->movie->base_price ?? null);

        // Lấy ghế từ DB theo room của showtime
        $dbSeats = collect();
        if ($showtime->room_id) {
            $dbSeats = \DB::table('seats')
                ->where('room_id', $showtime->room_id)
                ->orderBy('row')->orderBy('column')
                ->get();
        }

        // Lấy ghế đã booked cho showtime này
        $bookedSeats = \DB::table('bookings')
            ->where('showtime_id', $showtimeId)
            ->whereNotNull('seats')
            ->pluck('seats')
            ->flatMap(fn($s) => explode(',', $s))
            ->filter()
            ->values()
            ->toArray();

        return view('tickets.seat', compact('showtime', 'cinema', 'price', 'bookedSeats', 'dbSeats'));
    }

    public function buy(Request $request)
    {
        $showtimeId = $request->query('showtime');
        $showtime = Showtime::with(['movie'])->findOrFail($showtimeId);
        $price = PricingController::getPriceForDate($showtime->start_time, $showtime->movie->base_price ?? null);
        return view('tickets.buy', compact('showtime', 'price'));
    }

    public function confirm(Request $request)
    {
        if (!auth()->guard('customer')->check()) {
            return redirect()->route('login');
        }

        $request->validate([
            'showtime_id'      => 'required|exists:showtimes,id',
            'quantity'         => 'required|integer|min:1|max:50',
            'price_per_ticket' => 'required|numeric|min:0',
        ]);

        $quantity = (int) $request->quantity;
        $pricePerTicket = (float) $request->price_per_ticket;
        $discountAmount = (float) $request->discount_amount;
        $totalPrice = max(0, ($quantity * $pricePerTicket) - $discountAmount);

        $customer = auth()->guard('customer')->user();
        $seats = array_filter(explode(',', $request->seats));

        // Tạo 1 booking riêng cho mỗi ghế
        foreach ($seats as $seat) {
            \DB::table('bookings')->insert([
                'user_id'       => $customer->customer_id,
                'showtime_id'   => $request->showtime_id,
                'seat_id'       => null,
                'customer_name' => $customer->customer_name,
                'customer_email'=> $customer->customer_email,
                'total_price'   => $pricePerTicket,
                'price'         => $pricePerTicket,
                'status'        => 'confirmed',
                'seats'         => trim($seat),
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);
        }

        return redirect()->route('home')->with('success', 'Booking confirmed! Enjoy the movie.');
    }
}

