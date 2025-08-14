<?php

namespace Database\Seeders;

use App\Models\FootballMatch;
use App\Models\Player;
use App\Models\Position;
use App\Models\PlayerMatchStats;
use Illuminate\Database\Seeder;

class PlayerMatchStatsSeeder extends Seeder
{
    public function run()
    {
        $matches = FootballMatch::all();
        $players = Player::all();
        foreach ($matches as $match) {
            $teamPlayers = $players->random(rand(14, 18));

            foreach ($teamPlayers as $player) {
                $minutes = rand(0, 90);
                $started = $minutes > 60;

                $baseStats = PlayerMatchStats::create([
                    'player_id' => $player->id,
                    'football_match_id' => $match->id,
                    'team_id' => rand(0, 1) ? $match->home_team_id : $match->away_team_id,
                    'played_position' => $player->primary_position,
                    'minutes_played' => $minutes,
                    'starts' => $started,
                    'substitute_on_min' => $started ? null : rand(45, 75),
                    'substitute_off_min' => $started ? rand(60, 90) : null,
                    'goals' => rand(0, $minutes > 70 ? 2 : 1),
                    'assists' => rand(0, $minutes > 70 ? 2 : 1),
                    'passes_attempted' => rand(20, 60),
                    'passes_completed' => rand(15, 55),
                    'tackles_attempted' => rand(1, 8),
                    'tackles_won' => rand(1, 6),
                    'interceptions' => rand(0, 5),
                    'fouls_committed' => rand(0, 4),
                    'yellow_cards' => rand(0, 1),
                    'distance_covered_m' => rand(7000, 12000),
                ]);

                // Create position-specific stats
                $this->createPositionStats($baseStats);
            }
        }
    }

    protected function createPositionStats($baseStats)
    {

        $category = $baseStats->position->category;
        if ($category === 'goalkeeper') {
            $baseStats->goalkeeperStats()->create([
                'player_match_stat_id' => $baseStats->id, // explicitly set FK
                'saves_total' => rand(1, 8),
                'goals_conceded' => rand(0, 3),
                'clean_sheet' => rand(0, 1),
            ]);
        } elseif ($category === 'defender') {
            $baseStats->defenderStats()->create([
                'player_match_stat_id' => $baseStats->id, // explicitly set FK
                'blocks' => rand(1, 5),
                'aerial_duels_won' => rand(3, 10),
            ]);
        } else {
            $baseStats->attackerStats()->create([
                'player_match_stat_id' => $baseStats->id, // explicitly set FK
                'big_chances_created' => rand(0, 3),
                'successful_dribbles' => rand(1, 6),
            ]);
        }
    }
}
