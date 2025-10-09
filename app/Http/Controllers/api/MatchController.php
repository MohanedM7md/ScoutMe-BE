<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\PlayerRepository;
use App\Repositories\MatchsRepository;
use App\Http\Resources\matchs\FootballMatchResource;
use App\Http\Resources\matchs\FootballMatchCollection;
use App\Http\Resources\matchs\FootballMatchStatsResource;
use App\Http\Resources\players\PlayerResource;
use App\Http\Resources\players\PlayerStatsResource;
use App\Models\Player;
use App\Models\FootballMatch;
use Illuminate\Http\Request;

class MatchController extends Controller
{
    protected $playerRepo;
    protected $matchRepo;

    public function __construct(PlayerRepository $playerRepo, MatchsRepository $matchRepo)
    {
        $this->playerRepo = $playerRepo;
        $this->matchRepo = $matchRepo;
    }

    public function index(Request $request)
    {
        $with = ['homeTeam', 'awayTeam'];
        if ($request->boolean('with_competition')) {
            $with[] = 'competition';
        }
        if ($request->boolean('with_season')) {
            $with[] = 'season';
        }
        if ($request->boolean('with_stats')) {
            $with[] = 'teamStats';
            $with[] = 'playerStats.player';
        }
        $filters = $request->only([
            'team',
            'player_id',
            'team_id',
            'away_id',
            'home_id',
            'competition',
            'competition_id',
            'competition_type',
            'season',
            'season_id',
            'date',
            'date_from',
            'date_to',
            'year'
        ]);

        $perPage = $request->input('per_page',0);

        $matches = $this->matchRepo->getMatches($filters,$with,$perPage);

        return new FootballMatchCollection($matches);
    }


    public function show(FootballMatch $match)
    {
        return new FootballMatchResource($match);
    }


    public function getMatchStats(FootballMatch $match)
    {
        return new FootballMatchStatsResource($match);
    }


    public function getPlayersByTeam(Request$request, FootballMatch $match)
    {
        $teamId = $request->query('team_id');
        $players = $match->getTeamPlayers($teamId);
        return PlayerResource::collection($players);
    }


    public function getPlayerStatsById(Request $request,FootballMatch $match)
    {
        $playerId = $request->query('player_id');
        $playerStat = $this->playerRepo->getPlayerMatchStats($match, $playerId );

        if (!$playerStat) {
            return response()->json([
                'message' => 'Player not found for this match'
            ], 404);
        }

        return new PlayerStatsResource($playerStat);
    }
}
