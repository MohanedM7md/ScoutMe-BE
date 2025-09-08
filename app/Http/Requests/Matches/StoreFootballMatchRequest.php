<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreFootballMatchRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Adjust if you need authorization
    }

    public function rules(): array
    {
        return [
            'home_team_id'   => ['required', 'exists:clubs,id'],
            'away_team_id'   => ['required', 'exists:clubs,id', 'different:home_team_id'],
            'match_date'     => ['required', 'date'],
            'season_id' => ['required', 'exists:seasons,id'],
            'competition_id' => ['nullable', 'exists:competitions,id'],
            'referee'        => ['nullable', 'string', 'max:100'],
            'status'         => [
                'required',
                Rule::in(['scheduled', 'in_play', 'finished', 'postponed', 'canceled'])
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'away_team_id.different' => 'Home team and away team must be different.',
            'match_date.after_or_equal' => 'Match date cannot be in the past.',
        ];
    }
}
