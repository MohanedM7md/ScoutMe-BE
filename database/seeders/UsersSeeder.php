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
        
    }
}
