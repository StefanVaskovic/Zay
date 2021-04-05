<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
            'name' => ['required','regex:/^(.+\s?.*)*$/','unique:categories,name']
        ];
    }

    public function messages()
    {
        return [
            'name.regex' => 'Categories must have exactly one space if category has more than one word!'
        ];
    }
}
