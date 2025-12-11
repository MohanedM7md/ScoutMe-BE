<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class JuniorPlayerResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'                => (string) $this->id,

            'name'              => $this->first_name . ' ' . $this->last_name,

            'age'               => $this->birth_date
                                   ? Carbon::parse($this->birth_date)->age
                                   : null,

            'birthDate'         => $this->birth_date,

            'gender'            => $this->gender,

            'email'             => $this->user->email ?? null,

            'phoneNumber'       => $this->user->phone_number ?? null,

            'imageUrl'          => $this->player_image,

            'positions'         => $this->positions ?? [],

            'primaryPosition'   => $this->primary_position,

            'height'            => $this->height_cm,

            'weight'            => $this->weight_kg,

            'description'       => $this->description,

            'videoLinks'        => $this->video_urls ?? [],

            'favFoots'          => $this->fav_feet ?? [],

            'nationality'       => $this->nationality_id,

            'currentClub'       => $this->current_club,

            'previousClubsInfo' => $this->previous_clubs_info,

            'isProfileCompleted'=> (bool) $this->is_profile_complete,
        ];
    }
}
