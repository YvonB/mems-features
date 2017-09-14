<?php 
   
	  $curentUserMail = htmlspecialchars($user->getEmail()); 
                     
      // envoyer un mail à l'utilisatuer courante                    
      if($res[0] > 50)
        {
          $to = $curentUserMail;
          $subject = "Alert au Gaz carbonique";
          $txt = "Le taux de Gaz carbonique non acceptable est de: ".$res[0]."%.";
          $headers = "From: sdpeiot@zone-1-179812.appspotmail.com" . "\r\n";
                              
          mail($to,$subject,$txt,$headers);
          $notif_mail++;
        }
      if ($res[1] > 50) 
        {
          $to = $curentUserMail;
          $subject = "Alert au Monoxyde de Carbone";
          $txt = "Le taux de Monoxyde de Carbone non acceptable est de: ".$res[1]."%.";
          $headers = "From: sdpeiot@zone-1-179812.appspotmail.com" . "\r\n";
                              
          mail($to,$subject,$txt,$headers);
          $notif_mail++;
        }
      if ($res[2] > 50) 
          {
            $to = $curentUserMail;
            $subject = "Alert à l' Ammoniaque";
            $txt = "Le taux d'Amoniaque non acceptable est de: ".$res[2]."%.";
            $headers = "From: sdpeiot@zone-1-179812.appspotmail.com" . "\r\n";
                              
            mail($to,$subject,$txt,$headers);
            $notif_mail++;
          } 
            // fin envoye mail 

 ?>