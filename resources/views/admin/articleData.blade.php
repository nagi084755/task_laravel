@extends('includes.header')
@section('content')


<div class="adminPageCont">
  <h2 class="adminPageTtl">投稿データ管理ページ</h2>

  <div class="exportWrap">
    <h3>エクスポート</h3>
    <form class="adminForm" action="" method="post">
      <input style="width: 120px;" type="date" name="first" max="">
      <span>~</span>
      <input style="width: 120px;" type="date" name="last" max="">
      <br>
      <h6>※日付を指定しない場合、全てのデータがエクスポートされます</h6>
      <input type="submit" class="downloadBtn" value="CSVエクスポート">
      <input type="hidden" name="func" value="export">
      <input type="hidden" name="type" value="article">
    </form>
  </div>


  <div class="importWrap">
    <h3>インポート</h3>
    <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="func" value="import">
      <input type="hidden" name="type" value="article">
      <input id="js_importFile" type="file" id="csvFile" name="csvFile" accept=".csv">
      <p class="errorTxt"></p>
      <br>
      <br>
      <input id="js_importBtn" type="submit" value="CSVインポート">
    </form>
  </div>


  <p class="topLink"><a href="adminPage">管理者ページに戻る</a></p>
</div>


@endsection
@include('includes.footer')