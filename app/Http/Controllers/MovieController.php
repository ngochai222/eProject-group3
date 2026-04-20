<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index()
    {
        $hotMovies = $this->getHotMovies();
        $comingSoonMovies = $this->getComingSoonMovies();
        return view('homepage', compact('hotMovies', 'comingSoonMovies'));
    }

    public function cinema()
    {
        return view('cinema');
    }

    public function detail($index)
    {
        $allMovies = array_merge($this->getHotMovies(), $this->getComingSoonMovies());
        $movie = $allMovies[$index] ?? abort(404);
        return view('showtime', compact('movie'));
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