<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Movie;
use App\Models\Room;
use App\Models\Cinema;
use App\Models\Booking;

class Showtime extends Model
{
    use HasFactory;

    protected $table = 'showtimes';

    protected $fillable = [
        'movie_id',
        'room_id',
        'cinema_id',
        'start_time',
        'end_time',
    ];

    // 🎬 1. Quan hệ với Movie
    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
    public function cinema()
    {
        return $this->belongsTo(Cinema::class);
    }
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}