<?php
if(!isset($ppm_co)) 
    {
        echo "#95a5a6";//on n'a pas encore de valeur //default
    }
elseif($ppm_co <= 3)
    {
        echo '#beeb9f'; // vert
    }
elseif($ppm_co > 3 AND $ppm_co <= 4 )
    {
        echo '#e67e22'; // jaune orange
    }
elseif($ppm_co > 5) 
    {
        echo '#e74c3c'; // rouge == danger
    }

