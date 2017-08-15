@extends('layouts.backend')
	@section('content')
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="pull-left">
						<h3><strong>Bulletins</strong></h3>
					</div>
					<div class="pull-right">
					</div>
				</div>
			</div>
			<div class="panel panel-default panel-plain">
				<div class="panel-heading clearfix">
					<div class="pull-left">
						{!! Form::open(['url' => 'backdoor/bulletins/search', 'class' => 'form-inline', 'role' => 'form', 'autocomplete' => 'off']) !!}
							<div class="form-group">
								<div class="input-group input-group-sm">
									{!! Form::text('search', $search, ['class' => 'form-control', 'placeholder' => 'search bulletins', 'required']) !!}
									<span class="input-group-btn">
										{!! Form::button('<span class="fa fa-search"></span>', ['class' => 'btn btn-default btn-xs', 'type' => 'submit', 'title' => 'Search']) !!}
									</span>
								</div>
							</div>
						{!! Form::close() !!}
					</div>
					<div class="pull-right"><a href="{{ url('backdoor/bulletins/add') }}" class="btn btn-primary btn-xs add-button" title="Add Bulletin"><span class="fa fa-plus"></span></a></div>
				</div>
				@if($bulletins->isEmpty())
					<div class="panel-body">
						<h5 class="text-danger"><strong><i class="fa fa-info-circle"></i> No bulletin(s) found.</strong></h5>
					</div>
				@else
					<table class="table">
						<thead>
							<tr>
								<th>Bulletin Type</th>
								<th class="text-center">No. of Recipients</th>
								<th class="text-center">SENT</th>
								<th class="text-center">FAILED</th>
								<th class="text-center">Date/Time Sent</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@foreach($bulletins as $bulletin)
							<tr>
								<td>{{ $bulletin->bulletin_type->bt_name }}</td>
								<td class="text-center">{{ $bulletin->bulletin_recipients->count() == 0 ? '' : $bulletin->bulletin_recipients->count() }}</td>
								<td class="text-center">{{ count($bulletin->bulletin_sent) == 0 ? '' : count($bulletin->bulletin_sent) }}</td>
								<td class="text-center">{{ count($bulletin->bulletin_failed) == 0 ? '' : count($bulletin->bulletin_failed) }}</td>
								<td class="text-center">{{ $bulletin->created_at->format('F d, Y h:i A') }}</td>
								<td class="text-right">
									<a href="{{ url('backdoor/bulletins/view/'.$bulletin->bl_id) }}" class="btn btn-success btn-xs" title="View"><span class="fa fa-eye"></span></a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
					@if($bulletins->render())
						<div class="panel-footer text-center">@if($search == '') {!! $bulletins->render() !!} @else {!! $bulletins->appends(Request::only('search'))->render() !!} @endif </div>
					@endif
				@endif
			</div>
		</div>
	@stop