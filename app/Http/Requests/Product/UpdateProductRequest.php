<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['sometimes', 'filled', 'string', 'max:255'],
            'description' => ['sometimes', 'filled', 'string', 'max:16000'],
            'price' => ['sometimes', 'filled', 'numeric'],
            'discount' => ['nullable', 'numeric'],
            'image' => ['nullable', 'mimes:jpg,jpeg,png,bmp,gif,svg,webp'],
            'is_active' => ['nullable', 'boolean'],
            'in_stock' => ['nullable', 'boolean'],
            'is_popular' => ['nullable', 'boolean'],
            'category_id' => ['sometimes', 'integer'],
            'format' => ['sometimes'],
            'size' => ['sometimes'],
        ];
    }
}
