<?php

namespace App\Http\Requests\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
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
            'password' => ['required', 'filled', 'string', 'min:6', 'max:90', 'current_password'],
            'new_password' => ['required', 'filled', 'string', 'max:90', 'min:6', 'different:password'],
        ];
    }

    public function validated()
    {
        $validated = $this->validator->validated();

        if ($this->has('password') && $this->has('new_password')) {
            $validated['password'] = Hash::make($this->new_password);
            unset($validated['new_password']);
        }

        return $validated;
    }

    public function messages()
    {
        return [
            'new_password.different' => trans('validation.password_different')
        ];
    }
}
