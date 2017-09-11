<?php    
    require_once '../../controllers/Nh3/getLatestValues.php';
?>
<html>
<head>
</head> 
<body>
<div align="center" class="mySlides">  
        <h4>Amoniaque</h4>
        <div id="nh3" style="height: 400px; min-width: 310px"></div> <!-- div qui va contenir de la courbe -->
</div>

<script type="text/javascript">
    var chart; // global

/**
 * Demandez des données du serveur, ajoutez-le au graphique et définissez un délai d'attente 
 * demander à nouveau
 */
function requestData() {
    $.ajax({
        url: '/zone_1/home/nh3/data',
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
            renderTo: 'nh3',
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
            name: 'nh3',
            data: []
        }]
    });        
});
</script>
</body>
</html>