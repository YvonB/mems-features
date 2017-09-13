<?php 
    // on a pas le droit de voir index si on était pas connecter au préalable.
    if(!$user)
    {   
        header("Location: /zone_2"); // on rédirige vers l'accueil et 
        exit; // On arrête tout.
    }
