    <?php

    require_once '../../vendor/autoload.php';
    use GDS\OneLatest\OneLatest;
    
    $obj_one = new OneLatest(); // On crée un objet de type OneLatest.
    $arr_posts = $obj_one->getLatestRecentPost(); // Chercher juste la dernière valeur insérée.