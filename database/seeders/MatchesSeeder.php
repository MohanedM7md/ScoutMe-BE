<?php

namespace Database\Seeders;

use App\Models\Club;
use App\Models\FootballMatch;
use App\Models\League;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class MatchesSeeder extends Seeder
{
    public function run()
    {
        $leagues = League::all();
        $clubs = Club::all()->shuffle();

        // Create matches for the past 30 days
        for ($i = 0; $i < 20; $i++) {
            $matchDate = Carbon::now()->subDays(rand(1, 30));

            FootballMatch::create([
                'home_team_id' => $clubs->random()->id,
                'away_team_id' => $clubs->random()->id,
                'league_id' => $leagues->random()->id,
                'match_date' => $matchDate,
                'status' => 'completed',
                'referee' => 'Referee ' . ($i + 1)
            ]);
        }
    }
}
