<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Room;
use App\Models\Ticket;

class Seat extends Model
{
    use HasFactory;

    protected $table = 'seats';

    protected $fillable = [
        'room_id',
        'seat_number',
        'seat_type',
    ];
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}