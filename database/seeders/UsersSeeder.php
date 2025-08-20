<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Scout;
use App\Models\JuniorPlayer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run()
    {
        /**
         * ADMIN
         */
        $admin = User::create([
            'email'       => 'admin@scoutme.com',
            'password'    => Hash::make('password'),
            'user_role'   => 'admin',
            'is_verified' => true,
        ]);
        $admin->assignRole('admin'); // if using spatie/laravel-permission

        /**
         * SCOUTS
         */
        for ($i = 1; $i <= 3; $i++) {
            $scoutUser = User::create([
                'email'       => "scout{$i}@example.com",
                'password'    => Hash::make('password'),
                'user_role'   => 'scout',
                'is_verified' => true,
            ]);

            $scoutUser->assignRole('scout');

            Scout::create([
                'user_id'  => $scoutUser->id,
                'name'     => "Scout {$i}",
                'logo_url' => null,
                'notes'    => "Notes for scout {$i}",
            ]);
        }

        /**
         * PLAYERS
         */
        for ($i = 1; $i <= 5; $i++) {
            $playerUser = User::create([
                'email'       => "player{$i}@example.com",
                'password'    => Hash::make('password'),
                'user_role'   => 'player',
                'is_verified' => true,
            ]);

            $playerUser->assignRole('player');

            JuniorPlayer::create([
                'user_id'            => $playerUser->id,
                'first_name'         => "Player{$i}",
                'last_name'          => "Last{$i}",
                'display_name'       => "P{$i}",
                'nationality_id'     => 'US', // must exist in `countries` table
                'primary_position'   => 'ST', // must exist in `positions` table
                'birth_date'         => now()->subYears(16 + $i)->format('Y-m-d'),
                'height_cm'          => 170 + $i,
                'weight_kg'          => 65 + $i,
                'preferred_foot'     => 'right',
                'is_profile_complete' => true,
            ]);
        }
    }
}
