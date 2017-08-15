@extends('layouts.frontend')
	@section('content')
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-default panel-plain">
								<div class="panel-heading">
									<h4 class="custom-header-title"><strong>Maps</strong></h4>
								</div>
								<div class="panel-body panel-fixed-height">
									@if(!count($maps))
										<label class="text-danger">No map available.</label>
									@else
										<?php $i = 0; ?>
										<table width="100%" class="table-map">
											@foreach($maps as $map)
												<?php $i++ ?>
												@if($i % 3 == 1) <tr> @endif
												<td class="text-center"><div><img src="{{ $map->m_path }}" width="150" height="150"></div><div class="text-center"><a class="map-link" target="_blank" href="{{ asset(''.$map->m_path) }}">{{ $map->m_name }}</a></div></td>
												@if($i % 3 == 0) </tr> @endif
											@endforeach
										</table>
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