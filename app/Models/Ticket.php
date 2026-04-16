<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketModels extends Model
{
    protected $table = 'tickets';

    protected $fillable = [
        'user_id',
        'showtime_id',
        'seat_id',
        'price',
    ];

    public function showtime()
    {
        return $this->belongsTo(Showtime::class);
    }

    public function seat()
    {
        return $this->belongsTo(Seat::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
