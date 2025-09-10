<?php

namespace App\Http\Requests\Players;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGoalkeeperStatsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'saves_total'        => 'nullable|integer|min:0',
            'saves_inside_box'   => 'nullable|integer|min:0',
            'saves_outside_box'  => 'nullable|integer|min:0',
            'penalties_faced'    => 'nullable|integer|min:0',
            'penalties_saved'    => 'nullable|integer|min:0',
            'punches'            => 'nullable|integer|min:0',
            'high_claims'        => 'nullable|integer|min:0',
            'goals_conceded'     => 'nullable|integer|min:0',
            'clean_sheet'        => 'nullable|boolean',
        ];
    }
}
