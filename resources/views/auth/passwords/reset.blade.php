<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reset Password</title>

    <!--CSS-->
    <link rel="stylesheet" href="/css/login.css" />
</head>
<body>
    <div class="container">
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
           <input type="hidden" name="token" value="{{ $token }}">

            <div class="title-form">
                <h1>Reset Password</h1>
                <p>Masukkan password baru untuk melanjutkan</p>
            </div>
            
            <div class="input-box">

                <!--email-->
                <div class="box">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" >
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <label for="email" class="email-label">E-mail</label>
                </div>

                <!--password-->
                <div class="box">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <label for="password">Password baru</label>
                </div>

                <!--password confirmation-->
                <div class="box">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <label for="password">Konfirmasi password</label>
                </div>

            </div>
            <div class="button-group">
                <button type="submit" class="btn btn-primary">
                    {{ __('Reset Password') }}
                </button>
            </div>
        </form>
    </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    if ($('#email').val() !== '') {
        $('.email-label').addClass('active');
    }
});
</script>
</body>
</html>