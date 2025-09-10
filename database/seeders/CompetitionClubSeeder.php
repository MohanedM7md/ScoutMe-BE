<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Competition;
use App\Models\Club;

class CompetitionClubSeeder extends Seeder
{
    public function run()
    {
        $competitions = Competition::all();
        $clubs = Club::all();

        if ($competitions->isEmpty() || $clubs->isEmpty()) {
            $this->command->info('Please seed competitions and clubs first.');
            return;
        }

        foreach ($competitions as $competition) {
            // Attach the first 2 clubs to each competition
            $competition->clubs()->syncWithoutDetaching($clubs->take(2)->pluck('id')->toArray());
        }
    }
}
