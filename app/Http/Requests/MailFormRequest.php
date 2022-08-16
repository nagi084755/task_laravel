<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MailFormRequest extends FormRequest
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
            'email' => 'required|email:strict,dns|max:255|unique:users,email',
        ];
    }


    public function messages()
    {
        return [
            'email.required' => 'メールアドレスを入力して下さい。',
            'email.email' => '正しい形で入力してください',
            'email.max' => ':max 文字以下で入力して下さい。',
            'email.unique' => '既に登録されているアドレスです。',
        ];
    }
}
