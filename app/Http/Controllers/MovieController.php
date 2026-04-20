<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index()
    {
        $now = \Carbon\Carbon::now();
        $oneMonthLater = $now->copy()->addMonth();

        // Movies có showtime trong vòng 1 tháng = đang chiếu
        $hotMovies = \App\Models\Movie::whereHas('showtimes', function($q) use ($now, $oneMonthLater) {
            $q->whereBetween('start_time', [$now, $oneMonthLater]);
        })->with('showtimes')->get()->map(fn($m) => [
            'id'       => $m->id,
            'title'    => $m->title,
            'genre'    => $m->genre ?? '',
            'duration' => $m->duration ? $m->duration . ' min' : '',
            'image'    => $m->poster ? asset('uploads/' . $m->poster) : 'https://via.placeholder.com/300x450?text=No+Image',
        ])->toArray();

        // Movies có showtime sau 1 tháng = coming soon
        $comingSoonMovies = \App\Models\Movie::whereHas('showtimes', function($q) use ($oneMonthLater) {
            $q->where('start_time', '>', $oneMonthLater);
        })->with('showtimes')->get()->map(fn($m) => [
            'id'           => $m->id,
            'title'        => $m->title,
            'genre'        => $m->genre ?? '',
            'release_date' => $m->release_date ? \Carbon\Carbon::parse($m->release_date)->format('M Y') : '',
            'image'        => $m->poster ? asset('uploads/' . $m->poster) : 'https://via.placeholder.com/300x450?text=No+Image',
        ])->toArray();

        // Fallback nếu DB trống
        if (empty($hotMovies)) {
            $hotMovies = $this->getHotMovies();
        }
        if (empty($comingSoonMovies)) {
            $comingSoonMovies = $this->getComingSoonMovies();
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
            // Fallback hardcode
            $allMovies = array_merge($this->getHotMovies(), $this->getComingSoonMovies());
            $movie = $allMovies[$index] ?? abort(404);
        }

        return view('movie-detail', compact('movie'));
    }

    private function getHotMovies()
    {
        return [
            ['title' => 'Ready OR Not 2: HERE I COME', 'genre' => 'HORROR, THRILLER', 'duration' => 'Apr 10, 2026', 'image' => 'https://tse4.mm.bing.net/th/id/OIP.JvaNzXdS810BFrL6WBiDCQHaLG?w=800&h=1199&rs=1&pid=ImgDetMain&o=7&rm=3'],
            ['title' => 'MINIONS & MONSTERS', 'genre' => 'ANIMATION', 'duration' => 'July 1, 2026', 'image' => 'https://tse2.mm.bing.net/th/id/OIP.p6bu_8NTkP3XVJANMdmy7QHaLH?rs=1&pid=ImgDetMain&o=7&rm=3'],
            ['title' => 'Spider-Man: Brand New Day', 'genre' => 'Adventure, Action', 'duration' => 'July 31, 2026', 'image' => 'https://image.tmdb.org/t/p/w500/9JCQtDCSpPR2ld55yNlEg1VwcQo.jpg'],
            ['title' => 'Moana', 'genre' => 'Adventure, Fantasy', 'duration' => 'July 10, 2026', 'image' => 'https://image.tmdb.org/t/p/w500/oA2LhsQwm7QEQP7LM70TBtuhzT6.jpg'],
        ];
    }

    private function getComingSoonMovies()
    {
        return [
            ['title' => 'Avatar 3: Fire and Ash', 'genre' => 'Sci-Fi, Action', 'release_date' => 'Dec 2026', 'image' => 'https://image.tmdb.org/t/p/w500/tElnmtQ6yz1PjN1kePNl8yMSb59.jpg'],
            ['title' => 'Mission: Impossible 8', 'genre' => 'Action, Thriller', 'release_date' => 'May 2026', 'image' => 'https://image.tmdb.org/t/p/w500/z53D72EAOxGRqdr7KXXWp9dJiDe.jpg'],
            ['title' => 'Jurassic World: Rebirth', 'genre' => 'Adventure, Sci-Fi', 'release_date' => 'Jul 2026', 'image' => 'https://image.tmdb.org/t/p/w500/oYuLEt3zVCKq57qu2F8dT7NIa6f.jpg'],
            ['title' => 'The Batman 2', 'genre' => 'Action, Crime', 'release_date' => 'Oct 2026', 'image' => 'https://image.tmdb.org/t/p/w500/74xTEgt7R36Fpooo50r9T25onhq.jpg'],
        ];
    }
}