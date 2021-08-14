<?php

namespace App\Http\Requests\Card;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCardRequest extends FormRequest
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
            'name'  => ['sometimes', 'filled', 'string', 'max:255'],
            'image' => ['sometimes', 'filled', 'file', 'mimes:jpeg,jpg,png,svg'],
            'previous_image' => ['nullable', 'string']
        ];
    }
}
