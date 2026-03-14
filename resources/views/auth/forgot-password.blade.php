<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Forgot Password - GymRat</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
        @vite(['resources/css/app.css'])
    </head>
    <body class="gymrat-page auth-page forgot-password-page">
        <div class="container">
            <div class="header">
                <div class="logo">GYMRAT</div>
                <p class="tagline">Reset your password</p>
            </div>

            <p class="auth-copy">
                Forgot your password? No problem. Enter your email address and we will send you a password reset link.
            </p>

            @if (session('status'))
                <div class="alert">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-error">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        placeholder="you@example.com"
                    />
                    @if ($errors->has('email'))
                        <div class="error">{{ $errors->first('email') }}</div>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary btn-full">Email Password Reset Link</button>
            </form>

            <div class="login-link">
                Remembered your password? <a href="{{ route('login') }}">Log in here</a>
            </div>
        </div>
    </body>
</html>
