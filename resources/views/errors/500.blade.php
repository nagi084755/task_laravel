@extends('errors.layouts.base')

@section('title', '500 Internal Server Error')

@section('message', 'サーバー内部でエラーが発生しました。')

@section('detail', 'It will be returned when there is a syntax error in the program, or there is an error in the setting. Please contact the administrator.')
{{-- プログラムに文法エラーがあったり、設定に誤りがあった場合などに返されます。管理者へ連絡してください。 --}}

@section('link')
    <p class="topLink"><a href="{{ route('topPage') }}">トップページに戻る</a></p>
@endsection