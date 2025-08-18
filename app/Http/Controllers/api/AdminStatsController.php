<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FootballMatch;
use App\Models\MatchTeamStats;
use App\Models\PlayerMatchStats;
use App\Models\GoalkeeperMatchStats;
use App\Models\AttackerMatchStats;
use App\Models\DefenderMatchStats;
use App\Models\Position;
use Illuminate\Http\Request;
use App\Contracts\PositionStats;

class AdminStatsController extends Controller
{
    // Common validation rules
    protected $commonTeamStatsRules = [
        'club_id' => 'required|exists:clubs,id',
        'is_home' => 'required|boolean',
        'passes_attempted' => 'nullable|integer|min:0',
        'passes_completed' => 'nullable|integer|min:0',
        'pass_accuracy' => 'nullable|numeric|min:0|max:1',
        'possession' => 'nullable|numeric|min:0|max:1',
        'shots' => 'nullable|integer|min:0',
        'shots_on_target' => 'nullable|integer|min:0',
        'expected_goals' => 'nullable|numeric|min:0',
        'shot_accuracy' => 'nullable|numeric|min:0|max:1',
        'tackles' => 'nullable|integer|min:0',
        'tackles_won' => 'nullable|integer|min:0',
        'interceptions' => 'nullable|integer|min:0',
        'fouls_committed' => 'nullable|integer|min:0',
        'offsides' => 'nullable|integer|min:0',
        'corners' => 'nullable|integer|min:0',
        'free_kicks' => 'nullable|integer|min:0',
        'penalty_kicks' => 'nullable|integer|min:0',
        'yellow_cards' => 'nullable|integer|min:0',
        'red_cards' => 'nullable|integer|min:0',
        'saves' => 'nullable|integer|min:0',
        'dribble_success_rate' => 'nullable|numeric|min:0|max:1',
    ];

    protected $commonPlayerStatsRules = [
        'player_id' => 'required|exists:players,id',
        'team_id' => 'required|exists:clubs,id',
        'played_position' => 'required|exists:positions,id',
        'minutes_played' => 'nullable|integer|min:0',
        'starts' => 'nullable|boolean',
        'substitute_on_min' => 'nullable|integer|min:0',
        'substitute_off_min' => 'nullable|integer|min:0',
        'rating' => 'nullable|numeric|min:0|max:10',
        'goals' => 'nullable|integer|min:0',
        'assists' => 'nullable|integer|min:0',
        'shots_total' => 'nullable|integer|min:0',
        'shots_on_target' => 'nullable|integer|min:0',
        'shot_accuracy' => 'nullable|numeric|min:0|max:1',
        'passes_attempted' => 'nullable|integer|min:0',
        'passes_completed' => 'nullable|integer|min:0',
        'pass_accuracy' => 'nullable|numeric|min:0|max:1',
        'dribbles_attempted' => 'nullable|integer|min:0',
        'dribbles_completed' => 'nullable|integer|min:0',
        'dribble_success_rate' => 'nullable|numeric|min:0|max:1',
        'tackles_attempted' => 'nullable|integer|min:0',
        'tackles_won' => 'nullable|integer|min:0',
        'tackle_success_rate' => 'nullable|numeric|min:0|max:1',
        'interceptions' => 'nullable|integer|min:0',
        'clearances' => 'nullable|integer|min:0',
        'fouls_committed' => 'nullable|integer|min:0',
        'fouls_suffered' => 'nullable|integer|min:0',
        'yellow_cards' => 'nullable|integer|min:0',
        'red_cards' => 'nullable|integer|min:0',
        'offsides' => 'nullable|integer|min:0',
        'distance_covered_m' => 'nullable|numeric|min:0',
        'distance_sprinted_m' => 'nullable|numeric|min:0',
        'possession_won' => 'nullable|integer|min:0',
        'possession_lost' => 'nullable|integer|min:0',
        'heatmap' => 'nullable|array',
    ];

    protected $goalkeeperSpecificRules = [
        'goalkeeper_stats.saves' => 'nullable|integer|min:0',
        'goalkeeper_stats.punches' => 'nullable|integer|min:0',
        'goalkeeper_stats.catches' => 'nullable|integer|min:0',
        'goalkeeper_stats.clean_sheets' => 'nullable|boolean',
        'goalkeeper_stats.goals_conceded' => 'nullable|integer|min:0',
        'goalkeeper_stats.penalties_saved' => 'nullable|integer|min:0',
        'goalkeeper_stats.crosses_stopped' => 'nullable|integer|min:0',
        'goalkeeper_stats.distribution_accuracy' => 'nullable|numeric|min:0|max:1',
    ];

    protected $defenderSpecificRules = [
        'defender_stats.aerial_duels_won' => 'nullable|integer|min:0',
        'defender_stats.aerial_duels_lost' => 'nullable|integer|min:0',
        'defender_stats.blocks' => 'nullable|integer|min:0',
        'defender_stats.clearances' => 'nullable|integer|min:0',
        'defender_stats.interceptions' => 'nullable|integer|min:0',
        'defender_stats.tackles' => 'nullable|integer|min:0',
        'defender_stats.last_man_tackles' => 'nullable|integer|min:0',
        'defender_stats.recoveries' => 'nullable|integer|min:0',
    ];

    protected $attackerSpecificRules = [
        'attacker_stats.shots_on_target' => 'nullable|integer|min:0',
        'attacker_stats.shots_off_target' => 'nullable|integer|min:0',
        'attacker_stats.dribbles_completed' => 'nullable|integer|min:0',
        'attacker_stats.dribbles_attempted' => 'nullable|integer|min:0',
        'attacker_stats.key_passes' => 'nullable|integer|min:0',
        'attacker_stats.crosses_completed' => 'nullable|integer|min:0',
        'attacker_stats.crosses_attempted' => 'nullable|integer|min:0',
        'attacker_stats.aerial_duels_won' => 'nullable|integer|min:0',
    ];

    // Update team stats
    public function updateTeamStats(Request $request)
    {
        $request->validate($this->commonTeamStatsRules);
        MatchTeamStats::updateOrCreate(
            [
                'football_match_id' => $request->input('football_match_id'),
                'club_id' => $request->input('club_id'),
            ],
            $request->only(array_keys($this->commonTeamStatsRules))
        );

        return response()->json(['message' => 'Team stats updated successfully']);
    }

    // Update player stats with position-specific validation
    public function updatePlayerStats(Request $request)
    {
        // Get position-specific rules for each player
        $playerStat = $request->input('playerState');
        $playerPostion = $request->input('postion_stat');

        $playerStat = PlayerMatchStats::updateOrCreate(
            $playerStat
        );
        $this->updatePositionStats($playerPostion, $playerStat);
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
    private function updatePositionStats($position, $playerStat)
    {
        dump($playerStat);
        $category = Position::find($playerStat['played_position'])?->category;

        dump($category);
        if (is_null($category)) {
            return response()->json(['error' => 'Invalid position: category is missing.'], 422);
        }
        $playerMatchStatId = is_array($playerStat) ? $playerStat['id'] : $playerStat->id;
        switch ($category) {
            case 'goalkeeper':
                GoalkeeperMatchStats::updateOrCreate(["player_match_stat_id" =>  $playerMatchStatId], $position);
                break;
            case 'midfielder':
                DefenderMatchStats::updateOrCreate(["player_match_stat_id" =>  $playerMatchStatId], $position);
                break;
            case 'attacker':
                AttackerMatchStats::updateOrCreate(["player_match_stat_id" =>  $playerMatchStatId], $position);
                break;
            default:
                break;
        }
    }
}
