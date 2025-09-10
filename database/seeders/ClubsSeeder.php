<?php

namespace Database\Seeders;

use App\Models\Club;
use App\Models\Country;
use Illuminate\Database\Seeder;

class ClubsSeeder extends Seeder
{
    public function run()
    {
        // $countries = Country::pluck('iso_code_3');

        $clubs = [
            ['name' => 'Manchester United', 'short_name' => 'MUFC', 'country_code' => 'GB', ],
            ['name' => 'Real Madrid', 'short_name' => 'RMA', 'country_code' => 'ES', ],
            ['name' => 'Bayern Munich', 'short_name' => 'FCB', 'country_code' => 'DE', ],
            ['name' => 'Paris Saint-Germain', 'short_name' => 'PSG', 'country_code' => 'FR', ],
            ['name' => 'Juventus', 'short_name' => 'JUV', 'country_code' => 'IT', ],
        ];

         foreach ($clubs as $club) {
            Club::create([
                'name' => $club['name'],
                'short_name' => $club['short_name'],
                'country_code' => $club['country_code'],
                'club_type' => 'professional',
                'logo_url' => 'logos/' . strtolower(str_replace(' ', '-', $club['name'])) . '.png',
                'is_verified' => true,

            ]);
        }
    }
}
