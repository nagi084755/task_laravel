@extends('includes.header')
@section('content')


<h2 class="adminPageTtl">ユーザーデータ管理ページ</h2>
<p class="provisionalTxt"><?= $data['result']; ?></p>


<?php if (!empty($data['errorDataList'])) : ?>
  <div class="importErrorWrap">
    <p class="importErrorText">※以下のデータはインポートできませんでした。<br>
      アドレスやパスワードが正しい形で入力されていないデータです。
    </p>
    <?php foreach ($data['errorDataList'] as $error) : ?>
      <p>【ユーザー名】：<?= $error['name']; ?>　【メールアドレス】：<?= $error['email']; ?></p>
    <?php endforeach; ?>
  </div>
<?php endif; ?>

<p class="topLink"><a href="adminPage">管理者ページに戻る</a></p>


@endsection
@include('includes.footer')