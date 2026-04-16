<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Showtime;
use App\Models\Review;

class Movie extends Model
{
    protected $fillable = [
        'title',
        'description',
        'duration',
        'release_date',
        'poster'
    ];

    // Quan hệ với showtimes
    public function showtimes()
    {
        return $this->hasMany(Showtime::class);
    }

    // Quan hệ với reviews
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}