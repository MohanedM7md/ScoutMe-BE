<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\PlayerRepository;
use App\Http\Requests\Players\SearchPlayerRequest;
use App\Http\Resources\players\PlayerResource;
use App\Http\Resources\players\PlayerSeasonalStatResource;
use App\Models\Player;
use Illuminate\Http\Request;

class PlayerController extends Controller
{

    protected $repo;

    public function __construct(PlayerRepository $repo){
        $this->repo = $repo;
    }
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 0);
        $page    = $request->input('page', 1);
        $filters = $request->only(['team_id', 'nationality','name','position']);
        $players = $this->repo->getPlayers($filters, $page,$perPage);
        return PlayerResource::collection($players);
    }

    public function show(Player $player)
    {
        return new PlayerResource($player);
    }


    public function getPlayerSeasonalStats(Request $request, $playerId){
        $seasonId = $request->query('season_id');
        $playerStats = $this->repo->getPlayerAggStats($seasonId,$playerId);
        return new PlayerSeasonalStatResource($playerStats);
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
