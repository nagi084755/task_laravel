@extends('errors.layouts.base')

@section('title', '401 Unauthorized')

@section('message', '認証に失敗しました')

@section('detail', 'Authentication is required to obtain the requested resource.')
{{-- リクエストされたリソースを得るために認証が必要です。 --}}

@section('link')
    <p class="topLink"><a href="{{ route('topPage') }}">トップページに戻る</a></p>
@endsection
