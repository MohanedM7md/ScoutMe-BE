<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSeasonRequest;
use App\Http\Requests\UpdateSeasonRequest;
use App\Http\Resources\SeasonResource;
use App\Models\Season;
use Illuminate\Http\Request;

class SeasonController extends Controller
{

    public function index(Request $request)
    {
        $query = Season::query();
        if ($request->boolean('current')) {
            $query->where('is_current', true);
        }
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        $seasons = $query->orderBy('start_date', 'desc')
            ->paginate($request->get('per_page', 15));

        return SeasonResource::collection($seasons);
    }

    public function store(StoreSeasonRequest $request)
    {
        $season = Season::create($request->validated());

        return new SeasonResource($season);
    }


    public function show(Season $season)
    {
        return new SeasonResource($season->load(['competitions', 'footballMatches']));
    }

    public function update(UpdateSeasonRequest $request, Season $season)
    {
        $season->update($request->validated());

        return new SeasonResource($season);
    }

    public function destroy(Season $season)
    {
        $season->delete();

        return response()->noContent();
    }
}
