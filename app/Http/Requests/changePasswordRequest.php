<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\UserPasswordRule;
use Illuminate\Support\Facades\Auth;

class changePasswordRequest extends FormRequest
{

  private $user_id;

  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return true;
  }


  public function all($keys = null)
  {
    $results = parent::all($keys);

    $this->user_id = Auth::user()->user_id;

    return $results;
  }


  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {

    return [
      'currentPass' => 'required|alpha_num|min:10', new UserPasswordRule($this->user_id),
      'newPass' => 'required|alpha_num|min:10|confirmed',
    ];
  }



  public function messages()
  {
    return [
      'currentPass.required' => '現在のパスワードを入力して下さい。',
      'currentPass.alpha_num' => '英数字で入力してください',
      'currentPass.min' => ':min 文字以上で入力してください',

      'newPass.required' => '新しいパスワードを入力してください',
      'newPass.alpha_num' => '英数字で入力してください',
      'newPass.min' => ':min 文字以上で入力してください',
      'newPass.confirmed' => '確認用の値と一致していません',
    ];
  }
}
