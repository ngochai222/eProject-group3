<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// 👇 import model liên quan
use App\Models\Movie;
use App\Models\Customer;

class Review extends Model
{
    use HasFactory;

    protected $table = 'reviews';

    protected $fillable = [
        'movie_id',
        'customer_id',
        'rating',
        'comment',
    ];
    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}