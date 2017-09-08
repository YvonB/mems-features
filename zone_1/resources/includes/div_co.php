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
<div align="center">  
        <h4>Monoxyde de Carbone</h4>
        <div id="co" style="height: 400px; min-width: 310px"></div> <!-- div qui va contenir de la courbe -->
</div>

<script src="/js/charts-co.js"></script> <!--le script de la courbe lui même -->
</body>
</html>