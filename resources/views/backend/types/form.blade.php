@extends('layouts.backend')
	@section('content')
		{!! Form::model($type, ['url' => 'backdoor/bulletins/type/save', 'class' => 'form-horizontal', 'autocomplete' => 'off', 'id' => 'typeForm', 'files' => 'true']) !!}
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="pull-left">
						<h3><strong><a href="{{ url('backdoor/bulletins/type') }}">Bulletin Type</a> | {{ $option }}</strong></h3>
					</div>
				</div>
			</div>
			<div class="panel panel-default panel-plain">
				<div class="panel-heading">
					<h1 class="panel-title"><strong>Bulletin Type Details</strong></h1>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-12">
							{!! Form::hidden('id', $id) !!}
							<div class="form-group {{ ($errors->has('bt_name') ? ' has-error ' : '') }} has-feedback">
								<label class="col-md-2 control-label">Bulletin Type: <span class="text-danger">*</span></label>
								<div class="col-md-3">{!! Form::text('bt_name', NULL, ['class' => 'form-control input-sm align-form', 'data-validation' => 'required', 'data-validation-error-msg-container' => '#bt_name', $option == 'View' ? 'readonly' : '']) !!}</div>
								<span class="text-danger"><small><strong id="bt_name" class="align-text"> {{ $errors->first('bt_name') }}</strong></small></span>
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
									<a href="{{ url('backdoor/bulletins/type') }}" class="btn btn-warning btn-sm"><span class="fa fa-arrow-left"></span> Cancel</a>
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
				form: '#typeForm'
			});
		</script>
	@stop