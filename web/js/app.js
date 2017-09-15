
(function(){

	
	  var map = new google.maps.Map(document.getElementById('map'), {
	    zoom: 13,
	    center: {lat: -18.9413966, lng: 47.46252389999995} // Ambodiafontsy
	  });

	  // premier marqueur == première zone
	  var cur = new google.maps.Marker({
	    position: {lat: -18.9703576 , lng: 47.42391939999993},
	 
	 	map: map,
	 	url: 'https://zone-1-179812.appspot.com'
	 
	 });
	 
	 // lorsqu'on clique dessus
	 google.maps.event.addListener(cur, 'click', function() {
	  window.location.href = cur.url;
	  });
	 
	 // 2eme marqueuer == 2nd zone
	 var tunnel = new google.maps.Marker({
	    position: {lat: -18.914834, lng: 47.531656699999985},
	 
	    map: map,
	  	url: 'https://zone-2-179812.appspot.com'
	  });

	 // lorsqu'on clique dessus
	  google.maps.event.addListener(tunnel, 'click', function() {
	  window.location.href = tunnel.url;
	  });
	
})();	