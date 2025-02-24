<!doctype html>
<html lang="en">

<head>
        
        <meta charset="utf-8" />
        <title>Login | Upcube - Admin & Dashboard Template</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesdesign" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ url('public/assets/images/favicon.ico') }}">

        <!-- Bootstrap Css -->
        <link href="{{ url('public/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{ url('public/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{ url('public/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

        <style>
            
            h1 { 
            font-family: helvetica;
            text-align:center;
            }

            .pin-code{ 
            padding: 0; 
            margin: 0 auto; 
            display: flex;
            justify-content:center;
            
            } 
            
            .pin-code input { 
            border: none; 
            text-align: center; 
            width: 48px;
            height:48px;
            font-size: 36px; 
            background-color: #F3F3F3;
            margin-right:5px;
            } 



            .pin-code input:focus { 
            border: 1px solid #573D8B;
            outline:none;
            } 


            input::-webkit-outer-spin-button,
            input::-webkit-inner-spin-button {
                -webkit-appearance: none;
                margin: 0;
            }
        </style>

    </head>

    <body class="auth-body-bg">
        <div class="bg-overlay"></div>
        <div class="wrapper-page">
            <div class="container-fluid p-0">
                <div class="card">
                    <div id="pincode_div" class="card-body">

                        <div class="text-center mt-4">
                            <div class="mb-3">
                                <a href="index.html" class="auth-logo">
                                    <img src="{{ url('public/assets/images/logo-dark.png') }}" height="30" class="logo-dark mx-auto" alt="">
                                    <img src="{{ url('public/assets/images/logo-light.png') }}" height="30" class="logo-light mx-auto" alt="">
                                </a>
                            </div>
                        </div>
    
                        <h4 class="text-muted text-center font-size-18"><b>Pincode</b></h4>

                        @include('admin.layouts._my_alerts')
    
                        <div class="p-3">
                            {{-- <form class="form-horizontal mt-3" action="{{ url('forgot_password') }}" method="POST"> --}}

                                {{-- {{ csrf_field() }} --}}

                                @php

                                    if (isset($_GET['email']) && isset($_GET['token'])) {
                                        $email = $_GET['email'];
                                        $token = $_GET['token'];
                                    }
                                @endphp

                                <input id="email" name="email" value="{{ $email }}" type="hidden"/>
    
                                <div class="pin-code mb-3">
                                    <input id="pin1" class="form-control" name="pin1" required="" type="text" value="{{ $token[0] }}" maxlength="1" autofocus>
                                    <input id="pin2" class="form-control" name="pin2" required="" type="text" value="{{ $token[1] }}" maxlength="1">
                                    <input id="pin3" class="form-control" name="pin3" required="" type="text" value="{{ $token[2] }}" maxlength="1">
                                    <input id="pin4" class="form-control" name="pin4" required="" type="text" value="{{ $token[3] }}" maxlength="1">
                                    <input id="pin5" class="form-control" name="pin5" required="" type="text" value="{{ $token[4] }}" maxlength="1">
                                    <input id="pin6" class="form-control" name="pin6" required="" type="text" value="{{ $token[5] }}" maxlength="1">
                                </div>

                                <div id="errorPinCode"></div>
    
                                <div class="form-group pb-2 text-center row mt-3">
                                    <div class="col-12 myPinBtn">
                                        <button id="submit_pincode_btn" class="btn btn-info w-100 waves-effect waves-light" type="submit">Submit Pin Code</button>
                                    </div>
                                </div>
                            {{-- </form> --}}
                        </div>
                        <!-- end -->
                        
                    </div>
                    <!-- end cardbody -->

                    <div id="new_password_div" class="card-body" style="display: none;">

                        <div class="text-center mt-4">
                            <div class="mb-3">
                                <a href="index.html" class="auth-logo">
                                    <img src="{{ url('public/assets/images/logo-dark.png') }}" height="30" class="logo-dark mx-auto" alt="">
                                    <img src="{{ url('public/assets/images/logo-light.png') }}" height="30" class="logo-light mx-auto" alt="">
                                </a>
                            </div>
                        </div>
    
                        <h4 class="text-muted text-center font-size-18"><b>Create New Password</b></h4>

                        @include('admin.layouts._my_alerts')

                        <div class="p-3">
                            {{-- <form class="form-horizontal mt-3" action="{{ url('create_new_password') }}" method="POST"> --}}

                                {{-- {{ csrf_field() }} --}}


                                <div class="form-group mb-3">
                                    <div class="col-xs-12">
                                        <input id="password" class="form-control" type="password" name="password" required="" placeholder="Password" autofocus>
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <div class="col-xs-12">
                                        <input id="cpassword" class="form-control" type="password" name="cpassword" required="" placeholder="Confirm Password">
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <div class="col-xs-12">
                                        <div id="passwordStrengthBar"></div>
                                    </div>
                                </div>
    
                                <div class="form-group pb-2 text-center row mt-3">
                                    <div class="col-12 myPassBtn">
                                        <button id="create_new_password_btn" class="btn btn-info w-100 waves-effect waves-light" type="submit">Create New password</button>
                                    </div>
                                </div>
                            {{-- </form> --}}
                        </div>


                        
                    </div>
                </div>
                <!-- end card -->
            </div>
            <!-- end container -->
        </div>
        <!-- end -->

        <!-- JAVASCRIPT -->
        <script src="{{ url('public/assets/libs/jquery/jquery.min.js') }}"></script>
        <script src="{{ url('public/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ url('public/assets/libs/metismenu/metisMenu.min.js') }}"></script>
        <script src="{{ url('public/assets/libs/simplebar/simplebar.min.js') }}"></script>
        <script src="{{ url('public/assets/libs/node-waves/waves.min.js') }}"></script>

        <script src="{{ url('public/assets/js/app.js') }}"></script>
        <script src="{{ url('public/assets/js/pincode.js') }}">></script>

    </body>

</html>
