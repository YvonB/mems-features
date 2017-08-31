<?php
// Inclusion pour notre lib
require_once('../vendor/autoload.php');

// On crée un objet de type Repository.
                                        $obj_repo = new \GDS\Demo\Repository();
                                        // Chercher les 10 dernières valeurs insérées
                                        $arr_posts = $obj_repo->getRecentPosts();

                                        foreach ($arr_posts as $obj_post) 
                                        {

                                            // Effectuez une belle chaîne d'affichage de date et heure
                                            $int_posted_date = strtotime($obj_post->posted);

                                            echo "<pre>";
                                            var_dump($int_posted_date);
                                            echo "</pre>";
                                        }
?>