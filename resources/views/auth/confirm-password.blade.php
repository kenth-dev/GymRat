<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Confirm Password - GymRat</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
        @vite(['resources/css/app.css'])
    </head>
    <body class="gymrat-page auth-page confirm-password-page">
        <div class="container">
            <div class="header">
                <div class="logo">GYMRAT</div>
                <p class="tagline">Confirm your password to continue</p>
            </div>

            <p class="auth-copy">
                This is a secure area of the application. Please confirm your password before continuing.
            </p>

            @if ($errors->any())
                <div class="alert alert-error">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.confirm') }}">
                @csrf

                <div class="form-group">
                    <label for="password">Password</label>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        placeholder="••••••••"
                    />
                    @if ($errors->has('password'))
                        <div class="error">{{ $errors->first('password') }}</div>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary btn-full">Confirm Password</button>
            </form>

            <div class="login-link">
                Back to <a href="{{ route('login') }}">log in</a>
            </div>
        </div>
    </body>
</html>
