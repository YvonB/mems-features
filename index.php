<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>SDP - IoT Choix de zones</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="/css/demo.css">
	<link rel="icon" type="image/png" href="/img/datastore-logo.png" />
	<style type="text/css">
		
		body
		{
			padding-top: 100px;
		}

		.global .zone_1 
			{
	    		float:left;
	    		width:45%;

	    		box-shadow: 0 0 10px;
			}
		.global .zone_2 
			{
    			float:right; 
    			width:45%;

    			box-shadow: 0 0 10px;
			}

		#map 
			{
		        width: 100%;
		        height: 400px;
		        background-color: grey;
     	 	}

     	.titre_zones
     	{
     		text-align: center;
     	}

		a
		{
			color: #039be5 !important;
		}

        a:hover
     	{
     		color: #337ab7 !important;
     		text-decoration: none !important;
     	}

	</style>
</head>
<body>
<div class="container"> <!-- contenu de la page -->
	<div class="global">
		<div class="zone_1"> <!-- div de gauche -->
	        
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
		    <h3 class="titre_zones"><a href="/zone_1">Zone 1</a></h3>
	    </div> <!-- fin div de gauche -->

	    <div class="zone_2"> <!-- div de droite -->
	       
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
		     <h3 class="titre_zones"><a href="">Zone 2</a></h3>         
	    </div> <!-- fin div de droite -->
	</div> <!-- fin div global -->

</div> <!-- end contenu -->
</body>
</html>