
(function(){

	
	  var map = new google.maps.Map(document.getElementById('map'), {
	    zoom: 12,
	    center: {lat: -18.9413966, lng: 47.46252389999995}, // Ambodiafontsy
	    styles: [
            {elementType: 'geometry', stylers: [{color: '#242f3e'}]},
            {elementType: 'labels.text.stroke', stylers: [{color: '#242f3e'}]},
            {elementType: 'labels.text.fill', stylers: [{color: '#746855'}]},
            {
              featureType: 'administrative.locality',
              elementType: 'labels.text.fill',
              stylers: [{color: '#d59563'}]
            },
            {
              featureType: 'poi',
              elementType: 'labels.text.fill',
              stylers: [{color: '#d59563'}]
            },
            {
              featureType: 'poi.park',
              elementType: 'geometry',
              stylers: [{color: '#263c3f'}]
            },
            {
              featureType: 'poi.park',
              elementType: 'labels.text.fill',
              stylers: [{color: '#6b9a76'}]
            },
            {
              featureType: 'road',
              elementType: 'geometry',
              stylers: [{color: '#38414e'}]
            },
            {
              featureType: 'road',
              elementType: 'geometry.stroke',
              stylers: [{color: '#212a37'}]
            },
            {
              featureType: 'road',
              elementType: 'labels.text.fill',
              stylers: [{color: '#9ca5b3'}]
            },
            {
              featureType: 'road.highway',
              elementType: 'geometry',
              stylers: [{color: '#746855'}]
            },
            {
              featureType: 'road.highway',
              elementType: 'geometry.stroke',
              stylers: [{color: '#1f2835'}]
            },
            {
              featureType: 'road.highway',
              elementType: 'labels.text.fill',
              stylers: [{color: '#f3d19c'}]
            },
            {
              featureType: 'transit',
              elementType: 'geometry',
              stylers: [{color: '#2f3948'}]
            },
            {
              featureType: 'transit.station',
              elementType: 'labels.text.fill',
              stylers: [{color: '#d59563'}]
            },
            {
              featureType: 'water',
              elementType: 'geometry',
              stylers: [{color: '#17263c'}]
            },
            {
              featureType: 'water',
              elementType: 'labels.text.fill',
              stylers: [{color: '#515c6d'}]
            },
            {
              featureType: 'water',
              elementType: 'labels.text.stroke',
              stylers: [{color: '#17263c'}]
            }
          ]
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