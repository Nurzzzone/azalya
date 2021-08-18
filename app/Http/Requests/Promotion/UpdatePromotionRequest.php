<?php

namespace App\Http\Requests\Promotion;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePromotionRequest extends FormRequest
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
            'description' => ['sometimes', 'string', 'max:16000'],
            'image' => ['nullable', 'file', 'mimes:jpg,jpeg,png,bmp,gif,svg,webp'],
            'is_active' => ['sometimes', 'nullable']
        ];
    }
}
