<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index()
    {
        $hotMovies = [
            [
                'title' => 'READY OR NOT',
                'genre' => 'HORROR • THRILLER',
                'duration' => '1H 35M',
                'image' => 'https://picsum.photos/300/400?random=1',
                'isIMAX' => true
            ],
            [
                'title' => 'SUPERMAN',
                'genre' => 'ACTION • SCI-FI',
                'duration' => '2H 15M',
                'image' => 'https://picsum.photos/300/400?random=2',
                'isIMAX' => false
            ]
        ];

        return view('homepage', compact('hotMovies'));
    }
}