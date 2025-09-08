<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateJuniorPlayerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name'       => 'sometimes|string|max:100',
            'last_name'        => 'sometimes|string|max:100',
            'display_name'     => 'sometimes|nullable|string|max:100',
            'birth_date'       => 'sometimes|date',
            'nationality_id'   => 'sometimes|exists:countries,id',
            'height_cm'        => 'sometimes|integer|min:100|max:240',
            'weight_kg'        => 'sometimes|integer|min:30|max:140',
            'primary_position' => ['sometimes', Rule::exists('positions', 'id')],
            'preferred_foot'   => 'sometimes|in:left,right,both',
            'player_image'     => 'sometimes|nullable|url',
            'video_url'        => 'sometimes|nullable|url',
        ];
    }
}
