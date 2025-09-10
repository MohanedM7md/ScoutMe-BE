<?php

namespace App\Http\Resources\teams;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Services\PointCalculationService;
class teamsStandingResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'team_id'       => $this->id,
            'name'          => $this->name,
            'short_name'    => $this->short_name,
            'logo_url'      => $this->logo_url,
            'total_matches' => $this->total_matches,
            'wins'          => $this->wins,
            'losses'        => $this->losses,
            'draws'         => $this->draws,
            'points'        => PointCalculationService::calculatePoints(
            wins: $this->wins, 
            draws: $this->draws, 
            losses: $this->losses
            ),
            'team_stats'    => $this->teamStats->map(function ($stat) {
                return [
                    'stat_id'   => $stat->id,
                    'match_id'  => $stat->football_match_id,
                    'result'    => $stat->result,
                ];
            }),
        ];
    }
}