<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PricingSeeder extends Seeder
{
    public function run(): void
    {
        $days = [
            ['day' => 0, 'name' => 'Sunday',    'surcharge' => 20],
            ['day' => 1, 'name' => 'Monday',     'surcharge' => 0],
            ['day' => 2, 'name' => 'Tuesday',    'surcharge' => 0],
            ['day' => 3, 'name' => 'Wednesday',  'surcharge' => 0],
            ['day' => 4, 'name' => 'Thursday',   'surcharge' => 0],
            ['day' => 5, 'name' => 'Friday',     'surcharge' => 10],
            ['day' => 6, 'name' => 'Saturday',   'surcharge' => 20],
        ];

        foreach ($days as $d) {
            DB::table('pricing')->insert([
                'base_price'       => 10.00,
                'day_of_week'      => $d['day'],
                'surcharge_percent'=> $d['surcharge'],
                'created_at'       => now(),
                'updated_at'       => now(),
            ]);
        }
    }
}
