	<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>SDPE - IoT Yersterday Co Historics</title>
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
				    	<h2>Liste(s) Quantité de CO émis hier</h2>
				    	<div class="panel panel-default" style="background-color: #cdf;">
				        	<div class="panel-body" style="text-align: center;">

<?php
require_once '../../controllers/Co/getAllRecentValues.php';

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
<a href="/home/co"><button class="btn btn-primary retourBtn"><i class="fa fa-arrow-left" aria-hidden="true" style="margin-right: 4px"></i>Retour</button></a>	
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
	$exist = false;
	foreach ($arr_posts as $obj_post) 
			{
			    // Effectuez une belle chaîne d'affichage de date et heure
			    $int_posted_date = strtotime($obj_post->posted);
			    $int_date_diff = time() - $int_posted_date; // on obtien un integer qui représente le temps en SECONDE du poste.


			    // 1jours = 86400sec
				if($int_date_diff == 86400)
					{
						$exist = true;
						//on affiche tous les valeurs de co
						?>
							<?php
							
							// On affiche les résultats pour le CO
								echo "<pre>";
								echo '<div class="post">';
								if(isset($obj_post->co) AND !empty($obj_post->co))
									{
										echo '<div class="gas">CO = <strong>', htmlspecialchars($obj_post->co),'</strong><em>ppm</em>    ', '</div>';
										                        }
										echo '</div>';
										echo "</pre>";

					} 
					// fin if
			}
			 //end foreach
					
			// On n'a pas trouvé aucune correspondance
			if (!$exist) 
				{
				    echo '<div class="post">';
				        ?>
					<p style="text-align: center"><i class="fa fa-ban" style="font-size:48px;color:red"></i>
					<p style="text-align: center">Aucune correspondance n'a été trouvée ! Désolé.</p>
				</div> <!-- end panel body -->
			</div> <!-- end panel default -->
			<a href="/home/co"><button class="btn btn-primary retourBtn" style="margin-top: 15px"><i class="fa fa-arrow-left" aria-hidden="true" style="margin-right: 4px"></i>Retour</button></a>	
		</div> <!-- end col md 8 -->
	</div> <!-- end row -->
</div> <!-- end container -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
</body>
</html>

	<?php
				}
				// end if exist
}
// end else
			   

				