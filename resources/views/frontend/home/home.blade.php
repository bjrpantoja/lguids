@extends('layouts.frontend')
	@section('content')
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<iframe src="{{ $ip }}/lguids/map" frameborder="no" width="100%" scrolling="no" height="775"></iframe>
				</div>
			</div>
		</div>
		<br>
		<div class="container">
			<div class="row">
				<div class="col-md-4">
					<div class="panel panel-default panel-plain">
						<div class="panel-heading">
							<h5 class="panel-title"><strong>EARTHQUAKE UPDATE</strong></h5>
						</div>
						@if(!count($data['latest_eq']))
							<div class="panel-body panel-widget">
								<i class="fa fa-exclamation-circle text-danger"></i> No updates found.
							</div>
						@else
							<div class="panel-widget">
								<table width="100%" class="side-panel-table">
									<tbody>
									@foreach($data['latest_eq'] as $eq)
										<tr>
											<td><small><p>{!! nl2br($eq->bl_message) !!}</p></small></td>
										</tr>
									@endforeach
									</tbody>
								</table>
							</div>
						@endif
					</div>
				</div>
				<div class="col-md-4">
					<div class="panel panel-default panel-plain">
						<div class="panel-heading">
							<h5 class="panel-title"><strong>WEATHER UPDATE</strong></h5>
						</div>
						@if(!count($data['latest_wb']))
							<div class="panel-body panel-widget">
								<i class="fa fa-exclamation-circle text-danger"></i> No updates found.
							</div>
						@else
							<div class="panel-widget">
								<table width="100%" class="side-panel-table">
									<tbody>
									@foreach($data['latest_wb'] as $wb)
										<tr>
											<td><small><p>{!! nl2br($wb->bl_message) !!}</p></small></td>
										</tr>
									@endforeach
									</tbody>
								</table>
							</div>
						@endif
					</div>
				</div>
				<div class="col-md-4">
					<div class="panel panel-default panel-plain">
						<div class="panel-heading">
							<h5 class="panel-title"><strong>TROPICAL CYCLONE UPDATE</strong></h5>
						</div>
						@if(!count($data['latest_tc']))
							<div class="panel-body panel-widget">
								As of today, there is no Tropical Cyclone within Philippine Area of Responsibility.
							</div>
						@else
							<div class="panel-widget">
								<table width="100%" class="side-panel-table">
									<tbody>
									@foreach($data['latest_tc'] as $tc)
										<tr>
											<td><small><p>{!! nl2br($tc->bl_message) !!}</p></small></td>
										</tr>
									@endforeach
									</tbody>
								</table>
							</div>
						@endif
					</div>
				</div>
				<div class="col-md-12">
				<br>
				</div>
				<div class="col-md-4 col-md-offset-2">
					<div class="panel panel-default panel-plain">
						<div class="panel-heading">
							<h5 class="panel-title"><strong>STATIONS</strong></h5>
						</div>
						<div class="panel-body panel-widget">
							<center>
								<img src="{{ asset('images/frontend/widgets/stations.jpg') }}" class="img-circle text-center" width="150" height="150">
							<hr/>
							<p class="widget-label">Monitor rainfall and water level data from DOST’s automated sensors installed near your location.</p>
							<br><br>
							<a href="http://handa.region4a.dost.gov.ph/stations" target="_blank" class="btn btn-default btn-md">View Stations &raquo;</a>
							</center>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="panel panel-default panel-plain">
						<div class="panel-heading">
							<h5 class="panel-title"><strong>INQUIRY</strong></h5>
						</div>
						<div class="panel-body panel-widget">
							<center>
								<img src="{{ asset('images/frontend/widgets/inquiry.jpg') }}" class="img-circle text-center" width="150" height="150">
							<hr/>
							<p class="widget-label">Be updated of the latest weather, storm, flood bulletins from PAGASA and earthquake alerts PHIVOLCS.</p>
							<br><br>
							<button class="btn btn-default btn-md">View Inquiry &raquo;</button>
							</center>
						</div>
					</div>
				</div>
			</div>
		</div>
	@stop