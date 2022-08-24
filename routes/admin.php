<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();


Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login');
Route::post('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
Route::get('/home', 'Admin\AdminController@index')->name('admin.index');
Route::get('/userData', 'Admin\AdminController@usersData')->name('admin.usersData');
Route::post('/userExport', 'Admin\AdminController@usersExport')->name('admin.usersExport');
Route::post('/userImport', 'Admin\AdminController@usersImport')->name('admin.usersImport');
Route::get('/articlesData', 'Admin\AdminController@articlesData')->name('admin.articlesData');
Route::post('/articlesExport', 'Admin\AdminController@articlesExport')->name('admin.articlesExport');
Route::get('/errorPage', 'Admin\AdminController@error')->name('admin.error');
Route::get('/completion', 'Admin\AdminController@completion')->name('admin.completion');



  Route::get('/', 'BaseController@topPageShow');
  Route::post('/', 'BaseController@topPageShow');
  Route::get('/topPage', 'BaseController@topPageShow')->name('topPage');


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