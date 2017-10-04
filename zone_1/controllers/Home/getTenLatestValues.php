<?php 

require '../../vendor/autoload.php'; // chargement de la classe
use GDS\TenLatest\TenLatest;
    
try 
    {   
                                        
        $obj_ten = new TenLatest(); // On crée un objet de type TenLatest.
                                        
        $arr_posts = $obj_ten->getRecentPosts(); // Chercher les 10 dernières valeurs insérées

                                        
        foreach ($arr_posts as $obj_post) 
            {

                // Effectuez une belle chaîne d'affichage de date et heure
                $int_posted_date = strtotime($obj_post->posted);
                $int_date_diff = time() - $int_posted_date;

                if ($int_date_diff < 3600) 
                    {
                        $str_date_display = round($int_date_diff / 60) . ' minute(s)';
                    } 
                else if ($int_date_diff < (3600 * 24)) 
                    {
                        $str_date_display = round($int_date_diff / 3600) . ' heure(s)';
                    } 
                else 
                    {
                        $str_date_display = date('\a\t jS M Y, H:i', $int_posted_date);
                    }

                echo "<pre>";
                echo '<div class="post">';
                if(isset($obj_post->co2) AND !empty($obj_post->co2))
                    {
                        echo '<div class="gas">Taux de CO2: <strong>', htmlspecialchars($obj_post->co2),'</strong><em> ppm</em>    ', '</div>';
                    }
                if(isset($obj_post->co) AND !empty($obj_post->co))
                    {
                        echo '<div class="gas"> Taux de CO: <strong>', htmlspecialchars($obj_post->co),'</strong><em> ppm</em>    ', '</div>';
                    }
                if(isset($obj_post->nh3) AND !empty($obj_post->nh3))
                    {
                         echo '<div class="gas"> Taux de NH3: <strong>', htmlspecialchars($obj_post->nh3), '</strong><em> ppm</em>    ', '<br><span class="time">', $str_date_display, '</span></div>';
                    }
                echo '</div>';
                echo "</pre>";
            }
            // end foreach

    $int_posts = count($arr_posts);

    echo '<div class="post"><em>Showing last ', $int_posts, '</em></div>';

    } 
    catch (\Exception $obj_ex)
        {
            syslog(LOG_ERR, $obj_ex->getMessage());
            echo '<em>Whoops, something went wrong!</em>';
        }

 ?>