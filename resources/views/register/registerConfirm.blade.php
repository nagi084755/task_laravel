@include('includes.header')


<div class="confWrap">
    <p class="el_center">登録情報を確認してください</p>

    <form action="" method="post">
        @csrf
        <input type="hidden" name="userId" value="">
        <p>ログインID(email)： <span class="check">{{ $email }}</span>
            <input type="hidden" name="email" value="{{ $email }}">
        </p>
        <p>パスワード： <span class="check">{{ $passwordHide }}</span>
            <input type="hidden" name="password" value="{{ $password }}">
        </p>
        <p>ニックネーム： <span class="check">{{ $name }}</span>
            <input type="hidden" name="name" value="{{ $name }}">
        </p>

        <div class="btnWrap el_flexEvenry"></div>
        <button class="fixBtn" formaction="{{route('register.input')}}">修正する</button>
        <input name="send" type="submit" class="sendBtn" value="送信する" formaction="{{ route('register.comp') }}">
    </form>
</div>


@include('includes.footer')
