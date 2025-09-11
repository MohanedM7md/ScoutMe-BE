<?php
// app/Http/Resources/CompetitionResource.php
namespace App\Http\Resources\competition;

use Illuminate\Http\Resources\Json\JsonResource;

class FeaturedCompetitionsResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'        => $this->competition_id,
            'name'      => $this->competition_name,
            'shortName' => $this->short_name,
            'country'   => $this->name,
            'logo'      => $this->logo_url,
            'season'    => $this->season,
            'teams'     => $this->teams,
            'matches'   => $this->matches,
        ];
    }
}
