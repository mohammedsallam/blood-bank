<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forget password</title>
    <link rel="stylesheet" href="{{asset('adminlte/plugins/bootstrap/dist/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('adminlte/plugins/font-awesome/css/font-awesome.min.css')}}">
</head>
<body>


<div class="container">
    <div class="row">
        <div class="panel panel-default col-lg-6 col-lg-offset-3" style="margin-top: 10%">
            <div class="panel-heading">
                <h3 class="panel-title text-center">Reset password</h3>
            </div>
            <div class="alert alert-success admin_success hidden text-center" style="margin-top: 6%"></div>
            <div class="alert alert-danger admin_error hidden text-center" style="margin-top: 6%"></div>
            <div class="panel-body">
                {!! Form::open(['route' => 'password.reset', 'method' => 'post', 'class' => 'reset_password_form']) !!}
                <div class="form-group">
                    {!! Form::email('email', '', ['class' => 'form-control', 'placeholder' => 'Your email']) !!}
                </div>
                <div class="form-group">
                    {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) !!}
                </div>
                <div class="form-group">
                    {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Confirm password']) !!}
                </div>
                {!! Form::submit('Reset password', ['class' => 'btn btn-primary btn-sm reset_password_button']) !!}
                <a class="pull-right btn btn-success btn-sm" href="{{route('login')}}">Login</a>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

<!-- jQuery 3 -->
<script src="{{asset('adminlte/plugins/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('adminlte/plugins/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{asset('adminlte/main.js')}}"></script>
</body>
</html>