<!DOCTYPE html>
<html lang="en">

<head>
    <title>Home</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/chosen/1.1.0/chosen.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/util.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css')}}" />

    <link rel="stylesheet" type="text/css" href="{{ asset('fontawesome/css/all.css')}}" />
    <link rel="stylesheet" href="{{ asset('css/create-class.css')}}">


    <style>
        .chosen-container {
            width: 100% !important;
            padding: 10px;
            margin: 5px 0 22px 0;
            border: none;
            border-bottom: 1.5px solid #8b16ff;
            background: white;
        }

        .chosen-single {
            display: inline !important;
            border: none !important;
            overflow: hidden !important;
            padding: 0px !important;
            border: 0px !important;
            background-color: #fff !important;
        }

        .chosen-container .chosen-drop {
            position: absolute;
            top: 100%;
            left: -9999px;
            z-index: 1010;
            width: 100%;
            border: 1px solid #e0e0e0;
            background-color: #fcfcfc;
            border-top: 0;
        }
    </style>

</head>

@if (Session::has('auth'))

<body>
    <div class="container-fluid p-0 m-0" style="">
        <div class="row">
            <div class="page col-12" id="page">
                <div class="img col-12 d-flex">
                    <div class="pt-3 pl-5 col-6"><img src="images/logo.png" class="logo w-25"></div>
                    <div class="col-4"></div>
                    <div class="pt-4 pr-5 col-2 btn"><a><img src="images/Group%202.png" class="icon w-25 float-right"
                                onclick="openForm()"></a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Don't have any class -->

        <!-- <div class="card card-verify mx-auto" style="width:300px">
        <img class="card-img-top" src="images/empty_states_comments.png" alt="Card image" style="width:100%">
        <div class="card-body">
            <p class="card-text-1 text-center text-dark" style="font-size:16px;">Don't see your existing classes?</p>
            <p class="card-text-1 text-center text-dark" role="button" onclick="openForm()">
                <a style="color: #8B16FF;font-size: 18px;font-weight: 600;padding-top: 10px;" >CREATE NEW CLASS?</a></p>

        </div>
    </div> -->


        <!-- If have class  -->
        <div class="container">
            <div class="row">
                @foreach($groups as $gr)
                <a href="{{route('group',['id'=>$gr->id])}}" class="col-4">
                    <div class="class-cart">
                        <div class="top">
                            <div class="name">{{$gr->name}}</div>
                            <div class="mt-n2 ">{{$gr->location->name}}</div>
                            <div class="">0 students</div>
                        </div>
                        <div class="bot">
                            <small>
                                Description
                            </small>
                            <div class="description">
                                {{$gr->description}}
                            </div>
                        </div>

                    </div>
                </a>

                @endforeach
            </div>
        </div>








        <div class="form-popup" id="myForm">
            <form action="{{route('createclass')}}" method="POST" class="form-container">
                @csrf
                <h3>Create class</h3>
                <input type="text" placeholder="Class name" name="name" required>

                <input type="text" placeholder="Description" name="description" required>

                <input type="text" placeholder="Room" name="room" required>

                <select data-placeholder="Select Location..." class="chosen-select-no-single" name="location">
                    <option value=""></option>
                    @foreach($locations as $l)
                    <option value="{{$l->id}}">{{$l->name}}</option>
                    @endforeach
                </select>

                <div class="col-12 d-flex float-right bg-white">
                    <button type="button" class="btn cancel" onclick="closeForm()">Cancel</button>
                    <button type="submit" class="btn btn-light">Create</button>
                </div>
            </form>
        </div>


    </div>


    <script src="{{ asset('vendor/jquery/jquery-3.2.1.min.js')}}"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/chosen/1.1.0/chosen.jquery.min.js"></script>

    <script>
        $(function () {
            $("select").chosen();
        });

        function openForm() {
            document.getElementById("myForm").style.display = "block";
        }
        function closeForm() {
            document.getElementById("myForm").style.display = "none";
        }
    </script>
    </div>
    </div>
    </div>

</body>
@else
<div class="container-fluid d-flex justify-content-center align-items-center" style="height:100vh">
    <div style="font-size: 48px !important">You need to <a style="font-size: 48px !important" href="{{ route('login')}}">LOGIN</a> first</div>
</div>

@endif

</html>
