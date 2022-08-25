<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\PreUser;
use Illuminate\Foundation\Auth\RegistersUsers;



class RegisterController extends Controller
{

  use RegistersUsers;

  public function __construct()
  {
    $this->middleware('guest');
  }




  //----------------------------------------------------
  // 本会員登録ページ
  //----------------------------------------------------
  public function input(Request $request)
  {
    $preEmail = $request->get('email');
    $preToken = $request->get('token');
    if (PreUser::checkPremember($preEmail, $preToken)) {
      return view('auth.register');
    } else {
      return redirect()->route('errorPage', ['code' => 403]);
    }
  }


  //----------------------------------------------------
  // 本会員登録確認ページ
  //----------------------------------------------------
  public function confirm(Request $request)
  {
    $email = $request->email;
    $password = $request->password;
    $passwordHide = str_repeat('*', mb_strlen($request->password, 'UTF8'));
    $name = $request->name;
    return view('register.registerConfirm', compact('email', 'passwordHide', 'password', 'name'));
  }




  //----------------------------------------------------
  // 本会員登録完了ページ
  //----------------------------------------------------
  public function completion(Request $request)
  {
    $userDataList = [
      'user_id' => Str::random(64),
      'name' => $request->name,
      'email' => $request->email,
      'password' => $request->password,
      'role' => 2,
    ];
    if (User::registration($userDataList)) {
      PreUser::deletePremember($userDataList['email']);
    };
    return view('register.registerCompletion');
  }
}
