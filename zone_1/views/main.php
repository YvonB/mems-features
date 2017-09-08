<?php
require_once '../resources/configs/calcul-masse-molaire.php';
require_once '../resources/includes/session-in-main.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>SDPE - IoT Welcome</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/demo.css">
    <meta name="author" content="Yvon Benahita">
    <link rel="icon" type="image/png" href="/img/datastore-logo.png" />

    <!-- font awesome -->
    <link rel="stylesheet" href="css/font-awesome/font-awesome.css">
    
    <!-- Pour le Jauge  -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <!-- Fin -->

    <!-- jquery du rafraîchissement -->
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
</head>
<!-- end head -->

<body>
      <?php require_once '../resources/includes/header-main.php'; ?>
        
        <div class="container" id="contenu_main">  <!-- ========= Pour tout le contenu de notre site======== -->

            <!-- =========================== Le logo et le titre ============================ -->
            <div class="row">
                <div class="col-md-12">
                    <h1><img src="/img/datastore-logo.png" id="gds-logo" /> PHP & <span class="hidden-xs">Google</span> Cloud Datastore</h1>
                </div>
            </div>
            <!-- ====================================================================== -->

            <!-- ==================== La définition et le Dashboard ===================== -->
            <div class="row">
                <!-- Définition -->
                <div class="col-md-8">
                    <h2><i class="fa fa-info" style="margin-left: 3px;margin-right: 4px;" aria-hidden="true"></i>
                        What is it ?</h2>
                    <dd>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla est purus, ultrices in porttitor
                    in, accumsan non quam. Nam consectetur porttitor rhoncus. Curabitur eu est et leo feugiat
                    auctor vel quis lorem.
                    Ut et ligula dolor, sit amet consequat lorem. Aliquam porta eros sed
                    velit imperdiet egestas.</dd>
                </div>
                <!-- Dadhboard -->
                <div class="col-md-4" >
                    <h3 align="center"><i class="fa fa-tachometer" style="margin-right: 4px;" aria-hidden="true"></i>
                    Counter Of Gases not acceptable</h3>

                    <div id="chart_div" style="width: 400px; height: 120px;">
                    
                     <?php 
                    // Demander des données au serveur
                     require_once '../private/live-server-main-pourc-not-acceptable.php';               
                     // Tant que les données ne sont pas prêtes on affiche un loder                        
                     if($res[0] == null AND $res[1] == null AND $res[2]== null)
                     {
                        ?>
                         <p>En attente des <strong>données</strong> provenant des <strong>capteurs</strong>...</p>
                         <div class="loader_compteurs"></div>
                        <?php
                     }
                        ?>
                    <!-- fin affichage loader -->

                    <!-- afficher les pourcentages de gazs non acceptable sur les compteurs -->
                    <script type="text/javascript">
                    google.charts.load('current', {'packages':['gauge']});
                    google.charts.setOnLoadCallback(drawChart);

                                function drawChart() 
                                {
                                    // des valeurs aléatoires au chargement de la page
                                    var data = google.visualization.arrayToDataTable([
                                      ['Label', 'Value'],                             
                                      ['CO2', <?php echo rand(0, 100); ?>],
                                      ['CO', <?php echo rand(0, 100); ?>],
                                      ['NH3', <?php echo rand(0, 100); ?>]
                                    ]);

                                    var options = {
                                      width: 400, height: 120,
                                      redFrom: 90, redTo: 100,
                                      yellowFrom:75, yellowTo: 90,
                                      minorTicks: 10
                                    };

                                    var chart = new google.visualization.Gauge(document.getElementById('chart_div'));

                                    chart.draw(data, options);

                                    setInterval(function() {
                                      data.setValue(0, 1, 0 + <?php echo htmlspecialchars($res[0]); ?>);
                                      chart.draw(data, options);
                                    }, 4000);
                                    setInterval(function() {
                                      data.setValue(1, 1, 0 + <?php echo htmlspecialchars($res[1]); ?>);
                                      chart.draw(data, options);
                                    }, 4000);
                                    setInterval(function() {
                                      data.setValue(2, 1, 0 + <?php echo htmlspecialchars($res[2]); ?>);
                                      chart.draw(data, options);
                                    }, 4000);
                                }                    
                    </script>
                    <!-- ================= Fin script affich ===================== % -->

                    </div> <!-- fin div compteurs -->
                </div> <!-- fin col md 4 -->
            </div> <!-- fin row -->
        <!-- ========================================================================== -->
        <br>
		<hr style="width: 50%; border-top: 1px solid #cacaca;">
        <!-- ============================== Le Map ==================================== -->
            <div>
                <h2><i class="fa fa-map-marker" style="margin-right: 4px;margin-left: 3px;" aria-hidden="true"></i>
                        Where are our sensors?</h2>
                <div class="my_map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d963367.6427555117!2d46.800975397000194!3d-19.40571407254446!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x21fa8238a95a8965%3A0xe11f2e914a20ec99!2sEcole+Sup%C3%A9rieur+Polytechnique+d&#39;Antananarivo!5e0!3m2!1sfr!2sfr!4v1501594670727" width="675" height="250" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
            </div>
        <!-- =============================== Fin Map ================================== -->
<br><br>
<hr style="width: 50%; border-top: 1px solid #cacaca;">
<!-- ========================== Tableau des dernièrs valeurs en mg/m3 ========================== -->
<div class="brute" id="mg_m3" style="height: 420px;">
<h2><i class="fa fa-bell" style="margin-left: 3px;margin-right: 4px;" aria-hidden="true"></i>
Notifications</h2>
    <?php 
        // Demander des données au serveur
        require_once '../private/live-server-main-brute-mgm3-notif.php'; 
    ?>

   <div class="promos">  
        <div class="promo">
          <div class="deal">
            <span style="padding-bottom: 15px;padding-top: 5px;">CO2</span>
            <span>Lorem ipsum lorem ipsum</span>
          </div>
          <span class="price" style="background-color: <?php
                                                            require_once '../resources/includes/mg_m3-bg-co2.php';
                                                        ?>"><?php 
                                                        if(isset($masseVolumique_co2)) echo htmlspecialchars($masseVolumique_co2)." ".'<em>mg/m3</em>'; 
                                                        else 
                                                            {
                                                                ?>
                                                                <div class="loader_notif_co2_nh3"></div>
                                                                <?php
                                                            }
                                                        ?></span>
          <ul class="features">
            <li class="li_brute">Lorem Ipsum ipsum</li>
            <li class="li_brute">Another lorem ipsum</li>
            <li class="li_brute">Lorem ipsum...</li>   
          </ul>
          <a href="<?php 
                                    require_once '../resources/includes/href-home-or-login.php';
                                ?>"><button type="submit" class="btn btn-primary sign_up">See More
                    </button></a>
        </div>
        <div class="promo scale">
          <div class="deal">
            <span style="padding-bottom: 15px;padding-top: 5px;">CO</span>
            <span>Lorem ipsum lorem ipsum</span>
          </div>
          <span class="price" style="background-color: <?php
                                                          require_once '../resources/includes/mg_m3-bg-co.php';                                                            
                                                        ?>"><?php 
                                                        if(isset($masseVolumique_co)) 
                                                            echo htmlspecialchars($masseVolumique_co)." ".'<em>mg/m3</em>';
                                                        else 
                                                        {
                                                            ?>
                                                                <div class="loader_notif_co"></div>
                                                            <?php
                                                        }
                                                        ?></span>
          <ul class="features">
            <li class="li_brute">Lorem Ipsum ipsum</li>
            <li class="li_brute">Another lorem ipsum</li>
            <li class="li_brute">Lorem ipsum...</li>   
          </ul>
          <a href="<?php 
                                    require_once '../resources/includes/href-home-or-login.php';
                                ?>"><button type="submit" class="btn btn-primary sign_up">See More
                   </button></a>
        </div>
        <div class="promo">
          <div class= "deal">
            <span style="padding-bottom: 15px;padding-top: 5px;">NH3</span>
            <span>Lorem ipsum lorem ipsum</span>
          </div>
          <span class="price" style="background-color: <?php
                                                          require_once '../resources/includes/mg_m3-bg-nh3.php';
                                                       ?>"><?php 
                                                        if(isset($masseVolumique_nh3)) 
                                                            echo htmlspecialchars($masseVolumique_nh3)." ".'<em>mg/m3</em>'; 
                                                        else 
                                                           {
                                                                ?>
                                                                <div class="loader_notif_co2_nh3"></div>
                                                                <?php
                                                           }
                                                        ?></span>
          <ul class="features">
            <li class="li_brute">Choose the lorem ipsum</li>
            <li class="li_brute">We need lorem ipsum</li>
            <li class="li_brute">Lorem ipsem...</li>   
          </ul>
          <a href="<?php 
                                    require_once '../resources/includes/href-home-or-login.php';
                                ?>"><button type="submit" class="btn btn-primary sign_up">See More
                   </button></a>
        </div> 
    </div> 
</div> <!-- end notiff mg/m3 -->

<div style="margin-right: 80px;"> <!-- Legend -->

    <script>
        // On attend que la page soit chargée 
        jQuery(document).ready(function()
        {
        // On cache la zone de texte
        jQuery('#toggle').hide();
        // toggle() lorsque le lien avec l'ID #toggler est cliqué
        jQuery('h2#toggler').click(function()
        {
        jQuery('#toggle').toggle(400);
        return false;
        });
        });
    </script>

    <h2 style="color: #337ab7 !important; font-size: 16px" id="toggler"><i class="fa fa-bookmark" style="margin-right: 4px;margin-left: 3px;" aria-hidden="true"></i>See The Legend</h2>

    <div id="toggle" class="toggle_legend">   
            <div class="float">
            <div class="carre" style="background-color:#beeb9f;display: inline;"></div> <p style="color: #212121" class="fanazavana">Vous trouvez dans un endroit très aéré ! Vous pouvez être tranquile.</p>
            </div>
        <br>
            <div class="float" style="margin-top: 0px;
                                      margin-right: 400px;">
            <div class="carre" style="background-color:#e67e22;display: inline;"></div> <p style="color: #e67e22" class="fanazavana">L'endroit est PRESQUE invivable à cause des polluants ! Prenez garde !!</p>
            </div>
        <br>
            <div class="float">
            <div class="carre" style="background-color:#e74c3c;display: inline;"></div> <p style="color: #e74c3c" class="fanazavana">Alert ! Alert ! Vous devez aérez le lieu ou bien évacuez !! Ca devient invivable.</p>
            </div>
    </div>
 </div> <!-- end legend -->

<!-- ========================== fin Tab Dèr=============================== -->

 <!-- ========================== Espace connexion ============================== -->
            <div class="row">
                <div class="col-md-12">
                    <h2><i class="fa fa-plus" style="margin-right: 4px;margin-left: 3px;" aria-hidden="true"></i>
                        See more content</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4" id="login_btn">
                    <div class="well btn_main_connect">
                        <form method="POST" action="<?php if(isset($user)) {echo '/zone_1/home';} else {echo '/zone_1/login';} ?>">
                            <button type="submit" class="btn btn-primary" align="center">
                                <?php 
                                    if(isset($user)) 
                                        {echo "Go Home<i class='fa fa-arrow-right' style='margin-left: 15px;'></i>";}
                                    else 
                                        {echo "Se Connecter";}
                                ?>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        <!-- ====================== Fin Espace Connexion ============================== -->

</div> <!-- fin de container de la page --> 
       
<?php require_once '../resources/includes/footer.php'; ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
   
</body>
</html>