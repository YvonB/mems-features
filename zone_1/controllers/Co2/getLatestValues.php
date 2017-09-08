    <?php
    // Pour notre lib
    require_once('../../vendor/autoload.php');

    // On crée un objet de type Repository.
    $obj_repo = new \GDS\Demo\Repository();
    // Chercher juste les dernières valeurs insérées.
    $arr_posts = $obj_repo->getLatestRecentPost();