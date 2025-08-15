<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Player;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function index(Request $request)
    {
        $players = Player::with('primaryPosition')
            ->filter($request->all())
            ->paginate(15);

        return response()->json($players);
    }

    public function show(Player $player)
    {
        return response()->json($player->load([
            'nationalityCountry',
            'secondNationalityCountry',
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
        $players = Player::search($request->query('q'))
            ->with(['nationalityCountry', 'primaryPosition'])
            ->paginate(10);

        return response()->json($players);
    }
}
