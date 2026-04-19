<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cinema extends Model
{
    protected $table = 'cinema'; 

    protected $fillable = [
        'name',
        'location',
        'address',
    ];

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
}
