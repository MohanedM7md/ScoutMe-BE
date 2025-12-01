<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JuniorPlayer;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class JuniorPlayerSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        $positionsList = [
            ['ST','RW','LW'],
            ['CM','CDM','CAM'],
            ['CB','RB','LB'],
            ['GK']
        ];

        $feetOptions = ['left', 'right', 'both'];

        for ($i = 0; $i < 15; $i++) {

            $first = $faker->firstName();
            $last  = $faker->lastName();

            $randomPositions = $faker->randomElement($positionsList);
            $primary = $randomPositions[0];

            // 1️⃣ Create User first
            $user = User::create([
                'email' => $faker->unique()->safeEmail(),
                'password' => Hash::make('password123'),
                'phone_number' => $faker->phoneNumber(),
                'user_role' => 'player',
            ]);

            // 2️⃣ Create JuniorPlayer profile linked to User
            JuniorPlayer::create([
                'user_id' => $user->id,

                // Names
                'first_name' => $first,
                'last_name'  => $last,
                'display_name' => "{$first} {$last}",

                // PlayerEntity
                'gender' => $faker->randomElement(['male', 'female']),
                'birth_date' => $faker->dateTimeBetween('-18 years', '-10 years'),

                // Physical
                'height_cm' => (string)$faker->numberBetween(145, 195),
                'weight_kg' => (string)$faker->numberBetween(40, 90),

                // JSON fields
                'positions' => $randomPositions,
                'primary_position' => $primary,
                'video_urls' => [
                    "https://youtube.com/watch?v=" . Str::random(10),
                    "https://youtube.com/watch?v=" . Str::random(10)
                ],
                'fav_feet' => [$faker->randomElement($feetOptions)],

                // Clubs
                'nationality_id' => "GB",
                'current_club' => $faker->company(),
                'previous_clubs_info' => $faker->sentence(10),

                // Other info
                'description' => $faker->realText(120),
                'player_image' => "https://picsum.photos/200/200?random=$i",

                // Status
                'is_profile_complete' => true,
                'is_scout' => false,
            ]);
        }
    }
}
