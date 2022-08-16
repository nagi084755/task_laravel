<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\PreUser;
use App\Http\Requests\MailFormRequest;
use Illuminate\Support\Str;

use App\Mail\SendMail;

class PreRegisterController extends Controller
{

  //----------------------------------------------------
  // 仮会員登録入力ページ
  //----------------------------------------------------
  public function input()
  {
    return view('provRegister.provRegister');
  }


  //----------------------------------------------------
  // 仮会員登録確認ページ
  //----------------------------------------------------
  public function confirm(MailFormRequest $request)
  {
    $email = $request->email;
    $token = Str::random(64);
    return view('provRegister.provRegisterConfirm', compact('email', 'token'));
  }


  //----------------------------------------------------
  // 仮登録完了ページ
  // メールを送り、完了画面を表示させる
  //----------------------------------------------------
  public function sendMailToPremember(MailFormRequest $request)
  {
    $email = $request->email;
    $token = $request->token;
    Mail::send(new SendMail($email, $token));

    PreUser::create(['email' => $request->email,'token' => $request->token]);
    return view('provRegister.provRegisterCompletion');
  }
}
