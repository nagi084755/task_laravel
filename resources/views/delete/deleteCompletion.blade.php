@extends('includes.header')
@section('content')
    <p class="completionTxt">削除が完了しました</p>
    <p class="topLink"><a href="{{ $pageLink }}">{{ $linkText }}</a></p>
@endsection
@include('includes.footer')
