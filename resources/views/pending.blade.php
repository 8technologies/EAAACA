<?php
$u = Admin::user();
if ($u == null) {
    die('User account not found.');
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('admin.title') }} | {{ trans('admin.login') }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    @if (!is_null($favicon = Admin::favicon()))
        <link rel="shortcut icon" href="{{ $favicon }}">
    @endif

    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{ admin_asset('vendor/laravel-admin/AdminLTE/bootstrap/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ admin_asset('vendor/laravel-admin/font-awesome/css/font-awesome.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ admin_asset('vendor/laravel-admin/AdminLTE/dist/css/AdminLTE.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ admin_asset('vendor/laravel-admin/AdminLTE/plugins/iCheck/square/blue.css') }}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="//oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
{{-- <body class="hold-transition login-page" @if (config('admin.login_background_image'))style="background: url({{config('admin.login_background_image')}}) no-repeat;background-size: cover;"@endif> --}}

<body class="hold-transition login-page" style="background-color: #1D55C4;">
    <div class="login-box">
        <div class="login-logo">

            {{-- <a href="{{ admin_url('/') }}"><b>{{ config('admin.name') }}</b></a> --}}
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body" style="border-radius: 15px!important">

            <br>
            <center>
                <img width="75%" src="{{ url('public/assets/images/arinea.jpeg') }}" alt="">
            </center>
            <br>
            <p class="login-box-msg h3" style="color: black; font-weight: 800;">ARINEA Secure Information Exchange
                Platform</p>
            <hr style="background-color: #1D55C4; height: 5px;">

            <p class="text-center" style="font-size: 18px; color: black;">
                <b>Account Pending for Verification</b>
            </p>

            <p>Dear <b>{{ $u->name }}</b>,

                Thank you for registering with <b>ARINEA Secure Information Exchange Platform</b>. Your account is
                currently pending for verification.
            </p>
            <p> If you need assistance, feel free to contact our
                support team at <b>support@eaaaca.com</b>. We appreciate your cooperation and look forward to having you
                fully onboarded.</p>
            <hr>
            <div class="row ">
                <!-- /.col -->
                <div class="col-xs-8">
                    <a style="color: blue" href="{{ admin_url('/') }}"><b>Refresh Page</b></a>
                </div>
                <!-- /.col -->
            </div>
            <br>
            <div class="row">
                <!-- /.col -->

                <div class="col-xs-8">
                    <a style="color: rgb(230, 13, 13);" href="{{ admin_url('auth/logout') }}"><b>Logout</b></a>
                </div>
                <!-- /.col -->
            </div>

        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src="{{ admin_asset('vendor/laravel-admin/AdminLTE/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="{{ admin_asset('vendor/laravel-admin/AdminLTE/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- iCheck -->
    <script src="{{ admin_asset('vendor/laravel-admin/AdminLTE/plugins/iCheck/icheck.min.js') }}"></script>
    <script>
        $(function() {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
</body>

</html>
