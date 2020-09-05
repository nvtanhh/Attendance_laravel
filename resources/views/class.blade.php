<!DOCTYPE html>
<html lang="en">

<head>
    <title>Create Class</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="{{ asset('images/icons/favicon.ico')}}" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css')}}" />

    <link rel="stylesheet" type="text/css" href="{{ asset('css/util.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css')}}" />

    <link rel="stylesheet" type="text/css" href="{{ asset('fontawesome/css/all.css')}}" />
    <link rel="stylesheet" type="text/css"
        href="http://cdn.datatables.net/plug-ins/3cfcc339e89/integration/bootstrap/3/dataTables.bootstrap.css">


    <style>
        .starter-template {
            padding: 40px 15px;
        }

        .card {
            width: 300px !important;
        }

        .project-tab {
            padding: 8%;
            margin-top: -8%;
        }

        .project-tab #tabs {
            background: #007b5e;
            color: #eee;
        }

        .project-tab #tabs h6.section-title {
            color: #eee;
        }

        .project-tab #tabs .nav-tabs .nav-item.show .nav-link,
        .nav-tabs .nav-link.active {
            color: #0062cc;
            background-color: transparent;
            border-color: transparent transparent #f3f3f3;
            border-bottom: 3px solid !important;
            font-size: 16px;
            font-weight: bold;
        }

        .project-tab .nav-link {
            border: 1px solid transparent;
            border-top-left-radius: .25rem;
            border-top-right-radius: .25rem;
            color: #0062cc;
            font-size: 16px;
            font-weight: 600;
        }

        .project-tab .nav-link:hover {
            border: none;
        }

        .project-tab thead {
            background: #f3f3f3;
            color: #333;
        }

        .project-tab a {
            text-decoration: none;
            color: #333;
            font-weight: 600;
        }

        .cover-img {
            background-image: url('{{asset('images/img_backtoschool.jpg')}}');
            background-repeat: no-repeat, repeat;
            background-size: 150px;
            height: 200px;
            width: 100%;
            background-size: cover;
            resize: both;
            border-radius: 10px;
            margin-top: 10px;
        }

        .class-name {
            font-size: 34px;
            font-weight: 600px;
        }
    </style>

</head>

<body>
    <div class="container-fluid p-0 m-0">
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

        <section id="tabs" class="project-tab">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <nav>
                            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home"
                                    role="tab" aria-controls="nav-home" aria-selected="true">Stream</a>
                                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile"
                                    role="tab" aria-controls="nav-profile" aria-selected="false">Add Students</a>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                                aria-labelledby="nav-home-tab">

                                <div class="cover-img" style="">
                                    <div class="text-white p-4">
                                        <div class="class-name">
                                            NMCNPM
                                        </div>
                                        <div class="">
                                            Mr. Black
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-10" style="border-radius:10px;">
                                        <table id="datatable" class="table table-striped table-bordered" cellspacing="0"
                                            width="100%">
                                            <thead>
                                                <tr>
                                                    <th>Student Code</th>
                                                    <th>Full Name</th>
                                                    <th>Email</th>
                                                    <th>Is Attended</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr>
                                                    <td>Tiger Nixon</td>
                                                    <td>System Architect</td>
                                                    <td>Edinburgh</td>
                                                    <td>
                                                        <i class="fas fa-check"></i>
                                                    </td>
                                                </tr>

                                                </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                    <div class="col-2">
                                        <a href="#" class="btn btn-primary text-white">Attendance</a>
                                    </div>
                                </div>


                            </div>
                            <div class="tab-pane fade" id="nav-profile" role="tabpanel"
                                aria-labelledby="nav-profile-tab">
                                <form class="mt-5">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputEmail4">Student ID</label>
                                            <input type="text" class="form-control" placeholder="Student ID">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputPassword4">Full Name (Optional)</label>
                                            <input type="text" class="form-control" placeholder="Full Name">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputAddress">Email</label>
                                        <input type="email" class="form-control" placeholder="example@gmail.com">
                                    </div>
                                    <div class="d-flex">
                                        <button class="btn btn-primary ml-auto" type="submit">Submit form</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>


    </div>


    <script src="{{ asset('vendor/jquery/jquery-3.2.1.min.js')}}"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script language="JavaScript" src="https://cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"
        type="text/javascript"></script>
    <script language="JavaScript"
        src="https://cdn.datatables.net/plug-ins/3cfcc339e89/integration/bootstrap/3/dataTables.bootstrap.js"
        type="text/javascript"></script>


    <script>
        //Initialize Masonry inside Bootstrap 3 Tab component 

        (function ($) {

            var $container = $('.masonry-container');
            $container.imagesLoaded(function () {
                $container.masonry({
                    columnWidth: '.card',
                    itemSelector: '.card'
                });
            });

            //Reinitialize masonry inside each panel after the relative tab link is clicked - 
            $('a[data-toggle=tab]').each(function () {
                var $this = $(this);

                $this.on('shown.bs.tab', function () {

                    $container.imagesLoaded(function () {
                        $container.masonry({
                            columnWidth: '.card',
                            itemSelector: '.card'
                        });
                    });

                }); //end shown
            });  //end each
        })(jQuery);
        $(document).ready(function () {
            $('#datatable').dataTable();

            $("[data-toggle=tooltip]").tooltip();

        });

    </script>
    </div>
    </div>
    </div>

</body>

</html>