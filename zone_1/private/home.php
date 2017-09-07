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

    ini_set("display_errors",0);error_reporting(0);
 
    require_once 'sendmail.php';
?>

<!DOCTYPE html>
<html lang="fr">

<!-- head -->
<head>
    <meta charset="utf-8">
    <title>SDPE - IoT Home</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
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
          <h3 style="display: none;">Follow your healf closely</h3>

          <div id="afficherheure">
          </div> 

          <div class="date">
            <h3><?php echo  date('l jS \of F Y'); ?></h3>
          </div> <!-- end date -->

          <?php if($notif_mail != 0)
                  { 
                    ?>
                    <br><a href="https://mail.google.com/"><img src="/img/gmail-with-notif.png" id="gmail-with-notif" /></a><b id="notif_mail"><?php echo $notif_mail; ?></b> 
                    <?php
                  } 
                  else
                  {?>
                    <br><img src="/img/gmail-no-notif.png" id="gmail-no-notif" />
                    <?php
                  }

          ?>

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
              <a class="navbar-brand colortextnav" href="/zone_1"><b>SDPE - IoT</b></a>
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
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user" style="font-size: 16px;margin-right: 2px;" aria-hidden="true"></i>
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
                    <h2><i class="fa fa-info" style="margin-left: 3px;margin-right: 4px;" aria-hidden="true"></i>Lorem Ipsum</h2>
                    <dd>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla est purus ultrices in porttitor
                    in, accumsan non quam. Nam consectetur porttitor rhoncus.<br> Curabitur eu est et leo feugiat
                    auctor vel quis lorem.
                    Ut et ligula dolor, sit amet consequat lorem. Aliquam porta eros sed
                    velit imperdiet egestas.</dd>
                    
                </div>
                <!-- ============== -->
                <div class="col-md-4">
                    <h2 align="center"><i class="fa fa-pie-chart" style="margin-right: 8px" aria-hidden="true"></i>Gas not accepted</h2>
                      <div id="container" style="width:100%;height: 400px"> <!-- div pour contenir le Pie -->

                        <!-- // Tant que les données ne sont pas prêtes on affiche un loader   -->
                         <?php 
                        
                        if($res[0] == null AND $res[1] == null AND $res[2] == null)
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
                                      ['co2', <?php echo htmlspecialchars($res[0]); ?>],
                                      ['co', <?php echo htmlspecialchars($res[1]); ?>],
                                      {
                                          name: 'nh3',
                                          y: <?php echo htmlspecialchars($res[2]); ?>,
                                          sliced: true,
                                          selected: true
                                      } 
              
                                  ]
                              }]
                        });
                        </script>
                        <!-- end script Pie -->

                   </div> <!-- fin div Pie -->
                </div> <!-- end coll md 4 -->
            </div> <!-- end row -->
            <!-- =========================================================================== -->

            <!-- ============================= Slide des 03 courbes ======================== -->
                  <!-- 1)HTML -->
                  <div class="col-md-12">
                  <h2><i class="fa fa-line-chart" style="margin-left: 3px;margin-right: 8px;" aria-hidden="true"></i>See all at once</h2>
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

<!-- ================ Fin slide de 3 courbes ============================ -->

<!-- ================= les 10 dernières valeurs insérées ================== -->
<!-- jquery hide show toggle -->
<div class="col-md-8">
    <h2 id="toggler"><i class="fa fa-history" style="margin-left: 3px;margin-right: 4px;" aria-hidden="true"></i>
See Quickly the last 10 inserted values</h2>
</div>
<div class="row">

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

                <div class="col-md-8" id="toggle">
                    <!-- <h2>Results</h2> -->
                    <div class="panel panel-default" style="background-color: #cdf;box-shadow: 0 0 10px;margin-bottom: 50px;width: 1000px;margin-left: 40px;">
                        <div class="panel-body">

                            <?php
                              require_once 'zone_1/private/live-server-home-ten-latest-brute.php';
                            ?>
                        </div>
                    </div>
                </div>
            </div>
<!-- ================ fin 10 dernières valeurs insérées =================== -->

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