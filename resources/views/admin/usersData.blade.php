@extends('includes.header')
@section('content')
    <div class="adminPageCont">
        <h2 class="adminPageTtl">ユーザーデータ管理ページ</h2>

        <div class="exportWrap">
            <h3>エクスポート</h3>
            <form class="adminForm" action="{{ route('admin.usersExport') }}" method="post">
                @csrf
                <input style="width: 120px;" type="date" name="first" max="{{ date("Y-m-d") }}">
                <span>~</span>
                <input style="width: 120px;" type="date" name="last" max="{{ date("Y-m-d") }}">
                <br>
                <h6>※日付を指定しない場合、全てのデータがエクスポートされます</h6>
                <input type="submit" class="downloadBtn" value="CSVエクスポート">
            </form>
        </div>


        <div class="importWrap">
            <h3>インポート</h3>
            <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="func" value="import">
                <input type="hidden" name="type" value="user">
                <input id="js_importFile" type="file" id="csvFile" name="csvFile" accept=".csv">
                <p class="errorTxt"></p>
                <br>
                <br>
                <input id="js_importBtn" type="submit" value="CSVインポート">
            </form>
        </div>

        <p class="topLink"><a href="{{ route('admin.index') }}">管理者ページに戻る</a></p>
    </div>
@endsection
@include('includes.footer')
