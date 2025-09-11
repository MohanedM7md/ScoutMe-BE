<?php

namespace App\Http\Resources\matchs;

use Illuminate\Http\Resources\Json\JsonResource;

class FootballMatchResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'             => $this->id,
            'season_id'      => $this->season_id,
            'match_date'     => $this->match_date,
            'competition_id' => $this->competition_id,
            'referee'        => $this->referee,
            'status'         => $this->status,
            'is_upcoming'  => $this->status,

            'homeTeam'    => [
                'id'          => $this->homeTeam->id,
                'name'        => $this->homeTeam->name,
                'shortName'   => $this->homeTeam->short_name,
                'logo'        => $this->homeTeam->logo_url,
                'goals'     => optional(
                        $this->teamStats->firstWhere('club_id', $this->homeTeam->id)
                                )->goals
            ],
            'awayTeam'    => [
                'id'          => $this->awayTeam->id,
                'name'        => $this->awayTeam->name,
                'shortName'   => $this->awayTeam->short_name,
                'logo'        => $this->awayTeam->logo_url,
                'goals'     => optional(
                        $this->teamStats->firstWhere('club_id', $this->awayTeam->id)
                                )->goals
            ]

        ];
    }
}
