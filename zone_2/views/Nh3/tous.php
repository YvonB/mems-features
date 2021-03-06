<!DOCTYPE html>
							<html lang="fr">
							<head>
								<meta charset="UTF-8">
								<title>SDPE - IoT All Nh3 Historics</title>
								<meta http-equiv="X-UA-Compatible" content="IE=edge">
								<meta name="author" content="Yvon Benahita">
								<link rel="icon" type="image/png" href="/img/datastore-logo.png" />
								<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
							    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
								<!-- font awesome -->
							    <link rel="stylesheet" href="css/font-awesome/font-awesome.css">

							     <link rel="stylesheet" href="/css/demo.css">

							    <style>
							    	body
									{
										padding-top: 100px;
										padding-bottom: 100px;
									}

									#results
									{
										margin:auto !important;
										width: 70% !important;
										float: none !important;
										border-radius: 10px;
										box-shadow: 0 0 10px;
										padding: 1px 25px 45px 25px;
									}
									
									.retourBtn
									{
										float: right;
										/*margin-right: 15px;*/
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
							                    <h2>Tous les NH3 émis </h2>
							                    <div class="panel panel-default" style="background-color: #cdf;">
							                        <div class="panel-body">

<?php


require_once '../../controllers/Nh3/getAllRecentValues.php';

if(empty($arr_posts))
{
	// loaders
	?>
	<!-- html -->

											<p align="center"><i class="fa fa-database" aria-hidden="true" style="font-size: 100px"></i></p> 
											<br>
											<p align="center">Pour l'instant, <strong>aucune donnée </strong> n'est insérée dans la Base De Données <em>Datastore </em>! </p>
										</div> <!-- end panel body -->
									</div> <!-- end panel default -->
									<a href="/home/nh3"><button class="btn btn-primary retourBtn"><i class="fa fa-arrow-left" aria-hidden="true" style="margin-right: 4px"></i>
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
			   
					
						//on affiche tous les valeurs de nh3
						?>
							
					
										<?php
							
										                // On affiche les résultats pour le NH3
														echo "<pre>";
										                echo '<div class="post">';
										                    if(isset($obj_post->nh3) AND !empty($obj_post->nh3))
										                        {
										                            echo '<div class="gas">NH3 = <strong>', htmlspecialchars($obj_post->nh3),'</strong><em> ppm</em>    ', '<span class="time"> Il y a ', $str_date_display, '</span></div>';
										                        }
										                echo '</div>';
										                echo "</pre>";
					
					
					
			 }
			   // end foreach
?>
			 </div> <!-- end panel body -->
												</div> <!-- end panel default -->

									<a href="/home/nh3"><button class="btn btn-primary retourBtn"><i class="fa fa-arrow-left" aria-hidden="true" style="margin-right: 4px"></i>
									Retour</button></a>	
								</div> <!-- end col md 8 et results -->
							</div> <!-- end row -->

							</div> <!-- end container -->

							<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
							<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
							</body>
							</html>
			   
<?php			
} // fin else vide arr_posts
?>
			


