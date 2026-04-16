<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Cinema;
use App\Models\Showtime;
use App\Models\Seat;

class Room extends Model
{
    protected $table = 'room';

    protected $fillable = [
        'cinema_id',
        'name',
        'seat_count',
    ];
    public function cinema()
    {
        return $this->belongsTo(Cinema::class);
    }

    // 🎬 Room có nhiều Showtime
    public function showtimes()
    {
        return $this->hasMany(Showtime::class);
    }
    public function seats()
    {
        return $this->hasMany(Seat::class);
    }
}