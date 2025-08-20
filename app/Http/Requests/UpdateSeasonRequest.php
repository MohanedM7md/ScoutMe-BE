<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSeasonRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'        => 'sometimes|string|max:50',
            'start_date'  => 'sometimes|date',
            'end_date'    => 'sometimes|date|after:start_date',
            'is_current'  => 'sometimes|boolean',
        ];
    }
}
