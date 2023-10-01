<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login!</title>

    <!--CSS-->
    <link rel="stylesheet" href="/css/login.css" />
</head>
<body>
    <div class="container">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="title-form">
                <h1>Login Form</h1>
                <p>Masukkan email & password untuk melanjutkan</p>
            </div>
            <div class="input-box">
                <div class="box">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required  autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <label for="email">E-mail</label>
                </div>

                <div class="box">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <label for="password">Password</label>
                </div>
            </div>
            <div class="button-group">
                <button type="submit" class="btn btn-primary">
                    {{ __('Login') }}
                </button>

                @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
            </div>
        </form>
    </div>

</body>
</html>