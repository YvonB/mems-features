<?php
// Inclusion pour notre lib
require_once('../../vendor/autoload.php');

// On crée un objet de type Repository.
$obj_repo = new \GDS\Demo\Repository();
// Chercher les 10 dernières valeurs insérées
$arr_posts = $obj_repo->getAllRecentPost();