<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchPlayerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Add auth logic if needed
    }

    public function rules(): array
    {
        return [
            'query'    => 'required|string|min:2',
            'per_page' => 'sometimes|integer|min:1|max:100',
        ];
    }
}
