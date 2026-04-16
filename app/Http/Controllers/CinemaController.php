<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cinema;

class CinemaController extends Controller
{
    public function index()
    {
        $cinemas = Cinema::all();
        return view('cinema.index', compact('cinemas'));
    }

    public function create()
    {
        return view('cinema.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'location' => 'required',
        ]);

        Cinema::create($request->all());

        return redirect()->route('cinema.index')
            ->with('success', 'Cinema created successfully!');
    }

    public function show($id)
    {
        $cinema = Cinema::findOrFail($id);
        return view('cinema.show', compact('cinema'));
    }

    public function edit($id)
    {
        $cinema = Cinema::findOrFail($id);
        return view('cinema.edit', compact('cinema'));
    }

    public function update(Request $request, $id)
    {
        $cinema = Cinema::findOrFail($id);

        $cinema->update($request->all());

        return redirect()->route('cinema.index')
            ->with('success', 'Cinema updated!');
    }

    public function destroy($id)
    {
        Cinema::findOrFail($id)->delete();

        return redirect()->route('cinema.index')
            ->with('success', 'Cinema deleted!');
    }
}