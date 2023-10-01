<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lupa Password</title>

    <!--CSS-->
    <link rel="stylesheet" href="/css/login.css" />
</head>
<body>
    <div class="container">

       @if (session('error'))
    <div class="alert alert-danger" role="alert">
        {{ session('error') }}
    </div>
@elseif (session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif


        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="title-form">
                <h1>Lupa Password</h1>
                <p>Masukkan e-mail untuk melanjutkan</p>
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
            </div>
            <div class="button-group">
                <button type="submit" class="btn btn-primary">
                    {{ __('Send Password Reset Link') }}
                </button>
            </div>
        </form>
    </div>

</body>
</html>