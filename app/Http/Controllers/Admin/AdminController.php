<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Article;
use Faker\Provider\ja_JP\Company;
use App\Facades\AdminService;


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




  public function usersExport(Request $request)
  {
    $min = $request->first ?? '0000-01-01';
    $max = $request->last ?? date("Y-m-d");
    $usersData = User::whereBetween('created_at', [$min, $max])->get();
    $data = AdminService::export($usersData);
    return response()->streamDownload($data['callback'], 'usersData.csv', $data['header']);
  }


  public function articlesExport(Request $request)
  {
    $min = $request->first ?? '0000-01-01';
    $max = $request->last ?? date("Y-m-d");
    $articlesData = Article::whereBetween('created_at', [$min, $max])->get();
    $data = AdminService::export($articlesData);
    return response()->streamDownload($data['callback'], 'articlesData.csv', $data['header']);
  }
}
