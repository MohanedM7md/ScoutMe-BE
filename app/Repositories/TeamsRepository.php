<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\Club;
use App\Models\MatchTeamStats;

class TeamsRepository
{
    public function getTeamsSatanding($teams = 5,$limit = 5){
        $TeamsSatanding = Club::query()
        ->withCount([
        'teamStats as total_matches',
        'teamStats as wins'   => fn($q) => $q->where('result', 1),
        'teamStats as losses' => fn($q) => $q->where('result', -1),
        'teamStats as draws'  => fn($q) => $q->where('result', 0),
                ])
                ->with(['teamStats' => fn($q) => $q->orderBy('id', 'desc')->limit($limit)])
                ->limit($teams)
                ->get();
        return $TeamsSatanding;
    }   
}
