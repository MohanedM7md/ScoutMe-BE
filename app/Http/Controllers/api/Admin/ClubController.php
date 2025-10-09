<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Club;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\Teams\StoreClubRequest;
use App\Http\Requests\Teams\UpdateClubRequest;
use Illuminate\Http\Request;

class ClubController extends Controller
{

    public function index(Request $request)
        {
            $name = $request->query('name'); 
            $perPage = $request->input('per_page', 10);

            $query = Club::query();
            $clubs =   $query->byName($name)
                ->paginate($perPage);

            return response()->json($clubs);
        }

    // Store a new club
    public function store(StoreClubRequest $request): JsonResponse
    {
        $club = Club::create($request->validated());

        return response()->json([
            'message' => 'Club created successfully',
            'data'    => $club,
        ], 201);
    }

    // Update an existing club
    public function update(UpdateClubRequest $request, Club $club): JsonResponse
    {
        $club->update($request->validated());

        return response()->json([
            'message' => 'Club updated successfully',
            'data'    => $club,
        ]);
    }

    // Delete a club
    public function destroy(Club $club): JsonResponse
    {
        $club->delete();

        return response()->json([
            'message' => 'Club deleted successfully',
        ]);
    }
}
