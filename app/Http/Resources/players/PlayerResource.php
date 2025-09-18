<?php

namespace App\Http\Resources\players;

use Illuminate\Http\Resources\Json\JsonResource;

class PlayerResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'                => $this->id,
            'firstName'        => $this->first_name,
            'lastName'         => $this->last_name,
            'displayName'      => $this->display_name,
            'birthDate'        => $this->birth_date,
            'heightCm'         => $this->height_cm,
            'weightKg'         => $this->weight_kg,
            'image'            => $this->player_image,
            'club'             =>$this->team->name,
            'nationality'       => $this->nationality?->name,
            'position'  => [
                    'id'   => $this->primaryPosition->id,
                    'name' => $this->primaryPosition->full_name,
                ],
        ];
    }
}
