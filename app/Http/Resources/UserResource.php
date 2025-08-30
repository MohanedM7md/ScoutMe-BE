<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'email'       => $this->email,
            'user_role'   => $this->user_role,
            'is_verified' => $this->is_verified,
            'created_at'  => $this->created_at,
            'updated_at'  => $this->updated_at,

            'profile' => $this->whenLoaded('player') ?? $this->whenLoaded('scout')
        ];
    }
}
