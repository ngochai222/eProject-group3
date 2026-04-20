<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CinemaController extends Controller
{

    public function index()
    {
        $cinemas = \DB::table('cinema')->get();
        return view('cinema', compact('cinemas'));
    }
}