@extends('layouts.backend')
	@section('content')
		<link rel="stylesheet" href="{{ asset('extensions/chosen/chosen.css') }}" type="text/css">
		<link rel="stylesheet" href="{{ asset('extensions/chosen/chosen-bootstrap.css') }}" type="text/css">
		<script src="{{ asset('extensions/chosen/chosen.jquery.min.js') }}"></script>
		{!! Form::open(['url' => 'backdoor/bulletins/save', 'class' => 'form-horizontal', 'autocomplete' => 'off', 'id' => 'bulletinForm']) !!}
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="pull-left">
						<h3><strong><a href="{{ url('backdoor/bulletins') }}">Bulletins</a> | {{ $option }}</strong></h3>
					</div>
				</div>
			</div>
			<div class="panel panel-default panel-plain">
				<div class="panel-heading">
					<h1 class="panel-title"><strong>Bulletin Details</strong></h1>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="col-md-2 control-label">Send Mode: <span class="text-danger">*</span></label>
								<div class="col-md-4">{!! Form::select('send_mode', array('Individual', 'Group', 'All'), NULL, ['class' => 'form-control input-sm', 'id' => 'send_mode']) !!}</div>
							</div>
							<div class="form-group {{ ($errors->has('recipients') ? ' has-error ' : '') }} has-feedback" id="recipients-container">
								<label class="col-md-2 control-label">Recipients: <span class="text-danger">*</span></label>
								<div class="col-md-4">{!! Form::select('recipients[]', $recipients, NULL, ['id' => 'recipients', 'class' => 'form-control input-sm chosen-select', 'multiple']) !!}</div>
								<span class="text-danger"><small><strong class="align-text"> {{ $errors->first('recipients') }}</strong></small></span>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">Bulletin Type: <span class="text-danger">*</span></label>
								<div class="col-md-4">{!! Form::select('bt_id', $type, NULL, ['class' => 'form-control input-sm']) !!}</div>
							</div>
							<div class="form-group {{ ($errors->has('bl_message') ? ' has-error ' : '') }} has-feedback">
								<label class="col-md-2 control-label">Message: <span class="text-danger">*</span></label>
								<div class="col-md-4">{!! Form::textarea('bl_message', NULL, ['class' => 'form-control input-sm', 'size' => '10x5']) !!}</div>
								<span class="text-danger"><small><strong class="align-text"> {{ $errors->first('bl_message') }}</strong></small></span>
							</div>
							<div class="form-group">
								<div class="col-md-3 col-md-offset-2">
									{!! Form::button('<span class="fa fa-check"></span> Save', ['class' => 'btn btn-primary btn-sm', 'type' => 'submit']) !!}
									<a href="{{ url('backdoor/bulletins') }}" class="btn btn-warning btn-sm"><span class="fa fa-arrow-left"></span> Cancel</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		{!! Form::close() !!}
		<script type="text/javascript">
			if($(".chosen-select").length) {
				$(".chosen-select").chosen();
			}
			$('#send_mode').change(function() {
				var send_mode = $('#send_mode :selected').text();
				$.ajax({
					url: "{{ url('backdoor/bulletins/send') }}",
					type: "get",
					data: { send_mode: send_mode },
					success: function(data) {
						var opts = $.parseJSON(data);
						$('#recipients').empty();
						if(opts['send_mode'] == 'All') {
							var newOption = '<option value="" selected></option>';
							$('#recipients').append(newOption);
							$('#recipients').trigger('chosen:updated');
							$('#recipients-container').hide();
						}
						else if(opts['send_mode'] == 'Individual') {
							$.each(opts['individual'], function(i, e) {
								var newOption = $('<option value="'+i+'">'+e+'</option>');
								$('#recipients').append(newOption);
								$('#recipients').attr('data-placeholder', 'Individual Mode');
								$('#recipients').trigger('chosen:updated');
								$('#recipients-container').show();
							});
						}
						else if(opts['send_mode'] == 'Group') {
							$.each(opts['group'], function(i, e) {
								var newOption = $('<option value="'+i+'">'+e+'</option>');
								$('#recipients').append(newOption);
								$('#recipients').attr('data-placeholder', 'Group Mode');
								$('#recipients').trigger('chosen:updated');
								$('#recipients-container').show();
							});
						}
					}
				})
			});
		</script>
	@stop