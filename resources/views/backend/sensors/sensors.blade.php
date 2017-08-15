@extends('layouts.backend')
	@section('content')
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="pull-left">
						<h3><strong>Sensors</strong></h3>
					</div>
					<div class="pull-right">
					</div>
				</div>
			</div>
			<div class="panel panel-default panel-plain">
				<div class="panel-heading clearfix">
					<div class="pull-left">
						{!! Form::open(['url' => 'backdoor/sensors/search', 'class' => 'form-inline', 'role' => 'form', 'autocomplete' => 'off']) !!}
							<div class="form-group">
								<div class="input-group input-group-sm">
									{!! Form::text('search', $search, ['class' => 'form-control', 'placeholder' => 'search sensors', 'required']) !!}
									<span class="input-group-btn">
										{!! Form::button('<span class="fa fa-search"></span>', ['class' => 'btn btn-default btn-xs', 'type' => 'submit', 'title' => 'Search']) !!}
									</span>
								</div>
							</div>
						{!! Form::close() !!}
					</div>
					<div class="pull-right"><a href="{{ url('backdoor/sensors/add') }}" class="btn btn-primary btn-xs add-button" title="Add User"><span class="fa fa-plus"></span></a></div>
				</div>
				@if($sensors->isEmpty())
					<div class="panel-body">
						<h5 class="text-danger"><strong><i class="fa fa-info-circle"></i> No sensor(s) found.</strong></h5>
					</div>
				@else
					<table class="table">
						<thead>
							<tr>
								<th>Sensor Address</th>
								<th>Coordinates</th>
								<th class="text-center">Elevation</th>
								<th class="text-center">Sensor Type</th>
								<th class="text-center">Device ID</th>
								<th class="text-center">Status</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@foreach($sensors as $sensor)
							<tr>
								<td>{{ $sensor->ss_address }}</td>
								<td>{{ $sensor->ss_latitude }}, {{ $sensor->ss_longitude }}</td>
								<td class="text-center">{{ $sensor->ss_elevation }}</td>
								<td class="text-center">@if($sensor->ss_type == 1) ARG @elseif($sensor->ss_type == 2) AWS @elseif($sensor->ss_type == 3) WLMS @else WLMS with ARG @endif</td>
								<td class="text-center">{{ $sensor->dev_id }}</td>
								<td class="text-center">{!! $sensor->is_active == 1 ? '<span class="fa fa-check-circle text-success" title="Active"></span>' : '<span class="fa fa-times-circle text-danger" title="Inactive"></span>' !!}</td>
								<td class="text-right"><a href="{{ url('backdoor/sensors/edit/'.$sensor->ss_id) }}" class="btn btn-info btn-xs" title="Edit"><span class="fa fa-pencil-square-o"></span></a></td>
							</tr>
							@endforeach
						</tbody>
					</table>
					@if($sensors->render())
						<div class="panel-footer text-center">@if($search == '') {!! $sensors->render() !!} @else {!! $sensors->appends(Request::only('search'))->render() !!} @endif </div>
					@endif
				@endif
			</div>
		</div>
	@stop