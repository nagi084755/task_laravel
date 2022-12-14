<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterFormRequest extends FormRequest
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
      'loginId' => 'required|email:strict,dns|max:255|unique:users,login_id',
      'pass' => 'required|alpha_num|min:10|confirmed',
      'name' => 'required|alpha_num|min:8',
    ];
  }



  public function messages()
    {
        return [
            'loginId.required' => 'メールアドレスを入力して下さい',
            'loginId.email' => '正しい形で入力してください',
            'loginId.max' => ':max 文字以下で入力して下さい',
            'loginId.unique' => '既に登録されているアドレスです',

            'pass.required' => 'パスワードを入力してください',
            'pass.alpha_num' => '英数字で入力してください',
            'pass.min' => ':min 文字以上で入力してください',
            'pass.confirmed' => '入力した値と一致していません',

            'name.required' => 'ニックネームを入力してください',
            'name.alpha_num' => '英数字で入力してください',
            'name.min' => ':min 文字以上で入力してください',
        ];
    }
}
