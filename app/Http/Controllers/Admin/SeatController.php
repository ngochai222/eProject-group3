<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SeatController extends Controller
{
    public function index(Request $request)
    {
        $cinemas = DB::table('cinema')->get();

        $rooms = collect();
        if ($request->cinema_id) {
            $rooms = DB::table('rooms')->where('cinema_id', $request->cinema_id)->get();
        }

        $selectedRoom = null;
        $seats = collect();

        if ($request->room_id) {
            $selectedRoom = DB::table('rooms')->where('id', $request->room_id)->first();
            $seats = DB::table('seats')->where('room_id', $request->room_id)->orderBy('row')->orderBy('column')->get();
        }

        return view('managers.seats.index', compact('cinemas', 'rooms', 'selectedRoom', 'seats'));
    }

    public function generate(Request $request)
    {
        $request->validate([
            'room_id'  => 'required|exists:rooms,id',
            'rows'     => 'required|integer|min:1|max:26',
            'cols'     => 'required|integer|min:1|max:20',
            'vip_rows' => 'nullable|string',
        ]);

        // Xóa ghế cũ
        DB::table('seats')->where('room_id', $request->room_id)->delete();

        $vipRows = $request->vip_rows
            ? array_map('strtoupper', array_map('trim', explode(',', $request->vip_rows)))
            : [];

        $rowLetters = range('A', chr(64 + $request->rows));

        foreach ($rowLetters as $row) {
            for ($col = 1; $col <= $request->cols; $col++) {
                $type = in_array($row, $vipRows) ? 'vip' : 'standard';
                DB::table('seats')->insert([
                    'room_id'     => $request->room_id,
                    'seat_number' => $row . $col,
                    'row'         => $row,
                    'column'      => $col,
                    'seat_type'   => $type,
                    'created_at'  => now(),
                    'updated_at'  => now(),
                ]);
            }
        }

        return redirect()->route('admin.seats.index', ['room_id' => $request->room_id])
            ->with('success', 'Seats generated successfully.');
    }

    public function updateType(Request $request, $id)
    {
        $type = $request->input('seat_type') ?? $request->json('seat_type');
        DB::table('seats')->where('id', $id)->update([
            'seat_type'  => $type,
            'updated_at' => now(),
        ]);

        if ($request->expectsJson() || $request->isJson()) {
            return response()->json(['success' => true]);
        }
        return back()->with('success', 'Seat updated.');
    }

    public function destroy($id)
    {
        DB::table('seats')->where('id', $id)->delete();
        return back()->with('success', 'Seat deleted.');
    }
}


