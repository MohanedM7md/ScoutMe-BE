<?php

namespace App\Http\Requests\Players;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;

class AddJuniorPlayerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'display_name'     => 'nullable|string|max:100',
            'birth_date'       => 'required|date',
            'nationality_id'   => 'required|exists:countries,id',
            'height_cm'        => 'required|integer|min:100|max:240',
            'weight_kg'        => 'required|integer|min:30|max:140',
            'primary_position' => ['required', Rule::exists('positions', 'id')],
            'preferred_foot'   => 'required|in:left,right,both',
            'player_image'     => 'nullable|url',
            'video_url'        => 'nullable|url',
        ];
    }
}
