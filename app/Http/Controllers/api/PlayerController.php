<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Player;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10); // default = 10
        $page = $request->input('page', 1); // default first page

        $players = Player::with('primaryPosition')
            ->filter($request->only(['position', 'name']))
            ->paginate($perPage, ['*'], 'page', $page);

        return response()->json($players);
    }

    public function show(Player $player)
    {
        return response()->json($player->load([
            'primaryPosition',
            'matchStats',
            'aggregatedStats'
        ]));
    }

    public function getStats(Player $player)
    {
        return response()->json([
            'career_stats' => $player->aggregatedStats()->where('stat_type', 'career')->first(),
            'season_stats' => $player->aggregatedStats()->where('stat_type', 'season')->first(),
        ]);
    }

    public function search(Request $request)
    {
        $request->validate([
            'query' => 'required|string|min:2',
            'per_page' => 'sometimes|integer|min:1|max:100'
        ]);

        $results = Player::search($request->input('query'))
            ->query(function ($builder) {
                $builder->with(['primaryPosition', 'nationalityCountry']);
            })
            ->paginate($request->input('per_page', 10));

        return response()->json([
            'results' => $results,
            'suggestions' => $this->getSearchSuggestions($request->input('query'))
        ]);
    }

    protected function getSearchSuggestions($query)
    {
        return Player::where('first_name', 'like', $query . '%')
            ->orWhere('last_name', 'like', $query . '%')
            ->take(5)
            ->pluck('display_name');
    }
}
