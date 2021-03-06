<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['sometimes', 'string', 'max:255'],
            'email' => ['sometimes', 'email', 'string', 'max:40', 'unique:users'],
            'phone_number' => ['sometimes', 'string', 'max:20', 'unique:users'],
            'address' => ['sometimes', 'string', 'max:4000']
        ];
    }
}
