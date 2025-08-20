<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class SeasonsSeeder extends Seeder
{
    public function run()
    {

        $seasons = [
            [
                'name' => '2024/2025',
                'start_date' => Carbon::create('2024', '08', '01'),
                'end_date' => Carbon::create('2025', '05', '31'),
                'is_current' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '2023/2024',
                'start_date' => Carbon::create('2023', '08', '01'),
                'end_date' => Carbon::create('2024', '05', '31'),
                'is_current' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('seasons')->insert($seasons);
    }
}
