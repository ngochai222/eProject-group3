<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::all();
        return view('admin.movies.index', compact('movies'));
    }

    public function create()
    {
        return view('admin.movies.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'duration' => 'nullable|integer',
            'release_date' => 'nullable|date',
            'poster' => 'nullable|image'
        ]);

        // upload poster
        if ($request->hasFile('poster')) {
            $file = $request->file('poster');
            $name = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads'), $name);
            $data['poster'] = $name;
        }

        Movie::create($data);

        return redirect()->route('admin.movies.index');
    }

    public function edit(string $id)
    {
        $movie = Movie::findOrFail($id);
        return view('admin.movies.edit', compact('movie'));
    }

    public function update(Request $request, string $id)
    {
        $movie = Movie::findOrFail($id);

        $data = $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'duration' => 'nullable|integer',
            'release_date' => 'nullable|date',
            'poster' => 'nullable|image'
        ]);

        // update poster
        if ($request->hasFile('poster')) {
            if ($movie->poster && File::exists(public_path('uploads/'.$movie->poster))) {
                File::delete(public_path('uploads/'.$movie->poster));
            }

            $file = $request->file('poster');
            $name = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads'), $name);
            $data['poster'] = $name;
        }

        $movie->update($data);

        return redirect()->route('admin.movies.index');
    }

    public function destroy(string $id)
    {
        $movie = Movie::findOrFail($id);

        if ($movie->poster && File::exists(public_path('uploads/'.$movie->poster))) {
            File::delete(public_path('uploads/'.$movie->poster));
        }

        $movie->delete();

        return redirect()->route('admin.movies.index');
    }
}