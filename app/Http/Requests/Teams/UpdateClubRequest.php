<?php

namespace App\Http\Requests\Teams;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClubRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'        => 'sometimes|required|string|max:255',
            'short_name'  => 'sometimes|nullable|string|max:50',
            'country_code'=> 'sometimes|required|string|size:2',
            'club_type'   => 'sometimes|required|string|in:club,national',
            'logo_url'    => 'sometimes|nullable|url',
            'is_verified' => 'sometimes|boolean',
        ];
    }
}
