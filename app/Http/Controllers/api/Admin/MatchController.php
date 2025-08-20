<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFootballMatchRequest;
use App\Http\Requests\UpdateFootballMatchRequest;
use App\Http\Resources\FootballMatchResource;
use App\Http\Resources\FootballMatchCollection;
use App\Models\FootballMatch;
use Illuminate\Http\Request;

class MatchController extends Controller
{

    public function index(Request $request)
    {
        $query = FootballMatch::with(['homeTeam', 'awayTeam', 'competition']);

        // Optional filters
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        if ($request->has('competition_id')) {
            $query->where('competition_id', $request->competition_id);
        }

        if ($request->has('team_id')) {
            $teamId = $request->team_id;
            $query->where(function ($q) use ($teamId) {
                $q->where('home_team_id', $teamId)
                    ->orWhere('away_team_id', $teamId);
            });
        }

        if ($request->has('date_from')) {
            $query->where('match_date', '>=', $request->date_from);
        }

        if ($request->has('date_to')) {
            $query->where('match_date', '<=', $request->date_to);
        }

        // Sort by match date
        $query->orderBy('match_date', 'desc');

        $matches = $query->paginate($request->get('per_page', 15));

        // Use collection resource for list view
        return new FootballMatchCollection($matches);
    }


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
