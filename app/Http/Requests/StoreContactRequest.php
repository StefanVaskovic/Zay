<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactRequest extends FormRequest
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
            "name" => ["required","max:20","min:3"],
            "email" => ["required","regex:/^[\w]+\@([\w]+\.){1,2}[\w]{0,3}$/"],
            "subject" => ["required","regex:/^[\w\s]+$/"],
            "message" => ['required']
        ];
    }

    public function messages()
    {
        return [
            "email.regex" => "Email is not in good format!"
        ];
    }

}
