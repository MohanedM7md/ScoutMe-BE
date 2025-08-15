<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FootballMatch;
use App\Models\Player;
use App\Models\MatchTeamStats;
use App\Models\PlayerMatchStats;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminMatchStatsController extends Controller
{
    // Get all stats for a match
    public function show(FootballMatch $match)
    {
        return response()->json([
            'match' => $match->load(['homeTeam', 'awayTeam', 'league']),
            'team_stats' => $match->teamStats()->with('club')->get(),
            'player_stats' => $match->playerStats()
                ->with([
                    'player',
                    'team',
                    'position',
                    'goalkeeperStats',
                    'defenderStats',
                    'attackerStats'
                ])
                ->get()
        ]);
    }

    // Update team stats
    public function updateTeamStats(Request $request, FootballMatch $match)
    {
        $validated = $request->validate([
            'stats' => 'required|array',
            'stats.*.club_id' => 'required|exists:clubs,id',
            'stats.*.is_home' => 'required|boolean',
            'stats.*.passes_attempted' => 'sometimes|integer',
            // Add validation for all other MatchTeamStats fields
        ]);

        DB::transaction(function () use ($match, $validated) {
            foreach ($validated['stats'] as $statData) {
                MatchTeamStats::updateOrCreate(
                    [
                        'match_id' => $match->id,
                        'club_id' => $statData['club_id']
                    ],
                    $statData
                );
            }
        });

        return response()->json(['message' => 'Team stats updated successfully']);
    }

    // Update player stats
    public function updatePlayerStats(Request $request, FootballMatch $match)
    {
        $validated = $request->validate([
            'stats' => 'required|array',
            'stats.*.player_id' => 'required|exists:players,id',
            'stats.*.team_id' => 'required|exists:clubs,id',
            'stats.*.played_position' => 'required|exists:positions,id',
            // Add validation for all other PlayerMatchStats fields
        ]);

        DB::transaction(function () use ($match, $validated) {
            foreach ($validated['stats'] as $statData) {
                $playerStat = PlayerMatchStats::updateOrCreate(
                    [
                        'match_id' => $match->id,
                        'player_id' => $statData['player_id']
                    ],
                    $statData
                );

                // Handle position-specific stats
                $this->updatePositionStats($playerStat, $statData);
            }
        });

        return response()->json(['message' => 'Player stats updated successfully']);
    }

    protected function updatePositionStats(PlayerMatchStats $playerStat, array $data)
    {
        $positionCategory = $playerStat->position->category;

        switch ($positionCategory) {
            case 'Goalkeeper':
                $playerStat->goalkeeperStats()->updateOrCreate(
                    ['id' => $playerStat->id],
                    $data['goalkeeper_stats'] ?? []
                );
                break;

            case 'Defender':
                $playerStat->defenderStats()->updateOrCreate(
                    ['id' => $playerStat->id],
                    $data['defender_stats'] ?? []
                );
                break;

            case 'Forward':
                $playerStat->attackerStats()->updateOrCreate(
                    ['id' => $playerStat->id],
                    $data['attacker_stats'] ?? []
                );
                break;
        }
    }

    // Recalculate aggregated stats
    public function recalculateAggregatedStats(Player $player)
    {
        DB::transaction(function () use ($player) {
            // Calculate career stats
            $careerStats = $this->calculateAggregatedStats($player, 'career');

            // Calculate season stats (assuming season is current year)
            $seasonStats = $this->calculateAggregatedStats($player, 'season', now()->year);

            // Update or create aggregated stats
            $player->aggregatedStats()->updateOrCreate(
                ['stat_type' => 'career'],
                $careerStats
            );

            $player->aggregatedStats()->updateOrCreate(
                ['stat_type' => 'season'],
                $seasonStats
            );
        });

        return response()->json(['message' => 'Aggregated stats recalculated']);
    }

    protected function calculateAggregatedStats(Player $player, string $type, ?int $season = null)
    {
        $query = $player->matchStats()
            ->with('match')
            ->whereHas('match', function ($q) {
                $q->where('status', 'finished');
            });

        if ($type === 'season' && $season) {
            $query->whereYear('match_date', $season);
        }

        $stats = $query->get();

        return [
            'total_matches' => $stats->count(),
            'total_minutes' => $stats->sum('minutes_played'),
            'goals' => $stats->sum('goals'),
            'assists' => $stats->sum('assists'),
            'shots_total' => $stats->sum('shots_total'),
            'shots_on_target' => $stats->sum('shots_on_target'),
            'passes_attempted' => $stats->sum('passes_attempted'),
            'passes_completed' => $stats->sum('passes_completed'),
            'tackles_attempted' => $stats->sum('tackles_attempted'),
            'tackles_won' => $stats->sum('tackles_won'),
            'interceptions' => $stats->sum('interceptions'),
            'clearances' => $stats->sum('clearances'),
            'fouls_committed' => $stats->sum('fouls_committed'),
            'fouls_suffered' => $stats->sum('fouls_suffered'),
            'yellow_cards' => $stats->sum('yellow_cards'),
            'red_cards' => $stats->sum('red_cards'),
        ];
    }
}
