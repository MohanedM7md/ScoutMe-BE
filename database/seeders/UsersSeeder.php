<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run()
    {
        // Admin user
        $admin = User::create([
            'email' => 'admin@scoutme.com',
            'password' => 1234567,
            'user_role' => 'admin',
            'is_verified' => true
        ]);
        $admin->assignRole('admin');

        // Scout users
        for ($i = 1; $i <= 5; $i++) {
            $scout = User::create([
                'email' => "scout{$i}@example.com",
                'password' => Hash::make('password'),
                'user_role' => 'scout',
                'is_verified' => true
            ]);
            $scout->assignRole('scout');
        }
    }
}
