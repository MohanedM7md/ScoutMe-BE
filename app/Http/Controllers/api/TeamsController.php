<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\teams\teamsStandingCollection;
use App\Repositories\TeamsRepository;
use App\Http\Resources\teams\TeamStatsResource;
use App\Http\Resources\teams\TeamProfileResource;
use App\Http\Resources\teams\TeamsComaparisonResource;
use Illuminate\Http\Request;

class TeamsController extends Controller
{
    protected $repo;

    public function __construct(TeamsRepository $repo)
    {
        $this->repo = $repo;
    }
    public function fetchTeamsStandings(Request $request){
        
        $filters = $request->only([
            'competition_id',
            'country_code',
            'team_id',
        ]);
        $TeamsSatanding = $this->repo->getTeamsStanding(
            $request->query('teams_limit', 5),
            $request->query('stats_limit',5),
            $filters
        );
        
        return new teamsStandingCollection($TeamsSatanding);
    }

    public function fetchTeamProfile($teamId){
        return new TeamProfileResource($this->repo->getTeamProfile( $teamId ));
    }
    public function fetchTeamSeasonStats(Request $request,$teamId){
        $seasonId = $request->query('season_id');
        return new TeamStatsResource($this->repo->getTeamAggStats($seasonId,$teamId));
    }


    public function fetchTeamsComparasion(Request $request)
        {
            $teamA = $request->query('teamA');
            $teamB = $request->query('teamB');
            $seasonId = $request->query('season_id', 1);
            $teamAProfile = $this->repo->getTeamProfile($teamA);
            $teamBProfile = $this->repo->getTeamProfile($teamB);
            $teamAStats = $this->repo->getTeamAggStats($teamA,$seasonId);
            $teamBStats = $this->repo->getTeamAggStats($teamB,$seasonId);

            return new TeamsComaparisonResource([
                'teamAProfile' => $teamAProfile,
                'teamBProfile' => $teamBProfile,
                'teamAStats'   => $teamAStats,
                'teamBStats'   => $teamBStats,
            ]);
        }

}