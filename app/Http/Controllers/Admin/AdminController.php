<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Article;
use Faker\Provider\ja_JP\Company;
use App\Facades\AdminService;
use Exception;


class AdminController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth:admin');
  }


  public function index()
  {
    return view('admin.home');
  }


  public function usersData()
  {
    return view('admin.usersData');
  }


  public function articlesData()
  {
    return view('admin.articlesData');
  }


  public function error() {
    return view('admin.errorPage');
  }


  public function completion() {
    return view('admin.completion');
  }




  public function usersExport(Request $request)
  {
    $min = $request->first ?? '0000-01-01';
    $max = $request->last ?? date("Y-m-d");
    $usersData = User::whereBetween('created_at', [$min, $max])->get();
    $column = ['id', 'user_id',  'name', 'email', 'password', 'role', 'created_at', 'updated_at', 'deleted_at'];
    $data = AdminService::export($usersData, $column);
    return response()->streamDownload($data['callback'], 'usersData.csv', $data['header']);
  }


  public function usersImport(Request $request) {
    // dd(ini_get('post_max_size'));
    if($request->hasFile('usersCsv')) {
      if(AdminService::import($request->usersCsv)) {
        return redirect()->route('admin.completion');
      } else {
        return redirect()->route('admin.error');
      }
    } else {
      throw new Exception("CSVファイルの取得に失敗しました。");
    }
  }


  public function articlesExport(Request $request)
  {
    $min = $request->first ?? '0000-01-01';
    $max = $request->last ?? date("Y-m-d");
    $articlesData = Article::whereBetween('created_at', [$min, $max])->get();
    $column = ['id', 'user_id',  'title', 'content', 'created_at', 'updated_at', 'deleted_at'];
    $data = AdminService::export($articlesData, $column);
    return response()->streamDownload($data['callback'], 'articlesData.csv', $data['header']);
  }
}
