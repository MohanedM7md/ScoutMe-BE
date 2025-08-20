<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Club;
use App\Models\Player;

class PlayersSeeder extends Seeder
{
    public function run()
    {
        $positions = [
            'defender' => ['CB', 'RB', 'LB'],
            'midfielder' => ['MF'],
            'forward' => ['FW'],
        ];

        Club::all()->each(function ($club) use ($positions) {
            // 1 goalkeeper
            Player::factory()->create([
                'team_id' => $club->id,
                'primary_position' => 'GK',
            ]);

            // at least 1 defender, 1 midfielder, 1 forward
            foreach ($positions as $group => $choices) {
                Player::factory()->create([
                    'team_id' => $club->id,
                    'primary_position' => fake()->randomElement($choices),
                ]);
            }

            // Fill remaining players until at least 11 total
            $currentCount = $club->players()->count();
            $needed = 11 - $currentCount;

            if ($needed > 0) {
                Player::factory()->count($needed)->create([
                    'team_id' => $club->id,
                ]);
            }
        });
    }
}
