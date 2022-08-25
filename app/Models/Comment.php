<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use  Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\Article;

class Comment extends Model
{
  use SoftDeletes;
  
  protected $table = 'comments';
  protected $fillable = ['id', 'user_id', 'article_id', 'content', 'created_at', 'updated_at', 'deleted_at'];


  public function user() {
    return $this->belongsTo(User::class, 'user_id', 'user_id');
  }
  


  public function article() {
    return $this->belongsTo(Article::class, 'user_id', 'user_id')->orderBy('created_at', 'desc');
  }



  //--------------------------------------------------------------------
  // コメントデータをインサート
  //--------------------------------------------------------------------
  public static function postProcess(array $dataList)
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
  public static function getProcess(int $article_id)
  {
    $commentData = Comment::with('user')->where('article_id', '=', $article_id)->get();   
    return $commentData;
  }



  //--------------------------------------------------------------------
  // コメントを更新
  //--------------------------------------------------------------------
  public static function updateProcess(array $dataList)
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
  public static function deleteProcess(array $dataList)
  {
    DB::transaction(function () use ($dataList) {
      Comment::where('id', '=', $dataList['comment_id'])
        ->where('article_id', '=', $dataList['article_id'])->delete();
    });
  }
}
