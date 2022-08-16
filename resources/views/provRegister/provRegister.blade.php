@extends('includes.header')
@section('content')


<div class="signupCont">
    <h2 class="signupContTtl">仮登録ページ</h2>
    <p class="signupContTxt">メールアドレスを入力してください</p>

    <form class="signupForm" action="" method="post">
        @csrf
        <div class="item">
            <label for="email">メールアドレス</label>
            <br>
            @error('email')
            <p class="errorTxt">{{ $message }}</p>
            @enderror
            <p id="js_errorTxt" class="errorTxt"></p>
            <input type="text" name="email" id="js_preEmail" class="input">
        </div>
        <input id="js_confirmBtn" type="submit" value="確認画面へ" formaction="{{ route('provRegister.conf') }}">
    </form>

    <p class="topLink"><a href="{{ route('topPage') }}">トップページに戻る</a></p>
    <div id="js_fadeFrame" class="fadeFrame"></div>
</div>

@endsection
@include('includes.footer')
