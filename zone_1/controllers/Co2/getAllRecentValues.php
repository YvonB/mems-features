<?php

require_once '../../vendor/autoload.php';
use GDS\AllRecent\AllRecent;


$obj_recent = new AllRecent(); // On crée un objet de type AllRecent.
$arr_posts = $obj_recent->getAllRecentPost(); // Chercher les x dernières valeurs insérées