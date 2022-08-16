@extends('includes.header')
@section('content')
    <div class="container">
        <h2 class="newPostContTtl">新規投稿ページ</h2>
        <p class="newPostContTxt">各項目を入力してください</p>

        <form class="postWrap" action="{{ route('postArticle.conf') }}" method="post">
            @csrf

            
            <div class="item">
                <label for="title">タイトル</label><br>
                @error('title')
                    <p class="errorTxt">{{ $message }}</p>
                @enderror
                <input type="text" name="title" class="postTtl postForm" value="{{ old('title') }}">
            </div>


            <div class="item">
                <label for="content">内容</label><br>
                @error('content')
                    <p class="errorTxt">{{ $message }}</p>
                @enderror
                <textarea name="content" class="postCont postForm" value="">{{ old('content') }}</textarea>
            </div>

            <button id="js_confBtn" type="submit" name="pageType" value="article">確認画面へ</button>
        </form>
    </div>
@endsection
@include('includes.footer')
