@extends('includes.header')
@section('content')
    <p class="completionTxt">投稿されました</p>
    <p class="topLink"><a href="{{ route('postArticle.ditaile', ['id' => $id]) }}">投稿ページへ</a></p>
@endsection
@include('includes.footer')
