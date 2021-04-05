<?php

namespace App\Http\Requests;

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
            'name' => ['required'],
            'current_price' => ['required','numeric'],
            'gender' => ['required','regex:/^(Male|Female)$/'],
            'color' => ['required','alpha_num'],
            'category' => ['required','exists:categories,id'],
            'brand' => ['required','exists:brands,id'],
            'description' => ['required'],
            'quantitySizes' => ['array'],
            'quantitySizes.*' => ['numeric']
        ];
    }

    public function messages()
    {
        return [
            'gender.regex' => 'The :attribute must be Male or Female!',
            'quantitySizes.*.numeric' => 'Sizes need to be numeric values!'
        ];
    }
}
