<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreImagesRequest extends FormRequest
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
            'images' => ['required','array'],
            'images.*' => ['image']
        ];
    }

    public function messages()
    {
        return [
            'images.*.image' => 'File(s) need to be in format of an image!'
        ];
    }
}
