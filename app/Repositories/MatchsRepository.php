<?php

namespace App\Repositories;
use App\Models\Club;
use App\Models\FootballMatch;
use App\Models\MatchTeamStats;
use Illuminate\Support\Facades\Schema;

class MatchsRepository
{
    public function getMatches(array $filters = [], array $with = [], int $perPage = 10)
    {
        $query = FootballMatch::query();
        $query->with(['homeTeam', 'awayTeam']);




        return $query
            ->filter(filters: $filters)
            ->orderBy(column: 'match_date', direction: 'desc')
            ->paginate(perPage: $perPage);
    }

}
