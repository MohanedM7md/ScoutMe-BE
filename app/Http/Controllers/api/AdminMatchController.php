<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FootballMatch;
use Illuminate\Http\Request;

class AdminMatchController extends Controller
{
    public function index()
    {
        return response()->json(FootballMatch::with(['homeTeam', 'awayTeam'])->paginate(15));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'home_team_id' => 'required|exists:clubs,id',
            'away_team_id' => 'required|exists:clubs,id',
            'match_date' => 'required|date',
            // Add other match fields
        ]);

        $match = FootballMatch::create($validated);
        return response()->json($match, 201);
    }

    public function show(FootballMatch $match)
    {
        return response()->json($match->load(['homeTeam', 'awayTeam']));
    }

    public function update(Request $request, FootballMatch $match)
    {
        $validated = $request->validate([
            'home_team_id' => 'sometimes|exists:clubs,id',
            'away_team_id' => 'sometimes|exists:clubs,id',
            'match_date' => 'sometimes|date',
            // Add other match fields
        ]);

        $match->update($validated);
        return response()->json($match);
    }

    public function destroy(FootballMatch $match)
    {
        $match->delete();
        return response()->json(['message' => 'Match deleted']);
    }
}
