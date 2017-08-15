@extends('layouts.backend')
	@section('content')
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="pull-left">
						<h3><strong>Bulletin Type</strong></h3>
					</div>
					<div class="pull-right">
					</div>
				</div>
			</div>
			<div class="panel panel-default panel-plain">
				<div class="panel-heading clearfix">
					<div class="pull-left">
						{!! Form::open(['url' => 'backdoor/bulletins/type/search', 'class' => 'form-inline', 'role' => 'form', 'autocomplete' => 'off']) !!}
							<div class="form-group">
								<div class="input-group input-group-sm">
									{!! Form::text('search', $search, ['class' => 'form-control', 'placeholder' => 'search bulletin type', 'required']) !!}
									<span class="input-group-btn">
										{!! Form::button('<span class="fa fa-search"></span>', ['class' => 'btn btn-default btn-xs', 'type' => 'submit', 'title' => 'Search']) !!}
									</span>
								</div>
							</div>
						{!! Form::close() !!}
					</div>
					<div class="pull-right"><a href="{{ url('backdoor/bulletins/type/add') }}" class="btn btn-primary btn-xs add-button" title="Add Bulletin Type"><span class="fa fa-plus"></span></a></div>
				</div>
				@if($types->isEmpty())
					<div class="panel-body">
						<h5 class="text-danger"><strong><i class="fa fa-info-circle"></i> No data found.</strong></h5>
					</div>
				@else
					<table class="table align-middle">
						<thead>
							<tr>
								<th>Bulletin Type</th>
								<th class="text-center">No. of Bulletins</th>
								<th class="text-center">Status</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@foreach($types as $type)
							<tr>
								<td>{{ $type->bt_name }}</td>
								<td class="text-center">{{ $type->bulletins->count() == 0 ? '' : $type->bulletins->count() }}</td>
								<td class="text-center">{!! $type->is_active == 1 ? '<span class="fa fa-check-circle text-success" title="Active"></span>' : '<span class="fa fa-times-circle text-danger" title="Inactive"></span>' !!}</td>
								<td class="text-right">
									<a href="{{ url('backdoor/bulletins/type/view/'.$type->bt_id) }}" class="btn btn-success btn-xs" title="View"><span class="fa fa-eye"></span></a>
									<a href="{{ url('backdoor/bulletins/type/edit/'.$type->bt_id) }}" class="btn btn-info btn-xs" title="Edit"><span class="fa fa-pencil-square-o"></span></a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
					@if($types->render())
						<div class="panel-footer text-center">@if($search == '') {!! $types->render() !!} @else {!! $types->appends(Request::only('search'))->render() !!} @endif </div>
					@endif
				@endif
			</div>
		</div>
	@stop