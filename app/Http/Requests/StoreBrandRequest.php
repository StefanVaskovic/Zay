<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBrandRequest extends FormRequest
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
            'name' => ['required','regex:/^(.+\s?.*)*$/','unique:brands,name']
        ];
    }

    public function messages()
    {
        return [
            'name.regex' => 'Brands must have exactly one space if brand has more than one word!'
        ];
    }
}
