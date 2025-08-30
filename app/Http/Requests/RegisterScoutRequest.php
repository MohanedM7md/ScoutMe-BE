<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterScoutRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // can tweak if you restrict who can register
    }

    public function rules(): array
    {
        return [
            'name'      => 'required|string|max:255',
            'email'     => 'required|string|email|max:255|unique:users,email',
            'password'  => ['required', 'confirmed', Password::defaults()],
            'phone'     => 'sometimes|nullable|string|max:20',
            'logo_url'  => 'sometimes|nullable|url',
            'notes'     => 'sometimes|nullable|string',
            'country_id' => 'sometimes|nullable|string|size:2|exists:countries,id',
        ];
    }
}
