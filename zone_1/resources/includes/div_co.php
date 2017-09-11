<?php    
    require_once '../../controllers/Co/getLatestValues.php';
?>
<html>
<head>
    <!-- script pour la courbe -->
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <!-- ********************** -->
</head> 
<body>
<div align="center" class="mySlides">  
        <h4>Monoxyde de Carbone</h4>
        <div id="co" style="height: 400px; min-width: 310px"></div> <!-- div qui va contenir de la courbe -->
</div>

<script type="text/javascript">
    var chart; // global

/**
 * Demandez des données du serveur, ajoutez-le au graphique et définissez un délai d'attente 
 * demander à nouveau
 */
function requestData() {
    $.ajax({
        url: '/zone_1/home/co/data',
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
            renderTo: 'co',
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
            name: 'co',
            data: []
        }]
    });        
});
</script>
</body>
</html>