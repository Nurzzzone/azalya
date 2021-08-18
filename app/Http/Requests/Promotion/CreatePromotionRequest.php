<?php

namespace App\Http\Requests\Promotion;

use Illuminate\Foundation\Http\FormRequest;

class CreatePromotionRequest extends FormRequest
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
            'description' => ['required', 'string', 'max:16000'],
            'image' => ['nullable', 'file', 'mimes:jpg,jpeg,png,bmp,gif,svg,webp'],
            'is_active' => ['required', 'nullable']
        ];
    }
}
