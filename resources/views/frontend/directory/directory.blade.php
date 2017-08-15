@extends('layouts.frontend')
	@section('content')
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-default panel-plain">
								<div class="panel-heading">
									<h4 class="custom-header-title"><strong>Directory</strong></h4>
								</div>
								<div class="panel-body panel-fixed-height">
									<ul>
										@foreach($users as $user)
										<li>+{{ $user->u_number}} - {{ $user->u_lname }}, {{ $user->u_fname }} {{ $user->u_mname }}</li>
										@endforeach	
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
				@include('frontend.side-panel.side-panel')
			</div>
		</div>
	@stop