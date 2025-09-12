<?php

namespace App\Http\Resources\matchs;

use App\Http\Resources\teams\TeamStatsResource;
use Illuminate\Http\Resources\Json\JsonResource;

class FootballMatchStatsResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'matchId'         => $this->id,
            'home_team_stats' => new TeamStatsResource($this->homeTeamStats),
            'away_team_stats' => new TeamStatsResource($this->awayTeamStats),
        ];
    }
}
