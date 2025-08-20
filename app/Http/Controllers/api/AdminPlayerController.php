<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminPlayerController extends Controller
{
    public function index()
    {
        return response()->json(
            Player::with(['primaryPosition', 'nationalityCountry'])
                ->orderBy('last_name')
                ->paginate(15)
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'display_name' => 'nullable|string|max:100',
            'birth_date' => 'required|date|before:-16 years',
            'height_cm' => 'required|integer|between:150,220',
            'weight_kg' => 'required|integer|between:40,100',
            'primary_position' => [
                'required',
                Rule::exists('positions', 'id')
            ],
            'player_image' => 'nullable|url|max:255',
            'is_profile_complete' => 'sometimes|boolean'
        ]);

        $player = Player::create($validated);

        return response()->json($player->load([
            'nationalityCountry',
            'secondNationalityCountry',
            'primaryPosition'
        ]), 201);
    }

    public function show(Player $player)
    {
        return response()->json($player->load([
            'primaryPosition',
            'matchStats.match',
            'aggregatedStats'
        ]));
    }

    public function update(Request $request, Player $player)
    {
        $validated = $request->validate([
            'first_name' => 'sometimes|string|max:100',
            'last_name' => 'sometimes|string|max:100',
            'display_name' => 'sometimes|nullable|string|max:100',
            'birth_date' => 'sometimes|date|before:-16 years',
            'height_cm' => 'sometimes|integer|between:150,220',
            'weight_kg' => 'sometimes|integer|between:40,100',
            'primary_position' => [
                'sometimes',
                Rule::exists('positions', 'id')
            ],
            'player_image' => 'sometimes|nullable|url|max:255',
            'is_profile_complete' => 'sometimes|boolean'
        ]);

        $player->update($validated);

        return response()->json($player->fresh([
            'nationalityCountry',
            'secondNationalityCountry',
            'primaryPosition'
        ]));
    }

    public function destroy(Player $player)
    {
        $player->delete();
        return response()->json(['message' => 'Player deleted successfully']);
    }
}
