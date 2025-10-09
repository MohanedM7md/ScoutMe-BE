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
        $clubs = Club::all()->shuffle(); // shuffle once globally

        if ($competitions->isEmpty() || $clubs->isEmpty()) {
            $this->command->info('Please seed competitions and clubs first.');
            return;
        }

        // Split clubs into groups (one group per competition)
        $chunks = $clubs->chunk(
            ceil($clubs->count() / $competitions->count())
        );

        foreach ($competitions as $index => $competition) {
            if (isset($chunks[$index])) {
                $competition->clubs()->syncWithoutDetaching(
                    $chunks[$index]->pluck('id')->toArray()
                );
            }
        }

        $this->command->info('Competitions linked with unique random clubs successfully!');
    }
}
