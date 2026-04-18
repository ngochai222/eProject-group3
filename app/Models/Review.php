<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'movie_id',
        'user_name',
        'comment',
        'rating',
        'image'
    ];

    public function movie()
    {
        return $this->belongsTo(\App\Models\Movie::class);
    }
}