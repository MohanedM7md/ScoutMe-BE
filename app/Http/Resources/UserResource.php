<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\MissingValue;

class UserResource extends JsonResource
{
    public function toArray($request): array
    {
        $Arr = [];
        if ($this->user_role == "player")
            $Arr = $this->whenLoaded('juniorPlayer')?->toArray();
        elseif ($this->user_role == "scout")
            $Arr = $this->whenLoaded('scout')?->toArray();
        else
            $Arr = [];
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'email'       => $this->email,
            'user_role'   => $this->user_role,
            'is_verified' => $this->is_verified,
            ...($Arr),
        ];
    }
}
