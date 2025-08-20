<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCompetitionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'         => ['sometimes', 'string', 'max:100'],
            'short_name'   => ['nullable', 'string', 'max:50'],
            'type'         => ['sometimes', Rule::in(['league', 'friendly', 'tournament'])],
            'country_code' => ['nullable', 'string', 'size:2', 'exists:countries,id'],
            'gender'       => ['nullable', Rule::in(['men', 'women'])],
            'age_group'    => ['nullable', 'string', 'max:20'],
            'logo_url'     => ['nullable', 'url'],
        ];
    }
}
