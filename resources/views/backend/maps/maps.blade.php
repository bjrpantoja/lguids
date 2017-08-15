@extends('layouts.backend')
	@section('content')
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="pull-left">
						<h3><strong>Maps</strong></h3>
					</div>
					<div class="pull-right">
					</div>
				</div>
			</div>
			<div class="panel panel-default panel-plain">
				<div class="panel-heading clearfix">
					<div class="pull-left">
						{!! Form::open(['url' => 'backdoor/maps/search', 'class' => 'form-inline', 'role' => 'form', 'autocomplete' => 'off']) !!}
							<div class="form-group">
								<div class="input-group input-group-sm">
									{!! Form::text('search', $search, ['class' => 'form-control', 'placeholder' => 'search maps', 'required']) !!}
									<span class="input-group-btn">
										{!! Form::button('<span class="fa fa-search"></span>', ['class' => 'btn btn-default btn-xs', 'type' => 'submit', 'title' => 'Search']) !!}
									</span>
								</div>
							</div>
						{!! Form::close() !!}
					</div>
					<div class="pull-right"><a href="{{ url('backdoor/maps/add') }}" class="btn btn-primary btn-xs add-button" title="Add Map"><span class="fa fa-plus"></span></a></div>
				</div>
				@if($maps->isEmpty())
					<div class="panel-body">
						<h5 class="text-danger"><strong><i class="fa fa-info-circle"></i> No map(s) found.</strong></h5>
					</div>
				@else
					<table class="table align-middle">
						<thead>
							<tr>
								<th>Map Name</th>
								<th>Map Type</th>
								<th>Map File</th>
								<th class="text-center">Status</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@foreach($maps as $map)
							<tr>
								<td>{{ $map->m_name }}</td>
								<td>{!! $map->m_type == 1 ? 'Hazard Map' : 'Vulnerability Rating' !!}</td>
								<td><a href="{{ asset(''.$map->m_path) }}" target="_blank"><img src="{{ asset(''.$map->m_path) }}" width="50" height="50"></a></td>
								<td class="text-center">{!! $map->is_active == 1 ? '<span class="fa fa-check-circle text-success" title="Active"></span>' : '<span class="fa fa-times-circle text-danger" title="Inactive"></span>' !!}</td>
								<td class="text-right">
									<a href="{{ url('backdoor/maps/view/'.$map->m_id) }}" class="btn btn-success btn-xs" title="View"><span class="fa fa-eye"></span></a>
									<a href="{{ url('backdoor/maps/edit/'.$map->m_id) }}" class="btn btn-info btn-xs" title="Edit"><span class="fa fa-pencil-square-o"></span></a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
					@if($maps->render())
						<div class="panel-footer text-center">@if($search == '') {!! $maps->render() !!} @else {!! $maps->appends(Request::only('search'))->render() !!} @endif </div>
					@endif
				@endif
			</div>
		</div>
	@stop