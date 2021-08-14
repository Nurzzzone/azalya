<?php

namespace App\Http\Requests\Card;

use Illuminate\Foundation\Http\FormRequest;

class CreateCardRequest extends FormRequest
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
            'name'  => ['required', 'string', 'max:255'],
            'image' => ['required', 'file', 'mimes:jpeg,jpg,png,svg'],
        ];
    }
}
