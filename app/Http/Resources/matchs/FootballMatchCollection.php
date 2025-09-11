<?php

namespace App\Http\Resources\matchs;

use Illuminate\Http\Resources\Json\ResourceCollection;

class FootballMatchCollection extends ResourceCollection
{
    public function toArray($request): array
    {
        return [
            'data' => $this->collection->map(function ($match) use ($request) {
                return (new FootballMatchResource($match))->toArray($request);
            }),
        ];
    }
}
