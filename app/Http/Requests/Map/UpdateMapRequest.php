<?php

namespace App\Http\Requests\Map;

use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;

class UpdateMapRequest extends FormRequest
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
            'value' => ['sometimes', 'string', 'max:8000'],
        ];
    }
}
