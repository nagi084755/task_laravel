<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;

class CommentsController extends Controller
{

  //----------------------------------------------------
  // 新規投稿確認ページ
  //----------------------------------------------------
  public function confirm(CommentRequest $request)
  {
    $content = $request->content;
    $article_id = $request->article_id;
    $comment = $request->comment;

    $cancelRoute = route('postArticle.ditaile.post', ['id' => $request->article_id]);
    $postRoute = route('postComment.comp');
    return view('post.postConfirm', compact('content', 'cancelRoute', 'postRoute', 'comment', 'article_id'));
  }



  //----------------------------------------------------
  // 新規投稿完了ページ
  //----------------------------------------------------
  public function completion(Request $request)
  {
    Comment::postProcess($request->all());
    $id = $request->article_id;

    return view('post.postCompletion', compact('id'));
  }


  //----------------------------------------------------
  // 編集入力ページ
  //----------------------------------------------------
  public function edit(Request $request)
  {
    $confRoute = route('editComment.conf');
    $article_id = $request->article_id;
    $comment_id = $request->comment_id;

    if($request->input('back') === 'back'){
      return redirect()->route('editComment', ['article_id' => $article_id, 'comment_id' => $comment_id])->withInput();
  }
    return view('edit.editPage', compact('confRoute', 'article_id', 'comment_id'));
  }



  //----------------------------------------------------
  // 編集確認ページ
  //----------------------------------------------------
  public function editConfirm(Request $request)
  {
    $content = $request->content;
    $article_id = $request->article_id;
    $comment_id = $request->comment_id;

    $cancelRoute = route('editComment.back');
    $editRoute = route('editComment.comp');

    return view('edit.editConfirm', compact('content', 'article_id', 'comment_id', 'cancelRoute', 'editRoute'));
  }


  //----------------------------------------------------
  // 編集完了ページ
  //----------------------------------------------------
  public function editCompletion(Request $request)
  {
    $article_id = $request->article_id;

    Comment::updateProcess($request->all());
    return view('edit.editCompletion', compact('article_id'));
  }



  //----------------------------------------------------
  // 削除完了ページ
  //----------------------------------------------------
  public function delete(Request $request)
  {
    $article_id = $request->article_id;
    $pageLink = route('postArticle.ditaile', ['id' => $article_id]);
    $linkText = "投稿ページに戻る";

    Comment::deleteProcess($request->all());
    return view('delete.deleteCompletion', compact('article_id', 'pageLink', 'linkText'));
  }
}
