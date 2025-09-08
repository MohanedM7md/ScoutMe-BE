<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\PlayerStatsRepository;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $repo;

    public function __construct(PlayerStatsRepository $repo)
    {
        $this->repo = $repo;
    }

    public function getTopPlayers()
    {
        $players = $this->repo->getDashboardPlayers();
        return response()->json($players);
    }
}
