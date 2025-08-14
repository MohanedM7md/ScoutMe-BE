<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountriesSeeder extends Seeder
{
    public function run()
    {
        $countries = [
            ['id' => 'US', 'name' => 'United States', 'iso_code_3' => 'USA', 'continent' => 'North America'],
            ['id' => 'GB', 'name' => 'United Kingdom', 'iso_code_3' => 'GBR', 'continent' => 'Europe'],
            ['id' => 'FR', 'name' => 'France', 'iso_code_3' => 'FRA', 'continent' => 'Europe'],
            ['id' => 'DE', 'name' => 'Germany', 'iso_code_3' => 'DEU', 'continent' => 'Europe'],
            ['id' => 'ES', 'name' => 'Spain', 'iso_code_3' => 'ESP', 'continent' => 'Europe'],
            ['id' => 'BR', 'name' => 'Brazil', 'iso_code_3' => 'BRA', 'continent' => 'South America'],
        ];

        foreach ($countries as $country) {
            Country::create($country);
        }
    }
}
