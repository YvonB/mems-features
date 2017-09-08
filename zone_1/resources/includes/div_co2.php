<?php    
    require_once '../../controllers/Co2/getLatestValues.php';
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
        <h4>Gaz carbonique</h4>
        <div id="co2" style="height: 400px; min-width: 310px"></div> <!-- div qui va contenir de la courbe -->
</div>

<script src="/js/charts-co2.js"></script> <!--le script de la courbe lui même -->
</body>
</html>


