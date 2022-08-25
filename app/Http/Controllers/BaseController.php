<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\User;

class BaseController extends Controller
{
  //----------------------------------------------------
  // トップページ
  //----------------------------------------------------
  public function topPageShow(Request $request)
  {
    
    $countArticle = Article::countPostedInMonth();
    $countUser = User::countRegistedInMonth();
    return view('topPage', compact('countArticle', 'countUser'));
  }
}
