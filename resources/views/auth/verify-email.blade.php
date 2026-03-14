<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Verify Email - GymRat</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
        @vite(['resources/css/app.css'])
    </head>
    <body class="gymrat-page auth-page verify-email-page">
        <div class="container">
            <div class="header">
                <div class="logo">GYMRAT</div>
                <p class="tagline">Verify your email address</p>
            </div>

            <p class="auth-copy">
                Thanks for signing up! Before getting started, please verify your email address by clicking on the link we just emailed to you. If you did not receive it, we can send another.
            </p>

            @if (session('status') == 'verification-link-sent')
                <div class="alert">
                    A new verification link has been sent to the email address you provided during registration.
                </div>
            @endif

            <div class="auth-actions">
                <form method="POST" action="{{ route('verification.send') }}" style="flex: 1;">
                    @csrf
                    <button type="submit" class="btn btn-primary btn-full">Resend Verification Email</button>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-link">Log Out</button>
                </form>
            </div>
        </div>
    </body>
</html>
