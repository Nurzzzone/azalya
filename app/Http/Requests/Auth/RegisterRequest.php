<?php

namespace App\Http\Requests\Auth;

use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'string', 'max:40'],
            'password' => ['required', 'string', 'min:6', 'max:100'],
            'phone_number' => ['required', 'string', 'max:20'],
        ];
    }

    public function validated()
    {
        $request = $this->validator->validated();

        if ($this->has('password')) {
            $request['password'] = Hash::make($this->password);
        }
        $request['menuroles'] = 'user';
        
        return $request;
    }
}
