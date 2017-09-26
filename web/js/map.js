
(function(){

	// Un Map avec comme centre 'Ambodiafontsy'
	var map = new google.maps.Map(document.getElementById('map'), {
	    zoom: 13,
	    center: {lat: -18.9413966, lng: 47.46252389999995}, 
	    mapTypeId: google.maps.MapTypeId.TERRAIN
	});

	// Icon de mes futures marqueurs
	var image = {
			url: '/img/marker.png'
	}

	// Création des marqueurs
	function createMarker(pos, info_bulle, lien, titre)
	  	{
			var theMarker = new google.maps.Marker({
			position: pos,
			map: map,
			icon: image,
			url: lien,
			title: info_bulle,
			draggable: true,
			animation: google.maps.Animation.DROP
			});

			var content_marker = titre;
			var info = new google.maps.InfoWindow({
				content: content_marker
			});

			function afficheTitre(){
				info.open(map, theMarker);
			}

			afficheTitre();

			// lors d'un clique
	  		google.maps.event.addListener(theMarker, 'click', function() {
				window.location.href = theMarker.url;
			});
			
		}

	// premier marqueur == première zone
	  createMarker({lat: -18.9703576 , lng: 47.42391939999993}, "Aller vers la page SDPE Vontovorona", 'http://premiere-zone.appspot.com', '<h2 class="sous_titre">Cur Vontovorona</h2>');
	//seconde zone == second marqueur
	  createMarker({lat: -18.9074364 , lng: 47.52175009999996}, "Aller vers la page SDPE Antsahavola", 'http://seconde-zone.appspot.com', '<h2 class="sous_titre">Antsahavola</h2>');
	//3eme zone == 3eme marqueur
	   createMarker({lat: -18.93 , lng: 47.52611109999998}, "Aller vers la page SDPE Tsimbazaza Parc", 'http://zone-3.appspot.com', '<h2 class="sous_titre">Tsimbazaza Parc</h2>');
	//4eme zone == 4eme marqueur
	  createMarker({lat: -18.9375253 , lng: 47.55352289999996}, "Aller vers la page SDPE au Gare de Mandroseza", 'http://zone-4.appspot.com', '<h2 class="sous_titre">Gare Mandroseza</h2>');
	//seconde zone == second marqueur
	   createMarker({lat: -18.9368961 , lng: 47.47699590000002}, "Aller vers la page SDPE Ampitatafika", 'http://zone-5.appspot.com', '<h2 class="sous_titre">Ampitatafika</h2>');
	  
})();	