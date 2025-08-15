<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Player;
use Illuminate\Http\Request;

class AdminPlayerController extends Controller
{
    public function index()
    {
        return response()->json(Player::with('primaryPosition')->paginate(15));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            // Add all other player fields
        ]);

        $player = Player::create($validated);
        return response()->json($player, 201);
    }

    public function show(Player $player)
    {
        return response()->json($player->load([
            'secondNationalityCountry',
            'primaryPosition'
        ]));
    }

    public function update(Request $request, Player $player)
    {
        $validated = $request->validate([
            'first_name' => 'sometimes|string|max:100',
            'last_name' => 'sometimes|string|max:100',
            // Add all other player fields
        ]);

        $player->update($validated);
        return response()->json($player);
    }

    public function destroy(Player $player)
    {
        $player->delete();
        return response()->json(['message' => 'Player deleted']);
    }
}
