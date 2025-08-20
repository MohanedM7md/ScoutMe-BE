<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Use Policies if needed
    }

    public function rules(): array
    {
        $userId = $this->route('user')->id ?? null;

        return [
            'email' => [
                'sometimes',
                'email',
                Rule::unique('users', 'email')->ignore($userId),
            ],
            'user_role'   => ['sometimes', Rule::in(['scout', 'player', 'admin'])],
            'is_verified' => ['sometimes', 'boolean'],
        ];
    }
}
