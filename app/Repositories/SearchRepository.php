<?php

namespace App\Repositories;
use Illuminate\Support\Facades\DB;
use App\Models\Player;
use App\Models\FootballMatch;
use App\Models\Club;
use App\Models\Competition;

class SearchRepository
{   


public function SearchRepository(string $q, int $limit = 20)
    {
        return DB::table('players')
            ->select(
                'id',
                DB::raw("CONCAT(first_name, ' ', last_name) as name"),
                DB::raw("'player' as type"),
                "player_image as imageUrl"
            )
            ->where(function ($query) use ($q) {
                $query->where('first_name', 'like', "%{$q}%")
                    ->orWhere('last_name', 'like', "%{$q}%")
                    ->orWhere(DB::raw("CONCAT(first_name, ' ', last_name)"), 'like', "%{$q}%");
            })
            ->unionAll(
                DB::table('clubs')
                    ->select('id', 'name', DB::raw("'team' as type"), "logo_url as imageUrl")
                    ->where('name', 'like', "%{$q}%")
            )
            ->unionAll(
                DB::table('competitions')
                    ->select('id', 'name', DB::raw("'competition' as type"), "logo_url as imageUrl")
                    ->where('name', 'like', "%{$q}%")
            )

            ->limit(value: $limit)
            ->get();
    }

}
