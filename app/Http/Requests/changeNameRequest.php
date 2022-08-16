<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class changeNameRequest extends FormRequest
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
            'name' => 'required|alpha_num|min:8',
        ];
    }


    public function messages()
    {
        return [
            'name.required' => 'ニックネームを入力してください',
            'name.alpha_num' => '英数字で入力してください',
            'name.min' => ':min 文字以上で入力してください',
        ];
    }
}
