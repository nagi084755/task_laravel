@extends('includes.header')
@section('content')

    <h1 class="headTtl">検索結果一覧</h1>
    <div class="flexBox">
        <p class="linkWrap"><a class="newPostBtn" href="{{ route('postArticle') }}">新規投稿する</a></p>

        <form class="searchWrap" action="articleSearchedList" method="post">
            @csrf
            <input type="text" name="searchKey">
            <input type="submit" value="投稿検索" formaction="{{ route('searchList') }}">
        </form>
    </div>


    <div class="container">
        @if (!empty($articleList) && $articleList->count())
            @foreach ($articleList as $article)
                <div class="articleWrap">
                    <h4 class="articleTtl">
                        <a class="articleLink" href="{{ route('postArticle.detail', ['id' => $article->id]) }}">{{ $article->title }}</a>
                    </h4>
                    <div class="flex">
                        <p class="articleDate">{{ $article->created_at }}</p>
                    </div>
                </div>
            @endforeach
        @else
            <p style="text-align: center">投稿がありません</p>
        @endif

        <div class="pager">
            {!! $articleList->links() !!}
        </div>
    </div>


@endsection
@include('includes.footer')
