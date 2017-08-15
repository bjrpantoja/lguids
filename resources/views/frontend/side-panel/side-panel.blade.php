<div class="col-md-4">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default panel-plain">
				<div class="panel-heading">
					<h4 class="panel-title"><strong>Earthquake Update</strong></h4>
				</div>
				@if(!count($data['latest_eq']))
				<div class="panel-body side-panel">
					<i class="fa fa-exclamation-circle text-danger"></i> No updates found.
				</div>
				@else
				<div class="side-panel">
					<table width="100%" class="side-panel-table">
						<tbody>
						@foreach($data['latest_eq'] as $eq)
							<tr>
								<td><small><p>{!! nl2br($eq->bl_message) !!}</p></small></td>
							</tr>
						@endforeach
						</tbody>
					</table>
				</div>
				@endif
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default panel-plain">
				<div class="panel-heading">
					<h4 class="panel-title"><strong>Weather Update</strong></h4>
				</div>
				@if(!count($data['latest_wb']))
				<div class="panel-body side-panel">
					<i class="fa fa-exclamation-circle text-danger"></i> No updates found.
				</div>
				@else
				<div class="side-panel">
					<table width="100%" class="side-panel-table">
						<tbody>
						@foreach($data['latest_wb'] as $wb)
							<tr>
								<td><small><p>{!! nl2br($wb->bl_message) !!}</p></small></td>
							</tr>
						@endforeach
						</tbody>
					</table>
				</div>
				@endif
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default panel-plain">
				<div class="panel-heading">
					<h4 class="panel-title"><strong>Tropical Cyclone Update</strong></h4>
				</div>
				@if(!count($data['latest_tc']))
				<div class="panel-body side-panel">
					<i class="fa fa-exclamation-circle text-danger"></i> No updates found.
				</div>
				@else
				<div class="side-panel">
					<table width="100%" class="side-panel-table">
						<tbody>
						@foreach($data['latest_tc'] as $tc)
							<tr>
								<td><small><p>{!! nl2br($tc->bl_message) !!}</p></small></td>
							</tr>
						@endforeach
						</tbody>
					</table>
				</div>
				@endif
			</div>
		</div>
	</div>
</div>