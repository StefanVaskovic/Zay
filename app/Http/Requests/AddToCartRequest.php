<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddToCartRequest extends FormRequest
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
            'size' => ['required','exists:sizes,size'],
            'quantity' => ['required','gt:0']
        ];
    }

    public function messages()
    {
        return [
            'size.required' => 'Please choose a size for a product!',
            'size.exists' => "The size doesn't exists in database!",
            'quantity.gt' => 'You need at least one product in cart!'
        ];
    }
}
