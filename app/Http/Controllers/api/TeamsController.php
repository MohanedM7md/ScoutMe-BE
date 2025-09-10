<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\teams\teamsStandingCollection;
use App\Repositories\TeamsRepository;
class TeamsController extends Controller
{
    protected $repo;

    public function __construct(TeamsRepository $repo)
    {
        $this->repo = $repo;
    }
    public function fetchTeamsStandings(){
        $TeamsSatanding = $this->repo->getTeamsSatanding();
        return new teamsStandingCollection($TeamsSatanding);
    }
}