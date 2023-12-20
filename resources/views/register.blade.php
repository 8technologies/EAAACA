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
            <p class="text-center" style="font-size: 18px;">Welcome To</p>
            <p class="login-box-msg h3" style="color: black; font-weight: 800;">ARINEA Secure Information Exchange Platform</p>
            <hr style="background-color: #1D55C4; height: 5px;">

            <p class="text-center" style="font-size: 18px;">Register</p>


            <form action="{{ admin_url('auth/login') }}" method="post">
                <div class="form-group has-feedback {!! !$errors->has('name') ?: 'has-error' !!}">
                    @if ($errors->has('name'))
                        @foreach ($errors->get('name') as $name)
                            <label class="control-label" for="inputError"><i
                                    class="fa fa-times-circle-o"></i>{{ $name }}</label><br>
                        @endforeach
                    @endif
                    <label for="name">Full name</label>
                    <input type="text" class="form-control" placeholder="{{ 'Full name' }}" name="name"
                        value="{{ old('name') }}" required>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>


                <div class="form-group has-feedback {!! !$errors->has('email') ?: 'has-error' !!}">
                    @if ($errors->has('email'))
                        @foreach ($errors->get('email') as $message)
                            <label class="control-label" for="inputError"><i
                                    class="fa fa-times-circle-o"></i>{{ $message }}</label><br>
                        @endforeach
                    @endif
                    <label for="bank">Organization Name</label>
                    <input type="text"id="bank" class="form-control" placeholder="Organization Name"
                        name="bank_name" value="{{ old('bank_name') }}">
                    <span class="glyphicon glyphicon-email form-control-feedback"></span>
                </div>

                <div class="form-group has-feedback {!! !$errors->has('email') ?: 'has-error' !!}">
                    @if ($errors->has('email'))
                        @foreach ($errors->get('email') as $message)
                            <label class="control-label" for="inputError"><i
                                    class="fa fa-times-circle-o"></i>{{ $message }}</label><br>
                        @endforeach
                    @endif
                    <label for="email">Organization Email Address</label>
                    <input type="text"id="email" class="form-control" placeholder="Organization Email Address"
                        name="email" value="{{ old('email') }}">
                    <span class="glyphicon glyphicon-email form-control-feedback"></span>
                </div>

                <div class="form-group has-feedback {!! !$errors->has('password') ?: 'has-error' !!}">

                    @if ($errors->has('password'))
                        @foreach ($errors->get('password') as $message)
                            <label class="control-label" for="inputError"><i
                                    class="fa fa-times-circle-o"></i>{{ $message }}</label><br>
                        @endforeach
                    @endif
                    <label for="password">Password</label>
                    <input type="password" id="password" class="form-control"
                        placeholder="{{ trans('admin.password') }}" name="password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>

                <div class="form-group has-feedback {!! !$errors->has('password_1') ?: 'has-error' !!}">

                    @if ($errors->has('password_1'))
                        @foreach ($errors->get('password_1') as $message)
                            <label class="control-label" for="inputError"><i
                                    class="fa fa-times-circle-o"></i>{{ $message }}</label><br>
                        @endforeach
                    @endif
                    <label for="password2">Re-enter Password</label>
                    <input type="password" id="password2" class="form-control" placeholder="Re-Password"
                        name="password_1">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>

                <div class="row">

                    <!-- /.col -->
                    <div class="col-xs-4">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">REGISTER</button>
                    </div>
                    <div class="col-xs-8">
                        <a href="{{ url('auth/login') }}">Already have account?<b>Login</b></a>
                        <input type="hidden" name="remember" value="1">
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <br>

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
