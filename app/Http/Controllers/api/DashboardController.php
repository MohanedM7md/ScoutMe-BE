<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\DashboardRepository;
use App\Http\Resources\FootballMatchCollection;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $repo;

    public function __construct(DashboardRepository $repo)
    {
        $this->repo = $repo;
    }

    public function getTopPlayers(Request $request)
    {
        $limit = $request->query('limit', 5);
        $players = $this->repo->getPlayers($limit);
        return response()->json($players);
    }

        public function getTopCompetetion(Request $request)
        {
            $limit = $request->query('limit', 4); // default = 10
            $season = $request->query('season',"2024/2025");       // null if not provided
            $type = $request->query('type',"");       // null if not provided
            $competitions = $this->repo->getCompetitions($limit,$season,$type);
            return response()->json($competitions);
        }

        public function getRecentMatchs(Request $request){
            $limit = $request->query('limit', 3);
            $matches = $this->repo->getRecentMatchs($limit);
            return new FootballMatchCollection($matches);
        }
}
