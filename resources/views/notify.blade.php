<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css')}}" />

    <link rel="stylesheet" type="text/css" href="{{ asset('css/util.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css')}}" />
    <title>Notify</title>
</head>

<body>
    <div class="container" style="height: 100vh;">
        <div class="row h-100 justify-content-center align-items-center">
            @error('mes')
            <div class="alert alert-danger" role="alert">
                <h4 class="alert-heading">OOPS!</h4>
                <p>
                    {{$message}}
                </p>
                <hr />
                <p class="mb-0">
                    <button type="button" class="btn btn-primary border-0">
                        Home Page
                    </button>
                </p>
            </div>
            @enderror

            @if(Session::has('ok'))
            <div class="alert alert-success" role="alert">
                <h4 class="alert-heading">Notification!</h4>
                <p>
                    {{Session::get('ok')}}
                </p>
                <hr />
                <p class="mb-0">
                    <a href="{{route('index')}}" type="button" class="btn btn-primary border-0">
                        Home Page
                    </a>
                </p>
            </div>
            @endif

        </div>
    </div>
</body>

</html>