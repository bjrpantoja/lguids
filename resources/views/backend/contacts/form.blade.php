@extends('layouts.backend')
	@section('content')
		<link rel="stylesheet" href="{{ asset('extensions/chosen/chosen.css') }}" type="text/css">
		<link rel="stylesheet" href="{{ asset('extensions/chosen/chosen-bootstrap.css') }}" type="text/css">
		<script src="{{ asset('extensions/chosen/chosen.jquery.min.js') }}"></script>
		{!! Form::model($contact, ['url' => 'backdoor/contacts/save', 'class' => 'form-horizontal', 'autocomplete' => 'off', 'id' => 'contactForm']) !!}
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="pull-left">
						<h3><strong><a href="{{ url('backdoor/contacts') }}">Contacts</a> | {{ $option }}</strong></h3>
					</div>
				</div>
			</div>
			<div class="panel panel-default panel-plain">
				<div class="panel-heading">
					<h1 class="panel-title"><strong>Contact Details</strong></h1>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-12">
							{!! Form::hidden('id', $id) !!}
							<div class="form-group {{ ($errors->has('c_fname') ? ' has-error ' : '') }} has-feedback">
								<label class="col-md-2 control-label">First Name: <span class="text-danger">*</span></label>
								<div class="col-md-3">{!! Form::text('c_fname', NULL, ['class' => 'form-control input-sm align-form', 'data-validation' => 'required', 'data-validation-error-msg-container' => '#c_fname', $option == 'View' ? 'readonly' : '']) !!}</div>
								<span class="text-danger"><small><strong id="c_fname" class="align-text"> {{ $errors->first('c_fname') }}</strong></small></span>
							</div>
							<div class="form-group {{ ($errors->has('c_mname') ? ' has-error ' : '') }} has-feedback">
								<label class="col-md-2 control-label">Middle Name: <span class="text-danger">*</span></label>
								<div class="col-md-3">{!! Form::text('c_mname', NULL, ['class' => 'form-control input-sm align-form', 'data-validation' => 'required', 'data-validation-error-msg-container' => '#c_mname', $option == 'View' ? 'readonly' : '']) !!}</div>
								<span class="text-danger"><small><strong id="c_mname" class="align-text"> {{ $errors->first('c_mname') }}</strong></small></span>
							</div>
							<div class="form-group {{ ($errors->has('c_lname') ? ' has-error ' : '') }} has-feedback">
								<label class="col-md-2 control-label">Last Name: <span class="text-danger">*</span></label>
								<div class="col-md-3">{!! Form::text('c_lname', NULL, ['class' => 'form-control input-sm align-form', 'data-validation' => 'required', 'data-validation-error-msg-container' => '#c_lname', $option == 'View' ? 'readonly' : '']) !!}</div>
								<span class="text-danger"><small><strong id="c_lname" class="align-text"> {{ $errors->first('c_lname') }}</strong></small></span>
							</div>
							<div class="form-group {{ ($errors->has('c_number') ? ' has-error ' : '') }} has-feedback">
								<label class="col-md-2 control-label">Mobile Number: <span class="text-danger">*</span></label>
								<div class="col-md-3">{!! Form::text('c_number', NULL, ['class' => 'form-control input-sm align-form', 'data-validation' => 'required', 'data-validation-error-msg-container' => '#c_number', $option == 'View' ? 'readonly' : '']) !!}</div>
								<span class="text-danger"><small><strong id="c_number" class="align-text"> {{ $errors->first('c_number') }}</strong></small></span>
							</div>
							<div class="form-group {{ ($errors->has('c_agency') ? ' has-error ' : '') }} has-feedback">
								<label class="col-md-2 control-label">Agency:</label>
								<div class="col-md-3">{!! Form::text('c_agency', NULL, ['class' => 'form-control input-sm align-form', $option == 'View' ? 'readonly' : '']) !!}</div>
								<span class="text-danger"><small><strong id="c_agency" class="align-text"> {{ $errors->first('c_agency') }}</strong></small></span>
							</div>
							<div class="form-group {{ ($errors->has('c_position') ? ' has-error ' : '') }} has-feedback">
								<label class="col-md-2 control-label">Position:</label>
								<div class="col-md-3">{!! Form::text('c_position', NULL, ['class' => 'form-control input-sm align-form', $option == 'View' ? 'readonly' : '']) !!}</div>
								<span class="text-danger"><small><strong id="c_position" class="align-text"> {{ $errors->first('c_position') }}</strong></small></span>
							</div>
							<div class="form-group {{ ($errors->has('groups') ? ' has-error ' : '') }} has-feedback">
								<label class="col-md-2 control-label">Group(s): <span class="text-danger">*</span></label>
								<div class="col-md-5">{!! Form::select('groups[]', $groups, $option == 'Edit' || $option == 'View' ? $cg : NULL, ['class' => 'form-control input-sm chosen-select', 'multiple', $option == 'View' ? 'readonly' : '']) !!}</div>
								<span class="text-danger"><small><strong id="groups" class="align-text"> {{ $errors->first('groups') }}</strong></small></span>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">Is Active: <span class="text-danger">*</span></label>
								<div class="col-md-4">
									<div class="radio-inline"><label>{!! Form::radio('is_active', '1', true, ['required']) !!} Yes</label></div>
									<div class="radio-inline"><label>{!! Form::radio('is_active', '0') !!} No</label></div>
								</div>
							</div>
							<div class="form-group {{ $option == 'View' ? 'hidden' : ''}}">
								<div class="col-md-3 col-md-offset-2">
									{!! Form::button('<span class="fa fa-check"></span> Save', ['class' => 'btn btn-primary btn-sm', 'type' => 'submit']) !!}
									<a href="{{ url('backdoor/sensors') }}" class="btn btn-warning btn-sm"><span class="fa fa-arrow-left"></span> Cancel</a>
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
			if($(".chosen-select").length) {
				$(".chosen-select").chosen();
			}
			$.validate({
				form: '#contactForm'
			});
		</script>
	@stop