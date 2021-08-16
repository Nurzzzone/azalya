<?php

namespace App\Http\Requests\Benefit;

use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBenefitRequest extends FormRequest
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
            'image' => ['sometimes', 'mimes:jpg,jpeg,png,bmp,gif,svg,webp'],
            'previous_image' => ['nullable', 'string'],
            'in_homepage' => ['sometimes', 'boolean'],
            'in_about' => ['sometimes', 'boolean'],
            'in_product' => ['sometimes', 'boolean'],
        ];
    }
}
