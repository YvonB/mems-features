<?php
// Définitions des constantes modèles pour l'accès au datatore
define('GDS_ACCOUNT', ' !! your service account name here !! ');
define('GDS_KEY_FILE', dirname(__FILE__) . '/key.p12');

define('MASSE_MOLAIRE_CO2', 44);
define('MASSE_MOLAIRE_CO', 28);
define('MASSE_MOLAIRE_NH3', 17);
define('VOLUME_MOLAIRE', 22.4); // une mole de gaz occupe toujours le même volume dans les CNTP

use google\appengine\api\users\User;
use google\appengine\api\users\UserService;

# Looks for current Google account session
$user = UserService::getCurrentUser();

// pour cacher les notices au niveau des compteurs lorsque les valeures ne sont pas encore dispo
ini_set("display_errors",0);error_reporting(0);

// Inclusion pour notre lib
require_once('../vendor/autoload.php');

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>SDPE - IoT Welcome</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/demo.css">
    <meta name="author" content="Yvon Benahita">
    <link rel="icon" type="image/png" href="/img/datastore-logo.png" />

    <!-- font awesome -->
    <link rel="stylesheet" href="css/font-awesome/font-awesome.css">
    
    <!-- Pour le Jauge  -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <!-- Fin -->

    <!-- jquery du rafraîchissement -->
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
</head>
<!-- end head -->

<body>
    <!-- ====================================== Benière ====================================== -->
    <div class="container-fluid banner">
        <div class="ban">
            <video id = "video" src="medias/la_pollution.mp4" type="video/mp4" autoplay="autoplay" loop="loop" muted="muted" >   
            </video>
        </div> 

        <div class="inner-banner">
            <h3 class="sub_title_ban"><img src="/img/datastore-logo.png"  class="logo_ban" />Detecteur - Analyseur Web des Gaz polluants SDP - IoT</h3>
            <h1>Know what really exists in the air you breathe</h1>
            <h3 class="sub_title_ban" style="padding-bottom: 20px;">Follow your health closely</h3>
             <a href="<?php 
                                    $home = "/zone_1/home";
                                    $login = "/zone_1/login";
                                    echo(isset($user) ? $home : $login);
                                ?>">
                                <button type="submit" class="btn btn-primary">
                                    <?php 
                                        if(isset($user)) 
                                            {echo "Go Home<i class='fa fa-arrow-right' style='margin-left: 15px;'></i>";}
                                        else 
                                            {echo "See More Content";}
                                    ?>
                                </button>
        </div>
    </div>

<div data-spy="affix" data-offset-top="763.8">
        <nav class="navbar-default colornav"> 

        <div class="container-fluid">

            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand colortextnav" href="/"><b>SDPE - IoT</b></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <!-- Page courante -->
              <ul class="nav navbar-nav">
                <li class="active colortextnav"><a href="" style="color:#fafafa !important;"><b>Welcome</b><span class="sr-only">(current)</span></a></li>
              </ul>
              <!-- Recherche -->
              <form class="navbar-form navbar-left" style="margin-left: 150px;">
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Search" style="width: 370px; display: none;">
                </div>
                <button type="submit" class="btn btn-default" style="display: none;"><b>Chercher</b></button>
              </form>

              <ul class="nav navbar-nav navbar-right colortextnav">
                <li class="dropdown colortextnav">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><b>Options</b><span class="caret" style="margin-left: 8px;"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="/zone_1/home/co2" style="text-transform: lowercase;">Voir l'état de CO2</a></li>
                    <li><a href="/zone_1/home/co" style="text-transform: lowercase;">Voir l'état de CO</a></li>
                    <li><a href="/zone_1/home/nh3" style="text-transform: lowercase;">Voir l'état de NH3</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="<?php 
                                    $login = "/zone_1/login";
                                    $logout = "/zone_1/logout";
                                    echo(isset($user) ? $logout : $login );
                                ?>">
                    <button type="submit" class="btn btn-primary" align="center"><?php echo (isset($user) ? "Deconnexion" : "Se Connecter"); ?></button></a></li>
                  </ul>
                </li>
              </ul>
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
    </nav><!-- end nav -->
</div>
    
    <!-- =================================== end banière ===================================== -->
        
        <div class="container" id="contenu_main">  <!-- ========= Pour tout le contenu de notre site======== -->

            <!-- =========================== Le logo et le titre ============================ -->
            <div class="row">
                <div class="col-md-12">
                    <h1><img src="/img/datastore-logo.png" id="gds-logo" /> PHP & <span class="hidden-xs">Google</span> Cloud Datastore</h1>
                </div>
            </div>
            <!-- ====================================================================== -->

            <!-- ==================== La définition et le Dashboard ===================== -->
            <div class="row">
                <!-- Définition -->
                <div class="col-md-8">
                    <h2>What is it ?</h2>
                    <dd>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla est purus, ultrices in porttitor
                    in, accumsan non quam. Nam consectetur porttitor rhoncus. Curabitur eu est et leo feugiat
                    auctor vel quis lorem.
                    Ut et ligula dolor, sit amet consequat lorem. Aliquam porta eros sed
                    velit imperdiet egestas.</dd>
                </div>
                <!-- Dadhboard -->
                <div class="col-md-4" >
                    <h3 align="center">Counter Of Gases not acceptable</h3>
                    <div id="chart_div" style="width: 400px; height: 120px;">

                        <?php

                        try
                        {
                        // On crée un objet de type Repository.
                        $obj_repo = new \GDS\Demo\Repository();
                        // Chercher TOUS 'All' les gazs insérées récemment.
                        $arr_posts = $obj_repo->getAllRecentPost();

                        // au début 
                        $nbr_co2_na = 0;
                        $n_co2 = 0;
                        $nbr_co_na = 0;
                        $n_co = 0;
                        $nbr_nh3_na = 0;
                        $n_nh3 = 0;

                        // Compte tous les posts.
                        $nbr = count($arr_posts); // C'est le N dans le livre
                        
                        foreach ($arr_posts as $obj_post) 
                        {
                            if($obj_post->co2 >= 396)// tous les co2 qui dépasse ou égale à 396ppm
                                {   
                                    $nbr_co2_na += 1; // si on est ici c'est qu'il y a des co2 non acceptables, on icremente le nombre $nbr_co2_na alors !
                                    $n_co2 = $nbr_co2_na;
                                    // $co2_na = $obj_post->co2;
                                }
                            if($obj_post->co >= 3) // tous les co qui dépasse ou égale à 3ppm
                                {
                                    // si on est ici c'est qu'il y a des co non acceptables, on icremente le nombre $nbr_co_na alors !
                                    $nbr_co_na += 1;
                                    $n_co = $nbr_co_na;
                                    // $co_na = $obj_post->co;
                                }
                            if($obj_post->nh3 >= 5) // tous les nh3 qui dépasse ou égale à 5ppm
                                    {   
                                        // si on est ici c'est qu'il y a des nh3 non acceptables, on icremente le nombre $nbr_nh3_na alors !
                                        $nbr_nh3_na += 1;
                                        $n_nh3 = $nbr_nh3_na;
                                    }  
                            ?>
                        
                        <?php 

                        }

                        //calculs les %
                        if($nbr != 0) // on évite la division par zéro
                            {   
                                $pource_co2 = ($n_co2*100)/$nbr;
                                $pource_co = ($n_co*100)/$nbr;
                                $pource_nh3 = ($n_nh3*100)/$nbr;
                            }

                        ?>
                          <!-- // Tant que les données ne sont pas prêtes on affiche un loder   -->
                         <?php 
                        
                        if($pource_co2 == null AND $pource_co == null AND $pource_nh3 == null)
                        {
                            ?>
                            <p>En attente des <strong>données</strong> provenant des <strong>capteurs</strong>...</p>
                            <div class="loader_compteurs"></div>
                            <?php
                        }
                         ?>
                         <!-- fin affichage loader -->

                <!-- script pour afficher les pourcentages de gazs non acceptable sur les compteurs -->
                            <script type="text/javascript">
                                google.charts.load('current', {'packages':['gauge']});
                                google.charts.setOnLoadCallback(drawChart);

                                function drawChart() 
                                {
                                    // des valeurs aléatoires au chargement de la page
                                    var data = google.visualization.arrayToDataTable([
                                      ['Label', 'Value'],                             
                                      ['CO2', <?php echo rand(0, 100); ?>],
                                      ['CO', <?php echo rand(0, 100); ?>],
                                      ['NH3', <?php echo rand(0, 100); ?>]
                                    ]);

                                    var options = {
                                      width: 400, height: 120,
                                      redFrom: 90, redTo: 100,
                                      yellowFrom:75, yellowTo: 90,
                                      minorTicks: 10
                                    };

                                    var chart = new google.visualization.Gauge(document.getElementById('chart_div'));

                                    chart.draw(data, options);

                                    setInterval(function() {
                                      data.setValue(0, 1, 0 + <?php echo $pource_co2; ?>);
                                      chart.draw(data, options);
                                    }, 4000);
                                    setInterval(function() {
                                      data.setValue(1, 1, 0 + <?php echo $pource_co; ?>);
                                      chart.draw(data, options);
                                    }, 4000);
                                    setInterval(function() {
                                      data.setValue(2, 1, 0 + <?php echo $pource_nh3; ?>);
                                      chart.draw(data, options);
                                    }, 4000);
                                }                    
                            </script>
                    <!-- ================= Fin script affich ===================== % -->
                            
                    <!-- actualisation automatique,SEULEMENT le div des compteurs-->
                            <script type="text/javascript">
                            $(document).ready(function()
                                {   
                                    $('#chart_div').load('main.php');
                                    refresh();
                                });

                            function refresh() 
                                {   
                                    setTimeout(
                                                function()
                                                    {
                                                       $('#chart_div').load('main.php');
                                                       refresh();     
                                                    }, 1000        // l'actualisation se fait chaque sec 
                                              );
                                }
                            </script>
                        <!-- ======================= fin actu auto ===================== -->

                            <?php
                        }
                        catch(\Exception $obj_ex)
                        {
                            syslog(LOG_ERR, $obj_ex->getMessage());
                            echo '<em>Whoops, something went wrong!</em>';
                        }

                            ?>
                    </div> <!-- fin div compteurs -->
                </div> <!-- fin col md 4 -->
            </div> <!-- fin row -->
        <!-- ========================================================================== -->
        <br>
		<hr style="width: 50%; border-top: 1px solid #cacaca;">
        <!-- ============================== Le Map ==================================== -->
            <div>
                <h2>Where are our sensors?</h2>
                <div class="my_map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d963367.6427555117!2d46.800975397000194!3d-19.40571407254446!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x21fa8238a95a8965%3A0xe11f2e914a20ec99!2sEcole+Sup%C3%A9rieur+Polytechnique+d&#39;Antananarivo!5e0!3m2!1sfr!2sfr!4v1501594670727" width="675" height="250" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
            </div>
        <!-- =============================== Fin Map ================================== -->


<!-- ====== actualisation automatique,SEULEMENT le div des valeurs en mg/m3  ============ -->
                            <script type="text/javascript">
                            $(document).ready(function()
                                {   
                                    $('#mg_m3').load('main.php');
                                    refresh();
                                });

                            function refresh() 
                                {   
                                    setTimeout(
                                                function()
                                                    {
                                                       $('#mg_m3').load('main.php');
                                                       refresh();     
                                                    }, 1000        // l'actualisation se fait chaque seconde 
                                              );
                                }
                            </script>
<!-- ======================= fin actu auto ===================== --> 
<br><br>
<hr style="width: 50%; border-top: 1px solid #cacaca;">
<!-- ========================== Tableau des dernièrs valeurs en mg/m3 ========================== -->
<div class="brute" id="mg_m3" style="height: 420px;">
<h2>Notifications</h2>

<!-- Calculs -->

<?php
try
{   
    // ========Appel de notre modèle

    // On crée un objet de type Repository.
    $obj_repo = new \GDS\Demo\Repository();
    // Chercher juste les dernières valeurs insérées récemment.
    $arr_posts = $obj_repo->getLatestRecentPost();

    // =========fin appel de notre modèle

   // val ppm
    if(isset($arr_posts->co2) AND isset($arr_posts->co) AND isset($arr_posts->nh3))
       {
        $ppm_co2 = $arr_posts->co2;
        $ppm_co = $arr_posts->co;
        $ppm_nh3 = $arr_posts->nh3;

        // masse masseVolumique_co2 avec 3 après la virgule comme précision
        $masseVolumique_co2 = round(($ppm_co2 * (MASSE_MOLAIRE_CO2/VOLUME_MOLAIRE)), 3, PHP_ROUND_HALF_UP);
        $masseVolumique_co = round(($ppm_co * (MASSE_MOLAIRE_CO/VOLUME_MOLAIRE)), 3, PHP_ROUND_HALF_UP);
        $masseVolumique_nh3 = round(($ppm_nh3 * (MASSE_MOLAIRE_NH3/VOLUME_MOLAIRE)), 3, PHP_ROUND_HALF_UP);
       }    
}
catch(\Exception $obj_ex)
{
    syslog(LOG_ERR, $obj_ex->getMessage());
    echo '<em>Whoops, something went wrong!</em>';
}
?>
<!-- fin claculs -->

    <div class="promos">  
        <div class="promo">
          <div class="deal">
            <span style="padding-bottom: 15px;padding-top: 5px;">CO2</span>
            <span>Lorem ipsum lorem ipsum</span>
          </div>
          <span class="price" style="background-color: <?php
                                                            if(!isset($ppm_co2)) 
                                                                {
                                                                    echo "#95a5a6";//on n'a pas encore de valeur //default
                                                                }
                                                            elseif($ppm_co2 <= 396)
                                                                {
                                                                    echo '#beeb9f'; // vert //Info
                                                                }
                                                            elseif($ppm_co2 > 396 AND $ppm_co2 <= 496)
                                                                {
                                                                    echo '#e67e22'; // jaune orange //warning
                                                                }
                                                            elseif($ppm_co2 > 496) 
                                                                {
                                                                   echo '#e74c3c'; // rouge //danger
                                                                }
                                                                


                                                        ?>"><?php 
                                                        if(isset($masseVolumique_co2)) echo $masseVolumique_co2." ".'<em>mg/m3</em>'; 
                                                        else 
                                                            {
                                                                ?>
                                                                <div class="loader_notif_co2_nh3"></div>
                                                                <?php
                                                            }
                                                        ?></span>
          <ul class="features">
            <li class="li_brute">Lorem Ipsum ipsum</li>
            <li class="li_brute">Another lorem ipsum</li>
            <li class="li_brute">Lorem ipsum...</li>   
          </ul>
          <a href="<?php 
                                    $login = "/zone_1/login";
                                    $logout = "/zone_1/logout";
                                    echo(isset($user) ? $logout : $login );
                                ?>"><button type="submit" class="btn btn-primary sign_up">See More
                    </button></a>
        </div>
        <div class="promo scale">
          <div class="deal">
            <span style="padding-bottom: 15px;padding-top: 5px;">CO</span>
            <span>Lorem ipsum lorem ipsum</span>
          </div>
          <span class="price" style="background-color: <?php
                                                            if(!isset($ppm_co)) 
                                                                {
                                                                    echo "#95a5a6";//on n'a pas encore de valeur //default
                                                                }
                                                            elseif($ppm_co <= 3)
                                                                {
                                                                    echo '#beeb9f'; // vert
                                                                }
                                                            elseif($ppm_co > 3 AND $ppm_co <= 4 )
                                                                {
                                                                    echo '#e67e22'; // jaune orange
                                                                }
                                                            elseif($ppm_co > 5) 
                                                                {
                                                                   echo '#e74c3c'; // rouge == danger
                                                                }


                                                        ?>"><?php 
                                                        if(isset($masseVolumique_co)) 
                                                            echo $masseVolumique_co." ".'<em>mg/m3</em>';
                                                        else 
                                                        {
                                                            ?>
                                                                <div class="loader_notif_co"></div>
                                                            <?php
                                                        }
                                                        ?></span>
          <ul class="features">
            <li class="li_brute">Lorem Ipsum ipsum</li>
            <li class="li_brute">Another lorem ipsum</li>
            <li class="li_brute">Lorem ipsum...</li>   
          </ul>
          <a href="<?php 
                                    $login = "/zone_1/login";
                                    $logout = "/zone_1/logout";
                                    echo(isset($user) ? $logout : $login );
                                ?>"><button type="submit" class="btn btn-primary sign_up">See More
                   </button></a>
        </div>
        <div class="promo">
          <div class= "deal">
            <span style="padding-bottom: 15px;padding-top: 5px;">NH3</span>
            <span>Lorem ipsum lorem ipsum</span>
          </div>
          <span class="price" style="background-color: <?php
                                                            if(!isset($ppm_nh3)) 
                                                                {
                                                                    echo "#95a5a6";//on n'a pas encore de valeur //default
                                                                }
                                                            elseif($ppm_nh3 <= 5)
                                                                {
                                                                    echo '#beeb9f'; // vert
                                                                }
                                                            elseif($ppm_nh3 > 5 AND $ppm_nh3 <= 6)
                                                                {
                                                                    echo '#e67e22'; // jaune orange
                                                                }
                                                            elseif($ppm_nh3 > 6) 
                                                                {
                                                                    echo '#e74c3c'; // rouge == danger
                                                                }


                                                        ?>"><?php 
                                                        if(isset($masseVolumique_nh3)) 
                                                            echo $masseVolumique_nh3." ".'<em>mg/m3</em>'; 
                                                        else 
                                                           {
                                                                ?>
                                                                <div class="loader_notif_co2_nh3"></div>
                                                                <?php
                                                           }
                                                        ?></span>
          <ul class="features">
            <li class="li_brute">Choose the lorem ipsum</li>
            <li class="li_brute">We need lorem ipsum</li>
            <li class="li_brute">Lorem ipsem...</li>   
          </ul>
          <a href="<?php 
                                    $login = "/zone_1/login";
                                    $logout = "/zone_1/logout";
                                    echo(isset($user) ? $logout : $login );
                                ?>"><button type="submit" class="btn btn-primary sign_up">See More
                   </button></a>
        </div> 
    </div> 
</div> <!-- end notiff mg/m3 -->

<div style="margin-left: 160px;">

    <script>
              // On attend que la page soit chargée 
              jQuery(document).ready(function()
              {
              // On cache la zone de texte
              jQuery('#toggle').hide();
              // toggle() lorsque le lien avec l'ID #toggler est cliqué
              jQuery('h2#toggler').click(function()
              {
              jQuery('#toggle').toggle(400);
              return false;
              });
              });
    </script>

   
    <h2 style="color: #337ab7 !important;" id="toggler">See The Legend</h2>
    <div id="toggle" class="toggle_legend">   
            <div class="float">
            <div class="carre" style="background-color:#beeb9f;display: inline;"></div> <p style="color: #beeb9f" class="fanazavana">Vous trouvez dans un endroit très aéré !!</p>
            </div>
        <br>
            <div class="float" style="margin-top: 0px;
                                      margin-right: 400px;">
            <div class="carre" style="background-color:#e67e22;display: inline;"></div> <p style="color: #e67e22" class="fanazavana">L'endroit est presque invivable à cause des polluants !</p>
            </div>
        <br>
            <div class="float">
            <div class="carre" style="background-color:#e74c3c;display: inline;"></div> <p style="color: #e74c3c" class="fanazavana">Vous devez aérez le lieu ou bien évacuez ! Ca devient invivable.</p>
            </div>
    </div>
 </div>


<!-- ========================== fin Tab Dèr=============================== -->

<!-- <hr style="width: 50%; border-top: 1px solid #cacaca;"> -->

 <!-- ========================== Espace connexion ============================== -->
            <div class="row">
                <div class="col-md-12">
                    <h2>See more content</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4" id="login_btn">
                    <div class="well btn_main_connect">
                        <form method="POST" action="<?php if(isset($user)) {echo '/zone_1/home';} else {echo '/zone_1/login';} ?>">
                            <button type="submit" class="btn btn-primary" align="center">
                                <?php 
                                    if(isset($user)) 
                                        {echo "Go Home<i class='fa fa-arrow-right' style='margin-left: 15px;'></i>";}
                                    else 
                                        {echo "Se Connecter";}
                                ?>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        <!-- ====================== Fin Espace Connexion ============================== -->

    </div> <!-- fin de container de la page --> 
       
    <!-- ********************************* Footer ***************************************** -->
   <footer>
    <div class="footer" id="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h3> Contact </h3>
                    <ul>
                        <li> <a href="#"> Lorem Ipsum </a> </li>
                        <li> <a href="#"> Lorem Ipsum </a> </li>
                        <li> <a href="#"> Lorem Ipsum </a> </li>
                        <li> <a href="#"> Lorem Ipsum </a> </li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h3> Important Links </h3>
                    <ul>
                        <li> <a href="#"> Admission </a> </li>
                        <li> <a href="#"> Academic </a> </li>
                        <li> <a href="#"> Career </a> </li>
                        <li> <a href="#"> Administration </a> </li>
                        <li> <a href="#"> Notice </a> </li>
                        <li> <a href="#"> Tender </a> </li>
                        <li> <a href="login.php"> Teacher Login </a> </li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h3> Location </h3>
                    <ul>
                        <li> <a href="#"> Lorem Ipsum </a> </li>
                        <li> <a href="#"> Lorem Ipsum </a> </li>
                        <li> <a href="#"> Lorem Ipsum </a> </li>
                        <li> <a href="#"> Lorem Ipsum </a> </li>
                    </ul>
                </div>
            </div>
            <!--/.row-->
        </div>
        <!--/.container-->
    </div>
    <!--/.footer-->

    <div class="footer-bottom">
        <div class="container">
            <p class="pull-left"> Copyright © 2017, JKKNIU. All rights reserved.</p>
            <div class="pull-right">
                <ul class="nav nav-pills payments">
                    <li><i class="fa fa-cc-visa"></i></li>
                    <li><i class="fa fa-cc-mastercard"></i></li>
                    <li><i class="fa fa-cc-amex"></i></li>
                    <li><i class="fa fa-cc-paypal"></i></li>
                </ul>
            </div>
        </div>
    </div>
    <!--/.footer-bottom-->
</footer>
<!--*********************************** Fin footer **************************************** -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
   
</body>
</html>