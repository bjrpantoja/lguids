@extends('layouts.frontend')
	@section('content')
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-default panel-plain">
								<div class="panel-heading">
									<h4 class="bulletin-header"><strong><a href="{{ url('bulletins') }}" class="text-success">Bulletins</a></strong> &nbsp | &nbsp{{ $bt_type->bt_name }}</h4>
								</div>
								<div class="panel-body panel-fixed-height no-padding">
									<table width="100%" class="side-panel-table bulletin-view">
										<tbody>
										@foreach($bulletins as $bulletin)
											<tr>
												<td><p>{!! nl2br($bulletin->bl_message) !!}</p></td>
											</tr>
										@endforeach
										</tbody>
									</table>
									@if($bulletins->render())
									<div class="text-center">
										{!! $bulletins->render() !!}
									</div>
									@endif
								</div>
							</div>
						</div>
					</div>
				</div>
				@include('frontend.side-panel.side-panel')
			</div>
		</div>
	@stop