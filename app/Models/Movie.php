<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Showtime;
use App\Models\Review;

class Movie extends Model
{
    protected $table = 'movies';

    protected $fillable = [
        'title',
        'description',
        'duration',
        'base_price',
        'release_date',
        'poster',
        'trailer',
        'genre',
        'cast',
    ];
    public function showtimes()
    {
        return $this->hasMany(Showtime::class);
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}