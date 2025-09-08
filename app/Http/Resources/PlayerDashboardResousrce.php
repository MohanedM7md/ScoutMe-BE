<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PlayerDashboardResousrce extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'player_id'             => $this->id,
            'display_name'          => $this->display_name,
            'primary_position'      => $this->whenLoaded('primaryPosition'),
            'club'                  => $this->whenLoaded('team'),
        ];
    }
}
