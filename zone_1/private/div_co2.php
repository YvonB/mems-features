<?php    
    // Pour notre lib
    require_once('../vendor/autoload.php');

    // On crée un objet de type Repository.
    $obj_repo = new \GDS\Demo\Repository();
    // Chercher juste les dernières valeurs insérées.
    $arr_posts = $obj_repo->getLatestRecentPost();

?>
<html>
<head>
	<!-- script pour la courbe -->
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
	<!-- ********************** -->
</head>	
</html>
<div align="center">  
        <h4>Gaz carbonique</h4>
        <div id="co2" style="height: 400px; min-width: 310px"></div> <!-- div qui va contenir de la courbe -->
</div>

<!-- ===================== le script de la courbe lui même ================ -->
<script type="text/javascript">
   var chart; // global

/**
 * Demandez des données du serveur, ajoutez-le au graphique et définissez un délai d'attente 
 * demander à nouveau
 */
function requestData() {
    $.ajax({
        url: '/zone_1/home/co2/data',
        success: function(point) {
            var series = chart.series[0],
                shift = series.data.length > 20; // décalage si la série est
                                                 // plus de 20

            // ajouter le point
            chart.series[0].addPoint(point, true, shift);
            
            // l'appeler à nouveau après une seconde
            setTimeout(requestData, 1000);    
        },
        cache: false
    });
}

$(document).ready(function() {
    chart = new Highcharts.Chart({
        chart: {
            renderTo: 'co2',
            defaultSeriesType: 'spline',
            events: {
                load: requestData
            }
        },
        title: {
            text: ''
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
<!-- ================================================================ -->