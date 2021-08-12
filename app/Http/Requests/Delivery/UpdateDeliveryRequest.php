<?php

namespace App\Http\Requests\Delivery;

use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;

class UpdateDeliveryRequest extends FormRequest
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
            'title' => ['sometimes', 'string', 'max:255'],
            'description_title' => ['sometimes', 'string', 'max:255'],
            'price_title' => ['sometimes', 'string', 'max:255'],
            'description' => ['sometimes', 'string', 'max:16000'],
            'price' => ['sometimes', 'string', 'max:16000'],
            'image' => ['nullable', 'file', 'memes:jpeg,jpg,png,svg']
        ];
    }
}
