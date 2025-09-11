<?php

namespace App\Http\Resources\competition;

use Illuminate\Http\Resources\Json\ResourceCollection;

class FeaturedCompetitionsCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return FeaturedCompetitionsResource::collection($this->collection);
    }
}
