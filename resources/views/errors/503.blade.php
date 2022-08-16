@extends('errors.layouts.base')

@section('title', '503 Service Unavailable')
{{-- サービス利用不可 --}}

@section('message', 'このページへは事情によりアクセスできません。')

@section('detail', 'Service is temporarily unusable due to overload or maintenance.')
{{-- サービスが一時的に過負荷やメンテナンスで使用不可能な状態です。 --}}

@section('link')
    <p class="topLink"><a href="{{ route('topPage') }}">トップページに戻る</a></p>
@endsection