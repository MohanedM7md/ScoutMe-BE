<?php

namespace Database\Seeders;

use App\Models\FootballMatch;
use App\Models\MatchTeamStats;
use Illuminate\Database\Seeder;

class MatchTeamStatsSeeder extends Seeder
{
    public function run()
    {
        $matches = FootballMatch::with(['homeTeam', 'awayTeam'])->get();

        foreach ($matches as $match) {
            // Home team stats
            $homePossession = (float) round(rand(40, 70) / 100, 2);

            MatchTeamStats::create([
                'football_match_id' => $match->id,
                'club_id' => $match->home_team_id,
                'is_home' => true,
                'passes_attempted' => rand(400, 600),
                'passes_completed' => rand(300, 550),
                'pass_accuracy'   => (float) round(rand(70, 90) / 100, 2),
                'possession'      => $homePossession,
                'expected_goals'  => (float) round(rand(1, 4) / 2, 2),
                'shots' => rand(8, 20),
                'shots_on_target' => rand(3, 10),
                'tackles' => rand(15, 30),
                'tackles_won' => rand(10, 25),
                'interceptions' => rand(8, 20),
                'corners' => rand(2, 10),
                'yellow_cards' => rand(0, 4),
                'red_cards' => rand(0, 1),
            ]);

            MatchTeamStats::create([
                'football_match_id' => $match->id,
                'club_id' => $match->away_team_id,
                'is_home' => false,
                'passes_attempted' => rand(300, 550),
                'passes_completed' => rand(250, 500),
                'pass_accuracy'   => (float) round(rand(65, 85) / 100, 2),
                'possession'      => (float) round(1 - $homePossession, 2),
                'shots' => rand(5, 15),
                'shots_on_target' => rand(2, 8),
                'expected_goals'  => (float) round(rand(1, 3) / 2, 2),
                'tackles' => rand(12, 25),
                'tackles_won' => rand(8, 20),
                'interceptions' => rand(5, 15),
                'corners' => rand(1, 8),
                'yellow_cards' => rand(0, 5),
                'red_cards' => rand(0, 1),
            ]);
        }
    }
}
