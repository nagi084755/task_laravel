<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostFormRequest;
use App\Models\Article;
use App\Models\Comment;

class ArticlesController extends Controller
{
  //----------------------------------------------------
  //　記事一覧ページ
  //----------------------------------------------------
  public function listShow(Request $request)
  {
    $articleList = Article::getArticleAll();
    return view('article.articleList', compact('articleList'));
  }


  //----------------------------------------------------
  //　記事検索一覧ページ
  //----------------------------------------------------
  public function searchListShow(Request $request)
  {
    $searchKey = $request->searchKey;
    $articleList = Article::searchArticles($searchKey);
    return view('article.articleSearchedList', compact('articleList'));
  }


  //----------------------------------------------------
  //　投稿詳細ページ
  //----------------------------------------------------
  public function ditaile(Request $request, $id)
  {
    if($request->input('back') === 'back'){
      return redirect()->route('postArticle.ditaile.post', ['id' => $id])->withInput();
  }

    $articleData = Article::getProcess($id);
    $commentData = Comment::getProcess($id);

    return view('article.articleDitaile', compact('articleData', 'commentData', 'id'));
  }


  //----------------------------------------------------
  // 新規投稿ページ
  //----------------------------------------------------
  public function post(Request $request)
  {
    if($request->input('back') === 'back'){
      return redirect('/postArticle/post')->withInput();
  }
    return view('post.postPage');
  }


  //----------------------------------------------------
  // 新規投稿確認ページ
  //----------------------------------------------------
  public function confirm(PostFormRequest $request)
  {
    $title = $request->title;
    $content = $request->content;
    $cancelRoute = route('postArticle.back');
    $postRoute = route('postArticle.comp');

    return view('post.postConfirm', compact('title', 'content', 'cancelRoute', 'postRoute'));
  }


  //----------------------------------------------------
  // 新規投稿完了ページ
  //----------------------------------------------------
  public function completion(Request $request)
  {
    Article::postProcess($request->all());
    $id = Article::getLatestId();
    return view('post.postCompletion', compact('id'));
  }



  //----------------------------------------------------
  // 編集入力ページ
  //----------------------------------------------------
  public function edit(Request $request)
  {
    $article_id = $request->article_id;
    $confRoute = route('editArticle.conf');
    

    if($request->input('back') === 'back'){
      return redirect()->route('editArticle', ['article_id' => $article_id])->withInput();
  }

    return view('edit.editPage', compact('article_id', 'confRoute'));
  }


  //----------------------------------------------------
  // 編集確認ページ
  //----------------------------------------------------
  public function editConfirm(Request $request)
  {
    $title = $request->title;
    $content = $request->content;
    $article_id = $request->article_id;

    $cancelRoute = route('editArticle.back');
    $editRoute = route('editArticle.comp');

    return view('edit.editConfirm', compact('title', 'content', 'article_id', 'cancelRoute', 'editRoute'));
  }



  //----------------------------------------------------
  // 編集完了ページ
  //----------------------------------------------------
  public function editCompletion(Request $request)
  {
    $article_id = $request->article_id;

    Article::updateProcess($request->all());
    return view('edit.editCompletion', compact('article_id'));
  }



  //----------------------------------------------------
  // 削除完了ページ
  //----------------------------------------------------
  public function delete(Request $request)
  {
    $article_id = $request->article_id;
    $pageLink = route('articleList');
    $linkText = "記事一覧ページに戻る";

    Article::deleteProcess($request->all());
    return view('delete.deleteCompletion', compact('article_id', 'pageLink', 'linkText'));
  }
}
