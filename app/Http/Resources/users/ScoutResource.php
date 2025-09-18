<?php

namespace App\Http\Resources\users;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ScoutResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'email'            => $this->user->email,
            'user_id'          => $this->user_id,
            'phone_number'     => $this->user->phone_number,
            'logo_url'         => $this->logo_url,
            'notes'            => $this->notes,
        ];
    }
}
