<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
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
            'user_replied_id' => ['required', 'exists:users,id'],
            'comment_id' => ['required', 'exists:comments,id'],
            'text' => ['required'],
            'product_id'=>['required','exists:comments,product_id']
        ];
    }
}
