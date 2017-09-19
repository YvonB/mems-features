
(function(){

	
	  var map = new google.maps.Map(document.getElementById('map'), {
	    zoom: 13,
	    center: {lat: -18.9413966, lng: 47.46252389999995}, // Ambodiafontsy
	    mapTypeId: google.maps.MapTypeId.TERRAIN
	  });

	  // premier marqueur == première zone
	  var cur = new google.maps.Marker({
	    position: {lat: -18.9703576 , lng: 47.42391939999993},
	 
	 	map: map,
	 	url: 'https://vontovorna.appspot.com',
	 	draggable: true,
	 	animation: google.maps.Animation.DROP
	 
	 });
	  // fonction pour animer le marker
	  function toggleBounceCur()
	   {
  			if (cur.getAnimation() !== null) 
	  			{
	    			cur.setAnimation(null);
	  			} 
  			else 
	  			{
	    			cur.setAnimation(google.maps.Animation.BOUNCE);
	  			}
		}
	cur.addListener('onload', toggleBounceCur);
	 //info sur lui
	var content_cur = '<h1 class="titre">Cur Vontovorona</h1><h2 class="sous_titre">Première zone</h2>';
	var info_cur = new google.maps.InfoWindow({
		content:content_cur
	});
	// on affiche cette info lorsque la page est chargée
	function popUpCur(){
		info_cur.open(map, cur);
	}
	 // lorsqu'on clique dessus
	 google.maps.event.addListener(cur, 'click', function() {
	  window.location.href = cur.url;
	  });
	 
	 // 2eme marqueuer == 2nd zone
	 var tunnel = new google.maps.Marker({
	    position: {lat: -18.914834, lng: 47.531656699999985},
	 
	    map: map,
	  	url: 'https://zone-two.appspot.com',
	  	draggable: true,
	 	animation: google.maps.Animation.DROP
	  });
	 // fonction pour animer le marker
	  function toggleBounceTunnel()
	   {
  			if (tunnel.getAnimation() !== null) 
	  			{
	    			tunnel.setAnimation(null);
	  			} 
  			else 
	  			{
	    			tunnel.setAnimation(google.maps.Animation.BOUNCE);
	  			}
		}
	tunnel.addListener('onload', toggleBounceTunnel);
	 //info sur lui
	var content_tunnel = '<h1 class="titre">Tunnel Ambanidia</h1><h2 class="sous_titre">Seconde zone</h2>';
	var info_tunnel = new google.maps.InfoWindow({
		content:content_tunnel
	});
		// on affiche cette info lorsque la page est chargée
	 function popUpTunnel(){
		info_tunnel.open(map, tunnel);
	}
	 // lorsqu'on clique dessus
	  google.maps.event.addListener(tunnel, 'click', function() {
	  window.location.href = tunnel.url;
	  });

	popUpCur();
	popUpTunnel();

	
	// ============= modal
	// Get the modal
	var modal = document.getElementById('myModal');

	// Get the <span> element that closes the modal
	var span = document.getElementsByClassName("close")[0];

	//  open the modal 
	function afficheModal() {
	    modal.style.display = "block";
	}
	// close the modal
	function cacheModal() {
	    modal.style.display = "none";
	}
	// When the user clicks on <span> (x), close the modal
	span.onclick = function() {
	    modal.style.display = "none";
	}

	// When the user clicks anywhere outside of the modal, close it
	window.onclick = function(event) {
	    if (event.target == modal) {
	        modal.style.display = "none";
	    }
	}
	// ============= end modal

	setTimeout(afficheModal, 5000);
	setTimeout(cacheModal, 12000);
})();	