<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'cover' => ['required','image','max:3000'],
            'images' => ['array'],
            'images.*' => ['image','max:3000'],
            'description' => ['required'],
            'quantitySizes' => ['array'],
            'quantitySizes.*' => ['numeric']
        ];
    }

    public function messages()
    {
        return [
            'gender.regex' => 'The :attribute must be Male or Female!',
            'images.image' => 'The files need to be in format of a image!',
            'cover' => 'The image for cover needs to be in format of a image!',
            'quantitySizes.*.numeric' => 'Sizes need to be numeric values!'
        ];
    }
}
