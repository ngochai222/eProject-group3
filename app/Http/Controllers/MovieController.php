<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index()
    {
        $now = \Carbon\Carbon::now();
        $oneMonthLater = $now->copy()->addMonth();

        $allMovies = \App\Models\Movie::all();
        $hotMovies = [];
        $comingSoonMovies = [];

        foreach ($allMovies as $m) {
            $release = $m->release_date ? \Carbon\Carbon::parse($m->release_date) : null;
            if ($release && $release->isFuture()) {
                // Chưa tới ngày phát hành
                $comingSoonMovies[] = [
                    'id'           => $m->id,
                    'title'        => $m->title,
                    'genre'        => $m->genre ?? '',
                    'release_date' => $m->release_date ? $release->format('M Y') : '',
                    'image'        => $m->poster ? asset('uploads/' . $m->poster) : 'https://via.placeholder.com/300x450?text=No+Image',
                ];
            } elseif ($release && $release->lte($now) && $release->gte($now->copy()->subMonth())) {
                // Trong 1 tháng kể từ ngày phát hành
                $hotMovies[] = [
                    'id'       => $m->id,
                    'title'    => $m->title,
                    'genre'    => $m->genre ?? '',
                    'duration' => $m->duration ? $m->duration . ' min' : '',
                    'image'    => $m->poster ? asset('uploads/' . $m->poster) : 'https://via.placeholder.com/300x450?text=No+Image',
                ];
            }
            // Nếu muốn lấy danh sách Ended thì có thể bổ sung thêm ở đây
        }

        return view('homepage', compact('hotMovies', 'comingSoonMovies'));
    }

    public function cinema()
    {
        return view('cinema');
    }

    public function showtimeDetail($id)
    {
        $movie = \App\Models\Movie::with(['showtimes' => function($q) {
            $q->where('start_time', '>=', now())->orderBy('start_time');
        }])->findOrFail($id);

        $cinemas = \DB::table('cinema')->select('cinema_id', 'cinema_name', 'cinema_address')->get();

        return view('show-time-detail', compact('movie', 'cinemas'));
    }

    public function allMovies(\Illuminate\Http\Request $request)
    {
        $now = \Carbon\Carbon::now();
        $oneMonthLater = $now->copy()->addMonth();

        $allMovies = \App\Models\Movie::all()->map(function($m) use ($now) {
            $release = $m->release_date ? \Carbon\Carbon::parse($m->release_date) : null;
            if ($release && $release->isFuture()) {
                $status = 'Coming Soon';
            } elseif ($release && $release->lte($now) && $release->gte($now->copy()->subMonth())) {
                $status = 'Now Showing';
            } else {
                $status = 'Ended';
            }
            return [
                'id'           => $m->id,
                'title'        => $m->title,
                'genre'        => $m->genre ?? '',
                'duration'     => $m->duration ? $m->duration . ' min' : '',
                'release_date' => $m->release_date ? \Carbon\Carbon::parse($m->release_date)->format('M d, Y') : '',
                'base_price'   => $m->base_price ?? 10,
                'image'        => $m->poster ? asset('uploads/' . $m->poster) : 'https://via.placeholder.com/300x450?text=No+Image',
                'status'       => $status,
            ];
        });

        $filter = $request->query('filter', 'all');

        return view('all-movies', compact('allMovies', 'filter'));
    }

    public function comingSoon()
    {
        $oneMonthLater = now()->addMonth();

        $movies = \App\Models\Movie::whereHas('showtimes', function($q) use ($oneMonthLater) {
            $q->where('start_time', '>', $oneMonthLater);
        })->with('showtimes')->get();

        if ($movies->isEmpty()) {
            $movies = collect([]);
        }

        return view('coming-soon', compact('movies'));
    }

    public function showtime()
    {
        $showtimes = \App\Models\Showtime::with('movie')
            ->where('start_time', '>=', now())
            ->orderBy('start_time')
            ->get()
            ->groupBy(fn($s) => \Carbon\Carbon::parse($s->start_time)->format('Y-m-d'));

        return view('showtime', compact('showtimes'));
    }

    public function detail($index)
    {
        // Thử tìm theo ID trong DB trước
        $dbMovie = \App\Models\Movie::find($index);
        if ($dbMovie) {
            $movie = [
                'id'           => $dbMovie->id,
                'title'        => $dbMovie->title,
                'genre'        => $dbMovie->genre ?? '',
                'duration'     => $dbMovie->duration ? $dbMovie->duration . ' min' : '',
                'release_date' => $dbMovie->release_date ? \Carbon\Carbon::parse($dbMovie->release_date)->format('M d, Y') : '',
                'cast'         => $dbMovie->cast ?? '',
                'description'  => $dbMovie->description ?? '',
                'trailer'      => $dbMovie->trailer ?? '',
                'image'        => $dbMovie->poster ? asset('uploads/' . $dbMovie->poster) : 'https://via.placeholder.com/300x450?text=No+Image',
            ];
        } else {
            abort(404);
        }

        return view('movie-detail', compact('movie'));
    }
}
