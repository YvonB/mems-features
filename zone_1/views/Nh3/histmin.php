<!DOCTYPE html>
	<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<title>SDPE - IoT nh3 Historics some minute ago</title>
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
					padding-bottom: 100px
				}

				#results
				{
					margin:auto !important;
					width: 70% !important;
					float: none !important;
					box-shadow: 0 0 10px;
					padding: 1px 25px 45px 25px;
					border-radius: 10px;
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
				                 <h2>Liste(s)Quantité de NH3 émis il y a <em><?php echo $_POST['aujourduiMinNh3'].' min';?></em></h2>
				                 <div class="panel panel-default" style="background-color: #cdf;">
				                     <div class="panel-body" style="text-align: center;">
<?php

//on verifie que l'utilisateur entre un ENTIER dans le champ minute 
if(is_numeric($_POST['aujourduiMinNh3']))
    {
    	// on verifie que c'est bien entre 0 et 59
    	if($_POST['aujourduiMinNh3']>=0 AND $_POST['aujourduiMinNh3']<60)
    	{
    		?>	
				
					<?php
				try
				{
					require_once '../../controllers/Nh3/getAllRecentValues.php';

				    if(empty($arr_posts))
				    	{	
				    		?>
				    		<p align="center"><i class="fa fa-database" aria-hidden="true" style="font-size: 100px"></i></p> 
				    		<br>
				    		<p align="center">Pour l'instant, <strong>aucune donnée </strong> n'est disponnible dans la Base De Données <em>Datastore </em>! </p> 
				    		<?php
				    	}
				    	else
				    		{
				    			//Apres on selection les valeures de nh3 qui correspondent à la minute saisie
				    			$exist = false;
				    			foreach ($arr_posts as $obj_post) 
					    			{
								    	// Effectuez une belle chaîne d'affichage de date et heure
							            $int_posted_date = strtotime($obj_post->posted);
							            $int_date_diff = time() - $int_posted_date;

							            if ($int_date_diff < 3600) 
							                {
							                    $str_date_display = round($int_date_diff / 60); // Tous les minutes du post

							                    //on compare avec ce que l'utilisateur a rentrée
							                    if($_POST['aujourduiMinNh3'] == $str_date_display)
							                    {
							                    	$exist = true;
							                    	// On affiche les résultats pour le NH3
							                    	echo "<pre>";
							                    	echo '<div class="post">';
							                    		if(isset($obj_post->nh3) AND !empty($obj_post->nh3))
							                                {
							                                    echo '<div class="gas">Taux de NH3: <strong>', htmlspecialchars($obj_post->nh3),'</strong><em> ppm</em>    ', '</div>';
							                                }

							                    	echo '</div>';
							              			echo "</pre>";
							                    }
							                    
							                }
							          } // end foreach  
							          // On n'a pas trouvé aucune correspondance
							          if (!$exist) {
				      	              	echo '<div class="post">';
				                    	?>
										<p style="text-align: center"><i class="fa fa-ban" style="font-size:48px;color:red"></i>
										<p style="text-align: center">Aucune correspondance n'a été trouvée ! Désolé.</p>
										</div> <!-- end panel body -->
										</div> <!-- end panel default -->
										<a href="/zone_1/home/nh3"><button class="btn btn-primary retourBtn" style="margin-top: 15px"><i class="fa fa-arrow-left" aria-hidden="true" style="margin-right: 4px"></i>
										Retour</button></a>	
									</div> <!-- end col md 8 -->
								</div> <!-- end row -->
								</div> <!-- end container -->
								<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
								<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
								</body>
								</html>
				                    	<?php
				                    exit; // on arrête tout	
							          }
							} 
							// fin else empty array_posts

				}
				catch(\Exception $obj_ex)
				{
					syslog(LOG_ERR, $obj_ex->getMessage());
				    echo '<em>Whoops, something went wrong!</em>';
				}
				?>
							</div> <!-- end panel body -->
						</div> <!-- end panel default -->
						<a href="/zone_1/home/nh3"><button class="btn btn-primary retourBtn"><i class="fa fa-arrow-left" aria-hidden="true" style="margin-right: 4px"></i>
						Retour</button></a>	
					</div> <!-- end col md 8 -->
				</div> <!-- end row -->
				</div> <!-- end container -->
				<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
				<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
				</body>
				</html>
    		<?php
    	}	
    	// pas compris entre 0 et 59
    	else
    		{
    			?>

		
				<div>
					<h1 style="color:red">An Error Has Occurred</h1>
				    <h2>Veuillez entrez une minute valide svp.</h2>
				    <h2 style="color:green">Un nombre entier entre 0 et 59</h2>

				   </div> <!-- end panel body -->
				</div> <!-- end panel default -->
				    <a href="/zone_1/home/nh3"><button class="btn btn-primary retourBtn" style="margin-top: 15px;"><i class="fa fa-arrow-left" aria-hidden="true" style="margin-right: 4px"></i>
					Retour</button></a>	
			    </div> <!-- end col md 8 -->
				</div> <!-- end row -->
				</div> <!-- end container -->
				<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
				<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
				</body>
				</html>
				<?php  
    		}
    	?>

<?php

    }
    //c'est pas un nombre
    else
    {
    	?>
    	    	
			<div>
				<h1 style="color:red">What is this charabian ?</h1>
			    <h2>Veuillez entrez une minute valide svp.</h2>
			    <h2 style="color:green">Un nombre entier entre 0 et 59</h2>
			    </div> <!-- end panel body -->
			</div> <!-- end panel default -->
			    <a href="/zone_1/home/nh3"><button class="btn btn-primary retourBtn" style="margin-top: 15px;"><i class="fa fa-arrow-left" aria-hidden="true" style="margin-right: 4px"></i>
				Retour</button></a>	
		    </div> <!-- end col md 8 -->
				</div> <!-- end row -->
				</div> <!-- end container -->
				<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
				<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
				</body>
				</html>
<?php    
    
	}

?>
