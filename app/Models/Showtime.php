<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Showtime extends Model
{
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
