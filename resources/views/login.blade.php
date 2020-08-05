<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
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
                        Login
                    </span>
                </div>
                <div class="circle-1 p-t-90 row"></div>
                <div class="circle-2 p-t-40 row"></div>

                <form id="form" data-parsley-validate="" class="col-12 d-flex flex-column align-items-center"
                    action="{{route('login')}}" method="POST">
                    @csrf
                    <div class="col-md-11">
                        @if(Session::has('ok'))
                        <small class="form-text text-success">{{ Session::get('ok') }}</small>
                        @endif


                        @if(Session::has('lockLogin'))
                        <small id="lockWrapper" class="form-text text-danger mb-2">You are locked. Please retry for
                            <span
                                id="countdown">{{\Carbon\Carbon::now()->diffInSeconds(Session::get('lockLogin')->copy()->addMinutes(5), false)}}</span>
                            seconds!</small>
                        @else
                        @error('mes')
                        <small class="form-text text-danger mb-2">{{ $message }}</small>
                        @enderror
                        @endif

                        <div class="box">
                            <div class="wrap-input100">
                                <span class="icon"><i class="fal fa-envelope"></i></span>
                                <input class="input100" type="email" name="email" placeholder="Email"
                                    value="{{ old('email')}}" required data-parsley-type="email"
                                    data-parsley-trigger="change" data-parsley-errors-container="#errorBlock1" />
                                <span class="focus-input100 icon"></span>
                            </div>
                            <small id="errorBlock1" class="form-text text-danger"></small>

                            <div class="wrap-input100 validate-input mt-4" data-validate="Password is required">
                                <span class="icon"><i class="fal fa-key"></i></span>
                                <input class="input100" type="password" name="pass" placeholder="Password" required
                                    data-parsley-errors-container="#errorBlock2" data-parsley-minlength="8" />
                                <span class="focus-input100 icon"></span>
                            </div>
                            <small id="errorBlock2" class="form-text text-danger"></small>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <div class="">
                                <input class="input-checkbox100" id="ckb1" type="radio" name="remember-me" />
                                <label class="label-checkbox100" for="ckb1">
                                    <span class="txt1">
                                        Remember me
                                    </span>
                                </label>
                            </div>

                            <a href="#" class="txt2 hov1">
                                Forgot password?
                            </a>
                        </div>
                        {{-- ReCaptcha here --}}
                        @if(Session::has('reCaptcha'))
                        <div class="mt-4 d-flex">
                            <div class="ml-auto">
                                <div class="g-recaptcha" data-sitekey="{{ config('app.sitekey','')}}"></div>
                            </div>
                        </div>
                        @error('captcha')
                        <div class="d-flex">
                            <div class="ml-auto">
                                <small class="form-text text-danger">{{ $message }}</small>
                            </div>
                        </div>
                        @endif
                        <div class="d-flex">
                            <div class="ml-auto">
                                <small id="errCaptcha" class="form-text text-danger"></small>
                            </div>
                        </div>
                        @endif
                        <div class="d-flex mt-4">
                            <div class="ml-auto">
                                <button type="submit" class="btn btn-primary">LOGIN</button>
                            </div>
                        </div>
                    </div>

                </form>

                <div class="flex-m w-full p-b-33 row">
                    <div class="contact100-form-checkbox-login">
                        <label class="label-checkbox100-a" for="ckb1">
                            <span class="txt1">
                                Don't have an account?
                                <a href="{{route('register') }}" class="txt2 hov1">
                                    Sign up
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

    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="{{ asset('fontawesome/js/all.js')}}"></script>
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <script src="{{ asset('scripts/parsley.min.js')}}"></script>
    <script src="js/main.js"></script>

    <script type="text/javascript">
        $("#form").submit(function(event) {
        var recaptcha = $("#g-recaptcha-response").val();
        if (recaptcha === "") {
            event.preventDefault();
            $("#errCaptcha").text("Please check the recaptcha");
        }
        });

        $(function () {
          $('#form').parsley().on('field:validated', function() {
            var ok = $('.parsley-error').length === 0;
            $('.bs-callout-info').toggleClass('hidden', !ok);
            $('.bs-callout-warning').toggleClass('hidden', ok);
          })
          .on('form:submit', function() {
            return true; // Don't submit form for this demo
          });
        });
        
    </script>

    @if(Session::has('lockLogin'))
    <script type="text/javascript">
        // countdown seconds
      
    var timeleft = parseInt($('#countdown').text());

    if(timeleft<=0){
        $(":input[name='email']").prop('disabled', false)
        $(":input[name='pass']").prop('disabled', false)
        $("button[type='submit']").prop('disabled', false);
        $('#lockWrapper').hide();
    }else{
        $(":input[name='email']").prop('disabled', true)
        $(":input[name='pass']").prop('disabled', true)
        $("button[type='submit']").prop('disabled', true);
        var countdownTimer = setInterval(function(){
        $('#countdown').text(timeleft--);
        if(timeleft <= 0){
            clearInterval(countdownTimer);
            $(":input[name='email']").prop('disabled', false)
            $(":input[name='pass']").prop('disabled', false)
            $("button[type='submit']").prop('disabled', false);
            $('#lockWrapper').hide();
            }
        },1000);
        }

    </script>
    @endif
</body>

</html>