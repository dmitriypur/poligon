<!doctype html>
<html lang="ru">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>@yield('title')</title>

    <link rel="stylesheet" href="https://unpkg.com/simpleslider-js@1.9.0/dist/simpleSlider.min.css">
    <link rel="stylesheet" href="{{ asset('front/css/front.css') }}">
</head>
<body>
@include('parts.header')
@if(session()->has('success'))
    <section class="content mt-5">
        <div class="container">
            <div class="alert alert-success alert-dismissible">
                {{ session('success') }}
            </div>
        </div>
    </section>
@endif
<section class="my-5">
    <div class="container">
        @yield('content')
    </div>
</section>
<div class="modal__wrap hide" id="sign-in1">
    <div class="modalka">
        <div class="modal__close"><i class="far fa-times-circle"></i></div>
        <p class="login-box-msg">Войти</p>
        @if(session()->has('error'))
            <div class="alert alert-danger my-3">
                {{ session('error') }}
            </div>
        @endif
        @if(session()->has('email'))
            <div class="alert alert-danger my-3">
                {{ session('email') }}
            </div>
        @endif
        @if(session()->has('status'))
            <div class="alert alert-success my-3">
                {{ session('status') }}
            </div>
        @endif
        <form action="{{ route('login') }}" method="post">
            @csrf

            <div class="input-group mb-3">
                <input name="email" type="email" class="form-control @error('email') is-invalid @enderror"
                       placeholder="Email">
            </div>
            @error('email')
            <p class="text-danger">{{ $message }}</p>
            @enderror
            <div class="input-group mb-3">
                <input name="password" type="password" class="form-control @error('email') is-invalid @enderror"
                       placeholder="Пароль">
            </div>
            @error('password')
            <p class="text-danger">{{ $message }}</p>
            @enderror
            <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block">Войти</button>
            </div>
        </form>
        <div class="col-12 my-2">
            <a href="{{ route('password.request') }}" class="text-center">Забыли пароль</a>
        </div>
        <div class="col-12">
            <a href="{{ route('register.create') }}" class="text-center">Регистрация</a>
        </div>
    </div>
</div>
<div class="modal__wrap hide" id="sign-in2">
    <div class="modalka">
        <div class="modal__close"><i class="far fa-times-circle"></i></div>
        <p class="text-danger">В разработке</p>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/all.js"></script>
@yield('scripts')
<script src="{{ asset('front/js/front.js') }}"></script>
</body>
</html>
