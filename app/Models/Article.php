<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use  Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
  use SoftDeletes;
  
  protected $table = 'articles';
  protected $fillable = ['id', 'user_id', 'title', 'content', 'created_at', 'updated_at', 'deleted_at'];



  //--------------------------------------------------------------------
  // 記事データを投稿
  //--------------------------------------------------------------------
  public static function postProcess(array $dataList)
  {
    DB::transaction(function () use ($dataList) {
      $user_id = Auth::user()->user_id;
      Article::create([
        'user_id' => $user_id,
        'title' => $dataList['title'],
        'content' => $dataList['content'],
      ]);
  });
  }


  //--------------------------------------------------------------------
  // 記事データを更新
  //--------------------------------------------------------------------
  public static function updateProcess(array $dataList)
  {
    DB::transaction(function () use ($dataList) {
      Article::where('id', '=', $dataList['article_id'])
      ->update([
        'title' => $dataList['title'],
        'content' => $dataList['content'],
      ]);
  });
  }


  //--------------------------------------------------------------------
  // 記事データを削除
  //--------------------------------------------------------------------
  public static function deleteProcess(array $dataList)
  {
    DB::transaction(function () use ($dataList) {
      Article::where('id', '=', $dataList['article_id'])->delete();
  });
  }


  //----------------------------------------------------
  // 最新の記事のIDを取得
  //----------------------------------------------------
  public static function getLatestId()
  {
    $lastId = Article::whereNull('deleted_at')->latest()->limit(1)->value('id');
    return $lastId;
  }


  //----------------------------------------------------
  // 全ての投稿記事を取得
  //----------------------------------------------------
  public static function getArticleAll()
  {
    $articleList = Article::whereNull('deleted_at')->latest()->paginate(10);
    return $articleList;
  }


  //----------------------------------------------------
  // 検索された全ての投稿記事を取得
  //----------------------------------------------------
  public static function searchArticles(string $searchKey)
  {
    $articleList = Article::whereNull('deleted_at')
                            ->where('title', 'LIKE', "%{$searchKey}%")
                            ->orWhere('content', 'LIKE', "%{$searchKey}%")
                            ->latest()->paginate(10);
    return $articleList;
  }



  //----------------------------------------------------
  // リクエストされた記事を取得
  //----------------------------------------------------
  public static function getProcess(int $article_id)
  {
    $articleData = Article::join('users', 'articles.user_id', '=', 'users.user_id')
                            ->whereNull('articles.deleted_at')
                            ->where('articles.id', '=', $article_id)
                            ->get()->all();
    return $articleData;
  }



  //----------------------------------------------------
  // 今月の投稿記事数を取得
  //----------------------------------------------------
  public static function countPostedInMonth()
  {
    $carbon = Carbon::now();
    $thisMonth = $carbon->month;
    $count = Article::whereMonth('created_at', $thisMonth)->count();
    
    return $count;
  }
}
