@extends('includes.header')
@section('content')
    <div class="container">

            <div class="articledetail_Wrap">
                <div class="articledetail_head">
                    <p>{{ $articleData->created_at }}</p>
                    <h2 class="articledetail_Ttl">{{ $articleData->title }}</h2>
                    <p>投稿者:{{ $articleData->user->name }}</p>
                </div>


                <!-------- 【記事編集・削除ボタン】 -------->
                @if (Auth::user()->name === $articleData->user->name)
                    <div class="personalBtnWrap">
                        <form action="{{ route('editArticle') }}" method="post">
                            @csrf
                            <button type="submit" name="editArticle" value="editArticle" class="editBtn">編集</button>
                            <input type="hidden" name="article_id" value="{{ $id }}">
                        </form>
                        <button id="js_deleteArticleBtn" class="deleteBtn">削除</button>
                    </div>
                @endif
                <!-------------------------------------->



                <!-------- 【記事内容】 -------->
                <div class="articledetail_txt">
                    <p>{{ $articleData->content }}</p>
                </div>
            </div>
        
        <!------------------------------>



        <!-------- 【記事の削除モーダル】 -------->
        <div id="js_deleteArticleModal" class="deleteModal">
            <form action="{{ route('deleteArticle') }}" method="post">
                @csrf
                <p>この記事を削除しますか？</p>
                <input type="hidden" name="article_id" value="{{ $id }}">
                <input type="button" id="js_cancelArticleBtn" class="cancelBtn" value="キャンセル">
                <input type="submit" name="" value="削除">
            </form>
        </div>
    </div>
    <!--------------------------------------->



    <!-------- 《コメントの表示》 -------->

    <div class="commentWrap">
        @foreach ($commentData as $data)
            <p>{{ $data->content }}</p>

            <div class="commentAttr">
                <p class="commentBy">
                    <span class="commentUser">{{ $data->user->name }}</span>
                    <span class="commentDate">{{ $data->created_at }}</span>
                </p>


                <!-------- 【コメント編集・削除ボタン】 -------->
                @if (Auth::user()->name === $data->user->name)
                    <form action="{{ route('editComment') }}" method="post">
                        @csrf
                        <button type="submit" class="editBtn" name="comment" value="comment">編集</button>
                        <input type="hidden" name="article_id" value="{{ $id }}">
                        <input type="hidden" name="comment_id" value="{{ $data->id }}">
                    </form>
                    <p class="deleteCommentBtn deleteBtn">削除</p>
                @endif
                <!----------------------------------------->


                <!-------- 【コメントの削除モーダル】 -------->
                <div id="js_deleteCommentModal" class="deleteModal">
                    <form action="{{ route('deleteComment') }}" method="post">
                        @csrf
                        <p>このコメントを削除しますか？</p>
                        <input type="hidden" name="article_id" value="{{ $id }}">
                        <input type="hidden" name="comment_id" value="{{ $data->id }}">
                        <input type="button" id="js_cancelCommentBtn" class="cancelCommentBtn" value="キャンセル">
                        <input type="submit" name="" value="削除">
                    </form>
                </div>

                <!---------------------------------------->
            </div>
        @endforeach
    </div>
    <!------------------------------------>


    <!-------- 《コメントフォーム》 -------->
    <form class="commentForm" action="{{ route('postComment.conf') }}" method="post">
        @csrf
        <h5>コメントフォーム</h4>
            @error('content')
                <p class="errorTxt">{{ $message }}</p>
            @enderror
            <textarea id="js_comment" name="content" cols="50" rows="5">{{ old('content') }}</textarea>
            <br>
            <button type="submit" id="js_commentBtn" name="comment" value="comment">コメントする</button>
            <input type="hidden" name="article_id" value="{{ $id }}">
    </form>
    <!------------------------------------>


    <div id="js_fadeFrame" class="fadeFrame"></div>
@endsection
@include('includes.footer')
