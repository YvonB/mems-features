
(function(){

	
	  var map = new google.maps.Map(document.getElementById('map'), {
	    zoom: 10,
	    center: {lat: -19.565559, lng: 47.35861999999997}
	  });

	  var cur = new google.maps.Marker({
	    position: {lat: -18.9703576 , lng: 47.42391939999993},
	 
	 	map: map,
	 	url: 'zone-1-179812.appspot.com'
	 
	 });
	 
	 google.maps.event.addListener(cur, 'click', function() {
	  window.location.href = cur.url;
	  });
	 
	 var tunnel = new google.maps.Marker({
	    position: {lat: -18.914834, lng: 47.531656699999985},
	 
	    map: map,
	  	url: 'zone-2-179812.appspot.com'
	  });
	  google.maps.event.addListener(tunnel, 'click', function() {
	  window.location.href = tunnel.url;
	  });
	
})();	