<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PreUser extends Model
{
  protected $table = 'pre_users';
  protected $fillable = ['email', 'token'];


  //--------------------------------------------------------------------
  // リンククリック時に仮登録されたデータと一致したらtrueを返す
  //--------------------------------------------------------------------
  public static function checkPremember(string $preEmail, string $preToken)
  {
    $bool = PreUser::where('email', '=', $preEmail)->where('token', '=', $preToken)->exists();
    return $bool;
  }



  //--------------------------------------------------------------------
  // 本登録完了時に仮登録を削除
  //--------------------------------------------------------------------
  public static function deletePremember(string $data)
  {
    PreUser::where('email', $data)->delete();
  }
}
