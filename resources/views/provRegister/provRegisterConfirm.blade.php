@extends('includes.header')
@section('content')

<div class="confWrap">
    <p class="el_center">こちらのアドレスでよろしければ、送信ボタンを押してください</p>

    <form action="" method="post">
        @csrf
        <p>ログインID(email)： <span class="check">{{ $email }}</span></p>
        <input type="hidden" name="email" value="{{ $email }}">
        <input type="hidden" name="token" value="{{ $token }}">

        <div class="btnWrap el_flexEvenry">
            <button class="fixBtn" formaction="{{ route('provRegister.input') }}">修正する</button>
            <input type="submit" class="sendBtn" value="送信する" formaction="{{ route('provRegister.comp') }}">
        </div>
    </form>
</div>

@endsection
@include('includes.footer')
