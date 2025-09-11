<?php
// app/Http/Resources/CompetitionResource.php
namespace App\Http\Resources\competition;

use Illuminate\Http\Resources\Json\JsonResource;

class CompetitionResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'           => $this->id,
            'name'         => $this->name,
            'shortName'    => $this->short_name,
            'country'      => $this->country?->name,
            'type'         => $this->type,
            'gender'       => $this->gender,
            'age_group'    => $this->age_group,
            'logo_url'     => $this->logo_url,
        ];
    }

}
