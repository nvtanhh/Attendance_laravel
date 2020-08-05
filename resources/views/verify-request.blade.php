<!DOCTYPE html>
<html lang="en">

<head>
    <title>Verify</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
    <!--    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>-->
    <!--    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>-->
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css')}} " />
    <link rel="stylesheet" href="{{ asset('css/verify.css')}}" />


    <link rel="stylesheet" type="text/css" href="{{ asset('fontawesome/css/all.css')}}" />
    <script src="{{ asset('fontawesome/js/all.js')}}"></script>

</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="wrap col-12" style="background-image: url('{{ asset('images/background.png')}}');">
                <div class="img mt-3">
                    <div class="w-50 pt-3 pl-5 border-0">
                        <img src="{{ asset('images/logo_white.png')}}" class="w-25" />
                    </div>
                </div>
                <div class="card card-verify mx-auto" style="width: 500px;">
                    <img class="card-img-top" src="images/Group%2017.png" alt="Card image" style="width: 100%;" />
                    <div class="card-body text-left">
                        @if(Session::has('mes'))
                        <div class="card-title">Reset password link sent!</div>
                        <div class="card-text-2">
                            We have been sent a reset password link to
                            <span>{{$email ?? ''}}</span>
                            <br />
                            Check your email and follow the instruction to reset your password
                        </div>

                        <div class="card-text-3">
                            Didn't get a reset password email?
                            <br />
                            Check your spam folder or
                            <a href="#"> <i class="fal fa-redo" style="font-size: 0.8em;"></i> send again!</a>
                        </div>
                        @else
                        <div class="card-title">Verification link sent!</div>
                        <div class="card-text-2">
                            We have been sent a confirmation link to
                            <span>{{$email ?? ''}}</span>
                            <br />
                            Check your email and follow the instruction to active your
                            account
                        </div>

                        <div class="card-text-3">
                            Didn't get a confirmation email?
                            <br />
                            Check your spam folder or
                            <a href="#"> <i class="fal fa-redo" style="font-size: 0.8em;"></i> send again!</a>
                        </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>