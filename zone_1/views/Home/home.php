<?php
  $notif_mail = 0; 
  require_once '../../controllers/Home/getSession.php';
  require_once '../../controllers/Home/authentification.php';    
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
    <!-- fin css slide -->
    <meta name="author" content="Yvon Benahita">
    <link rel="icon" type="image/png" href="/img/datastore-logo.png" />
    <!-- font -->
    <link rel="stylesheet" href="css/font-awesome/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="http://csshake.surge.sh/csshake.min.css">

    <!-- script pour le Pie -->
     <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/highcharts-3d.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>

      <!-- script pour la courbe -->
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

</head>
<!-- end head -->

<body>
    <!--************************ Début Navigation ************************************-->
    <?php require_once '../../controllers/Home/getPourcNotAcceptable.php';?>
    <?php require_once '../../controllers/Home/sendmail.php'; ?> 
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
                      <div id="container" style="width:100%;height: 400px"> 
                       
                        <!-- // Tant que les données ne sont pas prêtes on affiche un loader   -->
                        <?php 
                        if($res[0] == null AND $res[1] == null AND $res[2] == null)
                        {
                            ?>
                            <p style="text-align: center;">En attente des <strong>données</strong>...</p>
                            <div class="loader_compteurs"></div>
                            <?php
                        }
                        else
                        {
                         ?>       
                        
                        <!-- sinon-->
                        <script type="text/javascript">
                          Highcharts.chart('container', {
                              chart: {
                                  type: 'column',
                              },
                              title: {
                                  text: 'Know where you find is livable or not'
                              },
                              subtitle: {
                                  text: ''
                              },
                              xAxis: {
                                  categories: [
                                      'A l\'instant'
                                      
                                  ],
                                  crosshair: true
                              },
                              yAxis: {
                                  min: 0,
                                  title: {
                                      text: 'Percentage (ppm)'
                                  }
                              },
                              tooltip: {
                                  headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                                  pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                                      '<td style="padding:0"><b>{point.y:.3f} %</b></td></tr>',
                                  footerFormat: '</table>',
                                  shared: true,
                                  useHTML: true
                              },
                              plotOptions: {
                                  column: {
                                      pointPadding: 0.2,
                                      borderWidth: 0
                                  }
                              },
                              series: [{
                                  name: 'co2',
                                  data: [<?php echo htmlspecialchars($res[0]); ?>]

                              }, {
                                  name: 'co',
                                  data: [<?php echo htmlspecialchars($res[1]); ?>]

                              }, {
                                  name: 'nh3',
                                  data: [<?php echo htmlspecialchars($res[2]); ?>]

                              }]
                          });
                        </script>
                        <!-- end script Pie -->
                      <?php
                          }
                      ?>
                    </div><!-- fin div Pie -->
                </div> <!-- end coll md 4 -->
            </div> <!-- end row -->
            <!-- =========================================================================== -->

            <!-- ============================= Slide des 03 courbes ======================== -->
                  <!-- 1)HTML -->
                  <div class="col-md-12">
                  <h2><i class="fa fa-line-chart" style="margin-left: 3px;margin-right: 8px;" aria-hidden="true"></i>See all at once</h2>
                  </div>

<div  class ="histoco2" style="max-height: 444px;margin-bottom: 50px;margin-top: 100px;box-shadow: 0 0 30px #888;"> 
                            <div align="center" class="mySlides">  
                              <!-- <h4>Gaz Carbonique</h4> -->
                              <div id="co2" style="height: 400px; min-width: 310px"></div>
                              <script type="text/javascript">
                                var chart_co2; // global

/**
 * Demandez des données du serveur, ajoutez-le au graphique et définissez un délai d'attente 
 * demander à nouveau
 */
function requestDataCO2() {
    $.ajax({
        url: '/zone_1/home/co2/data',
        success: function(point) {
            var series = chart_co2.series[0],
                shift = series.data.length > 20; // décalage si la série est
                                                 // plus de 20

            // ajouter le point
            chart_co2.series[0].addPoint(point, true, shift);
            
            // l'appeler à nouveau après une seconde
            setTimeout(requestDataCO2, 1000);    
        },
        cache: false
    });
}

$(document).ready(function() {
    chart_co2 = new Highcharts.Chart({
        chart: {
            renderTo: 'co2',
            defaultSeriesType: 'spline',
            events: {
                load: requestDataCO2
            },
        },
        title: {
            text: 'Gaz Carbonique'
        },
        xAxis: {
            type: 'datetime',
            tickPixelInterval: 150,
            maxZoom: 20 * 1000
        },
        yAxis: {
            minPadding: 0.2,
            maxPadding: 0.2,
            title: {
                text: 'Value in ppm',
                margin: 80
            }
        },
        series: [{
            name: 'co2',
            data: []
        }]
    });        
});

                              </script>
                            </div> <!-- div 1 --> 
                           
                            <div align="center" class="mySlides">  
                              <!-- <h4>Monoxyde de Carbone</h4> -->
                              <div id="co" style="height: 400px; min-width: 310px"></div>
                              <script type="text/javascript">
                                var chart_co; // global

/**
 * Demandez des données du serveur, ajoutez-le au graphique et définissez un délai d'attente 
 * demander à nouveau
 */
function requestDataCo() {
    $.ajax({
        url: '/zone_1/home/co/data',
        success: function(point) {
            var series = chart_co.series[0],
                shift = series.data.length > 20; // décalage si la série est
                                                 // plus de 20

            // ajouter le point
            chart_co.series[0].addPoint(point, true, shift);
            
            // l'appeler à nouveau après une seconde
            setTimeout(requestDataCo, 1000);    
        },
        cache: false
    });
}

$(document).ready(function() {
    chart_co = new Highcharts.Chart({
        chart: {
            renderTo: 'co',
            defaultSeriesType: 'spline',
            events: {
                load: requestDataCo
            }
        },
        title: {
            text: 'Monoxyde De Carbone'
        },
        xAxis: {
            type: 'datetime',
            tickPixelInterval: 150,
            maxZoom: 20 * 1000
        },
        yAxis: {
            minPadding: 0.2,
            maxPadding: 0.2,
            title: {
                text: 'Value in ppm',
                margin: 80
            }
        },
        series: [{
            name: 'co',
            data: []
        }]
    });        
});
                              </script> 
                            </div> <!-- div 2 -->

                            <div align="center" class="mySlides">  
                              <!-- <h4>Ammoniaque</h4> -->
                              <div id="nh3" style="height: 400px; min-width: 310px"></div>
                              <script type="text/javascript">
                                var chart_nh3; // global

/**
 * Demandez des données du serveur, ajoutez-le au graphique et définissez un délai d'attente 
 * demander à nouveau
 */
function requestDataNh3() {
    $.ajax({
        url: '/zone_1/home/nh3/data',
        success: function(point) {
            var series = chart_nh3.series[0],
                shift = series.data.length > 20; // décalage si la série est
                                                 // plus de 20

            // ajouter le point
            chart_nh3.series[0].addPoint(point, true, shift);
            
            // l'appeler à nouveau après une seconde
            setTimeout(requestDataNh3, 1000);    
        },
        cache: false
    });
}

$(document).ready(function() {
    chart_nh3 = new Highcharts.Chart({
        chart: {
            renderTo: 'nh3',
            defaultSeriesType: 'spline',
            events: {
                load: requestDataNh3
            }
        },
        title: {
            text: 'Ammoniaque'
        },
        xAxis: {
            type: 'datetime',
            tickPixelInterval: 150,
            maxZoom: 20 * 1000
        },
        yAxis: {
            minPadding: 0.2,
            maxPadding: 0.2,
            title: {
                text: 'Value in ppm',
                margin: 80
            }
        },
        series: [{
            name: 'nh3',
            data: []
        }]
    });        
});
                              </script>
                            </div> <!-- div 3 -->
                     
</div>                   
                    <!-- 3) JS -->
                    
                    
                    

                    <script>
                      var myIndex = 0;
                      carousel();

                      function carousel() {
                          var i;
                          var x = document.getElementsByClassName("mySlides");
                          for (i = 0; i < x.length; i++) {
                             x[i].style.display = "none";  
                          }
                          myIndex++;
                          if (myIndex > x.length) {myIndex = 1}    
                          x[myIndex-1].style.display = "block";  
                          setTimeout(carousel, 3000); // Change image every 2 seconds
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
                    <div class="panel panel-default" style="background-color: #cdf;margin-bottom: 50px;width: 1000px;margin-left: 40px;">
                        <div class="panel-body histoco2">

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