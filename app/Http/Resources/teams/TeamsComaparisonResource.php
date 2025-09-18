<?php

namespace App\Http\Resources\teams;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Services\PointCalculationService;
class TeamsComaparisonResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'teamA'                 => $this['teamAProfile'],
            'teamB'                 => $this['teamBProfile'],
            'teamAStats'            => new TeamStatsResource($this['teamAStats']),
            'teamBStats'            => new TeamStatsResource($this['teamBStats']),
        ];
    }
}