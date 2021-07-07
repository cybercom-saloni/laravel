<?php use Illuminate\Support\Facades\Session;?>
<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <title>CCC</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <!-- VENDOR CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}">


    <link rel="stylesheet" href="{{ asset('assets/vendor/font-awesome/css/font-awesome.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/vendor/linearicons/style.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/vendor/chartist/css/chartist-custom.css') }}">

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}">
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
    <!-- ICONS -->
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('assets/img/favicon.png') }}">

    <script src="{{ asset('assets/scripts/mage.js') }}"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">



    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.4/summernote.css" rel="stylesheet">

    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    <style>
        .disabled-link {
            pointer-events: none;
        }

        #loading{
	position: fixed;
	width: 100%;
	height: 100vh;
	background: #fff
	url("{{ asset('spnner.gif') }}")
	 no-repeat center center;
	z-index: 99999;
}
    </style>

</head>

<body onload="loader()">
    <!-- WRAPPER -->
    <div id="loading">  </div>

    <div id="wrapper">
        <!-- NAVBAR -->
        <div id="Content">
    <div class="main">
        <!-- MAIN CONTENT -->
        <div class="main-content">
            <div class="container-fluid">

                <!-- OVERVIEW -->

                        <!-- <h3 class="panel-title">Welcome</h3> -->
                        <main class="login-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                @include('layoutTemplate.message')
                @if (session('invalidPassword'))
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                    <i class="fa fa-info-circle"></i> {{session('invalidPassword')}}

                </div>
                @endif
                @if (session('logout'))
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                    <i class="fa fa-info-circle"></i> {{session('logout')}}

                </div>
                @endif
                @if (session('invalidUser'))
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                    <i class="fa fa-info-circle"></i> {{session('invalidUser')}}


                </div>
                @endif
                    <h3 class="card-header text-center">Login</h3>
                    <div class="card-body">
                        <form method="POST" action="{{route('login.check')}}">
                            @csrf
                            <div class="form-group mb-3">
                                <input type="text" placeholder="Email" id="email" class="form-control" name="email" required
                                    autofocus>
                                @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>

                            <div class="form-group mb-3">
                                <input type="password" placeholder="Password" id="password" class="form-control" name="password" required>
                                @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>

                            <div class="form-group mb-3">
                                <div class="checkbox">

                                </div>
                            </div>

                            <div class="d-grid mx-auto">
                                <div class="col-12">
                                    <div class="row">

                                        <div class="col-9">
                                        <button type="submit" class="btn btn-dark btn-block">Signin</button>
                                        </div>

                                    </div>
                                </div>


                            </div>

                        </form>
                        <div class="col-3">
                            <a href="<?php echo route('signup');?>">SignUp
                        </div>


                    </div>

                </div>
            </div>
        </div>
    </div>

</main>
                    </div>

                    </div>

                </div>

                <!-- END OVERVIEW -->

            </div>
        </div>
        <!-- END MAIN CONTENT -->
    </div>
    </div>
        <div class="clearfix"></div>
        <footer>
            <div class="container-fluid">
                <!-- <p class="copyright">&copy; 2021 <a href="https://www.themeineed.com" target="_blank">Theme I Need</a>.
                    All Rights Reserved.</p> -->
            </div>
        </footer>

    </div>
    <!-- END WRAPPER -->
    <!-- Javascript -->

    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/chartist/js/chartist.min.js') }}"></script>
    <script src="{{ asset('assets/scripts/klorofil-common.js') }}"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.4/summernote.js"></script>

    <script type="text/javascript">

            var preloader = document.getElementById('loading');

            // function loader()
            // {
            //     preloader.style.display = 'none';
            // }
        $(window).load(function() {
        $("#loading").fadeOut(3000);
        })

        // window.addEventListener('load',function(){
        //     const loader = document.querySelector(".loader");
        //     loader.className += " hidden";
        //     console.log(loader.className);
        // });
    </script>
</body>

</html>
