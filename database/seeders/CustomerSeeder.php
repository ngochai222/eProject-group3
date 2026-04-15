<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::create([
            'customer_name' => 'Test Customer',
            'customer_email' => 'test@example.com',
            'customer_phone' => '0123456789',
            'customer_password' => Hash::make('password'),
            'customer_date_of_birth' => '1990-01-01',
            'customer_gender' => 'Male',
            'customer_avatar' => '',
            'customer_favorite' => '',
            'customer_address' => 'Test Address',
        ]);
    }
}
