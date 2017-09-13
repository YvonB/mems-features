<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>SDPE - IoT Choix de zones</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="/css/demo.css">
	<link rel="stylesheet" href="/css/index.css">
	<link rel="icon" type="image/png" href="/img/datastore-logo.png" />
</head>

<body>
<div class="container"> <!-- contenu de la page -->
	<div class="global">
		<div class="zone_1 histoco2"> <!-- div de gauche -->
	        
	        <div id="map"></div>

	        <script>
		      function initMap() {
		        var uluru = {lat: -25.363, lng: 131.044};
		        var map = new google.maps.Map(document.getElementById('map'), {
		          zoom: 4,
		          center: uluru
		        });
		        var marker = new google.maps.Marker({
		          position: uluru,
		          map: map
		        });
		      }
    		</script>
		    <script async defer
		    src="https://maps.googleapis.com/maps/api/js?key= AIzaSyDYv6GZEKyU1Kj9Sp0hP7RYfChScPuciM8&callback=initMap">
		    </script>
		    <h3 class="titre_zones"><a href="https://zone-1-179812.appspot.com">Zone 1</a></h3>
	    </div> <!-- fin div de gauche -->

	    <div class="zone_2 histoco2"> <!-- div de droite -->
	       
	         <div id="map"></div>

	        <script>
		      function initMap() {
		        var uluru = {lat: -18.9703576, lng: 47.42391939999993};
		        var map = new google.maps.Map(document.getElementById('map'), {
		          zoom: 4,
		          center: uluru
		        });
		        var marker = new google.maps.Marker({
		          position: uluru,
		          map: map
		        });
		      }
    		</script>
		    <script async defer
		    src="https://maps.googleapis.com/maps/api/js?key= AIzaSyDYv6GZEKyU1Kj9Sp0hP7RYfChScPuciM8&callback=initMap">
		    </script> 
		     <h3 class="titre_zones"><a href="https://zone-2-179812.appspot.com">Zone 2</a></h3>         
	    </div> <!-- fin div de droite -->
	</div> <!-- fin div global -->

</div> <!-- end contenu -->
</body>
</html>