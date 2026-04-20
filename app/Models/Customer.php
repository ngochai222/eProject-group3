<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'customer';
    protected $primaryKey = 'customer_id';

    protected $fillable = [
        'customer_name',
        'customer_email',
        'customer_phone',
        'customer_password',
        'customer_date_of_birth',
        'customer_gender',
        'customer_avatar',
        'customer_favorite',
        'customer_address',
    ];

    protected $hidden = [
        'customer_password',
        'remember_token',
    ];

    protected $casts = [
        'customer_date_of_birth' => 'date',
        'customer_password' => 'hashed',
    ];

    public function getAuthIdentifierName()
    {
        return 'customer_email';
    }

    public function getAuthPassword()
    {
        return $this->customer_password;
    }
}
