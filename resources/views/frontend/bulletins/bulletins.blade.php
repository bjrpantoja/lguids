@extends('layouts.frontend')
	@section('content')
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-default panel-plain">
								<div class="panel-heading">
									<h4 class="custom-header-title"><strong>Bulletins</strong></h4>
								</div>
								<div class="panel-body panel-fixed-height">
									<ul class="list-unstyled">
										@foreach($bt_type as $bt)
										<li>
											<a href="{{ url('bulletins/'.$bt->bt_id) }}" class="text-success">{{ $bt->bt_name }} 
											@foreach($bt->bulletin_count as $a)
												@if(!count($a->bulletin) == '0')
													({!! $a->bulletin !!})
												@endif
											@endforeach
											</a>
										</li>
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