<?php

namespace App\Http\Requests\position;

use Illuminate\Foundation\Http\FormRequest;

class PositionStoreRequest extends FormRequest
{

    public function authorize(): bool
    {
        return false;
    }


    public function rules(): array
    {
        return [
            'id'            => 'required|string|size:2',
            'full_name'     => 'required|string|max:255',
            'category'      => 'required|string|max:255'
        ];
    }
}
