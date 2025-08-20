<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTeamStatsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Adjust for auth
    }

    public function rules(): array
    {
        return [
            'club_id'   => 'required|exists:clubs,id',
            'football_match_id'  => 'required|exists:football_matches,id',
            'is_home'   => 'required|boolean',
            'season_id' => ['required', 'exists:seasons,id'],
            // Results
            'goals'           => 'nullable|integer|min:0',
            'goals_conceded'  => 'nullable|integer|min:0',
            'result'          => 'nullable|integer|min:0|max:127',

            // Attack stats
            'penalty_goals'   => 'nullable|integer|min:0',
            'shots'           => 'nullable|integer|min:0',
            'shots_on_target' => 'nullable|integer|min:0',
            'expected_goals'  => 'nullable|numeric|min:0',

            // Passing
            'possession'            => 'nullable|numeric|min:0|max:100',
            'passes_attempted'      => 'nullable|integer|min:0',
            'passes_completed'      => 'nullable|integer|min:0',

            // Defending
            'tackles'         => 'nullable|integer|min:0',
            'interceptions'   => 'nullable|integer|min:0',
            'clearances'      => 'nullable|integer|min:0',
            'clean_sheet'     => 'nullable|boolean',

            // Cards
            'fouls_committed' => 'nullable|integer|min:0',
            'yellow_cards'    => 'nullable|integer|min:0',
            'red_cards'       => 'nullable|integer|min:0',
        ];
    }
}
