<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CinemaController extends Controller
{
    public function index()
    {
        $cinemas = DB::table('cinema')->paginate(10);
        return view('admin.cinema.index', compact('cinemas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cinema_name'    => 'required|string|max:255',
            'cinema_address' => 'required|string',
        ]);

        DB::table('cinema')->insert([
            'cinema_name'    => $request->cinema_name,
            'cinema_address' => $request->cinema_address,
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);

        return back()->with('success', 'Cinema added successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'cinema_name'    => 'required|string|max:255',
            'cinema_address' => 'required|string',
        ]);

        DB::table('cinema')->where('cinema_id', $id)->update([
            'cinema_name'    => $request->cinema_name,
            'cinema_address' => $request->cinema_address,
            'updated_at'     => now(),
        ]);

        return back()->with('success', 'Cinema updated.');
    }

    public function destroy($id)
    {
        DB::table('cinema')->where('cinema_id', $id)->delete();
        return back()->with('success', 'Cinema deleted.');
    }
}
