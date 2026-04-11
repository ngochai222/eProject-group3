<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Seat;
use App\Models\Room;
use App\Models\Ticket;

class SeatController extends Controller
{
    public function index()
    {
        $seats = Seat::with('room')->get();
        return view('seats.index', compact('seats'));
    }

    public function create()
    {
        $rooms = Room::all();
        return view('seats.create', compact('rooms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'seat_number' => 'required',
            'row' => 'required',
            'column' => 'required|integer',
            'type' => 'required'
        ]);

        Seat::create($request->all());

        return redirect()->route('seats.index')->with('success');
    }

    public function show($id)
    {
        $seat = Seat::with('room')->findOrFail($id);
        return view('seats.show', compact('seat'));
    }

    public function edit($id)
    {
        $seat = Seat::findOrFail($id);
        $rooms = Room::all();

        return view('seats.edit', compact('seat', 'rooms'));
    }
    public function update(Request $request, $id)
    {
        $seat = Seat::findOrFail($id);

        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'seat_number' => 'required',
            'row' => 'required',
            'column' => 'required|integer',
            'type' => 'required'
        ]);

        $seat->update($request->all());

        return redirect()->route('seats.index')->with('success');
    }

    public function destroy($id)
    {
        Seat::destroy($id);
        return redirect()->route('seats.index')->with('success');
    }

    public function getSeatsByShowtime($showtime_id)
    {
        $seats = Seat::all();

        $bookedSeats = Ticket::where('showtime_id', $showtime_id)
            ->pluck('seat_id')
            ->toArray();

        foreach ($seats as $seat) {
            $seat->is_booked = in_array($seat->id, $bookedSeats);
        }

        return response()->json($seats);
    }
}
