@extends('includes.header')
@section('content')

<p class="provisionalTxt">
  ご登録されたアドレスに仮登録用のURLを送信しました。<br>
  クリックされると本登録になります。</p>
<p class="topLink"><a href="{{route('topPage')}}">トップページに戻る</a></p>

@endsection
@include('includes.footer')