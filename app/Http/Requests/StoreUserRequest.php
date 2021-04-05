<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => ['required', 'max:20', 'min:3'],
            'email' => ['required', 'max:40','email','unique:users,email'],
            'password' => ['required','regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*[\d]).{8,25}$/'],
            'address' => ['required','min:5','max:100','regex:/^.*$/'],
            'city' => ['required','alpha'],
            'postal_code' => ['required','numeric'],
            'phone' => ['required','min:7','max:20','regex:/^\+\d+$/']
        ];
    }

    public function messages()
    {
        return [
            'password.regex' => 'The :attribute must contains at least 1 uppercase character, 1 lowercase character and 1 number and with minimum 8 character and maximum 25 characters.',
            'postal_code.required' => 'The postal code is required',
            'postal_code.numeric' => 'The postal code needs to be in format of a number!',
            'phone.regex' => 'The phone needs to be in format of this example: +381123456789 - without spaces!'
        ];
    }
}
