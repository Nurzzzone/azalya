<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
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
            'name' => ['required', 'filled', 'string', 'max:255'],
            'description' => ['required', 'filled', 'string', 'max:16000'],
            'price' => ['required', 'filled', 'numeric'],
            'discount' => ['nullable', 'numeric'],
            'image' => ['nullable', 'mimes:jpg,jpeg,png,bmp,gif,svg,webp'],
            'is_active' => ['nullable', 'boolean'],
            'in_stock' => ['nullable', 'boolean'],
            'is_popular' => ['nullable', 'boolean'],
            'in_homepage' => ['nullable', 'boolean'],
            'type_id' => ['sometimes', 'integer'],
            'category_id' => ['required', 'integer'],
            'format' => ['required'],
            'size' => ['required']
        ];
    }
}
