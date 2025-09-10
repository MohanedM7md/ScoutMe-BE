<?php

namespace App\Http\Requests\auth;

use Illuminate\Foundation\Http\FormRequest;

class UpdateScoutRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'phone'      => 'sometimes|nullable|string|max:20',
            'logo_url'   => 'sometimes|nullable|url',
            'notes'      => 'sometimes|nullable|string',
            'country_id' => 'sometimes|nullable|string|size:2|exists:countries,id',
        ];
    }
}
