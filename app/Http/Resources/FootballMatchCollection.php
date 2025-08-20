<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class FootballMatchCollection extends ResourceCollection
{
    public function toArray($request): array
    {
        return [
            'data' => $this->collection->map(function ($match) {
                return [
                    'id'         => $match->id,
                    'match_date' => $match->match_date,
                    'status'     => $match->status,
                    'home_team'  => [
                        'id'   => $match->homeTeam->id,
                        'name' => $match->homeTeam->name,
                        'logo' => $match->homeTeam->logo_url ?? null,
                    ],
                    'away_team'  => [
                        'id'   => $match->awayTeam->id,
                        'name' => $match->awayTeam->name,
                        'logo' => $match->awayTeam->logo_url ?? null,
                    ],
                ];
            }),
            'meta' => [
                'total'        => $this->total(),
                'per_page'     => $this->perPage(),
                'current_page' => $this->currentPage(),
                'last_page'    => $this->lastPage(),
            ],
        ];
    }
}
