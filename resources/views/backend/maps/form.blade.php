@extends('layouts.backend')
	@section('content')
		{!! Form::model($map, ['url' => 'backdoor/maps/save', 'class' => 'form-horizontal', 'autocomplete' => 'off', 'id' => 'mapForm', 'files' => 'true']) !!}
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="pull-left">
						<h3><strong><a href="{{ url('backdoor/maps') }}">Maps</a> | {{ $option }}</strong></h3>
					</div>
				</div>
			</div>
			<div class="panel panel-default panel-plain">
				<div class="panel-heading">
					<h1 class="panel-title"><strong>Map Details</strong></h1>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-12">
							{!! Form::hidden('id', $id) !!}
							<div class="form-group {{ ($errors->has('m_name') ? ' has-error ' : '') }} has-feedback">
								<label class="col-md-2 control-label">Map Name: <span class="text-danger">*</span></label>
								<div class="col-md-3">{!! Form::text('m_name', NULL, ['class' => 'form-control input-sm align-form', 'data-validation' => 'required', 'data-validation-error-msg-container' => '#m_name']) !!}</div>
								<span class="text-danger"><small><strong id="m_name" class="align-text"> {{ $errors->first('m_name') }}</strong></small></span>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">Map Type: <span class="text-danger">*</span></label>
								<div class="col-md-4">
									<div class="radio-inline"><label>{!! Form::radio('m_type', '1', true, ['required']) !!} Hazard Map</label></div>
									<div class="radio-inline"><label>{!! Form::radio('m_type', '2') !!} Vulnerability Ratings</label></div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">Is Active: <span class="text-danger">*</span></label>
								<div class="col-md-4">
									<div class="radio-inline"><label>{!! Form::radio('is_active', '1', true, ['required']) !!} Yes</label></div>
									<div class="radio-inline"><label>{!! Form::radio('is_active', '0') !!} No</label></div>
								</div>
							</div>
							<div class="form-group {{ ($errors->has('m_path') ? ' has-error ' : '') }} has-feedback">
								<label class="col-md-2 control-label">Map File: <span class="text-danger">*</span></label>
								<div class="col-md-4">{!! Form::file('m_path') !!}</div>
								<span class="text-danger"><small><strong id="m_path" class="align-text"> {{ $errors->first('m_path') }}</strong></small></span>
							</div>
							<div class="form-group">
								<div class="col-md-3 col-md-offset-2">
									{!! Form::button('<span class="fa fa-check"></span> Save', ['class' => 'btn btn-primary btn-sm', 'type' => 'submit']) !!}
									<a href="{{ url('backdoor/maps') }}" class="btn btn-warning btn-sm"><span class="fa fa-arrow-left"></span> Cancel</a>
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
				form: '#mapForm'
			});
		</script>
	@stop