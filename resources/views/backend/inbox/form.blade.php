@extends('layouts.backend')
	@section('content')
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="pull-left">
						<h3><strong><a href="{{ url('backdoor/inbox') }}">Inbox</a> | New Message</strong></h3>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-default panel-plain">
						<br>
						<div class="panel-body">
							{!! Form::open(['url' => 'backdoor/inbox/send', 'class' => 'form-horizontal', 'autocomplete' => 'off', 'id' => 'msgForm']) !!}
								<div class="form-group {{ ($errors->has('sms_number') ? ' has-error ' : '') }} has-feedback">
									<label class="col-md-3 control-label">Mobile Number: <span class="text-danger">*</span></label>
									<div class="col-md-5">{!! Form::text('sms_number', NULL, ['class' => 'form-control input-sm', 'data-validation' => 'required', 'data-validation-error-msg-container' => '#sms_number']) !!}</div>
									<span class="text-danger"><small><strong id="sms_number" class="align-text"> {{ $errors->first('sms_number') }}</strong></small></span>
								</div>
								<div class="form-group {{ ($errors->has('sms_message') ? ' has-error ' : '') }} has-feedback">
									<label class="col-md-3 control-label">Message: <span class="text-danger">*</span></label>
									<div class="col-md-5">{!! Form::textarea('sms_message', NULL, ['class' => 'form-control input-sm', 'size' => '10x3', 'data-validation' => 'required', 'data-validation-error-msg-container' => '#sms_message']) !!}</div>
									<span class="text-danger"><small><strong id="sms_message" class="align-text"> {{ $errors->first('sms_message') }}</strong></small></span>
								</div>
								<div class="form-group">
									<div class="col-md-offset-3 col-md-3">
										{!! Form::button('<span class="fa fa-check"></span> Send', ['type' => 'submit', 'class' => 'btn btn-primary btn-sm']) !!}
										<a class="btn btn-danger btn-sm" href="{{ url('backdoor/inbox') }}"><span class="fa fa-times-circle"></span> Cancel</a>
									</div>
								</div>
							{!! Form::close() !!}
						</div>
					</div>
				</div>
			</div>
		</div>
	<script type="text/javascript" src="{{ asset('extensions/validation/form-validator/jquery.form-validator.min.js') }}"></script>
	<script type="text/javascript">
		$.validate({
			form: '#msgForm'
		});
	</script>
	@stop