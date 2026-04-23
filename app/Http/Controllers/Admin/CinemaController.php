<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CinemaController extends Controller
{
    public function edit($id)
    {
        $cinema = DB::table('cinema')->where('cinema_id', $id)->first();
        return view('managers.cinema.edit', compact('cinema'));
    }

    public function create()
    {
        return view('managers.cinema.create');
    }

    public function index()
    {
        $cinemas = DB::table('cinema')
            ->leftJoin('rooms', 'cinema.cinema_id', '=', 'rooms.cinema_id')
            ->select('cinema.*', DB::raw('COUNT(rooms.id) as room_count'))
            ->groupBy('cinema.cinema_id', 'cinema.cinema_name', 'cinema.cinema_address', 'cinema.cinema_image', 'cinema.created_at', 'cinema.updated_at')
            ->paginate(10);
        return view('managers.cinema.index', compact('cinemas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cinema_name'    => 'required|string|max:255',
            'cinema_address' => 'required|string',
            'cinema_image'   => 'nullable|image|max:2048',
        ]);

        $imageName = null;
        if ($request->hasFile('cinema_image')) {
            $file = $request->file('cinema_image');
            $imageName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $imageName);
        }

        DB::table('cinema')->insert([
            'cinema_name'    => $request->cinema_name,
            'cinema_address' => $request->cinema_address,
            'cinema_image'   => $imageName,
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);

        // Auto-create rooms
        $cinemaId = DB::getPdo()->lastInsertId();
        $numRooms = (int) $request->num_rooms;
        $capacity = (int) $request->capacity ?: 100;
        for ($i = 1; $i <= $numRooms; $i++) {
            DB::table('rooms')->insert([
                'cinema_id'    => $cinemaId,
                'rooms_number' => 'R' . $i,
                'name'         => 'Room ' . $i,
                'capacity'     => $capacity,
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);
        }

        return back()->with('success', 'Cinema added successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'cinema_name'    => 'required|string|max:255',
            'cinema_address' => 'required|string',
            'cinema_image'   => 'nullable|image|max:2048',
        ]);

        $data = [
            'cinema_name'    => $request->cinema_name,
            'cinema_address' => $request->cinema_address,
            'updated_at'     => now(),
        ];

        if ($request->hasFile('cinema_image')) {
            $file = $request->file('cinema_image');
            $imageName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $imageName);
            $data['cinema_image'] = $imageName;
        }

        DB::table('cinema')->where('cinema_id', $id)->update($data);

        return back()->with('success', 'Cinema updated.');
    }

    public function destroy($id)
    {
        DB::table('cinema')->where('cinema_id', $id)->delete();
        return back()->with('success', 'Cinema deleted.');
    }
}


