<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Showtime;
use App\Models\Seat;
use App\Models\Support\Str;
use App\Models\Ticket;
class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::with(['showtime', 'seat', 'user'])->latest()->get();
        return view('tickets.index', compact('tickets'));
    }

    public function create()
    {
        $showtimes = Showtime::all();
        $seats = Seat::all();

        return view('tickets.create', compact('showtimes', 'seats'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'showtime_id' => 'required|exists:showtimes,id',
            'seat_id' => 'required|exists:seats,id',
            'price' => 'required|numeric'
        ]);
        $isBooked = Ticket::where('showtime_id', $request->showtime_id)
            ->where('seat_id', $request->seat_id)
            ->exists();

        if ($isBooked) {
            return back()->with('error');
        }
        Ticket::create([
            'user_id' => auth()->id() ?? 1,
            'showtime_id' => $request->showtime_id,
            'seat_id' => $request->seat_id,
            'price' => $request->price,
            'status' => 'booked',
            'ticket_code' => strtoupper(Str::random(10)),
            'booking_time' => now(),
            'payment_method' => $request->payment_method ?? 'cash'
        ]);

        return redirect()->route('tickets.index')->with('success');
    }

    public function show($id)
    {
        $ticket = Ticket::with(['showtime', 'seat', 'user'])->findOrFail($id);
        return view('tickets.show', compact('ticket'));
    }

    public function edit($id)
    {
        $ticket = Ticket::findOrFail($id);
        $showtimes = Showtime::all();
        $seats = Seat::all();

        return view('tickets.edit', compact('ticket', 'showtimes', 'seats'));
    }

    public function update(Request $request, $id)
    {
        $ticket = Ticket::findOrFail($id);

        $ticket->update([
            'showtime_id' => $request->showtime_id,
            'seat_id' => $request->seat_id,
            'price' => $request->price,
            'status' => $request->status
        ]);

        return redirect()->route('tickets.index')->with('success');
    }

    public function destroy($id)
    {
        $ticket = Ticket::findOrFail($id);

        $ticket->update([
            'status' => 'cancelled'
        ]);

        return redirect()->route('tickets.index')->with('success');
    }
}

