google.maps.event.addDomListener(window, 'load', init);

function init() {

    "use strict";

	var mapOptions = {
        zoom: 8,
        scrollwheel: true,
        center: new google.maps.LatLng(lat, long, 20.75)

    };

    var mapElement = document.getElementById('map'),
		map = new google.maps.Map(mapElement, mapOptions),
		marker = new google.maps.Marker({
			position: new google.maps.LatLng(lat, long, 20.75),
			map: map,
			title: address,
			icon: mapicon
		});
}
