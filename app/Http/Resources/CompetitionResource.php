<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CompetitionResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'           => $this->id,
            'name'         => $this->name,
            'short_name'   => $this->short_name,
            'type'         => $this->type,
            'country_code' => $this->country_code,
            'gender'       => $this->gender,
            'age_group'    => $this->age_group,
            'logo_url'     => $this->logo_url,
        ];
    }
}
