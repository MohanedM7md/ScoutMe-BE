<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Matches\StoreFootballMatchRequest;
use App\Http\Requests\Matches\UpdateFootballMatchRequest;
use App\Http\Resources\matchs\FootballMatchResource;
use App\Models\FootballMatch;
use Illuminate\Http\Request;

class MatchController extends Controller
{

    public function store(StoreFootballMatchRequest $request)
    {
        $match = FootballMatch::create($request->validated());

        return response()->json([
            'message' => 'Match created successfully.',
            'data'    => new FootballMatchResource($match->load(['homeTeam', 'awayTeam', 'competition'])),
        ], 201);
    }

    public function show(FootballMatch $match)
    {
        $match->load(['homeTeam', 'awayTeam', 'competition']);

        return new FootballMatchResource($match);
    }

    public function update(UpdateFootballMatchRequest $request, FootballMatch $match)
    {
        $match->update($request->validated());

        return response()->json([
            'message' => 'Match updated successfully.',
            'data'    => new FootballMatchResource($match->load(['homeTeam', 'awayTeam', 'competition'])),
        ], 200);
    }

    public function destroy(FootballMatch $match)
    {
        $match->delete();

        return response()->json([
            'message' => 'Match deleted successfully.'
        ], 204);
    }

    public function bulkUpdateStatus(Request $request)
    {
        $validated = $request->validate([
            'match_ids' => ['required', 'array'],
            'match_ids.*' => ['exists:football_matches,id'],
            'status' => ['required', 'in:scheduled,in_play,finished,postponed,canceled'],
        ]);

        FootballMatch::whereIn('id', $validated['match_ids'])
            ->update(['status' => $validated['status']]);

        return response()->json([
            'message' => count($validated['match_ids']) . ' matches updated successfully.'
        ], 200);
    }
}
