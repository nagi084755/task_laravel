@extends('includes.header')
@section('content')
    <div class="container">
        <h3 class="nameChangeTtl">名前変更ページ</h3>
        <div class="memberInfoForm">

            <form action="{{ route('nameChange.run') }}" method="post">
                @csrf
                <p>現在のニックネーム：<span>{{ Auth::user()->name }}</span></p>
                <br>
                @error('name')
                    <p class="errorTxt">{{ $message }}</p>
                @enderror
                <label for="name">変更後のニックネーム：</label>
                <input id="js_input" type="text" name="name" value="{{ old('name') }}">


                <div id="js_changeModal" class="changeModal">
                    <p>更新しますか？</p>
                    <div class="myPageBtnWrap">
                        <button type="button" id="js_cancelBtn">キャンセル</button>
                        <button id="js_sendBtn" type="submit" name="pageType" value="nameChange">更新</button>
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
