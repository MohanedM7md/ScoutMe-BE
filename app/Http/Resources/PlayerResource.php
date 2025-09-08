<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PlayerResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'                => $this->id,
            'first_name'        => $this->first_name,
            'last_name'         => $this->last_name,
            'display_name'      => $this->display_name,
            'birth_date'        => $this->birth_date,
            'height_cm'         => $this->height_cm,
            'weight_kg'         => $this->weight_kg,
            'primary_position'  => $this->whenLoaded('primaryPosition', function () {
                return [
                    'id'   => $this->primaryPosition->id,
                    'name' => $this->primaryPosition->full_name,
                ];
            }),
            'nationality'       => $this->whenLoaded('nationality'),
            'player_image'      => $this->player_image,
            'is_profile_complete' => $this->is_profile_complete,
        ];
    }
}
