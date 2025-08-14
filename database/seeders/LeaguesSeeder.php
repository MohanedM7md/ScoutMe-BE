<?php

namespace Database\Seeders;

use App\Models\League;
use Illuminate\Database\Seeder;

class LeaguesSeeder extends Seeder
{
    public function run()
    {
        $leagues = [
            ['name' => 'Premier League', 'country_code' => 'GB', 'tier' => 1],
            ['name' => 'La Liga', 'country_code' => 'ES', 'tier' => 1],
            ['name' => 'Bundesliga', 'country_code' => 'DE', 'tier' => 1],
            ['name' => 'Serie A', 'country_code' => 'IT', 'tier' => 1],
            ['name' => 'Ligue 1', 'country_code' => 'FR', 'tier' => 1],
            ['name' => 'Championship', 'country_code' => 'GB', 'tier' => 2],
        ];

        foreach ($leagues as $league) {
            League::create([
                'name' => $league['name'],
                'country_code' => $league['country_code'],
                'tier' => $league['tier'],
                'logo_url' => 'leagues/' . strtolower(str_replace(' ', '-', $league['name'])) . '.png'
            ]);
        }
    }
}
