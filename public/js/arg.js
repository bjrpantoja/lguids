$(document).ready(function() {
	var info = new google.maps.InfoWindow();
	
	map = new google.maps.Map(document.getElementById('sensor-map'), {
		zoom: 12,
		center: new google.maps.LatLng($('#latitude').text(), $('#longitude').text()),
		mapTypeId: google.maps.MapTypeId.ROADMAP
	});

	marker = new google.maps.Marker({
		position: new google.maps.LatLng($('#latitude').text(), $('#longitude').text()),
		map: map
	});

	info.setContent(
		'<div><strong>Automated Rain Gauge</strong></div>'+
		'<div><small>'+$('#address').text()+'</small>'
		);
	info.open(map, marker);
});