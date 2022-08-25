@extends('includes.adminHeader')
@section('content')
    <div class="adminPageCont">
        <h2 class="adminPageTtl">管理者用ページ</h2>

        <div class="adminBtnWrap">
            <div class="usersDataBtn">
                <a href="{{ route('admin.usersData') }}">ユーザーデータ管理</a>
            </div>

            <div class="articlesDataBtn">
                <a href="{{ route('admin.articlesData') }}">投稿データ管理</a>
            </div>
        </div>
    </div>
@endsection
@include('includes.footer')
