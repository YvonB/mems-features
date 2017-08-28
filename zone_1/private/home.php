<?php
    use google\appengine\api\users\User;
    use google\appengine\api\users\UserService;
    // On crée une session, pour pouvoir utiliser les sessions. De sorte à ce connecter au session.  
    $user = UserService::getCurrentUser();

    // on a pas le droit de voir index si on était pas connecter au préalable.
    if(!$user)
    {   
        header("Location: /zone_1"); // on rédirige vers l'accueil et 
        exit; // On arrête tout.
    }

    // Pour notre lib
    require_once('../vendor/autoload.php');

    // Chercher les dernières valeurs insérées
    $obj_repo = new \GDS\Demo\Repository();
    $arr_posts = $obj_repo->getRecentPosts();

?>

<!DOCTYPE html>
<html lang="fr">

<!-- head -->
<head>
    <meta charset="utf-8">
    <title>Détéction de pollution</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- CSS global -->
    <link rel="stylesheet" href="/css/demo.css">
    <!-- css du slide -->
    <link rel="stylesheet" href="/css/slide.css">
    <!-- fin css slide -->

    <meta name="author" content="Yvon Benahita">
    <link rel="icon" type="image/png" href="/img/datastore-logo.png" />

    <!-- font -->
    <link rel="stylesheet" href="css/font-awesome/font-awesome.css">

    <!-- script pour le Pie -->
     <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/highcharts-3d.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
</head>
<!-- end head -->

<body>
    <!--************************ Début Navigation ************************************-->
    <header>

        <nav class="navbar navbar-default navbar-fixed-top colornav">
        <div class="date_time">
          <h3>Follow your healf closely</h3>

          <div id="afficherheure">
          </div> 

          <div class="date">
            <p>We are on <?php echo  date('l jS \of F'); ?></p>
          </div> <!-- end date -->

           <!-- affiche heure -->
          <script type="text/javascript">
              setInterval(function(){
                document.getElementById('afficherheure').innerHTML = new Date().toLocaleTimeString();
                      }, 1000);
          </script><!-- end heure -->
        </div>
          <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand colortextnav" href="/zone_1"><b>SDP - IoT</b></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav">
                <li class="active colortextnav"><a href=""><b><i class="fa fa-home" style="margin-right: 4px;color:#fafafa !important;"></i>Home</b><span class="sr-only">(current)</span></a></li>
              </ul>
              <form class="navbar-form navbar-left" style="margin-left: 150px;">
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Search" style="width: 370px;display: none;">
                </div>
                <button type="submit" class="btn btn-default" style="display: none;"><b>Chercher</b></button>
              </form>
              <ul class="nav navbar-nav navbar-right colortextnav">
                <li><a href="/zone_1/home/co2">Gaz Carbonique</a></li>
                <li><a href="/zone_1/home/co">Monoxyde de Carbone</a></li>
                <li><a href="/zone_1/home/nh3">Amoniaque</a></li>
                <li class="dropdown colortextnav">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user" aria-hidden="true" style="margin-right: 0px;"></i>
                    <b><?php echo htmlspecialchars($user->getNickname());?></b><span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="/zone_1/logout"><button type="submit" class="btn btn-primary" align="center">Se Deconnecter</button></a></li>
                  </ul>
                </li>
              </ul>
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>
    </header>
    <!--****************************** Fin Navigation *****************************-->
        
<div class="container" id="contenu">  <!-- Pour tout le contenu de notre site -->

<!-- ===========================Le logo et le titre============================ -->
    <div class="row">
        <div class="col-md-12">
            <h1><img src="/img/datastore-logo.png" id="gds-logo" /> PHP & <span class="hidden-xs">Google</span> Cloud Datastore</h1>
        </div>
    </div>
<!-- ====================================================================== -->

<!-- =====================La définition et la Réssource===================== -->
            <div class="row">
                <div class="col-md-8">
                    <h2>Lorem Ipsum</h2>
                    <dd>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla est purus ultrices in porttitor
                    in, accumsan non quam. Nam consectetur porttitor rhoncus.<br> Curabitur eu est et leo feugiat
                    auctor vel quis lorem.
                    Ut et ligula dolor, sit amet consequat lorem. Aliquam porta eros sed
                    velit imperdiet egestas.</dd>
                </div>
                <!-- ============== -->
                <div class="col-md-4">
                    <h2 align="center">Gas not accepted</h2>
                      <div id="container" style="width:100%;height: 400px"> <!-- div pour contenir le Pie -->

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

                        <!-- // Tant que les données ne sont pas prêtes on affiche un loader   -->
                         <?php 
                        
                        if($pource_co2 == null AND $pource_co == null AND $pource_nh3 == null)
                        {
                            ?>
                            <p style="text-align: center;">En attente des <strong>données</strong>...</p>
                            <div class="loader_compteurs"></div>
                            <?php
                        }
                         ?>
                         <!-- fin affichage loader -->

                        <!-- script pour afficher le Pie -->
                        <script type="text/javascript">
                        Highcharts.chart('container', {
                              chart: {
                                  type: 'pie',
                                  options3d: {
                                      enabled: true,
                                      alpha: 45,
                                      beta: 0
                                  }
                              },
                              title: {
                                  text: 'Know where you find is livable or not'
                              },
                              tooltip: {
                                  pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                              },
                              plotOptions: {
                                  pie: {
                                      allowPointSelect: true,
                                      cursor: 'pointer',
                                      depth: 35,
                                      dataLabels: {
                                          enabled: true,
                                          format: '{point.name}'
                                      }
                                  }
                              },
                              series: [{
                                  type: 'pie',
                                  name: 'Not acceptable',
                                  data: [
                                      ['co2', <?php echo $pource_co2; ?>],
                                      ['co', <?php echo $pource_co; ?>],
                                      {
                                          name: 'nh3',
                                          y: <?php echo $pource_nh3; ?>,
                                          sliced: true,
                                          selected: true
                                      } 
              
                                  ]
                              }]
                        });
                        </script>
                        <!-- end script Pie -->

                        <!-- actu auto du div du Pie -->
                          <script type="text/javascript">
                            $(document).ready(function()
                                {   
                                    $('#container').load('home.php');
                                    refresh();
                                });

                            function refresh() 
                                {   
                                    setTimeout(
                                                function()
                                                    {
                                                       $('#container').load('home.php');
                                                       refresh();     
                                                    }, 1000        // l'actualisation se fait chaque sec 
                                              );
                                }
                            </script>
                        <!-- end actu auto -->

                          <?php
                   }
                    catch(\Exception $obj_ex)
                        {
                            syslog(LOG_ERR, $obj_ex->getMessage());
                            echo '<em>Whoops, something went wrong!</em>';
                        }

                            ?>
                   </div> <!-- fin div Pie -->
                </div> <!-- end coll md 4 -->
            </div> <!-- end row -->
            <!-- =========================================================================== -->

            <!-- ============================= Slide des 03 courbes ======================== -->
                  <!-- 1)HTML -->
                  <div class="col-md-12">
                  <h2>See all at once</h2>
                  </div>
                    <div class="mon_slide">
                        <div id="slider">
                          <ul id="slideWrap"> 
                            <li><?php include("div_co2.php") ?></li>
                            <li><?php include("div_co.php") ?></li>
                            <li><?php include("div_nh3.php") ?></li>
                          </ul>
                          <a id="prev" href="#">&#8810;</a>
                          <a id="next" href="#">&#8811;</a>
                        </div>
                    </div>

                    <!-- 2) CSS : slide.css-->

                    <!-- 3) JS -->
                    <script type="text/javascript">

                      var responsiveSlider = function() 
                      {
                          var slider = document.getElementById("slider");
                          var sliderWidth = slider.offsetWidth;
                          var slideList = document.getElementById("slideWrap");
                          var count = 1;
                          var items = slideList.querySelectorAll("li").length;
                          var prev = document.getElementById("prev");
                          var next = document.getElementById("next");

                          window.addEventListener('resize', function() 
                                                              {
                                                                sliderWidth = slider.offsetWidth;
                                                              }
                                                  );

                          var prevSlide = function() 
                                              {
                                                if(count > 1) 
                                                    {
                                                      count = count - 2;
                                                      slideList.style.left = "-" + count * sliderWidth + "px";
                                                      count++;
                                                    }
                                                else if(count = 1) 
                                                    {
                                                      count = items - 1;
                                                      slideList.style.left = "-" + count * sliderWidth + "px";
                                                      count++;
                                                    }
                                              };

                          var nextSlide = function() 
                                              {
                                                if(count < items) 
                                                    {
                                                      slideList.style.left = "-" + count * sliderWidth + "px";
                                                      count++;
                                                    }
                                                else if(count = items) 
                                                    {
                                                      slideList.style.left = "0px";
                                                      count = 1;
                                                    }
                                              };
                          
                          next.addEventListener("click", function() 
                                                              {
                                                                nextSlide();
                                                              }
                                               );

                          prev.addEventListener("click", function() 
                                                              {
                                                                prevSlide();
                                                              }
                                                );
                          
                          setInterval(function() 
                                          {
                                            nextSlide()
                                          }, 8000
                                     );

                    };

                    window.onload = function()
                     {
                      responsiveSlider();  
                     }
                    </script>


            <!-- ================================Fin slide de 3 courbes======================================================== -->

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