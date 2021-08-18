<?php

namespace App\Http\Requests\Contacts;

use Illuminate\Foundation\Http\FormRequest;

class CreateContactsRequest extends FormRequest
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
            'value' => ['required', 'string', 'max:8000'],
            'image' => ['nullable', 'file', 'mimes:jpg,jpeg,png,bmp,gif,svg,webp']
        ];
    }
}
