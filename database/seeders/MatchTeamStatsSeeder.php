<?php

namespace Database\Seeders;

use App\Models\FootballMatch;
use App\Models\MatchTeamStats;
use App\Models\Season;
use Illuminate\Database\Seeder;

class MatchTeamStatsSeeder extends Seeder
{
    public function run()
    {
        $matches = FootballMatch::with(['homeTeam', 'awayTeam'])->get();
        $season = Season::all();
        $seasonId = $season->random()->id;
        foreach ($matches as $match) {
            // Randomize home possession between 40–70%
            $homePossession = (float) round(rand(40, 70) / 100, 2);

            // ---- Home Team ----
            MatchTeamStats::create([
                'football_match_id' => $match->id,
                'club_id' => $match->home_team_id,
                'is_home' => true,
                'season_id' => $seasonId,
                // Result basics
                'goals' => rand(0, 4),
                'goals_conceded' => rand(0, 4),

                // Attack
                'shots' => rand(8, 20),
                'shots_on_target' => rand(3, 10),
                'shots_off_target' => rand(2, 8),
                'blocked_shots' => rand(1, 6),
                'big_chances' => rand(1, 5),
                'big_chances_missed' => rand(0, 3),
                'expected_goals' => (float) round(rand(50, 250) / 100, 2),

                // Passing
                'possession' => $homePossession,
                'passes_attempted' => rand(400, 600),
                'passes_completed' => rand(300, 550),
                'long_balls_attempted' => rand(30, 60),
                'long_balls_completed' => rand(20, 50),
                'crosses_attempted' => rand(10, 30),
                'crosses_completed' => rand(5, 20),
                'progressive_passes' => rand(20, 50),

                // Defending
                'tackles' => rand(15, 30),
                'tackles_won' => rand(10, 25),
                'interceptions' => rand(8, 20),
                'clearances' => rand(10, 25),
                'balls_recovered' => rand(20, 50),
                'clean_sheet' => (bool) rand(0, 1),

                // Discipline
                'fouls_committed' => rand(5, 15),
                'fouls_suffered' => rand(5, 15),
                'yellow_cards' => rand(0, 4),
                'red_cards' => rand(0, 1),
                'offsides' => rand(0, 5),
                'corners' => rand(2, 10),
                'free_kicks' => rand(5, 15),
            ]);

            // ---- Away Team ----
            MatchTeamStats::create([
                'football_match_id' => $match->id,
                'club_id' => $match->away_team_id,
                'is_home' => false,
                'season_id' => $seasonId,
                // Result basics
                'goals' => rand(0, 4),
                'goals_conceded' => rand(0, 4),
                'season_id' => $season->random()->id,
                // Attack
                'shots' => rand(5, 15),
                'shots_on_target' => rand(2, 8),
                'shots_off_target' => rand(2, 7),
                'blocked_shots' => rand(1, 5),
                'big_chances' => rand(1, 4),
                'big_chances_missed' => rand(0, 2),
                'expected_goals' => (float) round(rand(30, 200) / 100, 2),

                // Passing
                'possession' => (float) round(1 - $homePossession, 2),
                'passes_attempted' => rand(300, 550),
                'passes_completed' => rand(250, 500),
                'long_balls_attempted' => rand(25, 55),
                'long_balls_completed' => rand(15, 40),
                'crosses_attempted' => rand(8, 25),
                'crosses_completed' => rand(4, 15),
                'progressive_passes' => rand(15, 40),

                // Defending
                'tackles' => rand(12, 25),
                'tackles_won' => rand(8, 20),
                'interceptions' => rand(5, 15),
                'clearances' => rand(8, 20),
                'balls_recovered' => rand(15, 40),
                'clean_sheet' => (bool) rand(0, 1),

                // Discipline
                'fouls_committed' => rand(5, 12),
                'fouls_suffered' => rand(5, 12),
                'yellow_cards' => rand(0, 5),
                'red_cards' => rand(0, 1),
                'offsides' => rand(0, 4),
                'corners' => rand(1, 8),
                'free_kicks' => rand(3, 12),
            ]);
        }
    }
}
