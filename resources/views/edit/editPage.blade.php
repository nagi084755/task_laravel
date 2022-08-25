@extends('includes.header')
@section('content')
    <div class="container">
        <h1 class="headTtl">編集ページ</h1>
        <p class="subTxt">編集内容を入力してください</p>

        <form class="editForm" action="?" method="post">
            @csrf
            <input type="hidden" name="article_id" value="{{ $article_id }}">

            @if (empty($comment_id))
                <h3>タイトル</h3>
                @error('title')
                    <p class="errorTxt">{{ $message }}</p>
                @enderror
                <input class="editFormTtl postForm" name="title" type="text" value="{{ old('title') }}">
            @else
                <input type="hidden" name="comment_id" value="{{ $comment_id }}">
            @endif


            <h3>内容</h3>
            @error('content')
                <p class="errorTxt">{{ $message }}</p>
            @enderror
            <textarea name="content" class="editCont postForm" value="">{{ old('content') }}</textarea>


            <div class="btnWrap">
                <button type="submit" name="back"
                    formaction='{{ route('postArticle.detail.post', ['id' => $article_id]) }}'>キャンセル</button>
                <button id="js_confBtn" type="submit" name="" value=""
                    formaction="{{ $confRoute }}">確認する</button>
            </div>
        </form>
    </div>
@endsection
@include('includes.footer')
