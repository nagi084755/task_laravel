@extends('includes.header')
@section('content')
    <div class="myPageCont">
        <div class="myPageWrap">
            <div class="myPageTxt">
              <h3>マイページ</h3>
                <p>ニックネーム：{{ $name }}<span>
                    </span></p>
                <a href="{{ route('nameChange.show') }}" class="changeBtn">変更する</a>
                <br>

                <p>パスワード</p>
                <a href="{{ route('passwordChange.show') }}" class="changeBtn">変更する</a>
                <br>
            </div>
        </div>
    </div>
@endsection
@include('includes.footer')
