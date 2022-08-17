<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use App\Models\Article;
use App\Models\Comment;

class User extends Authenticatable
{
  use Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
  'id', 'user_id',  'name', 'email', 'password', 'role'
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'password', 'remember_token',
  ];

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];


  public function articles()
  {
    return $this->hasMany(Article::class, 'user_id', 'user_id');
  }


  //--------------------------------------------------------------------
  // 会員登録処理
  //--------------------------------------------------------------------
  public static function registration(array $data)
  {
    return User::create([
      'user_id' => Str::random(64),
      'name' => $data['name'],
      'email' => $data['email'],
      'password' => Hash::make($data['password']),
      'role' => 'member',
    ]);
  }



  //--------------------------------------------------------------------
  // 名前を更新する
  //--------------------------------------------------------------------
  public static function nameUpdate(string $newName)
  {
    DB::transaction(function () use ($newName) {
      $userId = Auth::user()->user_id;
      User::where('user_id', '=', $userId)->update([
        'name' => $newName,
      ]);
    });
  }



  //--------------------------------------------------------------------
  // パスワードを更新する
  //--------------------------------------------------------------------
  public static function passwordUpdate(string $newPass)
  {
    DB::transaction(function () use ($newPass) {
      $userId = Auth::user()->user_id;
      User::where('user_id', '=', $userId)->update([
        'password' => Hash::make($newPass),
      ]);
    });
  }


  //----------------------------------------------------
  // 今月の会員登録数を取得
  //----------------------------------------------------
  public static function countRegistedInMonth()
  {
    $carbon = Carbon::now();
    $thisMonth = $carbon->month;
    $count = User::whereMonth('created_at', $thisMonth)->count();

    return $count;
  }
}
