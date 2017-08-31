<!DOCTYPE html>
							<html lang="en">
							<head>
								<meta charset="UTF-8">
								<title>Document</title>
								
								<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
							    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
								<!-- font awesome -->
							    <link rel="stylesheet" href="css/font-awesome/font-awesome.css">

							     <link rel="stylesheet" href="/css/demo.css">

							    <style>
							    	body
									{
										padding-top: 100px;
									}

									#results
									{
										margin:auto !important;
										width: 70% !important;
										float: none !important;

										box-shadow: 0 0 10px;
										height: 310px;
									}

									.retourBtn
									{
										float: right;
										margin-right: 15px;
									}

									@-webkit-keyframes spin {
									  0% { -webkit-transform: rotate(0deg); }
									  100% { -webkit-transform: rotate(360deg); }
									}

									@keyframes spin {
									  0% { transform: rotate(0deg); }
									  100% { transform: rotate(360deg); }
									}
								</style>
							</head>

		<body>

							<div class="container"> <!-- contenu de la page -->

							            <div class="row">
							                <div class="col-md-8" id="results">
							                    <h2>Tous les CO2 émis </h2>
							                    <div class="panel panel-default" style="background-color: #cdf;">
							                        <div class="panel-body">


<?php
// Inclusion pour notre lib
require_once('../vendor/autoload.php');

// On crée un objet de type Repository.
$obj_repo = new \GDS\Demo\Repository();
// Chercher les 10 dernières valeurs insérées
$arr_posts = $obj_repo->getAllRecentPost();

if(empty($arr_posts))
{
	// loaders
	?>
	<!-- html -->
	<!DOCTYPE html>
				<html lang="en">
				<head>
					<meta charset="UTF-8">
					<title>Document</title>
					
					<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
				    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
					<!-- font awesome -->
				    <link rel="stylesheet" href="css/font-awesome/font-awesome.css">

				     <link rel="stylesheet" href="/css/demo.css">

				    <style>
				    	body
						{
							padding-top: 100px;
						}

						.loader 
						{
						  border: 16px solid #f3f3f3;
						  border-radius: 50%;
						  border-top: 16px solid blue;
						  border-right: 16px solid green;
						  border-bottom: 16px solid red;
						  border-left: 16px solid pink;
						  width: 120px;
						  height: 120px;
						  -webkit-animation: spin 2s linear infinite;
						  animation: spin 2s linear infinite;
						}

						#results
						{
							margin:auto !important;
							width: 70% !important;
							float: none !important;

							box-shadow: 0 0 10px;
							height: 310px;
						}

						.retourBtn
						{
							float: right;
							margin-right: 15px;
						}

						@-webkit-keyframes spin {
						  0% { -webkit-transform: rotate(0deg); }
						  100% { -webkit-transform: rotate(360deg); }
						}

						@keyframes spin {
						  0% { transform: rotate(0deg); }
						  100% { transform: rotate(360deg); }
						}
					</style>
				</head>
				<body>

				<div class="container"> <!-- contenu de la page -->

				            <div class="row">
				                <div class="col-md-8" id="results">
				                    <h2>Quantité de CO2 émis il y a 2 jours</h2>
				                    <div class="panel panel-default" style="background-color: #cdf;">
				                        <div class="panel-body">
											<div class="loader" style="margin:auto;"></div> 
											<br>
											<p align="center">Pour l'instant, <strong>aucune donnée </strong> n'est disponnible dans la Base De Données <em>Datastore </em>! </p>
										</div> <!-- end panel body -->
									</div> <!-- end panel default -->
									<a href="/zone_1/home/co2"><button class="btn btn-default retourBtn"><i class="fa fa-arrow-left" aria-hidden="true" style="margin-right: 4px"></i>
									Retour</button></a>	
								</div> <!-- end col md 8  -->
							</div> <!-- end row -->

				</div> <!-- end container -->

				<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
				<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>

				</body>
				</html>
	<?php
}
else
{
	foreach ($arr_posts as $obj_post) 
			{			


						// On crée un objet de type Repository.
                        $obj_repo = new \GDS\Demo\Repository();
                                        // Chercher les 10 dernières valeurs insérées
                        $arr_posts = $obj_repo->getAllRecentPost();

                                       
                            // Effectuez une belle chaîne d'affichage de date et heure
                            $int_posted_date = strtotime($obj_post->posted);
                            $int_date_diff = time() - $int_posted_date;

                            if ($int_date_diff < 3600) 
                            {
                                                $str_date_display = round($int_date_diff / 60) . ' minute(s)';
                            } 
                            else if ($int_date_diff < (3600 * 24)) 
                            {
                                                $str_date_display = round($int_date_diff / 3600) . ' heure(s)';
                            } 
                            else 
                            {
                                $str_date_display = date('\a\t jS M Y, H:i', $int_posted_date);
                            }
			   
					
						//on affiche tous les valeurs de co2
						?>
							
					
										<?php
							
										                // On affiche les résultats pour le CO2
										                echo '<div class="post">';
										                    if(isset($obj_post->co2) AND !empty($obj_post->co2))
										                        {
										                            echo '<div class="gas">CO2 = <strong>', htmlspecialchars($obj_post->co2),'</strong><em>ppm</em>    ', '<br><span class="time">', $str_date_display, '</span></div>';
										                        }
										                echo '</div>';
					
					
					
			 }
			   // end foreach
?>
			 </div> <!-- end panel body -->
												</div> <!-- end panel default -->
									<a href="/zone_1/home/co2"><button class="btn btn-default retourBtn"><i class="fa fa-arrow-left" aria-hidden="true" style="margin-right: 4px"></i>
									Retour</button></a>	
											</div> <!-- col md 8 et results -->
										</div> <!-- end row -->

							</div> <!-- end container -->

							<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
							<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
							</body>
							</html>
			   
<?php			
} // fin else vide arr_posts
?>
			


