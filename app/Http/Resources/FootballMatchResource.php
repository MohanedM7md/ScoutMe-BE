<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FootballMatchResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'             => $this->id,
            'home_team_id'   => $this->home_team_id,
            'away_team_id'   => $this->away_team_id,
            'season_id'      => $this->season_id,
            'match_date'     => $this->match_date,
            'competition_id' => $this->competition_id,
            'referee'        => $this->referee,
            'status'         => $this->status,
            'created_at'     => $this->created_at,
            'updated_at'     => $this->updated_at,

            'home_team'    => $this->whenLoaded('homeTeam'),
            'away_team'    => $this->whenLoaded('awayTeam'),
            'competition'  => $this->whenLoaded('competition'),

            'is_live'      => $this->status === 'in_play',
            'is_upcoming'  => $this->status === 'scheduled' && $this->match_date > now(),
        ];
    }
}
