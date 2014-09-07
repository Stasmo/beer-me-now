(function(undefined){
  function initialize() {

  	//Default center is downtown Vancouver
    var mapOptions = {
      center: new google.maps.LatLng(49.2760937, -123.1322881),
      zoom: 16
    };

    var map = new google.maps.Map(document.getElementById("map"),
        mapOptions);

	// Try W3C Geolocation (Preferred)
	if(navigator.geolocation) {
	    browserSupportFlag = true;
	    navigator.geolocation.getCurrentPosition(function(position) {
	      initialLocation = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);
	      map.setCenter(initialLocation);
	    });
	}

	//Biases the search to the Vancouver area, but does not restrict it
	//sw, ne
	var bounds = new google.maps.LatLngBounds(
		new google.maps.LatLng(49, -124),
		new google.maps.LatLng(50, -123)
	);

	//Create the autocomplete object
	var input = document.getElementById('searchField');
	var options = {
		bounds: bounds
	};
	autocomplete = new google.maps.places.Autocomplete(input, options);

	//Center on selected autocomplete location
    google.maps.event.addListener(autocomplete, 'place_changed', function() {
    	var position = autocomplete.getPlace().geometry.location;
	    map.setCenter(newCenter);
    });
  }
    google.maps.event.addDomListener(window, 'load', initialize);

})();