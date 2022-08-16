@extends('includes.header')
@section('content')
    <div class="container">
        <h2 class="newPostContTtl">編集内容確認ページ</h2>
        <p class="newPostContTxt">この内容でよろしいですか？</p>

        <form class="postWrap" action="" method="post">
            @csrf
            <div class="item">

                @if (empty($comment_id))
                    <label for="editTtl">タイトル</label>
                    <p>{{ $title }}</p>
                    <input type="hidden" name="title" value="{{ $title }}">
                @else
                    <input type="hidden" name="comment_id" value="{{ $comment_id }}">
                @endif


                <label for="content">内容</label><br>
                <p>{{ $content }}</p>
                <input type="hidden" name="content" value="{{ $content }}">

            </div>



            <input type="hidden" name="article_id" value="{{ $article_id }}">
            <button type="submit" name="back" value="back" formaction="{{ $cancelRoute }}">キャンセル</button>
            <button type="submit" name="" value="" formaction="{{ $editRoute }}">更新する</button>
        </form>
    </div>
@endsection
@include('includes.footer')
