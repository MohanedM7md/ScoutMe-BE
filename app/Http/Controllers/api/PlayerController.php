<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Players\SearchPlayerRequest;
use App\Http\Resources\PlayerResource;
use App\Models\Player;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $page    = $request->input('page', 1);

        $players = Player::with('primaryPosition')
            ->filter($request->only(['position', 'name']))
            ->orderBy('last_name')
            ->paginate($perPage, ['*'], 'page', $page);

        return PlayerResource::collection($players->load('nationality'));
    }

    public function show(Player $player)
    {
        return new PlayerResource(
            $player->load([
                'primaryPosition',
                'nationality',
            ])
        );
    }


    public function search(SearchPlayerRequest $request)
    {
        $results = Player::search($request->query('query'))
            ->query(fn($builder) => $builder->with(['primaryPosition', 'nationalityCountry']))
            ->paginate($request->input('per_page', 10));

        return response()->json([
            'results'     => PlayerResource::collection($results),
            'suggestions' => $this->getSearchSuggestions($request->input('query')),
        ]);
    }


    protected function getSearchSuggestions(string $query)
    {
        return Player::where('first_name', 'like', $query . '%')
            ->orWhere('last_name', 'like', $query . '%')
            ->take(5)
            ->pluck('display_name');
    }
}
