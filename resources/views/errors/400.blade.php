@extends('errors.layouts.base')

@section('title', '400 Bad Request')

@section('message', 'リクエストにエラーがあります。')
{{-- リクエストにエラーがあります。 --}}

@section('detail', 'This response indicates that the server can not understand the request because the syntax is invalid.')
{{-- このレスポンスは、構文が無効であるためサーバーがリクエストを理解できないことを示します。 --}}

@section('link')
    <p class="topLink"><a href="{{ route('topPage') }}">トップページに戻る</a></p>
@endsection
