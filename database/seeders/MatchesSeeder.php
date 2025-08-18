<?php

namespace Database\Seeders;

use App\Models\Club;
use App\Models\Competition;
use App\Models\FootballMatch;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class MatchesSeeder extends Seeder
{
    public function run()
    {
        $competitions = Competition::all();
        $clubs = Club::all()->shuffle();

        // Create matches for the past 30 days
        for ($i = 0; $i < 20; $i++) {
            $matchDate = Carbon::now()->subDays(rand(1, 30));

            // Ensure home and away teams are different
            $homeTeam = $clubs->random();
            $awayTeam = $clubs->where('id', '!=', $homeTeam->id)->random();

            FootballMatch::create([
                'home_team_id' => $homeTeam->id,
                'away_team_id' => $awayTeam->id,
                'competition_id' => $competitions->random()->id,
                'match_date' => $matchDate,
                'status' => 'completed',
                'referee' => 'Referee ' . ($i + 1)
            ]);
        }

        // Create some upcoming matches
        for ($i = 0; $i < 10; $i++) {
            $matchDate = Carbon::now()->addDays(rand(1, 30));

            $homeTeam = $clubs->random();
            $awayTeam = $clubs->where('id', '!=', $homeTeam->id)->random();

            FootballMatch::create([
                'home_team_id' => $homeTeam->id,
                'away_team_id' => $awayTeam->id,
                'competition_id' => $competitions->random()->id,
                'match_date' => $matchDate,
                'status' => 'scheduled',
                'referee' => 'Referee ' . ($i + 21)
            ]);
        }
    }
}
