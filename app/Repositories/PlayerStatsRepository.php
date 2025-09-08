<?php

namespace App\Repositories;

use App\Models\PlayerMatchStats;
use Illuminate\Support\Facades\DB;
use App\Models\Player;

class PlayerStatsRepository
{
    public function getAggregatedByPlayer($playerId, $seasonId = null)
    {
        $query = PlayerMatchStats::query()
            ->selectRaw('
                SUM(goals) as total_goals,
                SUM(assists) as total_assists,
                SUM(minutes_played) as total_minutes,
                AVG(pass_accuracy) as avg_pass_accuracy,
                SUM(shots_total) as total_shots,
                SUM(shots_on_target) as total_shots_on_target,
                SUM(tackles) as total_tackles,
                SUM(interceptions) as total_interceptions,
                SUM(clearances) as total_clearances,
                SUM(yellow_cards) as yellow_cards,
                SUM(red_cards) as red_cards
            ')
            ->where('player_id', $playerId);

        if ($seasonId) {
            $query->where('season_id', $seasonId);
        }

        return $query->first();
    }

    public function getLeaderboard($metric = 'goals', $limit = 10, $seasonId = null)
    {
        $query = PlayerMatchStats::query()
            ->select('player_id', DB::raw("SUM($metric) as total"))
            ->groupBy('player_id')
            ->orderByDesc('total');

        if ($seasonId) {
            $query->where('season_id', $seasonId);
        }

        return $query->with('player')->limit($limit)->get();
    }

    public function getTrendingPlayers($limit = 10, $seasonId = null)
    {
        $query = PlayerMatchStats::query()
            ->select(
                'player_id',
                DB::raw('
                (SUM(goals) * 4) + 
                (SUM(assists) * 3) + 
                (AVG(rating) * 2) - 
                (SUM(yellow_cards)) as trend_score
            ')
            )
            ->groupBy('player_id')
            ->orderByDesc('trend_score');

        if ($seasonId) {
            $query->where('season_id', $seasonId);
        }

        return $query->with('player')->limit($limit)->get();
    }

    public function getDashboardPlayers($limit = 5)
    {
        return Player::select(
            'players.id',
            'display_name as name',
            'positions.full_name as position',
            'clubs.name as club',
            DB::raw('COALESCE(SUM(player_match_stats.goals), 0) as goals'),
            DB::raw('COALESCE(SUM(player_match_stats.assists), 0) as assists')
        )
            ->leftJoin('player_match_stats', 'players.id', '=', 'player_match_stats.player_id')
            ->leftJoin('positions', 'players.primary_position', '=', 'positions.id')
            ->leftJoin('clubs', 'players.team_id', '=', 'clubs.id')
            ->groupBy('players.id', 'players.first_name', 'players.last_name', 'positions.full_name', 'clubs.name')
            ->orderByDesc('goals')
            ->limit($limit)
            ->get();
    }
}
