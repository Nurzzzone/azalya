<?php

namespace App\Http\Requests\Product;

use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;

class CreateAboutRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:16000'],
            'image' => ['nullable', 'file', 'memes:jpeg,jpg,png,svg'],
            'is_active' => ['required', 'boolean']
        ];
    }

    public function validated()
    {
        $request = $this->validator->validated();

        if ($this->has('name')) {
            $request['slug'] = Str::slug($this->name);
        }
        
        return $request;
    }
}
