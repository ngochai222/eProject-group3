<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeesModels extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'room_id',
        'position',
        'salary',
        'status',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
