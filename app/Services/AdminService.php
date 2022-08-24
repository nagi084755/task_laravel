<?php

namespace App\Services;

use App\Models\Article;
use Illuminate\Support\Facades\Storage;
use Exception;
use Illuminate\Support\Facades\Validator;
use SplFileObject;
use App\Models\User;

class AdminService
{

  //----------------------------------------------------
  // エクスポート処理
  //----------------------------------------------------
  public function export($dataList, $column)
  {
    $callback = function () use ($dataList, $column) {
      $fp = fopen('php://output', 'w');
      mb_convert_variables('SJIS', 'UTF-8', $dataList);


      fputcsv($fp, $column);

      foreach ($dataList->toArray() as $data) {
        mb_convert_variables('SJIS', 'UTF-8', $data);
        fputcsv($fp, $data);
      }
      fclose($fp);
    };

    $header = ['Content-Type' => 'application/octet-stream'];

    return $data = [
      'callback' => $callback,
      'header' => $header
    ];
  }



  //----------------------------------------------------
  // ユーザーインポート処理
  //----------------------------------------------------
  public function usersImport($csvFile)
  {
    $csvFile->storeAs('public/', "users.csv");
    $filePath = $csvFile->path($csvFile);
    $file = new SplFileObject($filePath);
    $file->setFlags(SplFileObject::READ_CSV);

    $collection = collect($file);
    $dataNum = count($collection->all());

    foreach ($collection->all() as $data) {

      $validator = Validator::make($data, [
        0 => ['required'],
        1 => ['required', 'alpha_num', 'min:8'],
        2 => ['required', 'alpha_num', 'min:10'],
        3 => ['required', 'email:strict,dns', 'max:255'],
        4 => ['required'],
        5 => ['required']
      ]);

      if ($validator->fails()) {
        return false;
      }

      $dataList = [
        'user_id' => mb_convert_encoding($data[0], 'UTF-8', 'SJIS'),
        'name' => mb_convert_encoding($data[1], 'UTF-8', 'SJIS'),
        'password' => mb_convert_encoding($data[2], 'UTF-8', 'SJIS'),
        'email' => mb_convert_encoding($data[3], 'UTF-8', 'SJIS'),
        'role' => mb_convert_encoding($data[4], 'UTF-8', 'SJIS'),
        'created_at' => mb_convert_encoding($data[5], 'UTF-8', 'SJIS'),
        'updated_at' => empty($data[6]) ? null : mb_convert_encoding($data[6], 'UTF-8', 'SJIS'),
        'deleted_at' => empty($data[7]) ? null : mb_convert_encoding($data[7], 'UTF-8', 'SJIS')
      ];

      if($dataNum >= 1000) {
        $array[] = $dataList;

        if(count($array) >= 1000) {
          User::insert($array);
          $array = [];
        }

      } elseif($dataNum < 1000) {
        User::insert($dataList);
      }

    }
    return true;
  }




  //----------------------------------------------------
  // 記事インポート処理
  //----------------------------------------------------
  public function articlesImport($csvFile)
  {
    $csvFile->storeAs('public/', "articles.csv");
    $filePath = $csvFile->path($csvFile);
    $file = new SplFileObject($filePath);
    $file->setFlags(SplFileObject::READ_CSV);

    $collection = collect($file);
    $dataNum = count($collection->all());

    foreach ($collection as $data) {
      if ($data === [null]) continue;

      $validator = Validator::make($data, [
        0 => ['required'],
        1 => ['required'],
        2 => ['required'],
        3 => ['required'],
      ]);

      if ($validator->fails()) {
        return false;
      }

      $dataList = [
        'user_id' => mb_convert_encoding($data[0], 'UTF-8', 'SJIS'),
        'title' => mb_convert_encoding($data[1], 'UTF-8', 'SJIS'),
        'content' => mb_convert_encoding($data[2], 'UTF-8', 'SJIS'),
        'created_at' => mb_convert_encoding($data[3], 'UTF-8', 'SJIS'),
        'updated_at' => empty($data[4]) ? null : mb_convert_encoding($data[4], 'UTF-8', 'SJIS'),
        'deleted_at' => empty($data[5]) ? null : mb_convert_encoding($data[5], 'UTF-8', 'SJIS')
      ];


      if($dataNum >= 1000) {
        $array[] = $dataList;

        if(count($array) >= 1000) {
          Article::insert($array);
          $array = [];
        }

      } elseif($dataNum < 1000) {
        Article::insert($dataList);
      }
    }
    return true;
  }
}
