@extends('includes.header')
@section('content')
    <h1 class="siteTtl">PHP掲示板</h1>
    <form action="{{ route('login') }}" id="js_loginWrap" class="loginWrap" method="post">
        @csrf
        <p>
            <label for="loginId">ログインID</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                value="{{ old('email') }}" required autocomplete="email" autofocus>

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </p>

        <p>
            <label for="pass">パスワード</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                name="password" required autocomplete="current-password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </p>
        <br>
        <input id="js_loginBtn" class="loginBtn" type="submit" value="ログイン">
    </form>
    
    <p class="el_center"><a class="entryBtn" href="{{ route('provRegister.input') }}">新規会員登録はこちらから</a></p>
    <div class="numWrap">
        <p>今月の会員登録数：{{ $countUser }}</p>
        <p>今月の累計投稿数：{{ $countArticle }}</p>
    </div>


@endsection
@include('includes.footer')
