<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/new-favicon-otfcoder-150x150.png') }}">
<title>Register | {{ config('app.name', 'OTFCoder') }}</title>
<!-- Bootstrap Core CSS -->
<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
<!-- Custom CSS -->
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body>
<!-- Preloader -->
<div class="preloader">
  <div class="cssload-speeding-wheel"></div>
</div>
<section id="wrapper" class="login-register">
  <div class="login-box login-sidebar">
    <div class="white-box">
      <form class="form-horizontal form-material" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <a href="javascript:void(0)" class="text-center db">
          <img src="{{ asset('images/new-logo-otfcoder.png') }}" alt="Home" width="100" /><br/>
        </a>
        <h3 class="box-title m-t-40 m-b-0">Register Now</h3><small>Create your account and enjoy</small>

        <div class="form-group m-t-20">
          <div class="col-xs-12">
            <input class="form-control" type="text" name="first_name" value="{{ old('first_name') }}" placeholder="First Name">
            @if ($errors->has('first_name'))
                <span class="help-block text-danger text-left">
                    <strong>{{ $errors->first('first_name') }}</strong>
                </span>
            @endif
          </div>
        </div>

        <div class="form-group m-t-20">
          <div class="col-xs-12">
            <input class="form-control" type="text" name="last_name" value="{{ old('last_name') }}" placeholder="Last Name">
            @if ($errors->has('last_name'))
                <span class="help-block text-danger text-left">
                    <strong>{{ $errors->first('last_name') }}</strong>
                </span>
            @endif
          </div>
        </div>

        <div class="form-group ">
          <div class="col-xs-12">
            <input class="form-control" type="text" name="email" value="{{ old('email') }}" placeholder="E-Mail Address">
            @if ($errors->has('email'))
                <span class="help-block text-danger text-left">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
          </div>
        </div>

        <div class="form-group ">
          <div class="col-xs-12">
            <input class="form-control" type="password" name="password" placeholder="Password">
            @if ($errors->has('password'))
                <span class="help-block text-danger text-left">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
          </div>
        </div>

        <div class="form-group">
          <div class="col-xs-12">
            <input class="form-control" type="password" name="password_confirmation" placeholder="Confirm Password">
          </div>
        </div>

        <div class="form-group">
          <div class="col-xs-12">
            <input type="text" id="phone" name="phone" class="form-control" placeholder="Enter phone" value="{{ old('phone') }}">
          </div>
        </div>

        <div class="form-group">
          <div class="col-xs-12">
            <input type="file" id="picture" name="picture">
            @if ($errors->has('picture'))
                <span class="help-block text-danger text-left">
                    <strong>{{ $errors->first('picture') }}</strong>
                </span>
            @endif
          </div>
        </div>

        <div class="form-group text-center m-t-20">
          <div class="col-xs-12">
            <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Sign Up</button>
          </div>
        </div>

        <div class="form-group m-b-0">
          <div class="col-sm-12 text-center">
            <p>Already have an account? <a href="{{ route('login') }}" class="text-primary m-l-5"><b>Sign In</b></a></p>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>
<!-- jQuery -->
<script src="{{ asset('js/jquery.min.js') }}"></script>
<!-- Bootstrap Core JavaScript -->
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<!--slimscroll JavaScript -->
<script src="{{ asset('js/jquery.slimscroll.js') }}"></script>
<!-- Custom Theme JavaScript -->
<script src="{{ asset('js/custom.js') }}"></script>
</body>
</html>
