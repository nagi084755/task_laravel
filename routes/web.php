<?php

// use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

Route::get('/', 'BaseController@topPageShow');
Route::post('/', 'BaseController@topPageShow');
Route::get('/topPage', 'BaseController@topPageShow')->name('home');


Route::prefix('provRegister')->group(function () {
  Route::get('/input', 'PreRegisterController@input')->name('provRegister.input');
  Route::post('/input', 'PreRegisterController@input');
  Route::post('/confirm', 'PreRegisterController@confirm')->name('provRegister.conf');
  Route::post('/completion', 'PreRegisterController@sendMailToPremember')->name('provRegister.comp');
});


Route::prefix('register')->group(function () {
  Route::get('/input', 'RegisterController@input')->name('register.input');
  Route::post('/input', function () {
    return view('auth.register');
  })->name('registerRedirect');
  Route::post('/confirm', 'RegisterController@confirm')->name('register.conf');
  Route::post('/completion', 'RegisterController@completion')->name('register.comp');
});


Route::prefix('mypage')->group(function () {
  Route::get('/show', 'MemberController@mypageShow')->name('mypage');
  Route::get('/nameChange', 'MemberController@nameChange')->name('nameChange.show');
  Route::post('/nameChange', 'MemberController@changeToMemberName')->name('nameChange.run');
  Route::get('/passwordChange', 'MemberController@passwordChange')->name('passwordChange.show');
  Route::post('/passwordChange', 'MemberController@changeToPassword')->name('passwordChange.run');
});


Route::prefix('article')->group(function () {
  Route::get('/list', 'ArticlesController@listShow')->name('articleList');
  Route::post('/searchList', 'ArticlesController@searchListShow')->name('searchList');
  Route::get('/detail/page_id={id}', 'ArticlesController@detail')->name('postArticle.detail');
  Route::post('/detail/page_id={id}', 'ArticlesController@detail')->name('postArticle.detail.post');
});


Route::prefix('postArticle')->group(function () {
  Route::get('/post', 'ArticlesController@post')->name('postArticle');
  Route::post('/post', 'ArticlesController@post')->name('postArticle.back');
  Route::post('/confirm', 'ArticlesController@confirm')->name('postArticle.conf');
  Route::post('/completion', 'ArticlesController@completion')->name('postArticle.comp');
});


Route::prefix('editArticle')->group(function () {
  Route::get('/edit', 'ArticlesController@edit')->name('editArticle');
  Route::post('/edit', 'ArticlesController@edit')->name('editArticle.back');
  Route::post('/confirm', 'ArticlesController@editConfirm')->name('editArticle.conf');
  Route::post('/completion', 'ArticlesController@editCompletion')->name('editArticle.comp');
});


Route::post('/deleteArticle/completion', 'ArticlesController@delete')->name('deleteArticle');
Route::post('/deleteComment/completion', 'CommentsController@delete')->name('deleteComment');



Route::prefix('comment')->group(function () {
  Route::post('/confirm', 'CommentsController@confirm')->name('postComment.conf');
  Route::post('/completion', 'CommentsController@completion')->name('postComment.comp');
});


Route::prefix('editComment')->group(function () {
  Route::get('/edit', 'CommentsController@edit')->name('editComment');
  Route::post('/edit', 'CommentsController@edit')->name('editComment.back');
  Route::post('/confirm', 'CommentsController@editConfirm')->name('editComment.conf');
  Route::post('/completion', 'CommentsController@editcompletion')->name('editComment.comp');
});

Route::get('error/{code}', function ($code) {
  abort($code);
})->name('errorPage');
