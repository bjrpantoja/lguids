@extends('layouts.frontend')
	@section('content')
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-default panel-plain">
								<div class="panel-heading">
									<h4 class="custom-header-title"><strong>Stations</strong></h4>
								</div>
								<div class="panel-body panel-fixed-height no-padding">
									<table width="100%" class="station-table">
										<thead>
											<tr>
												<th><h4><strong>Automated Weather Station (AWS) ({{ count($aws) }})</strong></h4></th>
												<th class="text-right"><h4><strong>Last Readings</strong></h4></th>
											</tr>
										</thead>
										<tbody>
										@foreach($aws as $sensor2)
											<div class="hidden">
												{{ $aws_latest 		= app\Models\Data::select('d_date_time_read')->where('ss_id', '=', $sensor2->ss_id)->orderBy('d_date_time_read', 'DESC')->limit('1')->pluck('d_date_time_read') }}
												{{ $time_difference = intval(abs(strtotime($aws_latest) - strtotime(date('Y-m-d H:i:s')))/86400) }}
											</div>
											<tr>
												<td><span class="{{($time_difference > 30 ? 'fa fa-exclamation-circle text-danger' : 'fa fa-check-circle text-success')}}"></span> <a href="{{ url('stations/aws/'.$sensor2->ss_id) }}" {{($time_difference > 30 ? 'class=text-danger' : 'class=text-success')}}>{{ $sensor2->ss_address }}</a></td>
												<td class="text-right"><i class="text-danger">{{ $time_difference > 30 ? Carbon\Carbon::parse($aws_latest)->format('F d, Y') : ''}}</i></td>
											</tr>
										@endforeach
										</tbody>
									</table>
									<table width="100%" class="station-table">
										<thead>
											<tr>
												<th><h4><strong>Automated Rain Gauge (ARG) ({{ count($arg) }})</strong></h4></th>
												<th></th>
											</tr>
										</thead>
										<tbody>
										@foreach($arg as $sensor1)
											<div class="hidden">
												{{ $aws_latest 		= app\Models\Data::select('d_date_time_read')->where('ss_id', '=', $sensor1->ss_id)->orderBy('d_date_time_read', 'DESC')->limit('1')->pluck('d_date_time_read') }}
												{{ $time_difference = intval(abs(strtotime($aws_latest) - strtotime(date('Y-m-d H:i:s')))/86400) }}
											</div>
											<tr>
												<td><span class="{{($time_difference > 30 ? 'fa fa-exclamation-circle text-danger' : 'fa fa-check-circle text-success')}}"></span> <a href="{{ url('stations/arg/'.$sensor1->ss_id) }}" {{($time_difference > 30 ? 'class=text-danger' : 'class=text-success')}}>{{ $sensor1->ss_address }}</a></td>
												<td class="text-right"><i class="text-danger">{{ $time_difference > 30 ? Carbon\Carbon::parse($aws_latest)->format('F d, Y') : ''}}</i></td>
											</tr>
										@endforeach
										</tbody>
									</table>
									<table width="100%" class="station-table">
										<thead>
											<tr>
												<th><h4><strong>Water Level Monitoring Station (WLMS) ({{ count($wlms) }})</strong></h4></th>
												<th></th>
											</tr>
										</thead>
										<tbody>
										@foreach($wlms as $sensor3)
											<div class="hidden">
												{{ $aws_latest 		= app\Models\Data::select('d_date_time_read')->where('ss_id', '=', $sensor3->ss_id)->orderBy('d_date_time_read', 'DESC')->limit('1')->pluck('d_date_time_read') }}
												{{ $time_difference = intval(abs(strtotime($aws_latest) - strtotime(date('Y-m-d H:i:s')))/86400) }}
											</div>
											<tr>
												<td><span class="{{($time_difference > 30 ? 'fa fa-exclamation-circle text-danger' : 'fa fa-check-circle text-success')}}"></span> <a href="{{ url('stations/wlms/'.$sensor3->ss_id) }}" {{($time_difference > 30 ? 'class=text-danger' : 'class=text-success')}}>{{ $sensor3->ss_address }}</a></td>
												<td class="text-right"><i class="text-danger">{{ $time_difference > 30 ? Carbon\Carbon::parse($aws_latest)->format('F d, Y') : ''}}</i></td>
											</tr>
										@endforeach
										</tbody>
									</table>
									<table width="100%" class="station-table bottom-table">
										<thead>
											<tr>
												<th colspan="2"><h4><strong>Water Level Monitoring Station with Automated Rain Rauge (WLMS with ARG) ({{ count($wlmsr) }})</strong></h4></th>
											</tr>
										</thead>
										<tbody>
										@foreach($wlmsr as $sensor4)
											<div class="hidden">
												{{ $aws_latest 		= app\Models\Data::select('d_date_time_read')->where('ss_id', '=', $sensor4->ss_id)->orderBy('d_date_time_read', 'DESC')->limit('1')->pluck('d_date_time_read') }}
												{{ $time_difference = intval(abs(strtotime($aws_latest) - strtotime(date('Y-m-d H:i:s')))/86400) }}
											</div>
											<tr>
												<td><span class="{{($time_difference > 30 ? 'fa fa-exclamation-circle text-danger' : 'fa fa-check-circle text-success')}}"></span> <a href="{{ url('stations/wlmsr/'.$sensor4->ss_id) }}" {{($time_difference > 30 ? 'class=text-danger' : 'class=text-success')}}>{{ $sensor4->ss_address }}</a></td>
												<td class="text-right"><i class="text-danger">{{ $time_difference > 30 ? Carbon\Carbon::parse($aws_latest)->format('F d, Y') : ''}}</i></td>
											</tr>
										@endforeach
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
				@include('frontend.side-panel.side-panel')
			</div>
		</div>
	@stop