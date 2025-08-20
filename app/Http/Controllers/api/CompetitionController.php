<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Competition;
use Illuminate\Http\Request;

class CompetitionController extends Controller
{
    public function index(Request $request)
    {
        $query = Competition::query();

        $query->withCount('footballMatchs');

        $query->filter($request->only(['country_code']));


        $sortField = $request->input('sort', 'name');
        $sortDirection = $request->input('direction', 'asc');
        $query->orderBy($sortField, $sortDirection);

        $competitions = $query->paginate($request->input('per_page', 15));

        return response()->json($competitions);
    }


    public function show(Competition $competition)
    {
        return response()->json($competition->load('matches', 'country'));
    }
}
