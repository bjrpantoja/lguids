@extends('layouts.backend')
	@section('content')
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="container">
			<div class="row">
				<div class="col-md-3">
					<div class="pull-left">
						<h3><strong>Inbox</strong></h3>
					</div>
					<div class="pull-right">
						<h3 id="delete_container"><strong><a href="" class="text-danger" id="delete_btn">Delete</a> </strong></h3>
					</div>
				</div>
				<div class="col-md-9">
					<div class="pull-right">
						<h3><strong><a href="{{ url('backdoor/inbox/add') }}">New Message</a></strong></h3>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3">
					<div class="panel panel-default panel-plain panel-custom">
						<ul class="nav nav-pills nav-stacked">
							@foreach($sms_inbox as $sms)
								<li>
									<a href="#" class="nowrap hide-overflow">
										<div class="pull-left">
											{{ $sms->contacts == '' ? $sms->sl_number : $sms->contacts->c_fname." ".substr($sms->contacts->c_mname, 0, 1).". ".$sms->contacts->c_lname }}
											<div class="hidden" id="sms_number">{{ $sms->sl_number }}</div>
										</div>
										<div class="pull-right checkbox_slot">@if($sms->notif != 0) <button class="btn btn-danger btn-xs">{{ $sms->notif }}</button> @endif </div>
									</a>
								</li>
							@endforeach
						</ul>
					</div>
				</div>
				<div class="col-md-9">
					<div class="panel panel-default panel-plain panel-custom-body">
						<div class="panel-body panel-body-message"></div>
						<div class="panel-body-message-footer">
							{!! Form::open(['class' => 'form-horizontal']) !!}
								<div class="col-md-11">
									<div class="form-group">
										{!! Form::textarea('send_sms', NULL, ['class' => 'form-control', 'rows' => '1', 'required', 'id' => 'send_sms', 'Placeholder' => 'Type your message here.']) !!}
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										{!! Form::submit('Send', ['class' => 'btn btn-default btn-primary send-btn', 'id' => 'send_btn']) !!}
									</div>	
								</div>
							{!! Form::close() !!}
						</div>
					</div>
				</div>
			</div>
		</div>

		<script type="text/javascript">
			$.ajaxSetup({
			    headers: {
			        'X-CSRF-Token': $('input[name="_token"]').val()
			    }
			});

			setInterval(get_last_msg, 5000);
			
			$('ul.nav.nav-pills li').first().addClass('active');
			var sms_number = $('ul.nav.nav-pills li.active').first().find(':hidden').text();

			if(sms_number == '') {
				$('#send_btn').attr('disabled', true);
				$('#send_sms').attr('disabled', true);
			}
			else {
				$('#send_btn').attr('disabled', false);
				$('#send_sms').attr('disabled', false);
			}

			get_msg(sms_number);

			$('ul.nav.nav-pills li a').click(function() {
				$('.panel-body-message').html("");
				$('ul.nav.nav-pills li').first().removeClass('active');       
			    $(this).parent().addClass('active').siblings().removeClass('active');
			    var sms_number = $('ul.nav.nav-pills li.active').first().find(':hidden').text();
			    get_msg(sms_number);
			});

			$('#send_sms').keydown(function(e) {
				var send_sms = $('#send_sms').val();
				if(e.keyCode == 13 && !e.shiftKey) {
					e.preventDefault();
					if(e.keyCode == 13) {
						$('#send_btn').trigger('click');
						return true;
					}
				}
			});

			$('#delete_btn').one("click", function(e) {
				var sms_numbers = [];
				e.preventDefault();
				$('#delete_container').append('<a href="" class="text-success">Cancel</a>');
				$('.checkbox_slot').append('<input type="checkbox">');
				$('.checkbox_slot input:checkbox').change(function() {
					var is_checked = $(this).is(':checked');
					sms_numbers.push($(this).parent().parent().find(':hidden').text());
					if(!is_checked) {
						var checked = $(this).parent().parent().find(':hidden').text();
						sms_numbers = jQuery.grep(sms_numbers, function(value) {
						  return value != checked;
						});
					}
				});

				$('#delete_btn').click(function() {
					$.get('{{ url("backdoor/inbox/delete") }}', { sms_numbers: sms_numbers }, function(data) {
						if(data == 'true') {
							location.reload();
						}
						else {
							alert("ERROR HAS OCCURED.");
						}
					});
				});
			});

			$('#send_btn').click(function(e) {
				var sms_number = $('ul.nav.nav-pills li.active').first().find(':hidden').text();
				var send_sms = $('#send_sms').val();
				if(send_sms != '') {
					$('#send_sms').val("");
					e.preventDefault();
					$.ajax({
						type: "POST",
						url: "{{ url('backdoor/inbox/send_ajax') }}",
						data: { sms_number: sms_number, sms_message: send_sms },
						success: function(data) {
							var data = $.parseJSON(data);
							var msg  = data.sms_message;
							if(data.sl_status == "SENT") {
								var insert = '<div id="chat-container"><div class="bubble you">'+msg+'<div><span class="inbox-pane-date"><em>'+data.date_formatted+' &middot; '+data.sl_status+'</em></span></div></div><div class="clr"></div></div>';
								$('.panel-body-message').prepend(insert);
							}
							else if(data.sl_status == "QUEUED") {
								var insert = '<div id="chat-container"><div class="bubble you queue">'+msg+'<div><span class="inbox-pane-date"><em>Sending..</em></span></div></div><div class="clr"></div></div>';
								$('.panel-body-message').prepend(insert);
							}
							else if(data.sl_status == "RECEIVED") {
								var insert = '<div id="chat-container"><div class="bubble me">'+msg+'<div><span class="inbox-pane-date"><em>'+data.date_formatted+' &middot; '+data.sl_status+'</em></span></div></div><div class="clr"></div></div>';
								$('.panel-body-message').prepend(insert);
							}
							else if(data.sl_status == "FAILED") {
								var insert = '<div id="chat-container"><div class="bubble you failed">'+msg+'<div><span class="inbox-pane-date"><em>'+e.date_formatted+' &middot; '+e.sl_status+'</em></span></div></div><div class="clr"></div></div>';
								$('.panel-body-message').prepend(insert);
								$('#chat-container').hide();
								$('#chat-container').show();
							}
						}
					});
				}
			});

			function get_msg(sms_number) {
				$('.panel-body-message').html("");
				$.ajax({
					url: "{{ url('backdoor/inbox/get_msg') }}",
					method: "GET",
					data: { sms_number: sms_number },
					success: function(data) {
						var msg = $.parseJSON(data);
						$.each(msg, function(i, e) {
							if(e.sl_status == "SENT") {
								var insert = '<div id="chat-container"><div class="bubble you">'+e.sl_message+'<div><span class="inbox-pane-date"><em>'+e.date_formatted+' &middot; '+e.sl_status+'</em></span></div></div><div class="clr"></div></div>';
								$('.panel-body-message').prepend(insert);
								$('#chat-container').hide();
								$('#chat-container').show();								
							}
							else if(e.sl_status == "QUEUED") {
								var insert = '<div id="chat-container"><div class="bubble you queue">'+e.sl_message+'<div><span class="inbox-pane-date"><em>Sending..</em></span></div></div><div class="clr"></div></div>';
								$('.panel-body-message').prepend(insert);
								$('#chat-container').hide();
								$('#chat-container').show();	
							}
							else if(e.sl_status == "RECEIVED") {
								var insert = '<div id="chat-container"><div class="bubble me">'+e.sl_message+'<div><span class="inbox-pane-date"><em>'+e.date_formatted+' &middot; '+e.sl_status+'</em></span></div></div><div class="clr"></div></div>';
								$('.panel-body-message').prepend(insert);
								$('#chat-container').hide();
								$('#chat-container').show();
							}
							else if(e.sl_status == "FAILED") {
								var insert = '<div id="chat-container"><div class="bubble you failed">'+e.sl_message+'<div><span class="inbox-pane-date"><em>'+e.date_formatted+' &middot; '+e.sl_status+'</em></span></div></div><div class="clr"></div></div>';
								$('.panel-body-message').prepend(insert);
								$('#chat-container').hide();
								$('#chat-container').show();
							}
						});
					}
				});
			}

			function get_last_msg() {
				var sms_number = $('ul.nav.nav-pills li.active').first().find(':hidden').text();
				$.ajax({
					url: "{{ url('backdoor/inbox/get_last_msg') }}",
					method: 'POST',
					data: { id: '1' },
					success: function(data) {
						if(data == 'false') {
							get_msg(sms_number);
						}
					}
				});
			}
		</script>
	@stop