<?php

namespace App\Http\Requests\Players;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePlayerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name'          => 'sometimes|string|max:100',
            'last_name'           => 'sometimes|string|max:100',
            'display_name'        => 'sometimes|nullable|string|max:100',
            'birth_date'          => 'sometimes|date|before:-16 years',
            'height_cm'           => 'sometimes|integer|between:150,220',
            'weight_kg'           => 'sometimes|integer|between:40,100',
            'player_nationality'  => 'required|string|size:2',
            'primary_position'    => ['sometimes', Rule::exists('positions', 'id')],
            'player_image'        => 'sometimes|nullable|url|max:255',
            'is_profile_complete' => 'sometimes|boolean',
            'team_id'             => 'required|integer',
        ];
    }
}
