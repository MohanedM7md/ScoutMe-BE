<?php

namespace App\Http\Requests\Teams;

use Illuminate\Foundation\Http\FormRequest;

class TeamStatsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Adjust for auth
    }

    public function rules(): array
    {
        return [
            'club_id'            => 'required|exists:clubs,id',
            'football_match_id'  => 'required|exists:football_matches,id',
            'season_id'          => 'required|exists:seasons,id',
            'is_home'            => 'required|boolean',

            // Results
            'goals'              => 'nullable|integer|min:0',
            'goals_conceded'     => 'nullable|integer|min:0',
            'result'             => 'nullable|integer|min:0|max:127',

            // Goals breakdown
            'penalty_goals'      => 'nullable|integer|min:0',
            'penalty_attempts'   => 'nullable|integer|min:0',
            'free_kick_goals'    => 'nullable|integer|min:0',
            'free_kick_attempts' => 'nullable|integer|min:0',
            'goals_inside_box'   => 'nullable|integer|min:0',
            'shots_inside_box'   => 'nullable|integer|min:0',
            'goals_outside_box'  => 'nullable|integer|min:0',
            'shots_outside_box'  => 'nullable|integer|min:0',
            'left_foot_goals'    => 'nullable|integer|min:0',
            'right_foot_goals'   => 'nullable|integer|min:0',
            'headed_goals'       => 'nullable|integer|min:0',

            // Attack stats
            'big_chances'        => 'nullable|integer|min:0',
            'big_chances_missed' => 'nullable|integer|min:0',
            'shots'              => 'nullable|integer|min:0',
            'shots_on_target'    => 'nullable|integer|min:0',
            'shots_off_target'   => 'nullable|integer|min:0',
            'blocked_shots'      => 'nullable|integer|min:0',
            'successful_dribbles'=> 'nullable|integer|min:0',
            'hit_woodwork'       => 'nullable|integer|min:0',
            'counter_attacks'    => 'nullable|integer|min:0',
            'big_chances_created'=> 'nullable|integer|min:0',
            'expected_goals'     => 'nullable|numeric|min:0',

            // Passing
            'possession'                        => 'nullable|numeric|min:0|max:100',
            'passes_attempted'                  => 'nullable|integer|min:0',
            'passes_completed'                  => 'nullable|integer|min:0',
            'own_half_passes_completed'         => 'nullable|integer|min:0',
            'own_half_passes_attempted'         => 'nullable|integer|min:0',
            'opposition_half_passes_completed'  => 'nullable|integer|min:0',
            'opposition_half_passes_attempted'  => 'nullable|integer|min:0',
            'long_balls_completed'              => 'nullable|integer|min:0',
            'long_balls_attempted'              => 'nullable|integer|min:0',
            'crosses_completed'                 => 'nullable|integer|min:0',
            'crosses_attempted'                 => 'nullable|integer|min:0',
            'through_balls_completed'           => 'nullable|integer|min:0',
            'progressive_passes'                => 'nullable|integer|min:0',

            // Defending
            'tackles'                 => 'nullable|integer|min:0',
            'tackles_won'             => 'nullable|integer|min:0',
            'interceptions'           => 'nullable|integer|min:0',
            'clearances'              => 'nullable|integer|min:0',
            'saves'                   => 'nullable|integer|min:0',
            'balls_recovered'         => 'nullable|integer|min:0',
            'errors_leading_to_shot'  => 'nullable|integer|min:0',
            'errors_leading_to_goal'  => 'nullable|integer|min:0',
            'penalties_committed'     => 'nullable|integer|min:0',
            'penalty_goals_conceded'  => 'nullable|integer|min:0',
            'clearances_off_line'     => 'nullable|integer|min:0',
            'last_man_tackles'        => 'nullable|integer|min:0',
            'clean_sheet'             => 'nullable|boolean',

            // Duels
            'duels_total'        => 'nullable|integer|min:0',
            'duels_won'          => 'nullable|integer|min:0',
            'ground_duels_total' => 'nullable|integer|min:0',
            'ground_duels_won'   => 'nullable|integer|min:0',
            'aerial_duels_total' => 'nullable|integer|min:0',
            'aerial_duels_won'   => 'nullable|integer|min:0',

            // Other
            'possession_lost'    => 'nullable|integer|min:0',
            'throw_ins'          => 'nullable|integer|min:0',
            'goal_kicks'         => 'nullable|integer|min:0',
            'offsides'           => 'nullable|integer|min:0',

            // Cards & Fouls
            'fouls_committed'    => 'nullable|integer|min:0',
            'fouls_suffered'     => 'nullable|integer|min:0',
            'yellow_cards'       => 'nullable|integer|min:0',
            'red_cards'          => 'nullable|integer|min:0',

            // Set pieces
            'corners'            => 'nullable|integer|min:0',
            'free_kicks'         => 'nullable|integer|min:0',
        ];
    }
}
