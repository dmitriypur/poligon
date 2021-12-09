<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Registration Page</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition register-page">
<div class="register-box">
    <div class="card">
        <div class="card-body register-card-body">
            <p class="login-box-msg">Восстановить пароль</p>
            <form action="{{ route('password.email') }}" method="post">
                @csrf
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
                <div class="input-group mb-3">
                    <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                @error('email')
                <p class="text-danger">{{ $message }}</p>
                @enderror

                <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-block">Отправить</button>
                </div>

            </form>

            <a href="{{ route('login.create') }}" class="text-center">Вспомнил</a>
        </div>
        <!-- /.form-box -->
    </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
{{--<script src="../../plugins/jquery/jquery.min.js"></script>--}}
<!-- Bootstrap 4 -->
{{--<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>--}}
<!-- AdminLTE App -->
{{--<script src="../../dist/js/adminlte.min.js"></script>--}}
</body>
</html>
