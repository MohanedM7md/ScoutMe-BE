<?php
// app/Http/Resources/CompetitionResource.php
namespace App\Http\Resources\dashboard;

use Illuminate\Http\Resources\Json\JsonResource;

class CompetitionDashboardResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'        => $this->id,
            'name'      => $this->name,
            'shortname' => $this->short_name,
            'logo'      => $this->logo_url,
            'season'    => $this->seasons->last()->name ?? null,
            'teams'     => $this->clubs()->count(),
            'matches'   => $this->footballMatches()->count(),
        ];
    }
}
