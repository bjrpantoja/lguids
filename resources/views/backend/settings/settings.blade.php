@extends('layouts.backend')
	@section('content')
		{!! Form::model($settings, ['url' => 'backdoor/settings/save', 'class' => 'form-horizontal', 'autocomplete' => 'off']) !!}
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="pull-left">
						<h3><strong>Handa Settings</strong></h3>
					</div>
					<div class="pull-right">
					</div>
				</div>
			</div>
			<div class="panel panel-default panel-plain">
				<div class="panel-heading">
					<h1 class="panel-title"><strong>Website Information</strong></h1>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group {{ ($errors->has('st_name') ? ' has-error ' : '') }} has-feedback">
								<label class="col-md-2 control-label">System Name: </label>
								<div class="col-md-5">{!! Form::text('st_name', NULL, ['class' => 'form-control input-sm align-form']) !!}</div>
								<span class="text-danger"><small><strong id="st_name" class="align-text"> {{ $errors->first('st_name') }}</strong></small></span>
							</div>
							<div class="form-group {{ ($errors->has('st_alias') ? ' has-error ' : '') }} has-feedback">
								<label class="col-md-2 control-label">System Alias: </label>
								<div class="col-md-5">{!! Form::text('st_alias', NULL, ['class' => 'form-control input-sm align-form']) !!}</div>
								<span class="text-danger"><small><strong id="st_alias" class="align-text"> {{ $errors->first('st_alias') }}</strong></small></span>
							</div>
							<div class="form-group {{ ($errors->has('st_footer') ? ' has-error ' : '') }} has-feedback">
								<label class="col-md-2 control-label">SMS Footer: </label>
								<div class="col-md-5">{!! Form::text('st_footer', NULL, ['class' => 'form-control input-sm align-form']) !!}</div>
								<span class="text-danger"><small><strong id="st_footer" class="align-text"> {{ $errors->first('st_footer') }}</strong></small></span>
							</div>
							<div class="form-group {{ ($errors->has('st_facebook') ? ' has-error ' : '') }} has-feedback">
								<label class="col-md-2 control-label">Facebook: </label>
								<div class="col-md-5">{!! Form::text('st_facebook', NULL, ['class' => 'form-control input-sm align-form', 'size' => '10x5']) !!}</div>
								<span class="text-danger"><small><strong id="st_facebook" class="align-text"> {{ $errors->first('st_facebook') }}</strong></small></span>
							</div>
							<div class="form-group {{ ($errors->has('st_twitter') ? ' has-error ' : '') }} has-feedback">
								<label class="col-md-2 control-label">Twitter: </label>
								<div class="col-md-5">{!! Form::text('st_twitter', NULL, ['class' => 'form-control input-sm align-form', 'size' => '10x5']) !!}</div>
								<span class="text-danger"><small><strong id="st_twitter" class="align-text"> {{ $errors->first('st_twitter') }}</strong></small></span>
							</div>
							<div class="form-group {{ ($errors->has('Google Plus') ? ' has-error ' : '') }} has-feedback">
								<label class="col-md-2 control-label">Google: </label>
								<div class="col-md-5">{!! Form::text('st_google', NULL, ['class' => 'form-control input-sm align-form', 'size' => '10x5']) !!}</div>
								<span class="text-danger"><small><strong id="Google Plus" class="align-text"> {{ $errors->first('Google Plus') }}</strong></small></span>
							</div>
							<div class="form-group {{ ($errors->has('st_about') ? ' has-error ' : '') }} has-feedback">
								<label class="col-md-2 control-label">About: </label>
								<div class="col-md-5">{!! Form::textarea('st_about', NULL, ['class' => 'form-control input-sm align-form', 'size' => '10x5']) !!}</div>
								<span class="text-danger"><small><strong id="st_about" class="align-text"> {{ $errors->first('st_about') }}</strong></small></span>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">Server Address: </label>
								<div class="col-md-5">{!! Form::text('st_address', NULL, ['class' => 'form-control input-sm align-form', 'required']) !!}</div>
							</div>
							<div class="form-group">
								<div class="col-md-5 col-md-offset-2">
									{!! Form::button('<span class="fa fa-check"></span> Update', ['class' => 'btn btn-primary btn-sm', 'type' => 'submit']) !!}
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="panel panel-default panel-plain">
				<div class="panel-heading">
					<h1 class="panel-title"><strong>SMS Information</strong></h1>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="col-md-2 control-label">GSM1</label>
								<label class="col-md-4"><label class="control-label text-danger" id="GSM1">{{ count(glob('/var/spool/sms/GSM1/'.'*')) }}</label></label>
								<div class="col-md-4 col-md-offset-1"><label class="control-label"><button class="btn btn-danger btn-xs purge-btn" data-id="GSM1" data-toggle="modal" data-target="#confirm-delete"><span class="fa fa-trash"></span></button></label></div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">GSM2</label>
								<label class="col-md-4"><label class="control-label text-danger" id="GSM2">{{ count(glob('/var/spool/sms/GSM2/'.'*')) }}</label></label>
								<div class="col-md-4 col-md-offset-1"><label class="control-label"><button class="btn btn-danger btn-xs purge-btn" data-id="GSM2" data-toggle="modal" data-target="#confirm-delete"><span class="fa fa-trash"></span></button></label></div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">Incoming</label>
								<label class="col-md-4"><label class="control-label text-danger" id="incoming">{{ count(glob('/var/spool/sms/incoming/'.'*')) }}</label></label>
								<div class="col-md-4 col-md-offset-1"><label class="control-label"><button class="btn btn-danger btn-xs purge-btn" data-id="incoming" data-toggle="modal" data-target="#confirm-delete"><span class="fa fa-trash"></span></button></label></div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">Outgoing</label>
								<label class="col-md-4"><label class="control-label text-danger" id="outgoing">{{ count(glob('/var/spool/sms/outgoing/'.'*')) }}</label></label>
								<div class="col-md-4 col-md-offset-1"><label class="control-label"><button class="btn btn-danger btn-xs purge-btn" data-id="outgoing" data-toggle="modal" data-target="#confirm-delete"><span class="fa fa-trash"></span></button></label></div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">Sent</label>
								<label class="col-md-4"><label class="control-label text-danger" id="sent">{{ count(glob('/var/spool/sms/sent/'.'*')) }}</label></label>
								<div class="col-md-4 col-md-offset-1"><label class="control-label"><button class="btn btn-danger btn-xs purge-btn" data-id="sent" data-toggle="modal" data-target="#confirm-delete"><span class="fa fa-trash"></span></button></label></div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">Failed</label>
								<label class="col-md-4"><label class="control-label text-danger" id="failed">{{ count(glob('/var/spool/sms/failed/'.'*')) }}</label></label>
								<div class="col-md-4 col-md-offset-1"><label class="control-label"><button class="btn btn-danger btn-xs purge-btn" data-id="failed" data-toggle="modal" data-target="#confirm-delete"><span class="fa fa-trash"></span></button></label></div>
							</div>
						</div>
					</div>
				</div>
				<div class="panel-footer">
					<table width="100%">
						<td><div id="logs"></div></td>
						<td align="right" class="add-padding"><span class="btn btn-danger btn-sm btn-circle" title="Restart SMS" data-toggle="modal" data-target="#confirm-restart"><span class="fa fa-power-off"></span></span></td>
					</table>
				</div>
			</div>
		</div>
		{!! Form::close() !!}
		<div id="confirm-delete" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title text-center">Are you sure to empty folder <label class="text-danger" id="folder-name"></label>?</h4>
					</div>
					<div class="modal-body">
						<div class="text-center"><button class="btn btn-success btn-xs submit-delete">Yes</button> <button class="btn btn-danger btn-xs" data-dismiss="modal">No</button></div>
					</div>
				</div>
			</div>
		</div>
		<div id="confirm-restart" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title text-center">Are you sure to restart GSM modem?</h4>
					</div>
					<div class="modal-body">
						<div class="text-center"><button class="btn btn-success btn-xs submit-restart">Yes</button> <button class="btn btn-danger btn-xs" data-dismiss="modal">No</button></div>
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript">
			$('#logs').load('settings/logs');

			$('.purge-btn').click(function(e) {
				e.preventDefault();
				$('.modal-header #folder-name').text($(this).data('id'));
			});

			$('.submit-delete').click(function() {
				$.ajax({
					url: '{{ url('backdoor/settings/purge') }}',
					data: { data: $('#folder-name').text() },
					type: 'get'
				}).done(function(response) {
					alert(response);
					$('#confirm-delete').modal('hide');
					$.ajax({
						url: '{{ url('backdoor/settings/msgs') }}',
						data: { data: $('#folder-name').text() },
						type: 'get'
					}).done(function(response) {
						var data = $.parseJSON(response);
						$('#'+data['id']).text(data['data_count']);
					});
				});
			});

			$('.submit-restart').click(function() {
				$.ajax({
					url: '{{ url('backdoor/settings/gsm') }}',
					type: 'get'
				}).done(function(response) {
					alert(response);
					$('#confirm-restart').modal('hide');
				});
			});

			setInterval(function() {
				$('#logs').load('settings/logs');
			}, 300000);
		</script>
	@stop