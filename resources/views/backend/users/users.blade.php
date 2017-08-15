@extends('layouts.backend')
	@section('content')
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="pull-left">
						<h3><strong>Users</strong></h3>
					</div>
					<div class="pull-right">
					</div>
				</div>
			</div>
			<div class="panel panel-default panel-plain">
				<div class="panel-heading clearfix">
					<div class="pull-left">
						{!! Form::open(['url' => 'backdoor/users/search', 'class' => 'form-inline', 'role' => 'form', 'autocomplete' => 'off']) !!}
							<div class="form-group">
								<div class="input-group input-group-sm">
									{!! Form::text('search', $search, ['class' => 'form-control', 'placeholder' => 'search users', 'required']) !!}
									<span class="input-group-btn">
										{!! Form::button('<span class="fa fa-search"></span>', ['class' => 'btn btn-default btn-xs', 'type' => 'submit', 'title' => 'Search']) !!}
									</span>
								</div>
							</div>
						{!! Form::close() !!}
					</div>
					<div class="pull-right"><a href="{{ url('backdoor/users/add') }}" class="btn btn-primary btn-xs add-button" title="Add User"><span class="fa fa-plus"></span></a></div>
				</div>
				@if($users->isEmpty())
					<div class="panel-body">
						<h5 class="text-danger"><strong><i class="fa fa-info-circle"></i> No user(s) found.</strong></h5>
					</div>
				@else
					<table class="table">
						<thead>
							<tr>
								<th>Name</th>
								<th>Mobile Number</th>
								<th class="text-center">Bulletin Updates</th>
								<th class="text-center">User Status</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@foreach($users as $user)
							<tr>
								<td>{{ $user->u_fname }} {{ $user->u_mname }} {{ $user->u_lname }}</td>
								<td>{{ $user->u_number }}</td>
								<td class="text-center">{!! $user->is_updated == 1 ? '<span class="fa fa-check-circle text-success" title="Yes"></span>' : '<span class="fa fa-times-circle text-danger" title="No"></span>' !!}</td>
								<td class="text-center">{!! $user->is_active == 1 ? '<span class="fa fa-check-circle text-success" title="Active"></span>' : '<span class="fa fa-times-circle text-danger" title="Inactive"></span>' !!}</td>
								<td class="text-right"><a href="{{ url('backdoor/users/edit/'.$user->u_id) }}" class="btn btn-info btn-xs" title="Edit"><span class="fa fa-pencil-square-o"></span></a></td>
							</tr>
							@endforeach
						</tbody>
					</table>
					@if($users->render())
						<div class="panel-footer text-center">@if($search == '') {!! $users->render() !!} @else {!! $users->appends(Request::only('search'))->render() !!} @endif </div>
					@endif
				@endif
			</div>
		</div>
	@stop