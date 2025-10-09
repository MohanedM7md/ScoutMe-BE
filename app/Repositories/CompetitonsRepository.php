<?php

namespace App\Repositories;
use App\Models\Competition;

class CompetitonsRepository
{
    public function getCompetitions(array $filters = [], $sortField, $sortDirection, int $perPage = 10)
    {
       $query = Competition::query();

        $query->withCount('footballMatches');
        $query->filter($filters);

        $query->orderBy($sortField, $sortDirection);

        $competitions = $query->paginate($perPage);


        return $competitions;
    }

}
