<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Competition;
use App\Models\Season;

class CompetitionSeasonSeeder extends Seeder
{
    public function run()
    {
        $competitions = Competition::all();
        $seasons = Season::all();

        if ($competitions->isEmpty() || $seasons->isEmpty()) {
            $this->command->info('Please seed competitions and seasons first.');
            return;
        }

        foreach ($competitions as $competition) {
            // Attach the first 2 seasons to each competition
            $competition->seasons()->syncWithoutDetaching($seasons->take(2)->pluck('id')->toArray());
        }
    }
}
