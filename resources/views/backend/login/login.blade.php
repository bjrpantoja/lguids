<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Login</title>
	<link rel="icon" href="{{ asset('images/frontend/header/favicon.ico') }}" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="{{ asset('extensions/bootstrap/css/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('extensions/font-awesome/css/font-awesome.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/login.css') }}">
	<script type="text/javascript" src="{{ asset('extensions/jquery/jquery.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('extensions/bootstrap/js/bootstrap.min.js') }}"></script>
</head>
<body>
	<div class="panel panel-default panel-plain center">
		<div class="panel-heading">
			<h4 class="panel-title text-center">Administrator Login</h4>
		</div>
		<div class="panel-body no-padding">
			{!! Form::open(['url' => 'login', 'class' => 'form', 'autocomplete' => 'off']) !!}
				<div class="text-center text-danger"><strong>{{ $error_message }}</strong></div>
				<br>
				<div class="input-group input-group-padding">
					<span class="input-group-addon no-border-radius">Username </span>
					{!! Form::text('username', NULL, ['class' => 'form-control no-border-radius input-sm', 'maxlength' => '255', 'required']) !!}
				</div>
				<div class="input-group input-group-padding">
					<span class="input-group-addon no-border-radius">Password&nbsp</span>
					{!! Form::password('password', ['class' => 'form-control no-border-radius input-sm', 'maxlength' => '255', 'required']) !!}
				</div>
				<div class="text-center">
					{!! Form::submit('Login', ['class' => 'btn btn-default btn-xs login-btn']) !!}
				</div>
				<br>
			{!! Form::close() !!}
		</div>
	</div>
</body>
</html>