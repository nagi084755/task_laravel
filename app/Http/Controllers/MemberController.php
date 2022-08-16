<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\changePasswordRequest;
use App\Http\Requests\changeNameRequest;

class MemberController extends Controller
{
  public function __construct()
  {
      $this->middleware('users');
  }


  //--------------------------------------------------------------------
  // マイぺージ
  //--------------------------------------------------------------------
  public function mypageShow(Request $request)
  {
    $name = Auth::user()->name;
    return view('member.mypage', compact('name'));
  }



  //--------------------------------------------------------------------
  // 名前変更ページ
  //--------------------------------------------------------------------
  public function nameChange(Request $request)
  {
    return view('member.nameChange');
  }



  //--------------------------------------------------------------------
  // パスワード変更ページ
  //--------------------------------------------------------------------
  public function passwordChange(Request $request)
  {
    return view('member.passwordChange');
  }



  //----------------------------------------------------
  // 名前変更の処理
  //----------------------------------------------------
  public static function changeToMemberName(changeNameRequest $request)
  {
    User::nameUpdate($request->name);
    return view('member.changeCompletion');
  }


  //----------------------------------------------------
  // パスワード変更の処理
  //----------------------------------------------------
  public static function changeToPassword(changePasswordRequest $request)
  {
    User::passwordUpdate($request->newPass);
    return view('member.changeCompletion');
  }
}

