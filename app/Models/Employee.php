<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Employee extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'position',
        'salary',
        'room_id',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}