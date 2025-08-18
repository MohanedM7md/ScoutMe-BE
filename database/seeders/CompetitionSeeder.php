<?php

namespace Database\Seeders;

use App\Models\Competition;
use Illuminate\Database\Seeder;

class CompetitionSeeder extends Seeder
{
    private $competitions = [
        [
            'name' => 'Premier League',
            'short_name' => 'EPL',
            'type' => 'league',
            'country_code' => 'GB',
            'gender' => 'men',
            'age_group' => 'senior',
            'logo_url' => 'https://example.com/logos/premier-league.png'
        ],
        [
            'name' => 'UEFA Champions League',
            'short_name' => 'UCL',
            'type' => 'tournament',
            'country_code' => null, // International
            'gender' => 'men',
            'age_group' => 'senior',
            'logo_url' => 'https://example.com/logos/ucl.png'
        ],
        [
            'name' => 'FA Cup',
            'short_name' => 'FAC',
            'type' => 'tournament',
            'country_code' => 'GB',
            'gender' => 'men',
            'age_group' => 'senior',
            'logo_url' => 'https://example.com/logos/fa-cup.png'
        ],
        [
            'name' => 'International Friendly',
            'short_name' => 'Friendly',
            'type' => 'friendly',
            'country_code' => null,
            'gender' => 'men',
            'age_group' => 'senior',
            'logo_url' => null
        ],
        [
            'name' => 'Women\'s Super League',
            'short_name' => 'WSL',
            'type' => 'league',
            'country_code' => 'GB',
            'gender' => 'women',
            'age_group' => 'senior',
            'logo_url' => 'https://example.com/logos/wsl.png'
        ],
        [
            'name' => 'UEFA Youth League',
            'short_name' => 'UYL',
            'type' => 'tournament',
            'country_code' => null,
            'gender' => 'men',
            'age_group' => 'U20',
            'logo_url' => 'https://example.com/logos/uyl.png'
        ],
    ];

    public function run()
    {
        foreach ($this->competitions as $competition) {
            Competition::create($competition);
        }
    }
}
