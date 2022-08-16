@extends('includes.header')
@section('content')

    <body>
        <div class="error-wrap">
            <section>
                <h1 class="error-title">@yield('title')</h1>
                <p class="error-message">@yield('message')</p>
                <p class="error-detail">@yield('detail')</p>
                @yield('link')
            </section>
        </div>
    </body>
@endsection
@include('includes.footer')
