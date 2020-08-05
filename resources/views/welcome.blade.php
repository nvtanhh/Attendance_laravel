<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>


    <!-- Styles -->
    <style>
        html,
        body {
            background-color: #fff;
            color: #eef0f1;
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
            font-size: 64px;
        }

        .links>a {
            color: #eef0f1;
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
    </style>

</head>

<body>
    <div class="flex-center position-ref full-height"
        style="background-image: linear-gradient(45deg, #8B16FF , #C489FF);">
        <div class="top-right links">
            @if(Session::has('auth'))
            <a href="{{ route('logout') }}">Logout</a>
            @else
            <a href="{{ route('login') }}">Login</a>

            @if (Route::has('register'))
            <a href="{{ route('register') }}">Register</a>
            @endif
            @endauth
        </div>

        <div class="content">
            <div class="title m-b-md">
                WELCOME TO FACE ATTENDANCE SYSTEM
            </div>

        </div>
    </div>
</body>

</html>