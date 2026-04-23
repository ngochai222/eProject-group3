<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SuperAdminAndManagerSeeder extends Seeder
{
    public function run()
    {
        // Super Admin
        DB::table('customer')->updateOrInsert(
            ['customer_email' => 'admin@gmail.com'],
            [
                'customer_name' => 'Super Admin',
                'customer_password' => Hash::make('123456'),
                'role' => 'admin',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
        // Manager
        DB::table('customer')->updateOrInsert(
            ['customer_email' => 'manager@gmail.com'],
            [
                'customer_name' => 'Manager 1',
                'customer_password' => Hash::make('123456'),
                'role' => 'manager',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
