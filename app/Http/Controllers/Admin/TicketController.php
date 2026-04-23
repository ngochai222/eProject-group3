<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller
{
    public function index()
    {
        $bookings = DB::table('bookings')
            ->leftJoin('showtimes', 'bookings.showtime_id', '=', 'showtimes.id')
            ->leftJoin('movies', 'showtimes.movie_id', '=', 'movies.id')
            ->select(
                'bookings.id',
                'bookings.customer_name',
                'bookings.customer_email',
                'bookings.seats',
                'bookings.price',
                'movies.title as movie_title',
                'showtimes.start_time',
                'bookings.total_price',
                'bookings.status',
                'bookings.created_at'
            )
            ->orderByDesc('bookings.created_at')
            ->paginate(20);

        $todayRevenue = DB::table('bookings')->whereDate('created_at', today())->sum('total_price');
        $totalBooked  = DB::table('bookings')->count();
        $validated    = DB::table('bookings')->where('status', 'confirmed')->count();

        return view('managers.tickets.index', compact('bookings', 'todayRevenue', 'totalBooked', 'validated'));
    }

    public function destroy($id)
    {
        DB::table('bookings')->where('id', $id)->delete();
        return back()->with('success', 'Booking deleted.');
    }
}


