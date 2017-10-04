<?php
    require '../../vendor/autoload.php';
    use GDS\Mgm3\Mgm3;

    $obj_mgm3 = new Mgm3(); // On crée un objet de type Mgm3.
    
    $arr_posts = $obj_mgm3->getLatestRecentPost();

    if(isset($arr_posts->co2) AND isset($arr_posts->co) AND isset($arr_posts->nh3))
       {
        $ppm_co2 = $arr_posts->co2;
        $ppm_co = $arr_posts->co;
        $ppm_nh3 = $arr_posts->nh3;

        // masse masseVolumique_co2 avec 3 chiffres après la virgule comme précision
        $masseVolumique_co2 = round(($ppm_co2 * (MASSE_MOLAIRE_CO2/VOLUME_MOLAIRE)), 3, PHP_ROUND_HALF_UP);
        $masseVolumique_co = round(($ppm_co * (MASSE_MOLAIRE_CO/VOLUME_MOLAIRE)), 3, PHP_ROUND_HALF_UP);
        $masseVolumique_nh3 = round(($ppm_nh3 * (MASSE_MOLAIRE_NH3/VOLUME_MOLAIRE)), 3, PHP_ROUND_HALF_UP);
       }   