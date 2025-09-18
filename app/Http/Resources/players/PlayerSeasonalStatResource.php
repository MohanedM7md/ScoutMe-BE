<?php

namespace App\Http\Resources\players;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlayerSeasonalStatResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'playerId'            => (int) $this->player_id,
            'seasonId'            => (int) $this->season_id,
            'matches'             => (int) $this->matches,
            'goals'               => (int) $this->goals,
            'assists'             => (int) $this->assists,
            'shotsTotal'         => (int) $this->shots_total,
            'shotsOnTarget'     => (int) $this->shots_on_target,
            'shotAccuracy'       => (float) $this->shot_accuracy,
            'hitWoodwork'        => (int) $this->hit_woodwork,
            'bigChancesMissed'  => (int) $this->big_chances_missed,
            'bigChancesCreated' => (int) $this->big_chances_created,
            'touchesInBox'      => (int) $this->touches_in_box,
            'progressiveReceptions' => (int) $this->progressive_receptions,
            'dribblesAttempted'  => (int) $this->dribbles_attempted,
            'dribblesCompleted'  => (int) $this->dribbles_completed,
            'dribbleSuccessRate'=> (float) $this->dribble_success_rate,
            'progressiveCarries' => (int) $this->progressive_carries,
            'offsides'            => (int) $this->offsides,
            'tackles'             => (int) $this->tackles,
            'tacklesWon'         => (int) $this->tackles_won,
            'tackleSuccessRate' => (float) $this->tackle_success_rate,
            'interceptions'       => (int) $this->interceptions,
            'clearances'          => (int) $this->clearances,
            'blocks'              => (int) $this->blocks,
            'shotBlocks'         => (int) $this->shot_blocks,
            'recoveries'          => (int) $this->recoveries,
            'groundDuels'        => (int) $this->ground_duels,
            'groundDuelsWon'    => (int) $this->ground_duels_won,
            'aerialDuels'        => (int) $this->aerial_duels,
            'aerialDuelsWon'    => (int) $this->aerial_duels_won,
            'possession'          => (float) $this->possession,
            'possessionWon'      => (int) $this->possession_won,
            'starts'              => (bool) $this->starts,
            'substituteOnMin'   => (int) $this->substitute_on_min,
            'substituteOffMin'  => (int) $this->substitute_off_min,
            'minutesPlayed'      => (int) $this->minutes_played,
            'passesAttempted'    => (int) $this->passes_attempted,
            'passesCompleted'    => (int) $this->passes_completed,
            'passAccuracy'       => (float) $this->pass_accuracy,
            'progressivePasses'  => (int) $this->progressive_passes,
            'foulsCommitted'     => (int) $this->fouls_committed,
            'foulsSuffered'      => (int) $this->fouls_suffered,
            'yellowCards'        => (int) $this->yellow_cards,
            'redCards'           => (int) $this->red_cards,
            'distanceCovered_m'  => (float) $this->distance_covered_m,
            'distanceSprinted_m' => (float) $this->distance_sprinted_m,
            'crossesAttempted'   => (int) $this->crosses_attempted,
            'crossesCompleted'   => (int) $this->crosses_completed,
            'crossAccuracy'      => (float) $this->cross_accuracy,
            'savesTotal'         => (int) $this->saves_total,
            'savesInside_box'    => (int) $this->saves_inside_box,
            'savesOutside_box'   => (int) $this->saves_outside_box,
            'penaltiesFaced'     => (int) $this->penalties_faced,
            'penaltiesSaved'     => (int) $this->penalties_saved,
            'punches'             => (int) $this->punches,
            'highClaims'         => (int) $this->high_claims,
            'goalsConceded'      => (int) $this->goals_conceded,
            'cleanSheet'         => (int) $this->clean_sheet,
        ];
    }
}
