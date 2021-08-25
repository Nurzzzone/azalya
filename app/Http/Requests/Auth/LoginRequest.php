<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
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
            'email' => ['nullable', 'string', 'email', 'max:50'],
            'phone_number' => ['nullable', 'string', 'max:50'],
            'password' => ['required', 'filled', 'string', 'max:100'],
            'remember' => ['nullable', 'boolean'],
        ];
    }

    public function validated()
    {
        $request = $this->validator->validated();

        if ($this->has('email') || $this->has('phone_number')) {
            $user = User::where("email", $this->email)
                ->orWhere('phone_number', $this->phone_number)
                ->first(['id', 'name', 'email', 'phone_number', 'address']);

            $request['user'] = $user ?? null;
        }

        if (!$this->has('remember')) {
            $request['remember'] = false;
        }
        return $request;
    }
}
