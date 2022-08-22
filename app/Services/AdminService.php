<?php

namespace App\Services;

class AdminService
{

  public function export($dataList)
  {
    $callback = function () use ($dataList) {
      $fp = fopen('php://output', 'w');
      mb_convert_variables('SJIS', 'UTF-8', $dataList);

      $column = ['id', 'user_id',  'name', 'email', 'password', 'role', 'created_at', 'updated_at', 'deleted_at'];
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
}
