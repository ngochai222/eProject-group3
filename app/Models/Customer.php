<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Booking;

class Customer extends Model
{
    protected $table = 'customer'; 

    protected $fillable = [
        'name',
        'email',
        'phone',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
