<?php

namespace Database\Seeders;

use App\Models\FootballMatch;
use App\Models\PlayerMatchStats;
use Illuminate\Database\Seeder;

class PlayerMatchStatsSeeder extends Seeder
{
    public function run()
    {
        $matches = FootballMatch::with('players')->get();

        foreach ($matches as $match) {
            foreach ($match->players as $player) {
                // Prevent duplicate stats if already exist
                if (PlayerMatchStats::where('player_id', $player->id)
                    ->where('football_match_id', $match->id)
                    ->exists()) {
                    continue;
                }

                $minutes = rand(0, 90);
                $started = $minutes > 60;
                $isGoalkeeper = strtoupper($player->pivot->played_position) === 'GK';

                $baseStats = PlayerMatchStats::create([
                    // Relations
                    'player_id' => $player->id,
                    'football_match_id' => $match->id,
                    'season_id' => $match->season_id,

                    // Basic info
                    'is_goalkeeper' => $isGoalkeeper,

                    // Playing time
                    'minutes_played' => $minutes,
                    'starts' => $started,
                    'substitute_on_min' => $started ? null : rand(45, 75),
                    'substitute_off_min' => $started ? rand(60, 90) : null,

                    // Attacking stats
                    'goals' => rand(0, $minutes > 70 ? 2 : 1),
                    'assists' => rand(0, $minutes > 70 ? 2 : 1),
                    'shots_total' => $isGoalkeeper ? 0 : rand(0, $minutes > 45 ? 5 : 3),
                    'shots_on_target' => $isGoalkeeper ? 0 : rand(0, $minutes > 45 ? 3 : 2),
                    'hit_woodwork' => rand(0, $minutes > 70 ? 1 : 0),
                    'big_chances_missed' => $isGoalkeeper ? 0 : rand(0, $minutes > 60 ? 2 : 1),
                    'big_chances_created' => $isGoalkeeper ? 0 : rand(0, $minutes > 60 ? 3 : 1),
                    'touches_in_box' => $isGoalkeeper ? 0 : rand(0, $minutes > 60 ? 10 : 5),
                    'progressive_receptions' => $isGoalkeeper ? 0 : rand(0, $minutes > 60 ? 8 : 4),
                    'dribbles_attempted' => $isGoalkeeper ? 0 : rand(0, $minutes > 60 ? 6 : 3),
                    'dribbles_completed' => $isGoalkeeper ? 0 : rand(0, $minutes > 60 ? 4 : 2),
                    'progressive_carries' => $isGoalkeeper ? 0 : rand(0, $minutes > 60 ? 5 : 3),
                    'offsides' => $isGoalkeeper ? 0 : rand(0, $minutes > 60 ? 2 : 1),

                    // Defensive stats
                    'tackles' => $isGoalkeeper ? 0 : rand(0, $minutes > 60 ? 5 : 3),
                    'tackles_won' => $isGoalkeeper ? 0 : rand(0, $minutes > 60 ? 4 : 2),
                    'interceptions' => $isGoalkeeper ? 0 : rand(0, $minutes > 60 ? 4 : 2),
                    'clearances' => $isGoalkeeper ? rand(1, 5) : rand(0, $minutes > 60 ? 6 : 3),
                    'blocks' => $isGoalkeeper ? 0 : rand(0, $minutes > 60 ? 3 : 1),
                    'shot_blocks' => $isGoalkeeper ? 0 : rand(0, $minutes > 60 ? 2 : 1),
                    'recoveries' => rand(1, $minutes > 60 ? 8 : 4),
                    'ground_duels' => $isGoalkeeper ? 0 : rand(0, $minutes > 60 ? 10 : 5),
                    'ground_duels_won' => $isGoalkeeper ? 0 : rand(0, $minutes > 60 ? 7 : 4),
                    'aerial_duels' => rand(0, $minutes > 60 ? 8 : 4),
                    'aerial_duels_won' => rand(0, $minutes > 60 ? 5 : 3),
                    'possession' => rand(20, 80),
                    'possession_won' => rand(5, 15),

                    // General stats
                    'passes_attempted' => rand(20, 60),
                    'passes_completed' => rand(15, 55),
                    'progressive_passes' => $isGoalkeeper ? rand(1, 5) : rand(3, 10),
                    'fouls_committed' => rand(0, 4),
                    'fouls_suffered' => rand(0, 3),
                    'yellow_cards' => rand(0, 1),
                    'red_cards' => rand(0, min(1, $minutes > 80 ? 1 : 0)),
                    'distance_covered_m' => rand(7000, 12000),
                    'distance_sprinted_m' => rand(1000, 3000),
                    'crosses_attempted' => $isGoalkeeper ? 0 : rand(0, $minutes > 60 ? 5 : 3),
                    'crosses_completed' => $isGoalkeeper ? 0 : rand(0, $minutes > 60 ? 3 : 1),
                    'heatmap' => json_encode($this->generateHeatmap($isGoalkeeper)),
                ]);

                // Derived % stats
                $this->calculateDerivedStats($baseStats);

                // GK-specific stats
                if ($isGoalkeeper) {
                    $baseStats->goalkeeperStats()->create([
                        'player_match_stat_id' => $baseStats->id,
                        'saves_total' => rand(1, 8),
                        'saves_inside_box' => rand(0, 5),
                        'saves_outside_box' => rand(0, 3),
                        'goals_conceded' => rand(0, 3),
                        'clean_sheet' => rand(0, 1),
                        'penalties_faced' => rand(0, 1),
                        'penalties_saved' => rand(0, 1),
                        'punches' => rand(0, 3),
                        'high_claims' => rand(0, 2),
                    ]);
                }
            }
        }
    }

    private function generateHeatmap(bool $isGoalkeeper): array
    {
        $zones = $isGoalkeeper ? [
            'gk_left', 'gk_center', 'gk_right',
            'def_left', 'def_center', 'def_right'
        ] : [
            'def_left', 'def_center', 'def_right',
            'mid_left', 'mid_center', 'mid_right',
            'att_left', 'att_center', 'att_right'
        ];

        $heatmap = [];
        foreach ($zones as $zone) {
            $heatmap[$zone] = rand(1, 20);
        }
        return $heatmap;
    }

    private function calculateDerivedStats(PlayerMatchStats $stats): void
    {
        $stats->shot_accuracy = $stats->shots_total > 0
            ? round(($stats->shots_on_target / $stats->shots_total) * 100, 2)
            : 0;

        $stats->dribble_success_rate = $stats->dribbles_attempted > 0
            ? round(($stats->dribbles_completed / $stats->dribbles_attempted) * 100, 2)
            : 0;

        $stats->tackle_success_rate = $stats->tackles > 0
            ? round(($stats->tackles_won / $stats->tackles) * 100, 2)
            : 0;

        $stats->pass_accuracy = $stats->passes_attempted > 0
            ? round(($stats->passes_completed / $stats->passes_attempted) * 100, 2)
            : 0;

        $stats->cross_accuracy = $stats->crosses_attempted > 0
            ? round(($stats->crosses_completed / $stats->crosses_attempted) * 100, 2)
            : 0;

        $stats->save();
    }
}
