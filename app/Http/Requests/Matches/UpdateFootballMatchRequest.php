<?php

namespace App\Http\Requests\Matches;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateFootballMatchRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'home_team_id'   => ['sometimes', 'exists:clubs,id'],
            'away_team_id'   => [
                'sometimes',
                'exists:clubs,id',
                Rule::notIn([$this->home_team_id ?? $this->route('match')->home_team_id])
            ],
            'match_date'     => ['sometimes', 'date'],
            'competition_id' => ['nullable', 'exists:competitions,id'],
            'referee'        => ['nullable', 'string', 'max:100'],
            'status'         => [
                'sometimes',
                Rule::in(['scheduled', 'in_play', 'finished', 'postponed', 'canceled'])
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'away_team_id.not_in' => 'Home team and away team must be different.',
        ];
    }
}
