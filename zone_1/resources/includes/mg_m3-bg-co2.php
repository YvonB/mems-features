<?php
if(!isset($ppm_co2)) 
    {
        echo "#95a5a6";//on n'a pas encore de valeur //default
    }
elseif($ppm_co2 <= 396)
    {
        echo '#beeb9f'; // vert //Info
    }
elseif($ppm_co2 > 396 AND $ppm_co2 <= 496)
    {
        echo '#e67e22'; // jaune orange //warning
    }
elseif($ppm_co2 > 496) 
    {
       echo '#e74c3c'; // rouge //danger
    }
                                                                

