<?php

namespace App\Http\Resources\players;

use Illuminate\Http\Resources\Json\JsonResource;

class PlayerStatsResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'minutesPlayed'       => (int) $this->minutes_played,
            'rating'              => (float) $this->rating,
            'position'            => $this->position?->name,
            'isStarter'           => (bool) $this->starts,
            'substituteOnMin'     => (int) $this->substitute_on_min,
            'substituteOffMin'    => (int) $this->substitute_off_min,
            'goals'               => (int) $this->goals,
            'assists'             => (int) $this->assists,
            'shotsTotal'          => (int) $this->shots_total,
            'shotsOnTarget'       => (int) $this->shots_on_target,
            'shotAccuracy'        => (float) $this->shot_accuracy,
            'hitWoodwork'         => (int) $this->hit_woodwork,
            'bigChancesCreated'   => (int) $this->big_chances_created,
            'bigChancesMissed'    => (int) $this->big_chances_missed,
            'touchesInBox'        => (int) $this->touches_in_box,
            'progressiveCarries'  => (int) $this->progressive_carries,
            'progressiveReceptions'=> (int) $this->progressive_receptions,
            'dribblesAttempted'   => (int) $this->dribbles_attempted,
            'dribblesCompleted'   => (int) $this->dribbles_completed,
            'dribbleSuccessRate'  => (float) $this->dribble_success_rate,
            'offsides'            => (int) $this->offsides,
            'tacklesAttempted'    => (int) $this->tackles_attempted,
            'tacklesWon'          => (int) $this->tackles_won,
            'tackleSuccessRate'   => (float) $this->tackle_success_rate,
            'interceptions'       => (int) $this->interceptions,
            'clearances'          => (int) $this->clearances,
            'blocks'              => (int) $this->blocks,
            'shotBlocks'          => (int) $this->shot_blocks,
            'recoveries'          => (int) $this->recoveries,
            'groundDuels'         => (int) $this->ground_duels,
            'groundDuelsWon'      => (int) $this->ground_duels_won,
            'aerialDuels'         => (int) $this->aerial_duels,
            'aerialDuelsWon'      => (int) $this->aerial_duels_won,
            'possession'          => (float) $this->possession,
            'possessionWon'       => (int) $this->possession_won,
            'passesAttempted'     => (int) $this->passes_attempted,
            'passesCompleted'     => (int) $this->passes_completed,
            'passAccuracy'        => (float) $this->pass_accuracy,
            'progressivePasses'   => (int) $this->progressive_passes,
            'crossesAttempted'    => (int) $this->crosses_attempted,
            'crossesCompleted'    => (int) $this->crosses_completed,
            'crossAccuracy'       => (float) $this->cross_accuracy,
            'foulsCommitted'      => (int) $this->fouls_committed,
            'foulsSuffered'       => (int) $this->fouls_suffered,
            'yellowCards'         => (int) $this->yellow_cards,
            'redCards'            => (int) $this->red_cards,
            'distanceCoveredM'    => (float) $this->distance_covered_m,
            'distanceSprintedM'   => (float) $this->distance_sprinted_m,
            // Goalkeeper stats
            'savesTotal'          => (int) $this->goalkeeperStats?->saves_total,
            'savesInsideBox'      => (int) $this->goalkeeperStats?->saves_inside_box,
            'savesOutsideBox'     => (int) $this->goalkeeperStats?->saves_outside_box,
            'penaltiesFaced'      => (int) $this->goalkeeperStats?->penalties_faced,
            'penaltiesSaved'      => (int) $this->goalkeeperStats?->penalties_saved,
            'punches'             => (int) $this->goalkeeperStats?->punches,
            'highClaims'          => (int) $this->goalkeeperStats?->high_claims,
            'goalsConceded'       => (int) $this->goalkeeperStats?->goals_conceded,
            'cleanSheet'          => (int) $this->goalkeeperStats?->clean_sheet,
        ];
    }
}
