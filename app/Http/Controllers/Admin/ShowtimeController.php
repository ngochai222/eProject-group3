<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Showtime;
use App\Models\Movie;

class ShowtimeController extends Controller
{
    // LIST
    public function index()
    {
        $showtimes = Showtime::with('movie')->latest()->get();
        return view('admin.showtimes.index', compact('showtimes'));
    }

    // FORM CREATE
    public function create()
    {
        $movies = Movie::all();
        return view('admin.showtimes.create', compact('movies'));
    }

    // STORE (FIX CHÍNH Ở ĐÂY)
    public function store(Request $request)
    {
        $request->validate([
            'movie_id' => 'required',
            'date' => 'required',
            'time' => 'required',
        ]);

        $movie = Movie::findOrFail($request->movie_id);

        // ghép ngày + giờ
        $start = strtotime($request->date . ' ' . $request->time);

        // auto giờ kết thúc
        $end = $start + ($movie->duration * 60);

        // 🚫 tránh trùng lịch (cùng phòng nếu có room thì thêm điều kiện room)
        $exists = Showtime::where('movie_id', $request->movie_id)
            ->where('start_time', date('Y-m-d H:i:s', $start))
            ->exists();

        if ($exists) {
            return back()->with('error', '⚠️ Suất chiếu đã tồn tại!');
        }

        Showtime::create([
            'movie_id' => $request->movie_id,
            'start_time' => date('Y-m-d H:i:s', $start),
            'end_time' => date('Y-m-d H:i:s', $end),
        ]);

        return redirect()->route('admin.showtimes.index')
            ->with('success', '🎉 Thêm lịch chiếu thành công!');
    }

    // FORM EDIT
    public function edit($id)
    {
        $showtime = Showtime::findOrFail($id);
        $movies = Movie::all();

        return view('admin.showtimes.edit', compact('showtime', 'movies'));
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        $request->validate([
            'movie_id' => 'required',
            'date' => 'required',
            'time' => 'required',
        ]);

        $showtime = Showtime::findOrFail($id);
        $movie = Movie::findOrFail($request->movie_id);

        $start = strtotime($request->date . ' ' . $request->time);
        $end = $start + ($movie->duration * 60);

        $showtime->update([
            'movie_id' => $request->movie_id,
            'start_time' => date('Y-m-d H:i:s', $start),
            'end_time' => date('Y-m-d H:i:s', $end),
        ]);

        return redirect()->route('admin.showtimes.index')
            ->with('success', '✅ Cập nhật thành công!');
    }

    // DELETE
    public function destroy($id)
    {
        Showtime::findOrFail($id)->delete();

        return back()->with('success', '🗑 Xóa thành công!');
    }
}