<?php

namespace App\Http\Resources\teams;

use Illuminate\Http\Resources\Json\JsonResource;

class TeamStatsResource extends JsonResource
{
    public function toArray($request): array
    {
        return [

            
                "possession"    => (float) $this->possession*100,
                "shots"         => (int) $this->shots,
                "shotsOnTarget" => (int) $this->shots_on_target,
                "shotsOffTarget"=> (int) $this->shots_off_target,
                "blockedShots"  => (int) $this->blocked_shots,
                "corners"       => (int) $this->corners,
                    
                "goals"            => (int) $this->goals,
                "goalsConceded"    => (int) $this->goals_conceded,
                "bigChances"       => (int) $this->big_chances,
                "bigChancesMissed" => (int) $this->big_chances_missed,
                "goalsInsideBox"   => (int) $this->goals_inside_box,
                "shotsInsideBox"   => (int) $this->shots_inside_box,
                "goalsOutsideBox"  => (int) $this->goals_outside_box,
                "shotsOutsideBox"  => (int) $this->shots_outside_box,
                "leftFootGoals"    => (int) $this->left_foot_goals,
                "rightFootGoals"   => (int) $this->right_foot_goals,
                "headedGoals"      => (int) $this->headed_goals,
                "counterAttacks"   => (int) $this->counter_attacks,
                "bigChancesCreated"=> (int) $this->big_chances_created,
                "hitWoodwork"      => (int) $this->hit_woodwork,



                "passesAttempted"               => (int) $this->passes_attempted,
                "passesCompleted"               => (int) $this->passes_completed,
                "passAcc"                       => (round(($this->passes_completed / (int)$this->passes_attempted) * 100, 1)),
                "ownHalfPassesAttempted"        => (int) $this->own_half_passes_attempted,
                "ownHalfPassesCompleted"        => (int) $this->own_half_passes_completed,
                "oppositionHalfPassesAttempted" => (int) $this->opposition_half_passes_attempted,
                "oppositionHalfPassesCompleted" => (int) $this->opposition_half_passes_completed,
                "longBallsAttempted"            => (int) $this->long_balls_attempted,
                "longBallsCompleted"            => (int) $this->long_balls_completed,
                "crossesAttempted"              => (int) $this->crosses_attempted,
                "crossesCompleted"              => (int) $this->crosses_completed,
                "throughBallsCompleted"         => (int) $this->through_balls_completed,
                "progressivePasses"             => (int) $this->progressive_passes,


            
                "tackles"             => (int) $this->tackles,
                "tacklesWon"          => (int) $this->tackles_won,
                "interceptions"       => (int) $this->interceptions,
                "clearances"          => (int) $this->clearances,
                "ballsRecovered"      => (int) $this->balls_recovered,
                "duelsTotal"          => (int) $this->duels_total,
                "duelsWon"            => (int) $this->duels_won,
                "groundDuelsTotal"    => (int) $this->ground_duels_total,
                "groundDuelsWon"      => (int) $this->ground_duels_won,
                "aerialDuelsTotal"    => (int) $this->aerial_duels_total,
                "aerialDuelsWon"      => (int) $this->aerial_duels_won,
                "clearancesOffLine"   => (int) $this->clearances_off_line,
                "lastManTackles"      => (int) $this->last_man_tackles,


            
                "saves"       => (int) $this->saves,
                "cleanSheet"  => (int) $this->clean_sheet,
                "penaltyGoalsConceded" => (int) $this->penalty_goals_conceded,


            
                "foulsCommitted"     => (int) $this->fouls_committed,
                "foulsSuffered"      => (int) $this->fouls_suffered,
                "offsides"           => (int) $this->offsides,
                "yellowCards"        => (int) $this->yellow_cards,
                "redCards"           => (int) $this->red_cards,
                "penaltiesCommitted" => (int) $this->penalties_committed,
                "possessionLost"     => (int) $this->possession_lost,


            
                "freeKicks"        => (int) $this->free_kicks,
                "freeKickAttempts" => (int) $this->free_kick_attempts,
                "freeKickGoals"    => (int) $this->free_kick_goals,
                "penaltyAttempts"  => (int) $this->penalty_attempts,
                "penaltyGoals"     => (int) $this->penalty_goals,
                "goalKicks"        => (int) $this->goal_kicks,
                "throwIns"         => (int) $this->throw_ins,


            
                "expectedGoals"      => (float) $this->expected_goals,
                "successfulDribbles" => (int) $this->successful_dribbles,
                "errorsLeadingToShot"=> (int) $this->errors_leading_to_shot,
                "errorsLeadingToGoal"=> (int) $this->errors_leading_to_goal,

        ];
    }
}
