<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\SearchRepository;

class SearchController extends Controller
{
    protected $repo;
    public function __construct(SearchRepository $repo){
        $this->repo = $repo;
    }
    public function search(Request $request)
    {
        $q = $request->input('q');
        $results = $this->repo->SearchRepository($q, 5);

        return response()->json($results->values());
    }
}
