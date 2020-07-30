<!DOCTYPE html>
<html lang="en">

<head>
    <title>FORGOT PASSWORD</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="{{ asset('images/icons/favicon.ico')}}" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css')}}" />

    <link rel="stylesheet" type="text/css" href="{{ asset('css/util.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css')}}" />
    <link rel="stylesheet" href="{{ asset('css/login.css')}}" />

    <link rel="stylesheet" type="text/css" href="{{ asset('fontawesome/css/all.css')}}" />
    <script src="{{ asset('fontawesome/js/all.js')}}"></script>


</head>

<body style="">
    <div class="limiter">
        <div class="container-login100">
            <div class="login100-more col-md-8 col-sm-0" style="background-image: url('images/Rectangle 5.png');">
                <div class="img-fluid col-md-9 pt-3">
                    <img src="images/Group%2022.png" class="w-25" />
                </div>
                <div class="modal-title col-md-9">
                    <h1 class="text-white">
                        Simple Software to Track Attendance By Facest
                    </h1>
                </div>
                <div class="card-subtitle col-md-9">
                    <h6 class="text-white pt-3">
                        * No Special Device is Required - The Biometric Device is a
                        Mobile/Tablet
                    </h6>
                </div>
                <div class="img-fluid col-md-9 col-sm-6 mx-auto">
                    <img src="images/Group%2032.png" class="w-100 h-50 m-t-100" />
                </div>
            </div>
            <div class="wrap-login100 p-t-72 p-b-80 col-md-4 col-sm-12">
                <div class="title">
                    <span class="login100-form-title p-l-70 p-r-50 p-b-89">
                        FORGOT <br> PASSWORD
                    </span>
                </div>
                <div class="circle-1 p-t-90 row"></div>
                <div class="circle-2 p-t-40 row"></div>

                <form class="col-12 d-flex flex-column align-items-center" action="{{route('forgotpass')}}"
                    method="POST">
                    @csrf
                    <div class="col-md-11">

                        <p class="mt-5">Enter your email, and we’ll send you instructions on
                            how to reset your password.</p>

                        @error('mes')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                        
                        <div class="box mt-2">
                            <div class="wrap-input100 validate-input" data-validate="Username is required">
                                <span class="icon"><i class="fal fa-envelope"></i></span>
                                <input class="input100" type="text" name="email" placeholder="Your Email"
                                    value="{{ old('email')}}" />
                                <span class="focus-input100 icon"></span>
                            </div>

                        </div>


                        <div class="d-flex mt-4">
                            <div class="ml-auto">
                                <button type="submit" class="btn btn-primary">SENT ME RESET INSTRUCTIONS</button>
                            </div>
                        </div>
                    </div>

                </form>

                <div class="flex-m w-full p-b-33 row">
                    <div class="contact100-form-checkbox-login">
                        <label class="label-checkbox100-a" for="ckb1">
                            <span class="txt1 text-right">
                                Never mind, send me back to
                                <a href="{{route('login') }}" class="txt2 hov1">
                                    the login page
                                </a>
                            </span>
                        </label>
                    </div>
                </div>
                <div class="circle-3 row"></div>
                <div class="circle-4 row"></div>
            </div>
        </div>
    </div>

    <!--===============================================================================================-->
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/bootstrap/js/popper.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/daterangepicker/moment.min.js"></script>
    <script src="vendor/daterangepicker/daterangepicker.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/countdowntime/countdowntime.js"></script>
    <!--===============================================================================================-->
    <script src="js/main.js"></script>
</body>

</html>