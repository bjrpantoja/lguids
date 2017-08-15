@extends('layouts.backend')
	@section('content')
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="pull-left">
						<h3><strong>Contacts</strong></h3>
					</div>
					<div class="pull-right">
					</div>
				</div>
			</div>
			<div class="panel panel-default panel-plain">
				<div class="panel-heading clearfix">
					<div class="pull-left">
						{!! Form::open(['url' => 'backdoor/contacts/search', 'class' => 'form-inline', 'role' => 'form', 'autocomplete' => 'off']) !!}
							<div class="form-group">
								<div class="input-group input-group-sm">
									{!! Form::text('search', $search, ['class' => 'form-control', 'placeholder' => 'search contacts', 'required']) !!}
									<span class="input-group-btn">
										{!! Form::button('<span class="fa fa-search"></span>', ['class' => 'btn btn-default btn-xs', 'type' => 'submit', 'title' => 'Search']) !!}
									</span>
								</div>
							</div>
						{!! Form::close() !!}
					</div>
					<div class="pull-right"><a href="{{ url('backdoor/contacts/add') }}" class="btn btn-primary btn-xs add-button" title="Add Contact"><span class="fa fa-plus"></span></a></div>
				</div>
				@if($contacts->isEmpty())
					<div class="panel-body">
						<h5 class="text-danger"><strong><i class="fa fa-info-circle"></i> No contact(s) found.</strong></h5>
					</div>
				@else
					<table class="table">
						<thead>
							<tr>
								<th>Name</th>
								<th>Mobile Number</th>
								<th>Group</th>
								<th>Agency</th>
								<th>Position</th>
								<th class="text-center">Status</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@foreach($contacts as $contact)
							<tr>
								<td>{{ $contact->c_lname }}, {{ $contact->c_fname }}</td>
								<td>{{ $contact->c_number }}</td>
								<td>
									@foreach($contact->groups as $group)
										<div>{{ $group->g_name }}</div>
									@endforeach
								</td>
								<td>{{ $contact->c_agency }}</td>
								<td>{{ $contact->c_position }}</td>
								<td class="text-center">{!! $contact->is_active == 1 ? '<span class="fa fa-check-circle text-success" title="Active"></span>' : '<span class="fa fa-times-circle text-danger" title="Inactive"></span>' !!}</td>
								<td class="text-right">
									<a href="{{ url('backdoor/contacts/view/'.$contact->c_id) }}" class="btn btn-success btn-xs" title="View"><span class="fa fa-eye"></span></a>
									<a href="{{ url('backdoor/contacts/edit/'.$contact->c_id) }}" class="btn btn-info btn-xs" title="Edit"><span class="fa fa-pencil-square-o"></span></a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
					@if($contacts->render())
						<div class="panel-footer text-center">@if($search == '') {!! $contacts->render() !!} @else {!! $contacts->appends(Request::only('search'))->render() !!} @endif </div>
					@endif
				@endif
			</div>
		</div>
	@stop