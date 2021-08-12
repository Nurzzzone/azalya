<?php

namespace App\Http\Requests\Delivery;

use Illuminate\Foundation\Http\FormRequest;

class CreateDeliveryRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255'],
            'description_title' => ['required', 'string', 'max:255'],
            'price_title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:16000'],
            'price' => ['required', 'string', 'max:16000'],
            'image' => ['nullable', 'file', 'memes:jpeg,jpg,png,svg']
        ];
    }
}
