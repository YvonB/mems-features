<?php
  require_once '../../controllers/Home/getSession.php';
  require_once '../../controllers/Home/authentification.php';    
  require_once '../../controllers/Home/sendmail.php';
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
    <?php require_once '../../resources/includes/header-home.php'; ?>
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
                        <?php 
                            // Appelle controlleur
                            require_once '../../controllers/Home/getPourcNotAcceptable.php'; 
                        ?>
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
                            <li><?php include("../../resources/includes/div_co2.php") ?></li>
                            <li><?php include("../../resources/includes/div_co.php") ?></li>
                            <li><?php include("../../resources/includes/div_nh3.php") ?></li>
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
                             // Appelle au controlleur
                              require_once '../../controllers/Home/getTenLatestValues.php';
                            ?>
                        </div>
                    </div>
                </div>
            </div>
<!-- ================ fin 10 dernières valeurs insérées =================== -->

</div> <!-- fin de container de la page --> 

   <!-- ********************************* Footer ***************************************** -->
    <?php require_once '../../resources/includes/footer.php' ?>
<!--*********************************** Fin footer **************************************** -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>

</body>
</html>