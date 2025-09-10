<?php

namespace App\Http\Resources\teams;

use Illuminate\Http\Resources\Json\ResourceCollection;

class teamsStandingCollection extends ResourceCollection
{
    public function toArray($request): array
    {
        return [
            'data' => teamsStandingResource::collection($this->collection)
        ];
    }
}