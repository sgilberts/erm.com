<!DOCTYPE html>
<html lang="en">

<head>
        
        <meta charset="utf-8" />
        <title>Dashboard | Upcube - Admin & Dashboard Template</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesdesign" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ url('public/uploads/system/arm2.ico') }}">


        @yield('style')
        
        <!-- Bootstrap Css -->
        <link href="{{ url('public/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{ url('public/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{ url('public/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
        
        <link href="{{ url('public/assets/libs/toastr/build/toastr.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

        <!-- Sweet Alert-->
        <link href="{{ url('public/assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />



        

    </head>
        
    <body data-topbar="dark">

        
    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

        <!-- Begin page -->
        <div id="layout-wrapper">



            
        @yield('content')







        @include('admin.layouts._modals')

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>



        <!-- JAVASCRIPT -->
        <script src="{{ url('public/assets/libs/jquery/jquery.min.js') }}"></script>
        
        <script src="{{ url('public/assets/libs/toastr/build/toastr.min.js') }}"></script>

        <script src="{{ url('public/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ url('public/assets/libs/metismenu/metisMenu.min.js') }}"></script>
        <script src="{{ url('public/assets/libs/simplebar/simplebar.min.js') }}"></script>
        <script src="{{ url('public/assets/libs/node-waves/waves.min.js') }}"></script>

        <!-- Sweet Alerts js -->
        <script src="{{ url('public/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>


        @yield('script')

        {{-- @include('admin.layouts._my_toasts') --}}

    </body>

</html>