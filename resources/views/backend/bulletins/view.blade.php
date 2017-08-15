@extends('layouts.backend')
	@section('content')
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="pull-left">
						<h3><strong><a href="{{ url('backdoor/bulletins') }}">Bulletins</a> | {{ $option }}</strong></h3>
					</div>
				</div>
			</div>
			{!! Form::open(['url' => '', 'class' => 'form-horizontal', 'autocomplete' => 'off']) !!}
			<div class="panel panel-default panel-plain">
				<div class="panel-heading">
					<h1 class="panel-title"><strong>Bulletin Details</strong></h1>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="col-md-2 control-label">Bulletin Type:</label>
								<div class="col-md-4"><label class="control-label">{{ $bulletin->bulletin_type->bt_name }}</label></div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">Message:</label>
								<div class="col-md-8 control-label custom-label">{!! nl2br($bulletin->bl_message) !!}</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">Recipients:</label>
								<div class="col-md-8 control-label custom-label">
									<table width="100%" id="recipients_table">
									@foreach($bulletin->bulletin_recipients as $recipient)
										<td><a href="{{ url('backdoor/contacts/view/'.$recipient->c_id) }}">{!! $recipient->c_fname !!} {!! $recipient->c_lname !!},</a></td>
									@endforeach
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			{!! Form::close() !!}
		</div>
	@stop