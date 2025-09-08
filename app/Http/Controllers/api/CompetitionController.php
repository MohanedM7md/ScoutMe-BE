<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Competition;
use App\Http\Resources\CompetitionResource;
use Illuminate\Http\Request;

class CompetitionController extends Controller
{
    public function index(Request $request)
    {
        $query = Competition::query();

        // Eager load with match count
        $query->withCount('footballMatches');
        // Apply all filters
        $filters = $request->only(['country_code', 'type', 'gender', 'age_group', 'name']);
        $query->filter($filters);
        // Sorting
        $sortField = $request->input('sort', 'name');
        $sortDirection = $request->input('direction', 'asc');
        $query->orderBy($sortField, $sortDirection);

        // Pagination
        $competitions = $query->paginate($request->input('per_page', 15));

        return CompetitionResource::collection($competitions);
    }


    public function show(Competition $competition)
    {
        return response()->json($competition->load('matches', 'country'));
    }
}
