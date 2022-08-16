@extends('includes.header')
@section('content')
    <div class="container">
        <h3 class="nameChangeTtl">パスワード変更ページ</h3>
        <div class="memberInfoForm">

            <form action="{{ route('passwordChange.run') }}" method="post">
                @csrf
                @error('currentPass')
                    <p class="invalid">{{ $message }}</p>
                @enderror
                <p class="errorTxt"></p>
                <label for="currentPass">現在のパスワード：</label>
                <input id="js_currentPass" class="inputForm" type="password" name="currentPass" value="">
                <br>
                <br>

                @error('newPass')
                    <p class="invalid">{{ $message }}</p>
                @enderror
                <p class="errorTxt"></p>
                <label for="newPass">新規のパスワード：</label>
                <input id="js_afterPass" class="inputForm" type="password" name="newPass" value="">
                <br>
                <span class="addNote">※英数10文字以上</span>
                <br>
                <br>

                @error('newPassRe')
                    <p class="invalid">{{ $message }}</p>
                @enderror
                <p class="errorTxt"></p>
                <label for="newPass_confirmation">新規のパスワード（確認用）：</label>
                <input id="js_afterPassRe" class="inputForm" type="password" name="newPass_confirmation" value="">
                <input type="hidden" name="user_id" value="">
                <br>

                <div id="js_changeModal" class="changeModal">
                    <p>更新しますか？</p>
                    <div class="myPageBtnWrap">
                        <button id="js_cancelBtn" type="button">キャンセル</button>
                        <button id="js_sendBtn" type="submit" name="pageType" value="passChange">更新</button>
                        <input type="hidden" name="token" value="">
                    </div>
                </div>
            </form>

            <div class="myPageBtnWrap">
                <button class="cancelBtn" onclick="location.href='{{ route('mypage') }}'">キャンセル</button>
                <button id="js_decideBtn">決定する</button>
            </div>
        </div>
    </div>
    <div id="js_fadeFrame" class="fadeFrame"></div>
@endsection
@include('includes.footer')
