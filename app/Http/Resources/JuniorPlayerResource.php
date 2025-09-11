<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class JuniorPlayerResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'email'            => $this->user->email,
            'user_id'          => $this->user_id,
            'phone_number'     => $this->user->phone_number,
            'first_name'       => $this->first_name,
            'last_name'        => $this->last_name,
            'display_name'     => $this->display_name,
            'birth_date'       => $this->birth_date,
            'nationality_id'   => $this->nationality_id,
            'height_cm'        => $this->height_cm,
            'weight_kg'        => $this->weight_kg,
            'primary_position' => $this->primary_position,
            'preferred_foot'   => $this->preferred_foot,
            'player_image'     => $this->player_image,
            'video_url'        => $this->video_url,
            'created_at'       => $this->created_at,
            'updated_at'       => $this->updated_at,
        ];
    }
}
