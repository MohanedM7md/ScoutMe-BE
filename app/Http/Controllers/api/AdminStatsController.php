<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FootballMatch;
use App\Models\MatchTeamStats;
use App\Models\PlayerMatchStats;
use App\Models\GoalkeeperMatchStats;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AdminStatsController extends Controller
{

    protected $commonTeamStatsRules = [
        'club_id' => 'required|exists:clubs,id',
        'is_home' => 'required|boolean',

        // Match result
        'goals' => 'nullable|integer|min:0',
        'goals_conceded' => 'nullable|integer|min:0',
        'result' => 'nullable|integer|min:0|max:127',

        // Goals breakdown
        'penalty_goals' => 'nullable|integer|min:0',
        'penalty_attempts' => 'nullable|integer|min:0',
        'free_kick_goals' => 'nullable|integer|min:0',
        'free_kick_attempts' => 'nullable|integer|min:0',
        'goals_inside_box' => 'nullable|integer|min:0',
        'shots_inside_box' => 'nullable|integer|min:0',
        'goals_outside_box' => 'nullable|integer|min:0',
        'shots_outside_box' => 'nullable|integer|min:0',
        'left_foot_goals' => 'nullable|integer|min:0',
        'right_foot_goals' => 'nullable|integer|min:0',
        'headed_goals' => 'nullable|integer|min:0',

        // Attack stats
        'big_chances' => 'nullable|integer|min:0',
        'big_chances_missed' => 'nullable|integer|min:0',
        'shots' => 'nullable|integer|min:0',
        'shots_on_target' => 'nullable|integer|min:0',
        'shots_off_target' => 'nullable|integer|min:0',
        'blocked_shots' => 'nullable|integer|min:0',
        'successful_dribbles' => 'nullable|integer|min:0',
        'hit_woodwork' => 'nullable|integer|min:0',
        'counter_attacks' => 'nullable|integer|min:0',
        'big_chances_created' => 'nullable|integer|min:0',
        'expected_goals' => 'nullable|numeric|min:0',

        // Passing
        'possession' => 'nullable|numeric|min:0|max:100',
        'passes_attempted' => 'nullable|integer|min:0',
        'passes_completed' => 'nullable|integer|min:0',
        'own_half_passes_completed' => 'nullable|integer|min:0',
        'own_half_passes_attempted' => 'nullable|integer|min:0',
        'opposition_half_passes_completed' => 'nullable|integer|min:0',
        'opposition_half_passes_attempted' => 'nullable|integer|min:0',
        'long_balls_completed' => 'nullable|integer|min:0',
        'long_balls_attempted' => 'nullable|integer|min:0',
        'crosses_completed' => 'nullable|integer|min:0',
        'crosses_attempted' => 'nullable|integer|min:0',
        'through_balls_completed' => 'nullable|integer|min:0',
        'progressive_passes' => 'nullable|integer|min:0',

        // Defending
        'tackles' => 'nullable|integer|min:0',
        'tackles_won' => 'nullable|integer|min:0',
        'interceptions' => 'nullable|integer|min:0',
        'clearances' => 'nullable|integer|min:0',
        'saves' => 'nullable|integer|min:0',
        'balls_recovered' => 'nullable|integer|min:0',
        'errors_leading_to_shot' => 'nullable|integer|min:0',
        'errors_leading_to_goal' => 'nullable|integer|min:0',
        'penalties_committed' => 'nullable|integer|min:0',
        'penalty_goals_conceded' => 'nullable|integer|min:0',
        'clearances_off_line' => 'nullable|integer|min:0',
        'last_man_tackles' => 'nullable|integer|min:0',
        'clean_sheet' => 'nullable|boolean',

        // Duels
        'duels_won' => 'nullable|integer|min:0',
        'duels_total' => 'nullable|integer|min:0',
        'ground_duels_won' => 'nullable|integer|min:0',
        'ground_duels_total' => 'nullable|integer|min:0',
        'aerial_duels_won' => 'nullable|integer|min:0',
        'aerial_duels_total' => 'nullable|integer|min:0',

        // Other
        'possession_lost' => 'nullable|integer|min:0',
        'throw_ins' => 'nullable|integer|min:0',
        'goal_kicks' => 'nullable|integer|min:0',
        'offsides' => 'nullable|integer|min:0',
        'fouls_committed' => 'nullable|integer|min:0',
        'fouls_suffered' => 'nullable|integer|min:0',
        'yellow_cards' => 'nullable|integer|min:0',
        'red_cards' => 'nullable|integer|min:0',
        'corners' => 'nullable|integer|min:0',
        'free_kicks' => 'nullable|integer|min:0',
    ];


    protected $commonPlayerStatsRules = [
        'player_id' => 'required|exists:players,id',
        'football_match_id' => 'required|exists:football_matches,id',
        'played_position' => 'required|exists:positions,id',
        'minutes_played' => 'nullable|integer|min:0|max:120',
        'starts' => 'nullable|boolean',
        'substitute_on_min' => 'nullable|integer|min:0|max:120',
        'substitute_off_min' => 'nullable|integer|min:0|max:120',

        // Attacking stats
        'goals' => 'nullable|integer|min:0',
        'assists' => 'nullable|integer|min:0',
        'shots_total' => 'nullable|integer|min:0',
        'shots_on_target' => 'nullable|integer|min:0',
        'shot_accuracy' => 'nullable|numeric|min:0|max:1',
        'hit_woodwork' => 'nullable|integer|min:0',
        'big_chances_missed' => 'nullable|integer|min:0',
        'big_chances_created' => 'nullable|integer|min:0',
        'touches_in_box' => 'nullable|integer|min:0',
        'progressive_receptions' => 'nullable|integer|min:0',
        'dribbles_attempted' => 'nullable|integer|min:0',
        'dribbles_completed' => 'nullable|integer|min:0',
        'dribble_success_rate' => 'nullable|numeric|min:0|max:1',
        'progressive_carries' => 'nullable|integer|min:0',
        'offsides' => 'nullable|integer|min:0',

        // Defending stats
        'tackles_attempted' => 'nullable|integer|min:0',
        'tackles_won' => 'nullable|integer|min:0',
        'tackle_success_rate' => 'nullable|numeric|min:0|max:1',
        'interceptions' => 'nullable|integer|min:0',
        'clearances' => 'nullable|integer|min:0',
        'blocks' => 'nullable|integer|min:0',
        'shot_blocks' => 'nullable|integer|min:0',
        'recoveries' => 'nullable|integer|min:0',
        'aerial_duels_won' => 'nullable|integer|min:0',
        'aerial_duels_lost' => 'nullable|integer|min:0',
        'possession_won' => 'nullable|integer|min:0',
        'possession_lost' => 'nullable|integer|min:0',

        // Distribution stats
        'passes_attempted' => 'nullable|integer|min:0',
        'passes_completed' => 'nullable|integer|min:0',
        'pass_accuracy' => 'nullable|numeric|min:0|max:1',
        'progressive_passes' => 'nullable|integer|min:0',
        'crosses_attempted' => 'nullable|integer|min:0',
        'crosses_completed' => 'nullable|integer|min:0',
        'cross_accuracy' => 'nullable|numeric|min:0|max:1',

        // Physical stats
        'distance_covered_m' => 'nullable|numeric|min:0',
        'distance_sprinted_m' => 'nullable|numeric|min:0',

        // Discipline stats
        'fouls_committed' => 'nullable|integer|min:0',
        'fouls_suffered' => 'nullable|integer|min:0',
        'yellow_cards' => 'nullable|integer|min:0',
        'red_cards' => 'nullable|integer|min:0',

        // Misc
        'heatmap' => 'nullable|array',
    ];

    protected $goalkeeperSpecificRules = [
        'saves_total' => 'nullable|integer|min:0',
        'saves_inside_box' => 'nullable|integer|min:0',
        'saves_outside_box' => 'nullable|integer|min:0',
        'penalties_faced' => 'nullable|integer|min:0',
        'penalties_saved' => 'nullable|integer|min:0',
        'punches' => 'nullable|integer|min:0',
        'high_claims' => 'nullable|integer|min:0',
        'goals_conceded' => 'nullable|integer|min:0',
        'clean_sheet' => 'nullable|boolean',
    ];


    // Update team stats
    public function updateTeamStats(Request $request)
    {
        try {
            $validate =  $request->validate($this->commonTeamStatsRules);
            MatchTeamStats::updateOrCreate(
                $validate
            );
            return response()->json(['message' => 'Team stats updated successfully']);
        } catch (ValidationException $exception) {
            return response()->json([
                'msg'    => 'Error',
                'error invalid' => $exception->errors(),
            ], 422);
        }
    }

    // Update player stats with position-specific validation
    public function updatePlayerStats(Request $request)
    {
        $validate =  $request->validate($this->commonPlayerStatsRules);
        $isGoalkeeper = Position::where('id', $validate['played_position'])
            ->where('category', 'GK')
            ->exists();

        if ($isGoalkeeper) {
            $this->updateGoalkeeperStats($request->validate($this->goalkeeperSpecificRules));
        }
        PlayerMatchStats::updateOrCreate($validate);
        return response()->json(['message' => 'Player stats updated successfully']);
    }

    // Delete team stats
    public function deleteTeamStats(FootballMatch $match, $clubId)
    {
        MatchTeamStats::where('match_id', $match->id)
            ->where('club_id', $clubId)
            ->delete();

        return response()->json(['message' => 'Team stats deleted successfully']);
    }

    // Delete player stats
    public function deletePlayerStats(FootballMatch $match, $playerId)
    {
        PlayerMatchStats::where('match_id', $match->id)
            ->where('player_id', $playerId)
            ->delete();

        return response()->json(['message' => 'Player stats deleted successfully']);
    }

    /**
     * Update position-specific stats
     */
    protected function updateGoalkeeperStats($playerMatchStatId)
    {
        $gkData = [
            'saves_total' => $data['saves_total'] ?? 0,
            'saves_inside_box' => $data['saves_inside_box'] ?? 0,
            'saves_outside_box' => $data['saves_outside_box'] ?? 0,
            'penalties_faced' => $data['penalties_faced'] ?? 0,
            'penalties_saved' => $data['penalties_saved'] ?? 0,
            'punches' => $data['punches'] ?? 0,
            'high_claims' => $data['high_claims'] ?? 0,
            'goals_conceded' => $data['goals_conceded'] ?? 0,
            'clean_sheet' => $data['clean_sheet'] ?? false,
        ];
        GoalkeeperMatchStats::updateOrCreate(
            ['player_match_stat_id' => $playerMatchStatId],
            $gkData
        );
    }
}
