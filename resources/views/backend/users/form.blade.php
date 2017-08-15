@extends('layouts.backend')
	@section('content')
		{!! Form::model($user, ['url' => 'backdoor/users/save', 'class' => 'form-horizontal', 'autocomplete' => 'off', 'id' => 'userForm']) !!}
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="pull-left">
						<h3><strong><a href="{{ url('backdoor/users') }}">Users</a> | {{ $option }}</strong></h3>
					</div>
				</div>
			</div>
			<div class="panel panel-default panel-plain">
				<div class="panel-heading">
					<h1 class="panel-title"><strong>Personal Details</strong></h1>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-12">
							{!! Form::hidden('id', $id) !!}
							<div class="form-group {{ ($errors->has('u_fname') ? ' has-error ' : '') }} has-feedback">
								<label class="col-md-2 control-label">First Name: <span class="text-danger">*</span></label>
								<div class="col-md-3">{!! Form::text('u_fname', NULL, ['class' => 'form-control input-sm align-form', 'data-validation' => 'required', 'data-validation-error-msg-container' => '#u_fname']) !!}</div>
								<span class="text-danger"><small><strong id="u_fname" class="align-text"> {{ $errors->first('u_fname') }}</strong></small></span>
							</div>
							<div class="form-group {{ ($errors->has('u_mname') ? ' has-error ' : '') }} has-feedback">
								<label class="col-md-2 control-label">Middle Name: <span class="text-danger">*</span></label>
								<div class="col-md-3">{!! Form::text('u_mname', NULL, ['class' => 'form-control input-sm align-form', 'data-validation' => 'required', 'data-validation-error-msg-container' => '#u_mname']) !!}</div>
								<span class="text-danger"><small><strong id="u_mname" class="align-text"> {{ $errors->first('u_mname') }}</strong></small></span>
							</div>
							<div class="form-group {{ ($errors->has('u_lname') ? ' has-error ' : '') }} has-feedback">
								<label class="col-md-2 control-label">Last Name: <span class="text-danger">*</span></label>
								<div class="col-md-3">{!! Form::text('u_lname', NULL, ['class' => 'form-control input-sm align-form', 'data-validation' => 'required', 'data-validation-error-msg-container' => '#u_lname']) !!}</div>
								<span class="text-danger"><small><strong id="u_lname" class="align-text"> {{ $errors->first('u_lname') }}</strong></small></span>
							</div>
							<div class="form-group {{ ($errors->has('u_number') ? ' has-error ' : '') }} has-feedback">
								<label class="col-md-2 control-label">Mobile Number: <span class="text-danger">*</span></label>
								<div class="col-md-3">{!! Form::text('u_number', NULL, ['class' => 'form-control input-sm align-form', 'data-validation' => 'required', 'data-validation-error-msg-container' => '#u_number']) !!}</div>
								<span class="text-danger"><small><strong id="u_number" class="align-text"> {{ $errors->first('u_number') }}</strong></small></span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="panel panel-default panel-plain">
				<div class="panel-heading">
					<h1 class="panel-title"><strong>Account Details</strong></h1>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group {{ ($errors->has('u_username') ? ' has-error ' : '') }} has-feedback">
								<label class="col-md-2 control-label">Username: <span class="text-danger">*</span></label>
								<div class="col-md-3">{!! Form::text('u_username', NULL, ['class' => 'form-control input-sm align-form', 'data-validation' => 'required', 'data-validation-error-msg-container' => '#u_username']) !!}</div>
								<span class="text-danger"><small><strong id="u_username" class="align-text"> {{ $errors->first('u_username') }}</strong></small></span>
							</div>
							<div class="form-group {{ ($errors->has('u_password') ? ' has-error ' : '') }} has-feedback">
								<label class="col-md-2 control-label">Password: <span class="text-danger">*</span></label>
								<div class="col-md-3">{!! Form::password('u_password', ['class' => 'form-control input-sm align-form', 'data-validation' => 'required', 'data-validation-error-msg-container' => '#u_password']) !!}</div>
								<span class="text-danger"><small><strong id="u_password" class="align-text"> {{ $errors->first('u_password') }}</strong></small></span>
							</div>
							@if(Auth::user()->is_admin == 1)
							<div class="form-group">
								<label class="col-md-2 control-label">Is Active: <span class="text-danger">*</span></label>
								<div class="col-md-2">
									<div class="radio-inline"><label>{!! Form::radio('is_active', '1', true, ['required']) !!} Yes</label></div>
									<div class="radio-inline"><label>{!! Form::radio('is_active', '0') !!} No</label></div>
								</div>
							</div>
							@endif
							<div class="form-group">
								<label class="col-md-2 control-label">Automated Bulletins: <span class="text-danger">*</span></label>
								<div class="col-md-2">
									<div class="radio-inline"><label>{!! Form::radio('is_updated', '1', true, ['required']) !!} Yes</label></div>
									<div class="radio-inline"><label>{!! Form::radio('is_updated', '0') !!} No</label></div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-3 col-md-offset-2">
									{!! Form::button('<span class="fa fa-check"></span> Save', ['class' => 'btn btn-primary btn-sm', 'type' => 'submit']) !!}
									<a href="{{ url('backdoor/users') }}" class="btn btn-warning btn-sm"><span class="fa fa-arrow-left"></span> Cancel</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		{!! Form::close() !!}
		<script type="text/javascript" src="{{ asset('extensions/validation/form-validator/jquery.form-validator.min.js') }}"></script>
		<script type="text/javascript">
			$.validate({
				form: '#userForm'
			});
		</script>
	@stop