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


        $query->withCount('matches');


        $query->filter($request->only([
            'name',
            'type',
            'country_code',
            'gender',
            'age_group'
        ]));


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

    public function getMatches(Competition $competition, Request $request)
    {
        $query = $competition->matches()
            ->with(['homeTeam', 'awayTeam'])
            ->orderBy('match_date', 'desc');


        if ($request->has('year')) {
            $query->whereYear('match_date', $request->year);
        }

        if ($request->has('date_from') && $request->has('date_to')) {
            $query->whereBetween('match_date', [
                $request->date_from,
                $request->date_to
            ]);
        }

        return response()->json($query->paginate($request->input('per_page', 10)));
    }
}
