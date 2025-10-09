<?php

namespace App\Http\Requests\Teams;

use Illuminate\Foundation\Http\FormRequest;

class StoreClubRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }
    public function rules(): array
    {
        return [
            'name'        => 'required|string|max:255',
            'short_name'  => 'nullable|string|max:50',
            'country_code'=> 'required|string|size:2',
            'club_type'   => 'required|string|in:club,national',
            'logo_url'    => 'nullable|url',
            'is_verified' => 'boolean',
        ];
    }
}
