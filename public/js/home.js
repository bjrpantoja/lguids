$(document).ready(function() {
	var map;
	var icons 	= [];
	var popups 	= [];
	var marker 	= [];
	var markers = [];
	var info 	= new google.maps.InfoWindow();
	var shape 	= {
		coord: 	[1, 1, 1, 32, 37, 37, 18, 1],
		type: 	'poly'
	};

	map = new google.maps.Map(document.getElementById('map'), {
		zoom: 9,
		center: {lat: 14.1250273, lng: 121.5933434},
		mapTypeId: google.maps.MapTypeId.ROADMAP
	});

	$.ajax({
		url: "map",
		type: "get",
		success: function(data) {
			$.each($.parseJSON(data), function(i, e) {
					if(e.ss_type == '3' || e.ss_type == '4') {
						icons.push($('#waterlevel').attr('src'));
					}
					else if(e.ss_data['ss_data'] >= 31) {
						icons.push($('#torrential').attr('src'));
					}
					else if((e.ss_data['ss_data'] >= 16) && (e.ss_data['ss_data'] <= 30)) {
						icons.push($('#intense').attr('src'))
					}
					else if((e.ss_data['ss_data'] >= 7.6) && (e.ss_data['ss_data'] <= 15)) {
						icons.push($('#heavy').attr('src'))
					}
					else if((e.ss_data['ss_data'] >= 2.5) && (e.ss_data['ss_data'] <= 7.5)) {
						icons.push($('#moderate').attr('src'))
					}
					else if((e.ss_data['ss_data'] >= 0.1) && (e.ss_data['ss_data'] <= 2.4)) {
						icons.push($('#light').attr('src'))
					}
					else {
						icons.push($('#none').attr('src'));
					}
				if(e.ss_type == '1') {
					popups.push(
						'<div><strong>Automated Rain Gauge</strong></div>'+
						'<div><a class="text-success" href=""><strong>'+e.ss_address+'</strong></a></div><br>'+
						'<div>as of '+e.ss_data['ss_date']+'</div>'+
						'<div><strong>'+e.ss_data['ss_data']+' mm/hr</strong></div>'+
						'</div>'
					);
				} else if(e.ss_type == '2') {
					popups.push(
						'<div><strong>Automated Weather Station</strong></div>'+
						'<div><a class="text-success" href=""><strong>'+e.ss_address+'</strong></a></div><br>'+
						'<div>as of '+e.ss_data['ss_date']+'</div>'+
						'<div><strong>'+e.ss_data['ss_data']+' mm/hr</strong></div>'+
						'</div>'
					);
				} else if(e.ss_type == '3') {
					popups.push(
						'<div><strong>Water Level Monitoring Station</strong></div>'+
						'<div><a class="text-success" href=""><strong>'+e.ss_address+'</strong></a></div><br>'+
						'<div>as of '+e.ss_data['ss_date']+'</div>'+
						'<div><strong>'+e.ss_data['ss_data']+' m</strong></div>'+
						'</div>'
					);
				} else if(e.ss_type == '4') {
					popups.push(
						'<div><strong>Water Level Monitoring Station with Automated Rain Gauge</strong></div>'+
						'<div><a class="text-success" href=""><strong>'+e.ss_address+'</strong></a></div><br>'+
						'<div>as of '+e.ss_data['ss_date']+'</div>'+
						'<div><strong>'+e.ss_data['ss_data']+' m</strong></div>'+
						'</div>'
					);
				}

				marker 	= new google.maps.Marker({
					position: new google.maps.LatLng(e.ss_latitude, e.ss_longitude),
					map: map,
					icon: new google.maps.MarkerImage(icons[i], new google.maps.Size(32, 37), new google.maps.Point(0,0), new google.maps.Point(0, 32)),
					shape: shape,
					category: e.ss_type
				});
				markers.push(marker);

				google.maps.event.addListener(marker, 'mouseover', (function(marker, i) {
					return function() {
						info.setContent(popups[i]);
						info.open(map, marker);
					}
				})(marker, i));
			});
		}
	});

	$.ajax({
		url: "sensor_feeds",
		type: "get",
		success: function(data) {
			$.each($.parseJSON(data), function(i, e) {
				if(e.ss_type == 1 || e.ss_type == 2) {
					$('#handa-feeds tbody').append(
						'<tr>'+
						'<td>'+e.ss_address+': <span class="argsparkline">'+e.d_rain_value+'</span></td>'+
						'</tr>'
					);
				} else {
					$('#handa-feeds tbody').append(
						'<tr>'+
						'<td>'+e.ss_address+': <span class="wlmsparkline">'+e.d_waterlevel+'</span></td>'+
						'</tr>'
					);
				}
			});
		}
	}).done(function() {
		$('.argsparkline').sparkline('html', {width: 75});
		$('.wlmsparkline').sparkline('html', {width: 75})
	});

	var legend = document.getElementById('legend');
	var filter = document.getElementById('filter');
	map.controls[google.maps.ControlPosition.TOP_RIGHT].push(legend);
	map.controls[google.maps.ControlPosition.RIGHT].push(filter);

	$('#sensor-filter').change(function() {
		var selected = $('#sensor-filter').find(":selected").val();
		for (var i = 0; i < markers.length; i++) {
			marker = markers[i];
			if(marker.category == selected || selected.length === 0) {
				marker.setVisible(true);
			}
			else {
				marker.setVisible(false);
			}
		}
	});
});