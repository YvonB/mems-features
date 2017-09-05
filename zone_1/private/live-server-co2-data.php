<?php
// Pour notre lib
    require_once('../vendor/autoload.php');

    
    // Set the JSON header
	header("Content-type: text/json");

	// The x value is the current JavaScript time, which is the Unix time multiplied 
	// by 1000.
	$x = time() * 1000;
	// The y value is a random number
	function getDataCo2()
				{
					// On crée un objet de type Repository.
				    $obj_repo = new \GDS\Demo\Repository();
				    // Chercher juste les dernières valeurs insérées.
				    $arr_posts = $obj_repo->getLatestRecentPost();

				    // val ppm  
				    if(isset($arr_posts))
				    {
				        $ppm_co2 = (float)$arr_posts->co2;    
				    } 

				    return $ppm_co2;

				};

	$y = getDataCo2() ;

	// Create a PHP array and echo it as JSON
	$ret = array($x, $y);
	echo json_encode($ret);
?>