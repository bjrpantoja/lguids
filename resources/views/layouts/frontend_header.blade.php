<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>{{ $data['page'] }} | LGUIDS</title>
	<link rel="icon" href="{{ asset('images/frontend/header/favicon.ico') }}" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="{{ asset('extensions/bootstrap/css/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('extensions/font-awesome/css/font-awesome.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/frontend.css') }}">
	<script type="text/javascript" src="{{ asset('extensions/jquery/jquery.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('extensions/bootstrap/js/bootstrap.min.js') }}"></script>
</head>
<body>
<div>
	<div class="home-banner">
		<div class="container-fluid">
			<div class="row">
				<br><br>
				<div class="col-md-4 col-md-offset-8">
					<div class="lguids-container">
						<img src="{{ url('images/frontend/header/lguids-logo.png') }}" width="150" height="150" class="lguids-logo">
						<h2 class="text-lguids"><strong>{!! app\Models\Setting::pluck('st_name') !!}</strong></h2>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<br><br>