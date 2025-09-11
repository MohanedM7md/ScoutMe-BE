<?php

namespace App\Http\Resources\teams;

use Illuminate\Http\Resources\Json\ResourceCollection;

class teamsStandingCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return teamsStandingResource::collection($this->collection);
    }
}