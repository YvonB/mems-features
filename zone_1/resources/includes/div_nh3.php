<?php    
    require_once '../../controllers/Nh3/getLatestValues.php';
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
        <h4>Amoniaque</h4>
        <div id="nh3" style="height: 400px; min-width: 310px"></div> <!-- div qui va contenir de la courbe -->
</div>

<script src="/js/charts-nh3.js"></script> <!--le script de la courbe lui même -->
</body>
</html>