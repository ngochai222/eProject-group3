<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Showtime extends Model
{
    protected $fillable = [
    'movie_id',
    'start_time',
    'end_time'
];
    

   public function movie() {
    return $this->belongsTo(\App\Models\Movie::class);
}
}