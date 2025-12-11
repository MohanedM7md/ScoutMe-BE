<?php

namespace App\Http\Resources;
use App\Http\Resources\users\ScoutResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\MissingValue;

class UserResource extends JsonResource
{
    public function toArray($request): array
    {
       
       $Arr = [];
        if ($this->user_role == "player") {
            $Arr  =(new JuniorPlayerResource($this->juniorPlayer))->toArray(request());
        } elseif ($this->user_role == "scout") {
            $Arr = (new ScoutResource($this->scout))->toArray(request());
        }

        return [
            'id'          => $this->id,
            'email'       => $this->email,
            'user_role'   => $this->user_role,
            'is_verified' => $this->is_verified,
            ...$Arr,
        ];
    }
}
