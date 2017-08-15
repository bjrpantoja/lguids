@extends('layouts.backend')
	@section('content')
		{!! Form::model($group, ['url' => 'backdoor/groups/save', 'class' => 'form-horizontal', 'autocomplete' => 'off', 'id' => 'groupForm']) !!}
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="pull-left">
						<h3><strong><a href="{{ url('backdoor/groups') }}">Groups</a> | {{ $option }}</strong></h3>
					</div>
				</div>
			</div>
			<div class="panel panel-default panel-plain">
				<div class="panel-heading">
					<h1 class="panel-title"><strong>Group Details</strong></h1>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-12">
							{!! Form::hidden('id', $id) !!}
							<div class="form-group {{ ($errors->has('g_name') ? ' has-error ' : '') }} has-feedback">
								<label class="col-md-2 control-label">Group Name: <span class="text-danger">*</span></label>
								<div class="col-md-3">{!! Form::text('g_name', NULL, ['class' => 'form-control input-sm align-form', 'data-validation' => 'required', 'data-validation-error-msg-container' => '#g_name', $option == 'View' ? 'readonly' : '']) !!}</div>
								<span class="text-danger"><small><strong id="g_name" class="align-text"> {{ $errors->first('g_name') }}</strong></small></span>
							</div>
							@if($option == 'View')
							<div class="form-group">
								<label class="col-md-2 control-label">Members:</label>
								<div class="col-md-4">
									@foreach($group->contact_groups as $cg)
										@foreach($cg->contacts as $contact)
											<div><label class="control-label"><a href="{{ url('backdoor/contacts/view/'.$contact->c_id) }}">{{ $contact->c_lname }}, {{ $contact->c_fname }}</a></label></div>
										@endforeach
									@endforeach
								</div>
							</div>
							@endif
							<div class="form-group {{ $option == 'View' ? 'hidden' : ''}}">
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
			$.validate({
				form: '#groupForm'
			});
		</script>
	@stop