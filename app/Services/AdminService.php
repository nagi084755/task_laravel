<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Exception;
use Illuminate\Support\Facades\Validator;
use SplFileObject;
use App\Models\User;

class AdminService
{

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



  public function import($csvFile)
  {
    $csvFile->storeAs('public/', "users.csv");
    $filePath = $csvFile->path($csvFile);
    $file = new SplFileObject($filePath);
    $file->setFlags(SplFileObject::READ_CSV);

    $collection = collect($file);

    $dataCount = 1;

    foreach ($collection as $data) {
      if ($data === [null]) continue;

      // 1行目のヘッダーは取り込まない
      if ($dataCount > 1) {


        // $validator = Validator::make($data, [
        //   0 => ['required'],
        //   1 => ['required', 'min:8'],
        //   2 => ['required', 'min:10'],
        //   3 => ['required', 'max:255'],
        //   4 => ['required'],
        //   5 => ['required']
        // ]);

        // if ($validator->fails()) {
        //   return false;
        // }

        $dataList[] = [
          'user_id' => mb_convert_encoding($data[0], 'UTF-8', 'SJIS'),
          'name' => mb_convert_encoding($data[1], 'UTF-8', 'SJIS'),
          'password' => mb_convert_encoding($data[2], 'UTF-8', 'SJIS'),
          'email' => mb_convert_encoding($data[3], 'UTF-8', 'SJIS'),
          'role' => mb_convert_encoding($data[4], 'UTF-8', 'SJIS'),
          'created_at' => mb_convert_encoding($data[5], 'UTF-8', 'SJIS'),
          'updated_at' => empty($data[6]) ? null : mb_convert_encoding($data[6], 'UTF-8', 'SJIS'),
          'deleted_at' => empty($data[7]) ? null : mb_convert_encoding($data[7], 'UTF-8', 'SJIS')
        ];

        if (count($dataList) >= 1000) {
          User::inport($dataList);
          $dataList = [];
        }
      }
      $dataCount++;
    }
    return true;
  }
}
