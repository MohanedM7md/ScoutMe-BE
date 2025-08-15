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
}
