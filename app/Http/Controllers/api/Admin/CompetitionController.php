<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Competitions\StoreCompetitionRequest;
use App\Http\Requests\Competitions\UpdateCompetitionRequest;
use App\Http\Resources\competition\CompetitionResource;
use App\Models\Competition;

class CompetitionController extends Controller
{
    public function store(StoreCompetitionRequest $request)
    {
        $competition = Competition::create($request->validated());

        return response()->json([
            'message' => 'Competition created successfully.',
            'data'    => new CompetitionResource($competition),
        ], 201);
    }

    public function update(UpdateCompetitionRequest $request, Competition $competition)
    {
        $competition->update($request->validated());

        return response()->json([
            'message' => 'Competition updated successfully.',
            'data'    => new CompetitionResource($competition),
        ], 200);
    }

    public function destroy(Competition $competition)
    {
        $competition->delete();

        return response()->json([
            'message' => 'Competition deleted successfully.'
        ], 204);
    }
}
