<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompetitionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array
     */
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
            'created_at'   => $this->created_at,
            'updated_at'   => $this->updated_at,
        ];
    }
}
