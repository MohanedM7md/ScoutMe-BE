<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSeasonRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Adjust if you add policies
    }

    public function rules(): array
    {
        return [
            'name'        => 'required|string|max:50',
            'start_date'  => 'required|date',
            'end_date'    => 'required|date|after:start_date',
            'is_current'  => 'boolean',
        ];
    }
}
