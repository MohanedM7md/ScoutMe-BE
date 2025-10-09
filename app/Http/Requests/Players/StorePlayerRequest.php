<?php

namespace App\Http\Requests\Players;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePlayerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Adjust for user permissions if needed
    }

    public function rules(): array
    {
        return [
            'first_name'          => 'required|string|max:100',
            'last_name'           => 'required|string|max:100',
            'display_name'        => 'nullable|string|max:100',
            'birth_date'          => 'required|date|before:-16 years',
            'height_cm'           => 'required|integer|between:150,220',
            'weight_kg'           => 'required|integer|between:40,100',
            'player_nationality'  => 'required|string|size:2',
            'primary_position'    => ['required', Rule::exists('positions', 'id')],
            'player_image'        => 'nullable|url|max:255',
            'is_profile_complete' => 'sometimes|boolean',
            'team_id'             => 'required|integer',
        ];
    }
}
