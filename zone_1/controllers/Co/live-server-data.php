<?php
	// Pour notre lib
    require_once '../../vendor/autoload.php';
	use GDS\OneLatest\OneLatest;
	
    // Définir l'en-tête JSON
	header("Content-type: text/json");

	date_default_timezone_set('Asia/Tehran');

	// La valeur x est le temps de JavaScript actuel, qui est le temps de Unix multiplié 
	// par 1000.
	$x = (time()+10800)*1000;

	function getDataCo()
				{
					// On crée un objet de type oneLatest.
				    $obj_last = new OneLatest();
				    // Chercher juste la dernière valeur insérée.
				    $arr_posts = $obj_last->getLatestRecentPost();


				    // val ppm  
				    if(isset($arr_posts))
				    {
				        $ppm_co = (float)$arr_posts->co; 
				        return $ppm_co;
				    } 

				};

    //La valeur y 
	$y= getDataCo();
		
	// Créer un tableau PHP et l'écho comme JSON
	$ret = array($x, $y);
	echo json_encode($ret);
?>