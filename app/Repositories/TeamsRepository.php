<?php

namespace App\Repositories;
use App\Models\Club;
use App\Models\FootballMatch;
use App\Models\MatchTeamStats;
use App\Models\Player;
use Illuminate\Support\Facades\Schema;

class TeamsRepository
{
    public function getTeamsStanding($teamsLimit = 5, $satsLimit = 5, $filters = []){
        $query = Club::query()
                ->withTeamRecords()
                ->with(['teamStats' => fn($q) => $q->orderBy('id', 'desc')->limit($satsLimit)]);
        
            if (isset($filters['competition_id'])) {
                $query->byCompetition($filters['competition_id']);
            }
            
            if (isset($filters['country_code'])) {
                $query->byCountry($filters['country_code']);
            }
            
            if (isset($filters['team_id'])) {
                $query->byTeam($filters['team_id']);
            }
            
            return $query ->limit($teamsLimit)->get();
        }
        
    public function getTeamProfile($teamId){
        $query = Club::query()
        ->where('id',$teamId)
        ->withTeamRecords()->first();
        return $query;
    }

    public function getTeamAggStats($seasonId, $clubId){
        $columns = Schema::getColumnListing('match_team_stats');
        
        $ignored = ['id', 'football_match_id', 'created_at'
                        , 'updated_at', 'deleted_at','club_id','result'];

        foreach($columns as $col){
            if (in_array($col, $ignored)) continue;

            $selects[] = (in_array($col, ['possession', 'expected_goals']) ? 
                        "AVG($col)" : "SUM($col)") . " as $col";
        }
        $query = MatchTeamStats::where('club_id', $clubId)
                    ->where('season_id', $seasonId)
                    ->selectRaw(implode(', ', $selects))
                    ->first();
        return $query;
    }

}
