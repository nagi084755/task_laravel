@extends('errors.layouts.base')

@section('title', '404 Not Found')

@section('message', '該当アドレスのページを見つける事ができませんでした。')

@section('detail', 'The server indicates that it could not find the requested resource. A typo in the URL, or the page
    may have been moved or deleted. Please go back to the top page or search again.')
    {{-- サーバーは要求されたリソースを見つけることができなかったことを示します。 URLのタイプミス、もしくはページが移動または削除された可能性があります。 トップページに戻るか、もう一度検索してください。 --}}

@section('link')
    <p class="topLink"><a href="{{ route('topPage') }}">トップページに戻る</a></p>
@endsection
