<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Cinema;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::with('cinema')->get();
        return view('room.index', compact('rooms'));
    }

    public function create()
    {
        $cinemas = Cinema::all();
        return view('room.create', compact('cinemas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cinema_id' => 'required|exists:cinemas,id',
            'name' => 'required',
            'capacity' => 'required|integer',
        ]);

        Room::create($request->all());

        return redirect()->route('room.index')
            ->with('success', 'Room created successfully!');
    }

    public function show($id)
    {
        $room = Room::with('cinema')->findOrFail($id);
        return view('room.show', compact('room'));
    }

    public function edit($id)
    {
        $room = Room::findOrFail($id);
        $cinemas = Cinema::all();

        return view('room.edit', compact('room', 'cinemas'));
    }

    public function update(Request $request, $id)
    {
        $room = Room::findOrFail($id);

        $room->update($request->all());

        return redirect()->route('room.index')
            ->with('success', 'Room updated!');
    }

    public function destroy($id)
    {
        Room::findOrFail($id)->delete();

        return redirect()->route('room.index')
            ->with('success', 'Room deleted!');
    }
}