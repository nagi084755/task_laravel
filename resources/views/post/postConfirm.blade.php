@extends('includes.header')
@section('content')
    <div class="container">
        <h2 class="newPostContTtl">投稿内容確認ページ</h2>
        <p class="newPostContTxt">この内容でよろしいですか？</p>


        <form class="postWrap" action="" method="post">
            @csrf
            @if (empty($comment))
                <div class="item">
                    <label for="title">タイトル</label><br>
                    <p>{{ $title }}</p>
                    <input type="hidden" name="title" value="{{ $title }}">
                </div>
            @else
                <input type="hidden" name="article_id" value="{{ $article_id }}">
            @endif

            <div class="item">
                <label for="content">内容</label><br>
                <p>{{ $content }}</p>
                <input type="hidden" name="content" value="{{ $content }}">
            </div>


            <button type="submit" name="back" value="back" formaction="{{ $cancelRoute }}">キャンセル</button>
            <button type="submit" name="pageType" value="" formaction="{{ $postRoute }}">投稿する</button>
        </form>


    </div>
@endsection
@include('includes.footer')
