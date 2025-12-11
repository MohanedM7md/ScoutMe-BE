<?php

namespace App\Http\Resources\users;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ScoutResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'                => $this->user->id,
            'name'              => $this->name,
            'location'          => null,
            'email'             => $this->user->email,
            'imageUrl;'         => $this->logo_url,
            'phoneNumber;'      => $this->user->phone_number,
            'notes'             => $this->notes,
            'is_verified'       => $this->is_verified,
        ];
    }
}
