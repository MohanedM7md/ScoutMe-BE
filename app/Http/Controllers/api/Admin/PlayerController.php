<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Players\StorePlayerRequest;
use App\Http\Requests\Players\UpdatePlayerRequest;
use App\Http\Resources\PlayerResource;
use App\Models\Player;

class playerController extends Controller
{

    public function index()
    {
        $players = Player::with(['primaryPosition', 'nationalityCountry'])
            ->orderBy('last_name')
            ->paginate(15);

        return PlayerResource::collection($players);
    }


    public function store(StorePlayerRequest $request)
    {
        $player = Player::create($request->validated());

        return new PlayerResource(
            $player->load([
                'nationalityCountry',
                'secondNationalityCountry',
                'primaryPosition'
            ])
        );
    }


    public function show(Player $player)
    {
        return new PlayerResource(
            $player->load([
                'primaryPosition',
                'matchStats.match',
                'aggregatedStats'
            ])
        );
    }

    public function update(UpdatePlayerRequest $request, Player $player)
    {
        $player->update($request->validated());

        return new PlayerResource(
            $player->fresh([
                'nationalityCountry',
                'secondNationalityCountry',
                'primaryPosition'
            ])
        );
    }

    public function destroy(Player $player)
    {
        $player->delete();

        return response()->json([
            'message' => 'Player deleted successfully'
        ], 204);
    }
}
