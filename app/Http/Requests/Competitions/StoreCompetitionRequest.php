<?php

namespace App\Http\Requests\Competitions;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCompetitionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Adjust if you add policies/authorization
    }

    public function rules(): array
    {
        return [
            'name'         => ['required', 'string', 'max:100'],
            'short_name'   => ['nullable', 'string', 'max:50'],
            'type'         => ['required', Rule::in(['league', 'friendly', 'tournament'])],
            'country_code' => ['nullable', 'string', 'size:2', 'exists:countries,id'],
            'gender'       => ['nullable', Rule::in(['men', 'women'])],
            'age_group'    => ['nullable', 'string', 'max:20'],
            'logo_url'     => ['nullable', 'url'],
        ];
    }
}
