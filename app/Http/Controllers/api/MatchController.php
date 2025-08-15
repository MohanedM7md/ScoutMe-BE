<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FootballMatch;
use Illuminate\Http\Request;

class MatchController extends Controller
{
    public function index(Request $request)
    {
        $query = FootballMatch::query();


        $query->with(['homeTeam', 'awayTeam']);


        if ($request->boolean('with_league')) {
            $query->with('league');
        }


        if ($request->boolean('with_stats')) {
            $query->with(['teamStats', 'playerStats.player']);
        }

        $matches = $query
            ->filter($request->only(['team', 'league', 'date', 'date_from', 'date_to']))
            ->orderBy('match_date', 'desc')
            ->paginate($request->input('per_page', 10));

        return response()->json($matches);
    }



    public function show(FootballMatch $match)
    {
        return response()->json($match->load([
            'homeTeam',
            'awayTeam',
            'league',
            'teamStats',
            'playerStats.player'
        ]));
    }

    public function getMatchStats(FootballMatch $match)
    {
        return response()->json([
            'home_team_stats' => $match->homeTeamStats,
            'away_team_stats' => $match->awayTeamStats,
            'player_stats' => $match->playerStats()->with('player')->get()
        ]);
    }


    public function getPlayersByTeam(FootballMatch $match, $teamId)
    {
        $players = $match->playerStats()
            ->where('team_id', $teamId)
            ->with('player:id,first_name,last_name,display_name')
            ->get()
            ->map(function ($stat) {
                return [
                    'player_id' => $stat->player->id,
                    'name' => $stat->player->display_name ?? $stat->player->full_name,
                ];
            });

        return response()->json($players);
    }
    public function getPlayerStatsById(FootballMatch $match, $playerId)
    {
        $playerStat = $match->playerStats()
            ->where('player_id', $playerId)
            ->with(['player', 'goalkeeperStats', 'defenderStats', 'attackerStats'])
            ->first();

        if (!$playerStat) {
            return response()->json(['message' => 'Player not found for this match'], 404);
        }

        return response()->json($playerStat);
    }
}
