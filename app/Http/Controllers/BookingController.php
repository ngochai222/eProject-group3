<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Showtime;
use App\Models\Seat;
use App\Models\Ticket;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    public function index()
    {     $bookings = Booking::with(['showtime', 'seat'])->where('user_id', auth()->id())->get();     
        return view('Booking.index', compact('bookings'));
    }

    public function create($showtime_id)
    {
        $showtime = Showtime::findOrFail($showtime_id);
        $seats = Seat::where('room_id', $showtime->room_id)->get();

        return view('Booking.create', compact('showtime', 'seats'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'showtime_id' => 'required|exists:showtimes,id',
            'seat_id' => 'required|exists:seats,id',
        ]);

        $exists = Booking::where('showtime_id', $request->showtime_id)
            ->where('seat_id', $request->seat_id)
            ->exists();

        if ($exists) {
            return back()->with('error', 'This seat is already booked!');
        }

        $booking = Booking::create([
            'user_id' => auth()->id(),
            'showtime_id' => $request->showtime_id,
            'seat_id' => $request->seat_id,
            'customer_name' => auth()->user()->name,
            'customer_email' => auth()->user()->email,
            'price' => $request->price ?? 0,
        ]);

        // Create ticket
        Ticket::create([
            'booking_id' => $booking->id,
            'seat_id' => $request->seat_id,
            'price' => $request->price ?? 0,
            'ticket_code' => strtoupper(Str::random(10)),
            'booking_time' => now(),
        ]);

        return redirect()->route('booking.index')
            ->with('success', 'Booking successful!');
    }

    public function show($id)
    {
        $booking = Booking::with(['showtime', 'seat'])->findOrFail($id);
        return view('Booking.show', compact('booking'));
    }
    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()->route('booking.index')
            ->with('success', 'Booking cancelled!');
    }
}