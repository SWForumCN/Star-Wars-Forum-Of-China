<?php

namespace App\Http\Requests\Columns;

use Illuminate\Foundation\Http\FormRequest;

class StoreColumnRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'description' => ['required', 'max:200'],
            'description_raw' => ['required', 'max:180'],
            'background' => ['nullable'],
            'cover' => ['nullable']
        ];
    }
}
