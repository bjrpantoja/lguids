@extends('layouts.backend')
	@section('content')
		{!! Form::model($sensor, ['url' => 'backdoor/sensors/save', 'class' => 'form-horizontal', 'autocomplete' => 'off', 'id' => 'sensorForm']) !!}
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="pull-left">
						<h3><strong><a href="{{ url('backdoor/sensors') }}">Sensors</a> | {{ $option }}</strong></h3>
					</div>
				</div>
			</div>
			<div class="panel panel-default panel-plain">
				<div class="panel-heading">
					<h1 class="panel-title"><strong>Sensor Details</strong></h1>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-12">
							{!! Form::hidden('id', $id) !!}
							<div class="form-group {{ ($errors->has('ss_address') ? ' has-error ' : '') }} has-feedback">
								<label class="col-md-2 control-label">Sensor Address: <span class="text-danger">*</span></label>
								<div class="col-md-3">{!! Form::text('ss_address', NULL, ['class' => 'form-control input-sm align-form', 'data-validation' => 'required', 'data-validation-error-msg-container' => '#ss_address']) !!}</div>
								<span class="text-danger"><small><strong id="ss_address" class="align-text"> {{ $errors->first('ss_address') }}</strong></small></span>
							</div>
							<div class="form-group {{ ($errors->has('ss_latitude') ? ' has-error ' : '') }} has-feedback">
								<label class="col-md-2 control-label">Latitude: <span class="text-danger">*</span></label>
								<div class="col-md-3">{!! Form::text('ss_latitude', NULL, ['class' => 'form-control input-sm align-form', 'data-validation' => 'number', 'data-validation-allowing' => 'float,negative', 'data-validation-error-msg-container' => '#ss_latitude']) !!}</div>
								<span class="text-danger"><small><strong id="ss_latitude" class="align-text"> {{ $errors->first('ss_latitude') }}</strong></small></span>
							</div>
							<div class="form-group {{ ($errors->has('ss_longitude') ? ' has-error ' : '') }} has-feedback">
								<label class="col-md-2 control-label">Longitude: <span class="text-danger">*</span></label>
								<div class="col-md-3">{!! Form::text('ss_longitude', NULL, ['class' => 'form-control input-sm align-form', 'data-validation' => 'number', 'data-validation-allowing' => 'float,negative', 'data-validation-error-msg-container' => '#ss_longitude']) !!}</div>
								<span class="text-danger"><small><strong id="ss_longitude" class="align-text"> {{ $errors->first('ss_longitude') }}</strong></small></span>
							</div>
							<div class="form-group {{ ($errors->has('ss_elevation') ? ' has-error ' : '') }} has-feedback">
								<label class="col-md-2 control-label">Elevation: <span class="text-danger">*</span></label>
								<div class="col-md-3">{!! Form::text('ss_elevation', NULL, ['class' => 'form-control input-sm align-form', 'data-validation' => 'number', 'data-validation-allowing' => 'float,negative', 'data-validation-error-msg-container' => '#ss_elevation']) !!}</div>
								<span class="text-danger"><small><strong id="ss_elevation" class="align-text"> {{ $errors->first('ss_elevation') }}</strong></small></span>
							</div>
							<div class="form-group {{ ($errors->has('dev_id') ? ' has-error ' : '') }} has-feedback">
								<label class="col-md-2 control-label">Device ID: <span class="text-danger">*</span></label>
								<div class="col-md-3">{!! Form::text('dev_id', NULL, ['class' => 'form-control input-sm align-form', 'data-validation' => 'number', 'data-validation-error-msg-container' => '#dev_id']) !!}</div>
								<span class="text-danger"><small><strong id="dev_id" class="align-text"> {{ $errors->first('dev_id') }}</strong></small></span>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">Sensor Type: <span class="text-danger">*</span></label>
								<div class="col-md-4">
									<div class="radio-inline"><label>{!! Form::radio('ss_type', '1', true, ['required']) !!} ARG</label></div>
									<div class="radio-inline"><label>{!! Form::radio('ss_type', '2') !!} AWS</label></div>
									<div class="radio-inline"><label>{!! Form::radio('ss_type', '3') !!} WLMS</label></div>
									<div class="radio-inline"><label>{!! Form::radio('ss_type', '4') !!} WLMS with ARG</label></div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">Is Active: <span class="text-danger">*</span></label>
								<div class="col-md-4">
									<div class="radio-inline"><label>{!! Form::radio('is_active', '1', true, ['required']) !!} Yes</label></div>
									<div class="radio-inline"><label>{!! Form::radio('is_active', '0') !!} No</label></div>
								</div>
							</div>
							<div class="form-group">
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
			$.validate({
				form: '#sensorForm'
			});
		</script>
	@stop