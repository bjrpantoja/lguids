<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>{{ $data['page'] }} | LGUIDS</title>
	<link rel="icon" href="{{ asset('images/frontend/header/favicon.ico') }}" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="{{ asset('extensions/bootstrap/css/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('extensions/font-awesome/css/font-awesome.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/backend.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/navbar.css') }}">
	<script type="text/javascript" src="{{ asset('extensions/jquery/jquery.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('extensions/bootstrap/js/bootstrap.min.js') }}"></script>
</head>
<body>
	<nav class="navbar navbar-default navbar-static-top">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
			        <span class="sr-only">Toggle navigation</span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
      			</button>
      			<div class="navbar-header">
	      			<a href="" class="navbar-brand">
	      				<img src="{{ url('images/frontend/header/lguids-logo.png') }}">
	      			</a>	
      			</div>
			</div>
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav navbar-left">
					@if(Auth::user()->is_admin == 1)
						<li {{(Request::is('backdoor/users') || (Request::is('backdoor/users/add')) || (Request::is('backdoor/users/edit/'.Request::segment(4))) || (Request::is('backdoor/users/search')) ? 'class=active' : '')}}><a href="{{ url('backdoor/users') }}"><span class="fa fa-users fa-fw"></span> Users</a></li>
					@endif
					<li {{(Request::is('backdoor/settings') ? 'class=active' : '')}}><a href="{{ url('backdoor/settings') }}"><span class="fa fa-cog fa-fw"></span> Settings</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li {{(Request::is('backdoor/dashboard') ? 'class=active' : '') }}><a href="{{ url('backdoor/dashboard')}}"><span class="fa fa-bar-chart fa-fw"></span> Dashboard</a></li>
					<li {{(Request::is('backdoor/bulletins/type') || (Request::is('backdoor/bulletins/type/add')) || (Request::is('backdoor/bulletins/type/edit/'.Request::segment(4))) || (Request::is('backdoor/bulletins/type/view/'.Request::segment(4))) || (Request::is('backdoor/bulletins/type/search')) || (Request::is('backdoor/bulletins')) || (Request::is('backdoor/bulletins/add')) || (Request::is('backdoor/bulletins/edit/'.Request::segment(4))) || (Request::is('backdoor/bulletins/view/'.Request::segment(4))) || (Request::is('backdoor/bulletins/search')) ? 'class=active' : '') }}>
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspop="true" aria-expanded="false"><span class="fa fa-envelope fa-fw"></span> Bulletins <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li {{(Request::is('backdoor/bulletins/type') || (Request::is('backdoor/bulletins/type/add')) || (Request::is('backdoor/bulletins/type/edit/'.Request::segment(4))) || (Request::is('backdoor/bulletins/type/view/'.Request::segment(4))) || (Request::is('backdoor/bulletins/type/search')) ? 'class=active' : '') }}><a href="{{ url('backdoor/bulletins/type') }}">Bulletin Type</a></li>
							<li {{(Request::is('backdoor/bulletins') || (Request::is('backdoor/bulletins/add')) || (Request::is('backdoor/bulletins/edit/'.Request::segment(4))) || (Request::is('backdoor/bulletins/view/'.Request::segment(4))) || (Request::is('backdoor/bulletins/search')) ? 'class=active' : '') }}><a href="{{ url('backdoor/bulletins') }}">Bulletins</a></li>
						</ul>
					</li>
					<li {{(Request::is('backdoor/groups') || (Request::is('backdoor/groups/add')) || (Request::is('backdoor/groups/edit/'.Request::segment(4))) || (Request::is('backdoor/groups/view/'.Request::segment(4))) || (Request::is('backdoor/groups/search')) || (Request::is('backdoor/contacts')) || (Request::is('backdoor/contacts/add')) || (Request::is('backdoor/contacts/edit/'.Request::segment(4))) || (Request::is('backdoor/contacts/view/'.Request::segment(4))) || (Request::is('backdoor/contacts/search')) ? 'class=active' : '') }}>
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspop="true" aria-expanded="false"><span class="fa fa-address-book fa-fw"></span> Phonebook <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li {{(Request::is('backdoor/contacts') || (Request::is('backdoor/contacts/add')) || (Request::is('backdoor/contacts/edit/'.Request::segment(4))) || (Request::is('backdoor/contacts/view/'.Request::segment(4))) || (Request::is('backdoor/contacts/search')) ? 'class=active' : '') }}><a href="{{ url('backdoor/contacts') }}">Contacts</a></li>
							<li {{(Request::is('backdoor/groups') || (Request::is('backdoor/groups/add')) || (Request::is('backdoor/groups/edit/'.Request::segment(4))) || (Request::is('backdoor/groups/view/'.Request::segment(4))) || (Request::is('backdoor/groups/search')) ? 'class=active' : '') }}><a href="{{ url('backdoor/groups') }}">Groups</a></li>
						</ul>
					</li>
					<li {{(Request::is('backdoor/inbox') ? 'class=active' : '')}}><a href="{{ url('backdoor/inbox') }}" title="Inbox"><span class="fa fa-inbox fa-fw"></span> Inbox</a></li>
					<li {{(Request::is('backdoor/profile') ? 'class=active' : '')}}>
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspop="true" aria-expanded="false" title="Account"><span class="fa fa-user fa-fw"></span> {{ Auth::user()->u_fname }} {{ Auth::user()->u_lname }} <span class="caret"></span></span></a>
						<ul class="dropdown-menu" role="menu">
							<li {{(Request::is('backdoor/profile') ? 'class=active' : '')}}><a href="{{ url('backdoor/profile') }}">Profile</a></li>
							<li><a href="{{ url('logout') }}">Logout</a></li>
						</ul>
					</li>
				</ul>
			</div>	
		</div>
	</nav>
	<div class="container">
		@if(Session::has('unauthorize'))
		    <div class="alert alert-danger fade in">
		    	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong><span class="fa fa-exclamation-circle"></span> {{ Session::get('unauthorize') }}</strong>
			</div>
		@endif
		@if(Session::has('update'))
		    <div class="alert alert-warning fade in">
		    	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong><span class="fa fa-check-circle"></span> {{ Session::get('update') }}</strong>
			</div>
		@endif
		@if(Session::has('success'))
		    <div class="alert alert-success fade in">
		    	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong><span class="fa fa-check-circle"></span> {{ Session::get('success') }}</strong>
			</div>
		@endif
	</div>

	<script type="text/javascript">
		$(".alert").fadeTo(2000, 500).slideUp(500, function(){
		    $(".alert").slideUp(500);
		});
	</script>