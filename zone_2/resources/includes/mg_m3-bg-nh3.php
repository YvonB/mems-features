<?php
if(!isset($ppm_nh3)) 
    {
        echo "#95a5a6";//on n'a pas encore de valeur //default
    }
elseif($ppm_nh3 <= 5)
    {
        echo '#beeb9f'; // vert
    }
elseif($ppm_nh3 > 5 AND $ppm_nh3 <= 6)
    {
        echo '#e67e22'; // jaune orange
    }
elseif($ppm_nh3 > 6) 
    {
        echo '#e74c3c'; // rouge == danger
    }
