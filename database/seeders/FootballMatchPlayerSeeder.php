<?php

namespace Database\Seeders;

use App\Models\FootballMatch;
use App\Models\Position;
use Illuminate\Database\Seeder;

class FootballMatchPlayerSeeder extends Seeder
{
    public function run()
    {
        $matches = FootballMatch::with(['homeTeam.players', 'awayTeam.players'])->get();

        foreach ($matches as $match) {
            $homePlayers = $match->homeTeam->players;
            $awayPlayers = $match->awayTeam->players;

            // Pick 11 starters if possible
            $homeSelected = $homePlayers->random(min(11, $homePlayers->count()));
            $awaySelected = $awayPlayers->random(min(11, $awayPlayers->count()));

            // Attach starters with team_id
            $this->attachPlayers($match, $homeSelected, $match->home_team_id);
            $this->attachPlayers($match, $awaySelected, $match->away_team_id);

            // Pick substitutes (up to 3)
            $homeSubs = $homePlayers->diff($homeSelected)->random(min(3, max(0, $homePlayers->count() - 11)));
            $awaySubs = $awayPlayers->diff($awaySelected)->random(min(3, max(0, $awayPlayers->count() - 11)));

            $this->attachPlayers($match, $homeSubs, $match->home_team_id);
            $this->attachPlayers($match, $awaySubs, $match->away_team_id);
        }
    }

    private function attachPlayers($match, $players, $teamId)
    {
        foreach ($players as $player) {
            // Get the position ID (since played_position references positions table)
            $position = Position::where('id', $player->primary_position)->first();

            $match->players()->attach($player->id, [
                'team_id' => $teamId,
                'played_position' => $position?->id ?? $player->primary_position,
            ]);
        }
    }
}
