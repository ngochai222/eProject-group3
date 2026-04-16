<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Showtime;
use App\Models\Movie;
use App\Models\Room; 

class ShowtimeController extends Controller
{
    public function index()
    {
        $showtimes = Showtime::with(['movie', 'room.cinema'])->get();
        return view('showtime.index', compact('showtimes'));
    }
    public function create()
    {
        $movies = Movie::all();
        $rooms = Room::with('cinema')->get();

        return view('showtime.create', compact('movies', 'rooms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'movie_id' => 'required|exists:movies,id',
            'room_id' => 'required|exists:rooms,id',
            'start_time' => 'required|date',
        ]);

        Showtime::create([
            'movie_id' => $request->movie_id,
            'room_id' => $request->room_id,
            'start_time' => $request->start_time,
        ]);

        return redirect()->route('showtime.index')
            ->with('success', 'Showtime created successfully!');
    }

    public function show($id)
    {
        $showtime = Showtime::with(['movie', 'room.cinema'])->findOrFail($id);
        return view('showtime.show', compact('showtime'));
    }

    public function edit($id)
    {
        $showtime = Showtime::findOrFail($id);
        $movies = Movie::all();
        $rooms = Room::all();

        return view('showtime.edit', compact('showtime', 'movies', 'rooms'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'movie_id' => 'required|exists:movies,id',
            'room_id' => 'required|exists:rooms,id',
            'start_time' => 'required|date',
        ]);

        $showtime = Showtime::findOrFail($id);

        $showtime->update([
            'movie_id' => $request->movie_id,
            'room_id' => $request->room_id,
            'start_time' => $request->start_time,
        ]);

        return redirect()->route('showtime.index')
            ->with('success', 'Showtime updated successfully!');
    }

    public function destroy($id)
    {
        $showtime = Showtime::findOrFail($id);
        $showtime->delete();

        return redirect()->route('showtime.index')
            ->with('success', 'Showtime deleted!');
    }
}
