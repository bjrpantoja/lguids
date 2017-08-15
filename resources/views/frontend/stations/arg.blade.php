@extends('layouts.frontend')
	@section('content')
		<link rel="stylesheet" type="text/css" href="{{ asset('extensions/morris/morris.css') }}">
		<link rel="stylesheet" href="{{ asset('extensions/date-picker/bootstrap-datepicker3.css') }}" type="text/css">

		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-default">
						<div class="panel-heading clearfix">
							<h4 class="custom-header-title pull-left"><strong>Automated Rain Gauge</strong></h4>
							<h4 class="custom-header-title2 pull-right"><span class="fa fa-map-marker text-danger"></span> <span id="address">{{ $arg->ss_address }}</span></h4>
						</div>
						<div class="panel-body panel-fixed-height sensor-content">
							<br>
							<div class="row">
								<div class="col-md-9">
									<div id="sensor-map"></div>
									<div id="latitude" class="hidden">{{ $arg->ss_latitude }}</div>
									<div id="longitude" class="hidden">{{ $arg->ss_longitude }}</div>
								</div>
								<div class="col-md-3">
									<div class="panel panel-default panel-plain">
										<div class="panel-heading">
											<div><h4 class="panel-title"><strong>Readings</strong></h4></div>
											<div><small>as of {{ Carbon\Carbon::parse($arg_latest->date_time)->format('F d, Y h:i A') }}</small></div>
										</div>
										<div class="panel-body no-padding sensor-body">
											<table width="100%" class="sensor-table">
												<tr>
													<td>
														<img src="{{ asset('images/frontend/sensors/rainfall.jpg') }}" class="float-img"> 
														<strong>Rainfall Amount</strong>
														<div><small>{{ $arg_latest->d_rain_value }} mm</small></div>
													</td>
												</tr>
											</table>
										</div>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-12">
									Data Source: <strong><a class="text-success" href="http://fmon.asti.dost.gov.ph/weather/predict/" target="_blank">PREDICT</a></strong> (Advanced Science and Technology Institute)
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-12">
									<div class="panel panel-default panel-plain">
										<div class="panel-heading">
											<h4 class="panel-title"><strong>12 HOUR DATA</strong></h4>
										</div>
										<div class="panel-body">
											<div id="12-hour-data"></div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="panel panel-default panel-plain">
										<div class="panel-heading">
											<h4 class="panel-title"><strong>PREVIOUS DATA</strong></h4>
										</div>
										<div class="panel-body">
											{!! Form::open(['url' => 'stations/arg/'.$id, 'class' => 'form-inline pull-right']) !!}
											<div class="input-group">
												<span class="input-group-addon">From</span>
												{!! Form::text('date_from', $date_from, ['class' => 'form-control input-sm filter', 'readonly']) !!}
											</div>
											<div class="input-group">
												<span class="input-group-addon">To</span>
												{!! Form::text('date_to', $date_to, ['class' => 'form-control input-sm filter', 'readonly']) !!}
											</div>
											<div class="form-group">
												{!! Form::submit('Submit', ['class' => 'btn btn-primary btn-sm']) !!}
											</div>
											{!! Form::close() !!}
										</div>
										@if(!count($arg_data))
											<div class="panel-body">
												<h4 class="text-danger"><strong><i class="fa fa-info-circle"></i> No data found.</strong></h4>
											</div>
										@else
										<table class="table table-hover custom-table">
											<thead>
												<tr>
													<th>DateTime</th>
													<th class="text-center">Rain Amount</th>
												</tr>
											</thead>
											<tbody>
											@foreach($arg_data as $arg)
												<tr>
													<td>{{ Carbon\Carbon::parse($arg->d_date_time_read)->format('F d, Y h:i A') }} </td>
													<td class="text-center">{{ $arg->d_rain_value }} mm</td>
												</tr>
											@endforeach	
											</tbody>
										</table>
										<div class="panel-footer custom-footer">
											@if($arg_data->render())
											<div class="text-center">
												@if(Input::get('date_from') == null && Input::get('date_to') == null)
													{!! $arg_data->render() !!}
												@else
													{!! $arg_data->appends(Request::only('date_from', 'date_to'))->render() !!}
												@endif
											</div>
											@endif
										</div>
										@endif
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCDzewCy_3XM_SKe4IaGDeb087N9wn7CMc"></script>
		<script type="text/javascript" src="{{ asset('extensions/date-picker/bootstrap-datepicker.js') }}"></script>
		<script type="text/javascript" src="{{ asset('extensions/morris/raphael.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('extensions/morris/morris.min.js')}}"></script>
		<script type="text/javascript" src="{{ asset('js/arg.js') }}"></script>
		<script type="text/javascript">

			$('.filter').datepicker({
				format: 'MM dd, yyyy',
				orientation: 'top'
			});

			$.ajax({
				url: '{{ url("stations/chart_data/".Request::segment(3)) }}',
				type: 'get',
				dataType: "json",
				success: function(data) {
					console.log(data);
					Morris.Line({
					  element: '12-hour-data',
					  data: data,
					  xkey: 'd_date_time_read',
					  ykeys: ['d_rain_value'],
					  labels: ['Rainfall Amount (mm)'],
					  hideHover: 'auto'
					});
				}
			});
		</script>
	@stop