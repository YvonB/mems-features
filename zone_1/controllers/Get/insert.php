<?php
/**
 * Enregistrer une entrée dans la BDD
 *
 * @author Yvon Benahita
 */

require_once '../../vendor/autoload.php';

$str_co2 = $_GET['ValeurCO2'];
$str_co = $_GET['ValeurCO'];
$str_nh3 = $_GET['ValeurNH3'];

use \GDS\Demo\Repository; // On importe la classe Repository.

$obj_repo = new Repository();
$obj_repo->createPost($str_co2, $str_co, $str_nh3); 

header("Location: /home");

