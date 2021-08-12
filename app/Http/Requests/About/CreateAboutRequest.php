<?php

namespace App\Http\Requests\About;

use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;

class CreateAboutRequest extends FormRequest
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
            'image' => ['nullable', 'mimes:jpg,jpeg,png,bmp,gif,svg,webp'],
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
