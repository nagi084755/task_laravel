@include('includes.header')


<div class="signupCont">
    <h2 class="signupContTtl">新規会員登録ページ</h2>
    <p class="signupContTxt">各項目を入力してください</p>

    <form class="signupForm" action="" method="post">
        @csrf
        <div class="item">
            <label for="loginId">ログインID（email）</label>
            <br>
            @error('loginId')
                <p class="errorTxt">{{ $message }}</p>
            @enderror
            <p class="errorTxt"></p>
            <input type="text" name="loginId" id="loginId" class="input">
        </div>

        <div class="item">
            <label for="pass">パスワード</label><span class="addNote">※英数10文字以上</span>
            <br>
            @error('pass')
                <p class="errorTxt">{{ $message }}</p>
            @enderror
            <p class="errorTxt"></p>
            <input type="password" name="pass" id="pass" class="input">
        </div>

        <div class="item">
            <label for="rePass">パスワード（確認）</label>
            <br>
            @error('pass')
                <p class="errorTxt">{{ $message }}</p>
            @enderror
            <p class="errorTxt"></p>
            <input type="password" name="pass_confirmation" id="rePass" class="input">
        </div>

        <div class="item">
            <label for="name">ニックネーム</label><span class="addNote">※英数8文字以上</span>
            <br>
            @error('name')
                <p class="errorTxt">{{ $message }}</p>
            @enderror
            <p class="errorTxt"></p>
            <input type="text" name="name" id="name" class="input">
        </div>
        <input type="hidden" name="token">
        <input id="js_confirmBtn" type="submit" value="確認画面へ" formaction="{{ route('registerConfirm') }}">
    </form>


    <p class="topLink"><a href="{{ route('topPage') }}">トップページに戻る</a></p>
    <div id="js_fadeFrame" class="fadeFrame"></div>
</div>


@include('includes.footer')
