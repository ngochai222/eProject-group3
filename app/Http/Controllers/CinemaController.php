<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CinemaController extends Controller
{

    public function index()
    {
        $cinema = [
            [
                'name' => 'CGV Xuan Khanh',
                'address' => '30/4, Ninh Kieu, Can Tho',
            ],
            [
                'name' => 'CGV Sense city',
            'address' => 'Hoa Binh, Ninh Kieu, Can Tho',
            ],
        [
            'name' => 'CGV Hung Vuong',
            'address' => 'Hung Vuong, Ninh Kieu, Can Tho',
        ],
        [
            'name' => 'Lotte Cinema Can Tho',
            'address' => '84 Mau Than, Ninh Kieu, Can Tho',
        ]
        ];
        return view('cinema', compact('cinema'));
    }
}