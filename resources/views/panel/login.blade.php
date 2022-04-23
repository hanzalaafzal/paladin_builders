<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{[asset('assets/images/favicon.png')]}">
    <title> Admin Login </title>
    <!-- Custom CSS -->
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">

    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>


<style media="screen">
  .auth-wrapper .auth-box{
    max-width: 600px !important;

  }
</style>
</head>

<body>
    <div class="main-wrapper">
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center" >
            <div class="auth-box">
                <div>
                    <div class="logo">
                        <span class="db"> <a href="{{route('index','en')}}"><img src="" style="height:60px" alt="logo" /></a> </span>
                    </div>
                    @if($errors->any())
                      <div class="">
                        <h5 style="color:red">{{$errors->first()}}</h5>
                      </div>
                    @endif
                    @if(session('success'))
                      <div class="">
                        <h5 style="color:green">{{session('success')}}</h5>
                      </div>
                    @endif
                    @if(session('error'))
                      <div class="">
                        <h5 style="color:red">{{session('error')}}</h5>
                      </div>
                    @endif

                    <!-- Form -->
                    <div class="row">
                        <div class="col-12">

                            <form class="form-horizontal m-t-20" method="post" action="{{route('web.auth')}}" enctype="multipart/form-data">
                              @csrf
                                <div class="form-group row">
                                    <div class="col-12">
                                        <input class="form-control form-control-lg" type="email" value="{{old('email')}}" name="email" placeholder="Email*">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12">
                                        <input class="form-control form-control-lg " type="password"  name="password" placeholder="Password *">
                                    </div>
                                </div>
                                <div class="form-group text-center">
                                    <div class="col-xs-12 p-b-20">
                                        <button href="#" class="btn btn-block btn-lg btn-info " type="submit">Log in</button>
                                    </div>
                                </div>
                                <div class="form-group row">
                                  <div class="col-md-12">
                                      <div class="custom-control custom-checkbox">
                                          <a href="#" id="to-recover" class="text-dark float-right"><i class="fa fa-lock m-r-5"></i> Forgot pwd?</a>
                                      </div>
                                  </div>
                              </div>
                                <div class="form-group m-b-0 m-t-10 ">
                                    <div class="col-sm-12 text-center ">
                                        Want to create account? <a href="register" class="text-info m-l-5 "><b>Sign Up</b></a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="{{asset('assets/libs/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{asset('assets/libs/popper.js/dist/umd/popper.min.js')}}"></script>
    <script src="{{asset('assets/libs/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- ============================================================== -->
    <!-- This page plugin js -->
    <!-- ============================================================== -->
    <script>
        $('[data-toggle="tooltip "]').tooltip();
        $(".preloader ").fadeOut();
    </script>
</body>

</html>
