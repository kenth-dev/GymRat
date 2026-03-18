<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>GymRat - Your Fitness Journey</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
        @vite(['resources/css/app.css'])
    </head>
    <body class="gymrat-page welcome-page">
        <div class="container">
            <div class="logo">GYMRAT</div>

            <div class="hero">
                <p class="hero-desc text-lg">Push harder.</p>
                <p class="hero-desc text-lg">  Go further.</p>
                <p class="hero-desc text-lg"> Become stronger.</p>
            </div>

            <div class="cta-buttons">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn btn-primary">Go to Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary">Log In</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-secondary">Create Account</a>
                        @endif
                    @endauth
                @endif
            </div>

            <div class="footer">
                <p>© 2026 GymRat. Your personal fitness tracker.</p>
            </div>
        </div>
    </body>
</html>       