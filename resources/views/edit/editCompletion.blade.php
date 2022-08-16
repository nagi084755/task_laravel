@extends('includes.header')
@section('content')


<p class="completionTxt">更新されました</p>
<p class="topLink"><a href="{{ route('postArticle.ditaile', ['id' => $article_id]) }}">投稿ページに戻る</a></p>


@endsection
@include('includes.footer')