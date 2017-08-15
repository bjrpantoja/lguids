@extends('layouts.backend')
	@section('content')
		<link rel="stylesheet" type="text/css" href="{{ asset('extensions/morris/morris.css') }}">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="pull-left">
						<h3><strong>Dashboard</strong></h3>
					</div>
					<div class="pull-right">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="panel panel-success">
						<div class="panel-heading">
							<div class="row">
								<div class="col-md-3">
									<div class="pull-left fa fa-envelope fa-5x"></div>
								</div>
								<div class="col-md-9 text-right">
									<h2>{{ number_format($bulletins_sent) }}</h2>
									<div>Bulletins Sent</div>
								</div>
							</div>
						</div>
						<a href="{{ url('backdoor/bulletins') }}">
							<div class="panel-footer clearfix">
								<div class="pull-left text-success">View Details</div>
								<div class="pull-right text-success"><i class="fa fa-arrow-circle-right"></i></div>
							</div>
						</a>
					</div>
				</div>
				<div class="col-md-4">
					<div class="panel panel-warning">
						<div class="panel-heading">
							<div class="row">
								<div class="col-md-3">
									<div class="pull-left fa fa-phone fa-5x"></div>
								</div>
								<div class="col-md-9 text-right">
									<h2>{{ number_format($contacts) }}</h2>
									<div>Contacts</div>
								</div>
							</div>
						</div>
						<a href="{{ url('backdoor/contacts') }}">
							<div class="panel-footer clearfix">
								<div class="pull-left text-warning">View Details</div>
								<div class="pull-right text-warning"><i class="fa fa-arrow-circle-right"></i></div>
							</div>
						</a>
					</div>
				</div>
				<div class="col-md-4">
					<div class="panel panel-info">
						<div class="panel-heading">
							<div class="row">
								<div class="col-md-3">
									<div class="pull-left fa fa-users fa-5x"></div>
								</div>
								<div class="col-md-9 text-right">
									<h2>{{ number_format($admins) }}</h2>
									<div>Administrators</div>
								</div>
							</div>
						</div>
						<a href="{{ url('backdoor/users') }}">
							<div class="panel-footer clearfix">
								<div class="pull-left text-info">View Details</div>
								<div class="pull-right text-info"><i class="fa fa-arrow-circle-right"></i></div>
							</div>
						</a>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="panel panel-default">
						<div class="panel-heading clearfix">
							<div class="panel-title pull-left"><span class="fa fa-bar-chart-o fa-fw"></span> SMS Activity</div>
							<div class="pull-right">
								<div class="input-group">
									<span class="input-group-addon">Year</span>
									{!! Form::select('year', $years, NULL, ['class' => 'form-control input-sm', 'id' => 'sms-year']) !!}
								</div>
							</div>
						</div>
						<div class="panel-body">
							<div id="sms-logs"></div>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="panel panel-default">
						<div class="panel-heading clearfix">
							<div class="panel-title pull-left"><span class="fa fa-bar-chart-o fa-fw"></span> Bulletin Activity</div>
							<div class="pull-right">
								<div class="input-group">
									<span class="input-group-addon">Year</span>
									{!! Form::select('year', $years, NULL, ['class' => 'form-control input-sm', 'id' => 'bulletin-year']) !!}
								</div>
							</div>
						</div>
						<div class="panel-body">
							<div id="bulletin-logs"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
<!-- 				<div class="col-md-6">
					<div class="panel panel-default">
						<div class="panel-heading clearfix">
							<div class="panel-title pull-left"><span class="fa fa-database fa-fw"></span> Bulletin Statistics</div>
						</div>
						<div class="panel-body">
							<div id="bulletin-stat"></div>
						</div>
					</div>
				</div> -->
				<div class="col-md-12">
					<div class="panel panel-default">
						<div class="panel-heading clearfix">
							<div class="panel-title pull-left"><span class="fa fa-database fa-fw"></span> Bulletin Statistics</div>
							<div class="pull-right">
								<div class="input-group">
									<span class="input-group-addon">Year</span>
									{!! Form::open(['url' => 'backdoor/dashboard', 'method' => 'GET']) !!}
										{!! Form::select('date', $years, $date, ['class' => 'form-control input-sm', 'onchange="this.form.submit()"']) !!}
									{!! Form::close() !!}
								</div>
							</div>
						</div>
						@if(!count($bulletin_stats))
							<div class="panel-body">
								<i><span class="fa fa-exclamation-circle text-danger"></span></i> No data found.
							</div>
						@else
							<table class="table">
								<thead>
									<tr>
										<th>Bulletin Name</th>
										<th>Bulletin Count</th>
									</tr>
								</thead>
								<tbody>
								@foreach($bulletin_stats as $stat)
									<tr>
										<td>{{ $stat->bulletin_type->bt_name }}</td>
										<td>{{ $stat->bl_stats }}</td>
									</tr>
								@endforeach
								</tbody>
							</table>
						@endif
					</div>
				</div>
			</div>
		</div>

		<script type="text/javascript" src="{{ asset('extensions/morris/raphael.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('extensions/morris/morris.min.js')}}"></script>

		<script type="text/javascript">
			var labels = {!! $bt_type !!};
			var year = new Date().getFullYear();
			line_chart(year);
			bar_chart(year);

			$.ajax({
				url: '{{ url("backdoor/dashboard/pie_chart_data") }}',
				type: 'get',
				data: { year: year },
				dataType: "json",
				success: function(data) {
					Morris.Donut({
							  element: 'bulletin-stat',
							  data: data
					});
				}
			});
			
			$('#sms-year').change(function() {
				year = $(this).val();
				line_chart(year);
			});
			
			$('#bulletin-year').change(function() {
				year = $(this).val();
				bar_chart(year);
			});

			var sms_chart = Morris.Line({
					  element: 'sms-logs',
					  data: '',
					  xkey: 'Year',
					  ykeys: ['Sent', 'Failed', 'Received'],
					  labels: ['Sent', 'Failed', 'Received'],
					  hideHover: 'auto',
					  parseTime: false,
					  xLabelAngle: 40
					});

			var bulletin_chart = Morris.Bar({
					  element: 'bulletin-logs',
					  data: '',
					  xkey: 'Year',
					  ykeys: labels,
					  labels: labels,
					  hideHover: 'auto',
					  stacked:  'true',
					  parseTime: false,
					  xLabelAngle: 40
			});

			function line_chart(year)
			{
				$.ajax({
					url: '{{ url("backdoor/dashboard/line_chart_data") }}',
					type: 'get',
					data: { year: year },
					dataType: "json",
					success: function(data) {
						sms_chart.setData(data);
					}
				});
			}

			function bar_chart(year)
			{
				$.ajax({
					url: '{{ url("backdoor/dashboard/bar_chart_data") }}',
					type: 'get',
					data: { year: year },
					dataType: "json",
					success: function(data) {
						bulletin_chart.setData(data);
					}
				});
			}

		</script>
	@stop