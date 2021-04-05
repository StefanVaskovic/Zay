<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
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
            'currentPassword' => ['required','regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*[\d]).{8,25}$/'],
            'newPassword' => ['required','regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*[\d]).{8,25}$/'],
            'confirmPassword' =>  ['required','regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*[\d]).{8,25}$/']
        ];

    }

    public function messages()
    {
        return [
            'currentPassword.regex' => 'The current password must contains at least 1 uppercase character, 1 lowercase character and 1 number and with minimum 8 character and maximum 25 characters.',
            'newPassword.regex' => 'The new password must contains at least 1 uppercase character, 1 lowercase character and 1 number and with minimum 8 character and maximum 25 characters.',
            'confirmPassword.regex' => 'The confirmation of password must contains at least 1 uppercase character, 1 lowercase character and 1 number and with minimum 8 character and maximum 25 characters.',
        ];
    }
}
