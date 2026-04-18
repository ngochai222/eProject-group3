<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index()
    {
        $hotMovies = [
            [
                'title' => 'Ready OR Not 2: HERE I COME',
                'genre' => 'HORROR, THRILLER',
                'duration' => 'Apr 10, 2026',
                'image' => 'https://tse4.mm.bing.net/th/id/OIP.JvaNzXdS810BFrL6WBiDCQHaLG?w=800&h=1199&rs=1&pid=ImgDetMain&o=7&rm=3',
            ],
            [
                'title' => 'MINIONS & MONTERS',
                'genre' => 'ANIMATION',
                'duration' => 'July 1, 2026',
                'image' => 'https://tse2.mm.bing.net/th/id/OIP.p6bu_8NTkP3XVJANMdmy7QHaLH?rs=1&pid=ImgDetMain&o=7&rm=3',
            ],
            [
                'title' => 'Spider-Man: Brand New Day',
                'genre' => 'Adventure, Action',
                'duration' => 'July 31, 2026',
                'image' => 'https://image.tmdb.org/t/p/w500/9JCQtDCSpPR2ld55yNlEg1VwcQo.jpg',
            ],
            [
                'title' => 'Moana',
                'genre' => 'Adventure, Fantasy',
                'duration' => 'July 10, 2026',
                'image' => 'https://image.tmdb.org/t/p/w500/oA2LhsQwm7QEQP7LM70TBtuhzT6.jpg',
            ]
            
        ];

        return view('homepage', compact('hotMovies'));
    }

    public function cinema()
    {
        return view('cinema');
    }
}