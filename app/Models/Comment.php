<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use  Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
  use SoftDeletes;
  
  protected $table = 'comments';
  protected $fillable = ['id', 'user_id', 'article_id', 'content', 'created_at', 'updated_at', 'deleted_at'];



  //--------------------------------------------------------------------
  // コメントデータをインサート
  //--------------------------------------------------------------------
  public static function postProcess($dataList)
  {
    DB::transaction(function () use ($dataList) {
      $user_id = Auth::user()->user_id;
      Comment::create([
        'user_id' => $user_id,
        'article_id' => $dataList['article_id'],
        'content' => $dataList['content'],
      ]);
    });
  }



  //----------------------------------------------------
  // コメントを取得
  //----------------------------------------------------
  public static function getProcess($article_id)
  {
    $commentData = Comment::select('comments.id','comments.user_id', 'comments.content', 'comments.created_at', 'users.name')
      ->join('users', 'comments.user_id', '=', 'users.user_id')
      ->whereNull('comments.deleted_at')
      ->where('comments.article_id', '=', $article_id)->latest()
      ->get();
    return $commentData;
  }



  //--------------------------------------------------------------------
  // コメントを更新
  //--------------------------------------------------------------------
  public static function updateProcess($dataList)
  {
    DB::transaction(function () use ($dataList) {
      Comment::where('id', '=', $dataList['comment_id'])
        ->where('article_id', '=', $dataList['article_id'])
        ->update([
          'content' => $dataList['content'],
        ]);
    });
  }



  //--------------------------------------------------------------------
  // コメントを削除
  //--------------------------------------------------------------------
  public static function deleteProcess($dataList)
  {
    DB::transaction(function () use ($dataList) {
      Comment::where('id', '=', $dataList['comment_id'])
        ->where('article_id', '=', $dataList['article_id'])->delete();
    });
  }
}
