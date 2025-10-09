<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Competition;
use App\Http\Resources\competition\CompetitionResource;
use App\Repositories\CompetitonsRepository;
use Illuminate\Http\Request;

class CompetitionController extends Controller
{
    protected $repo;
    public function __construct(CompetitonsRepository $repo){
        $this->repo = $repo;
    }
    public function index(Request $request)
    {
        $filters = $request->only(
            ['country_code', 'type', 'gender', 'age_group', 'name']
        );
        $sortField = $request->input('sort', 'name');
        $sortDirection = $request->input('direction', 'asc');
        $perPage = $request->input('per_page',10);
        $competitions = $this->repo->getCompetitions($filters,$sortField, $sortDirection,$perPage );
        return CompetitionResource::collection($competitions);
    }


    public function show(Competition $competition)
    {
        return new CompetitionResource($competition);
    }
}
