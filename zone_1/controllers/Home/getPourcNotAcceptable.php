<?php 

    require '../../vendor/autoload.php';  // chargement de classe
    use GDS\Perce\Percentage;
                        
    $obj_perc = new Percentage(); // On crée un objet de type Percentage.
    
    $arr_posts = $obj_perc->getAllRecentPost(); // Chercher TOUS les polluants insérées récemment.

    // au début 
    $nbr_co2_na = 0;
    $n_co2 = 0;
    $nbr_co_na = 0;
    $n_co = 0;
    $nbr_nh3_na = 0;
    $n_nh3 = 0;

    $nbr = count($arr_posts); // C'est le N dans le livre
                        
    foreach ($arr_posts as $obj_post) 
        {
            if($obj_post->co2 >= 396)
                {   
                    $nbr_co2_na += 1; // si on est ici c'est qu'il y a des co2 non acceptables, on icremente le nombre $nbr_co2_na alors !
                    $n_co2 = $nbr_co2_na;
                    // $co2_na = $obj_post->co2;
                }
            if($obj_post->co >= 3) 
                {
                    // si on est ici c'est qu'il y a des co non acceptables, on icremente le nombre $nbr_co_na alors !
                    $nbr_co_na += 1;
                    $n_co = $nbr_co_na;
                    // $co_na = $obj_post->co;
                }
            if($obj_post->nh3 >= 5) 
                {   
                    // si on est ici c'est qu'il y a des nh3 non acceptables, on icremente le nombre $nbr_nh3_na alors !
                    $nbr_nh3_na += 1;
                    $n_nh3 = $nbr_nh3_na;
                }  
                            
        } 
        // end foreach

    //calculs les %
    if($nbr != 0) // on évite la division par zéro
        {   
            $pource_co2 = ($n_co2*100)/$nbr;
            $pource_co = ($n_co*100)/$nbr;
            $pource_nh3 = ($n_nh3*100)/$nbr;
        }

    $res = array($pource_co2,$pource_co,$pource_co);

 ?>             


                 