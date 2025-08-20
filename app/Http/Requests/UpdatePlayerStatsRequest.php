<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePlayerStatsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'player_id'        => 'required|exists:players,id',
            'football_match_id' => 'required|exists:football_matches,id',
            'played_position'  => 'required|exists:positions,id',
            'season_id' => ['required', 'exists:seasons,id'],
            'minutes_played'   => 'nullable|integer|min:0|max:120',
            'starts'           => 'nullable|boolean',

            // Attacking
            'goals'            => 'nullable|integer|min:0',
            'assists'          => 'nullable|integer|min:0',
            'shots_total'      => 'nullable|integer|min:0',

            // Passing
            'passes_attempted' => 'nullable|integer|min:0',
            'passes_completed' => 'nullable|integer|min:0',
            'pass_accuracy'    => 'nullable|numeric|min:0|max:1',

            // Defending
            'tackles'          => 'nullable|integer|min:0',
            'interceptions'    => 'nullable|integer|min:0',
            'clearances'       => 'nullable|integer|min:0',

            // Discipline
            'fouls_committed'  => 'nullable|integer|min:0',
            'yellow_cards'     => 'nullable|integer|min:0',
            'red_cards'        => 'nullable|integer|min:0',

            // Misc
            'heatmap'          => 'nullable|array',
        ];
    }
}
