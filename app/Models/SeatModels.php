<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeatModels extends Model
{
    protected $table = 'seats';

    protected $fillable = [
        'room_id',
        'seat_number',
        'row',
        'column',
        'type'
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
