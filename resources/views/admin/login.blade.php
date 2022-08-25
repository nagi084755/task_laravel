@extends('includes.adminHeader')
@section('content')

<h1 class="headTtl">管理者ログインページ</h1>
<form action="{{ route('admin.login') }}" id="js_loginWrap" class="loginWrap" method="post">
  @csrf
  <p>
      <label for="email">ログインID</label>
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


@endsection
@include('includes.footer')