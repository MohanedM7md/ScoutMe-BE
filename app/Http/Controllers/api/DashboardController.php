<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\DashboardRepository;
use App\Http\Resources\matchs\FootballMatchCollection;
use App\Http\Resources\competition\FeaturedCompetitionsCollection;
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
            $limit = $request->query('limit', 4);// null if not provided
            $filters = $request->only([
                'season',
                'type'
            ]);
            $competitions = $this->repo->getCompetitions($limit, $filters );
            return new FeaturedCompetitionsCollection($competitions);
        }

        public function getRecentMatchs(Request $request){
            $limit = $request->query('limit', 3);
            $matches = $this->repo->getRecentMatchs($limit);
            return new FootballMatchCollection($matches);
        }
}
