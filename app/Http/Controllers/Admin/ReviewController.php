<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Movie;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with('movie')->latest()->get();
        return view('admin.reviews.index', compact('reviews'));
    }

    public function create()
    {
        $movies = Movie::all();
        return view('admin.reviews.create', compact('movies'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'movie_id' => 'required',
            'user_name' => 'required',
            'comment' => 'required',
            'rating' => 'required|integer|min:1|max:5',
            'image' => 'nullable|image'
        ]);

        // upload ảnh
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads'), $name);
            $data['image'] = $name;
        }

        Review::create($data);

        return redirect()->route('admin.reviews.index')
            ->with('success', '⭐ Review thành công!');
    }

    public function destroy($id)
    {
        Review::findOrFail($id)->delete();
        return back()->with('success', '🗑 Đã xóa!');
    }
}