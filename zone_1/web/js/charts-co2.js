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
            }
        },
        title: {
            text: 'Live co2 data'
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