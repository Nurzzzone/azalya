<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'name' => ['sometimes', 'filled', 'string', 'max:255'],
            'description' => ['sometimes', 'filled', 'string', 'max:16000'],
            'price' => ['sometimes', 'filled', 'numeric'],
            'discount' => ['nullable', 'numeric', 'between:0,100'],
            'image' => ['nullable', 'mimes:jpg,jpeg,png,bmp,gif,svg,webp'],
            'previous_image' => ['nullable', 'string'],
            'is_active' => ['nullable', 'boolean'],
            'in_stock' => ['nullable', 'boolean'],
            'is_popular' => ['nullable', 'boolean'],
            'in_homepage' => ['nullable', 'boolean'],
            'type_id' => ['sometimes', 'integer'],
            'category_id' => ['sometimes', 'integer'],
            'format' => ['sometimes'],
            'size' => ['sometimes'],
        ];
    }
}
