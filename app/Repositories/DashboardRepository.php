<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\Player;
use App\Models\Competition;
use App\Models\FootballMatch;

class DashboardRepository
{
    public function getPlayers($limit = 5)
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

    public function getCompetitions ($limit =4, $seasonName="2024/2025",$type="")
    {
        $competitions = Competition::query()
                            ->select(
                                'competitions.id',
                                'competitions.name',
                                'competitions.short_name',
                                'competitions.logo_url as logo',
                                'css.name as country',
                                's.name as season',
                                DB::raw('COUNT(DISTINCT fm.id) as matches'),
                                DB::raw('COUNT(DISTINCT clubs.id) as teams')
                            )
                            ->join('competition_club as cc', 'competitions.id', '=', 'cc.competition_id')
                            ->join("countries as css", "competitions.country_code", '=',"css.id")
                            ->join('clubs', 'clubs.id', '=', 'cc.club_id')
                            ->join('competition_season as cs', 'competitions.id', '=', 'cs.competition_id')
                            ->join('seasons as s', 'cs.season_id', '=', 's.id')
                            ->leftJoin('football_matches as fm', 'fm.season_id', '=', 's.id')
                            ->groupBy('competitions.id', 's.name')
                            ->where('s.name', $seasonName)
                            ->limit($limit)
                            ->get();
        if (!empty($type)) {
            $competitions->where('competitions.type', $type);
        }
        
        return $competitions;
    }

    public function getRecentMatchs($limit=3){
        $recentMatches = FootballMatch::orderBy('match_date', 'desc')
            ->take($limit)
            ->get();
        
        return $recentMatches;
    }
}
