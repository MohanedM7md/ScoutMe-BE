<?php

namespace App\Http\Resources\teams;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Services\PointCalculationService;
class TeamProfileResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'team_id'       => $this->id,
            'name'          => $this->name,
            'short_name'    => $this->short_name,
            'logo_url'      => $this->logo_url,
            'total_matches' => $this->total_matches,
            'record'        =>[
                'wins'          => $this->wins,
                'losses'        => $this->losses,
                'draws'         => $this->draws,
                'diff'          => ($this->wins - $this->losses),
            ],
            'points'        => PointCalculationService::calculatePoints(
            wins: $this->wins, 
            draws: $this->draws, 
            losses: $this->losses
            ),
        ];
    }
}