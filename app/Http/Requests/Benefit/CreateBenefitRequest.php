<?php

namespace App\Http\Requests\Benefit;

use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;

class CreateBenefitRequest extends FormRequest
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
            'image' => ['required', 'mimes:jpg,jpeg,png,bmp,gif,svg,webp'],
            'in_homepage' => ['required', 'boolean'],
            'in_about' => ['required', 'boolean'],
            'in_product' => ['required', 'boolean'],
        ];
    }
}
