<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    use Notifiable;

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
    ];

    // Laravel dùng cái này để retrieve user từ session
    public function getAuthIdentifierName()
    {
        return 'customer_id';
    }

    // Laravel dùng cái này để lưu vào session
    public function getAuthIdentifier()
    {
        return $this->customer_id;
    }

    // Laravel dùng cái này để verify password
    public function getAuthPassword()
    {
        return $this->customer_password;
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
