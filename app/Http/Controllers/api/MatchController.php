<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FootballMatchResource;
use App\Http\Resources\FootballMatchCollection;
use App\Models\FootballMatch;
use Illuminate\Http\Request;

class MatchController extends Controller
{

    public function index(Request $request)
    {
        $query = FootballMatch::query();

        $query->with(['homeTeam', 'awayTeam']);

        if ($request->boolean('with_competition')) {
            $query->with('competition');
        }
        if ($request->boolean('with_season')) {
            $query->with('season');
        }
        if ($request->boolean('with_stats')) {
            $query->with(['teamStats', 'playerStats.player']);
        }

        $filters = $request->only([
            'team',
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

        $matches = $query
            ->filter(filters: $filters)
            ->orderBy(column: 'match_date', direction: 'desc')
            ->paginate(perPage: $request->input(key: 'per_page', default: 10));

        return new FootballMatchCollection($matches);
    }


    public function show(FootballMatch $match)
    {
        $match->load(['homeTeam', 'awayTeam', 'competition']);

        return new FootballMatchResource($match);
    }


    public function getMatchStats(FootballMatch $match)
    {
        return response()->json([
            'home_team_stats' => $match->homeTeamStats,
            'away_team_stats' => $match->awayTeamStats,
            'home_players'    => $match->getTeamPlayers($match->home_team_id),
            'away_players'    => $match->getTeamPlayers($match->away_team_id),
        ]);
    }


    public function getPlayersByTeam(FootballMatch $match, $teamId)
    {
        $players = $match->getTeamPlayers($teamId);

        return response()->json($players);
    }


    public function getPlayerStatsById(FootballMatch $match, $playerId)
    {
        $playerStat = $match->playerStats()
            ->where('player_id', $playerId)
            ->with(['player', 'position'])
            ->first();

        if (!$playerStat) {
            return response()->json([
                'message' => 'Player not found for this match'
            ], 404);
        }

        return response()->json([
            'player'   => $playerStat->player,
            'position' => $playerStat->position,
            'stats'    => $playerStat->all_stats,
        ]);
    }
}
