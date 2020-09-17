<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PIOUS</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600,900" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <style>
        html, body {
            background-color: #fff;
            color: #c7d0d4;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 40px;
        }

        .links > a {
            color: #aed5d7;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        .social-logins a {
            border: none;
            margin: 0 10px;
        }

        .background--wrapper {
            position: fixed;
            height: 100vh;
            width: 100%;
            z-index: 0;
            background-image: url('https://res.cloudinary.com/ereztdev/image/upload/v1600367745/podcastIndex/Francesco_Botticini_-_The_Assumption_of_the_Virgin_kfidhg.jpg');
            background-size: 100% 100%;
            filter: grayscale(20%) brightness(0.4) blur(8px);
        }
    </style>
</head>
<body>
<div class="background--wrapper"></div>
<div class="flex-center position-ref full-height">
    <div class="content">
        <h1 style="font-weight: 900;color: white ">PIOUS</h1>
        <h2 style="text-transform: capitalize">Podcast Index OAuth2 Universal Server</h2>
        @if (Route::has('login'))
            <div class="links my-5">
                @auth
                    <a href="{{ url('/home') }}">Go to Dashboard</a>
                @else
                    <a href="{{ route('login') }}">Login</a>


                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Register</a>
                    @endif
                @endauth
            </div>
            @auth
            @else
                <div class="social-logins">
                    <h4 class="text-capitalize">additional login options via social</h4>
                    <a href="auth/google" style="color:#db3236"><i class="fa fa-google fa-3x"></i></a>
                    <a href="auth/github" style="color:#000000"><i class="fa fa-github fa-3x"></i></a>
                </div>
            @endauth

        @endif
    </div>
</div>
</body>
</html>
