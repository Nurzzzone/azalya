<?php

namespace App\Http\Requests\Contacts;

use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;

class UpdateContactsRequest extends FormRequest
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
            'value' => ['sometimes', 'string', 'max:8000'],
            'image' => ['nullable', 'file', 'mimes:jpg,jpeg,png,bmp,gif,svg,webp'],
            'previous_image' => ['nullable', 'string'],
        ];
    }
}
