var chart_nh3; // global

/**
 * Demandez des données du serveur, ajoutez-le au graphique et définissez un délai d'attente 
 * demander à nouveau
 */
function requestDataNH3() {
    $.ajax({
        url: '/zone_1/home/nh3/data',
        success: function(point) {
            var series = chart_nh3.series[0],
                shift = series.data.length > 20; // décalage si la série est
                                                 // plus de 20

            // ajouter le point
            chart_nh3.series[0].addPoint(point, true, shift);
            
            // l'appeler à nouveau après une seconde
            setTimeout(requestDataNH3, 1000);    
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
                load: requestDataNH3
            }
        },
        title: {
            text: 'Live nh3 data'
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