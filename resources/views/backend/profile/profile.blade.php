@extends('layouts.backend')
	@section('content')
		{!! Form::open(['url' => 'backdoor/profile/save', 'class' => 'form-horizontal', 'autocomplete' => 'off', 'id' => 'profileForm']) !!}
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="pull-left">
						<h3><strong>My Profile</strong></h3>
					</div>
					<div class="pull-right">
						<h3><strong>Last Login: @if(empty($user->logs->ul_login_time)) This is the first login of this account. @else {{ Carbon\Carbon::parse($user->logs->ul_login_time)->format('F d, Y h:i A') }} @endif</strong></h3>
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
							<div class="form-group {{ ($errors->has('u_fname') ? ' has-error ' : '') }} has-feedback">
								<label class="col-md-2 control-label">First Name: <span class="text-danger">*</span></label>
								<div class="col-md-3">{!! Form::text('u_fname', $user->u_fname, ['class' => 'form-control input-sm align-form', 'data-validation' => 'required', 'data-validation-error-msg-container' => '#u_fname']) !!}</div>
								<span class="text-danger"><small><strong id="u_fname" class="align-text"> {{ $errors->first('u_fname') }}</strong></small></span>
							</div>
							<div class="form-group {{ ($errors->has('u_mname') ? ' has-error ' : '') }} has-feedback">
								<label class="col-md-2 control-label">Middle Name: <span class="text-danger">*</span></label>
								<div class="col-md-3">{!! Form::text('u_mname', $user->u_mname, ['class' => 'form-control input-sm align-form', 'data-validation' => 'required', 'data-validation-error-msg-container' => '#u_mname']) !!}</div>
								<span class="text-danger"><small><strong id="u_mname" class="align-text"> {{ $errors->first('u_mname') }}</strong></small></span>
							</div>
							<div class="form-group {{ ($errors->has('u_lname') ? ' has-error ' : '') }} has-feedback">
								<label class="col-md-2 control-label">Last Name: <span class="text-danger">*</span></label>
								<div class="col-md-3">{!! Form::text('u_lname', $user->u_lname, ['class' => 'form-control input-sm align-form', 'data-validation' => 'required', 'data-validation-error-msg-container' => '#u_lname']) !!}</div>
								<span class="text-danger"><small><strong id="u_lname" class="align-text"> {{ $errors->first('u_lname') }}</strong></small></span>
							</div>
							<div class="form-group {{ ($errors->has('u_number') ? ' has-error ' : '') }} has-feedback">
								<label class="col-md-2 control-label">Mobile Number: <span class="text-danger">*</span></label>
								<div class="col-md-3">{!! Form::text('u_number', $user->u_number, ['class' => 'form-control input-sm align-form', 'data-validation' => 'required', 'data-validation-error-msg-container' => '#u_number']) !!}</div>
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
								<div class="col-md-3">{!! Form::text('u_username', $user->u_username, ['class' => 'form-control input-sm align-form', 'data-validation' => 'required', 'data-validation-error-msg-container' => '#u_username']) !!}</div>
								<span class="text-danger"><small><strong id="u_username" class="align-text"> {{ $errors->first('u_username') }}</strong></small></span>
							</div>
							<div class="form-group {{ ($errors->has('u_password') ? ' has-error ' : '') }} has-feedback">
								<label class="col-md-2 control-label">Password: <span class="text-danger">*</span></label>
								<div class="col-md-3">{!! Form::password('u_password', ['class' => 'form-control input-sm align-form', 'data-validation' => 'required', 'data-validation-error-msg-container' => '#u_password']) !!}</div>
								<span class="text-danger"><small><strong id="u_password" class="align-text"> {{ $errors->first('u_password') }}</strong></small></span>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">Automated Bulletins: <span class="text-danger">*</span></label>
								<div class="col-md-2">
									<div class="radio-inline"><label>{!! Form::radio('is_updated', '1', $user->is_updated == '1') !!} Yes</label></div>
									<div class="radio-inline"><label>{!! Form::radio('is_updated', '0', $user->is_updated == '0') !!} No</label></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="panel panel-default panel-plain">
				<div class="panel-heading">
					<h1 class="panel-title"><strong>Account Logs</strong></h1>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="col-md-2 control-label">Created At:</label>
								<div class="col-md-3"><label class="control-label">{{ $user->created_at->format('F d, Y h:i A') }}</label></div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">Updated At:</label>
								<div class="col-md-3"><label class="control-label">{{ $user->updated_at->format('F d, Y h:i A') }}</label></div>
							</div>
							<div class="form-group">
								<div class="col-md-3 col-md-offset-2">
									{!! Form::button('<span class="fa fa-check"></span> Update Profile', ['class' => 'btn btn-primary btn-sm', 'type' => 'submit']) !!}
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
				form: '#profileForm'
			});
		</script>
	@stop