@extends('includes.adminHeader')
@section('content')
    <div class="adminPageCont">
        <h3 class="adminPageTtl">インポートが完了しました</h3>
        <p class="topLink"><a href="{{ route('admin.index') }}">管理者ページに戻る</a></p>
    </div>
@endsection
@include('includes.footer')