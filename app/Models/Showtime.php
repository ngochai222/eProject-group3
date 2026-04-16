<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Movie;
use App\Models\Room;
use App\Models\Booking;

class Showtime extends Model
{
    protected $table = 'showtime';

    protected $fillable = [
        'movie_id',
        'room_id',
        'start_time'
    ];
    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}