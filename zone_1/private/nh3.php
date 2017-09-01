<?php
    use google\appengine\api\users\User;
    use google\appengine\api\users\UserService;
    // On crée une session, pour pouvoir utiliser les sessions. De sorte à ce connecter au session.  
    $user = UserService::getCurrentUser();

    // on a pas le droit de voir index si on était pas connecter au préalable.
    if(!$user)
    {   

        // header("Location: /zone_1"); // on rédirige vers l'accueil et 
        // exit; // On arrête tout.
            ?>  
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Login-SDP</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
     <!-- CSS global -->
    <link rel="stylesheet" href="/css/demo.css">
<style>
/*body*/
body
{
   /*body de google*/
    background-color: #fafafa !important;
    color: rgba(0,0,0,.987) !important;
    font-family: 'Roboto',sans-serif !important;
    font-size: 12px !important;
    font-weight: 400 !important;
    letter-spacing: .01em !important;
    line-height: 16px !important;
    margin: 0 !important;
    padding: 0 !important;
    overflow: auto !important;

}

/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.7); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
    position: relative;
    background-color: #fefefe;
    margin: auto;
    padding: 0;
   /* border: 1px solid #888;*/
    width: 80%;
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
    -webkit-animation-name: animatetop;
    -webkit-animation-duration: 0.4s;
    animation-name: animatetop;
    animation-duration: 0.4s
}

/* Add Animation */
@-webkit-keyframes animatetop {
    from {top:-300px; opacity:0} 
    to {top:0; opacity:1}
}

@keyframes animatetop {
    from {top:-300px; opacity:0}
    to {top:0; opacity:1}
}

/* The Close Button */
.close {
    color: white;
    float: right;
    font-size: 28px;
    font-weight: bold;
    margin-top: 14px !important;
}

.close:hover,
.close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}

.modal-header {
    padding: 2px 16px;
    background-color: rgb(59, 120, 231);
    color: #c8c8c8;

}

.modal-body 
{
    padding: 40px 16px !important;
    background-color: #fafafa;
    font: 400 16px/24px Roboto, sans-serif;
    color: #212121;
}
.okbtn
{
    float: left;
    margin-right: 15px;
}

/*.mark_ok 
{
    background-color: yellow;
}*/

/*.okbtn:hover
{
    background-color: yellow;
}*/

.cancelbtn
{
    float: right;
}

/*.mark_cancel 
{
    background-color: #e74c3c;
}*/

/*.cancelbtn:hover
{
    background-color: #e74c3c;
}
*/
.modal-footer {
    padding: 2px 16px;
    background-color: rgb(59, 120, 231);
    color: #c8c8c8;
}
</style>
</head>
<body>

<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
        <h3 align="center" style="color: #fafafa;">SDP - IoT</h3>
    </div>
    <div class="modal-body">
      <p align="center">Une connexion à votre compte est requise pour voir le contenu de la page que vous avez demandée !</p>
      <p align="center">Cliuquer sur <mark class="mark_ok">"Accept"</mark> pour <mark class="mark_ok">accepter et continuer</mark> , sinon <mark class="mark_cancel">fermez</mark> cette fenêtre ou cliquez le bouton <mark class="mark_cancel">"Cancel" pour annuler</mark>. Merci !</p>
     
      <button type="button" onclick="document.location.href='javascript:history.back()'" class="btn btn-primary cancelbtn">Cancel</button>
       <button type="button" id="ok_btn" class="btn btn-primary okbtn">Accept</button>

    </div>
    <div class="modal-footer">
      <h4 align="center" style="color: #fafafa;">© 2017, YvonB All rights reserved</h4>
    </div>
  </div>

</div>
<a href="<?php echo UserService::createLoginURL($_SERVER['REQUEST_URI']) ?>" id="lien"></a>
<script>
// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var ok = document.getElementById("ok_btn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
window.onload = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
    document.location.href='javascript:history.back()'; //page précédente
}

// When the user clicks anywhere outside of the modal, close it
ok.onclick = function() 
{
        modal.style.display = "none";
        document.getElementById('lien').click();
}

</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
</body>
</html>

<?php   
    }

    // Pour notre lib
    require_once('../vendor/autoload.php');

    // Chercher les dernières valeurs insérées
    $obj_repo = new \GDS\Demo\Repository();
    $arr_posts = $obj_repo->getRecentPosts();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>Détéction de Pollution</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- css global -->
    <link rel="stylesheet" href="/css/demo.css"> 
    <link rel="stylesheet" href="/css/slide.css"> <!-- pour l'utilisation de #slider ect -->

    <meta name="author" content="Yvon Benahita">
    <link rel="icon" type="image/png" href="/img/datastore-logo.png" />

	<!-- script pour la courbe -->
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
	<!-- ********************** -->

    <!-- font awesome-->
    <link rel="stylesheet" href="css/font-awesome/font-awesome.css">
</head>

<body>
    <!--************************ Début Navigation ************************************-->
    <header>
        <nav class="navbar navbar-default navbar-fixed-top colornav">
        <div class="date_time">
          <h3 style="display: none;">Follow your healf closely</h3>

          <div id="afficherheure">
          </div> 

          <div class="date">
            <h3><?php echo  date('l jS \of F Y'); ?></h3>
          </div> <!-- end date -->

           <!-- affiche heure -->
          <script type="text/javascript">
              setInterval(function(){
                document.getElementById('afficherheure').innerHTML = new Date().toLocaleTimeString();
                      }, 1000);
          </script><!-- end heure -->
        </div>
          <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand colortextnav" href="/"><b>SDP - IoT</b></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav">
                <li class="active colortextnav"><a href="" style="color:#fafafa !important;"><b>NH3</b><span class="sr-only">(current)</span></a></li>
              </ul>
              <form class="navbar-form navbar-left" style="margin-left: 150px;">
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Search" style="width: 370px;display: none;">
                </div>
                <button type="submit" class="btn btn-default" style="display: none;"><b>Chercher</b></button>
              </form>
              <ul class="nav navbar-nav navbar-right colortextnav">
                <li><a href="/zone_1/home"><b><i class="fa fa-home" style="margin-right: 4px;"></i>Back Home</b></a></li>
                <li><a href="/zone_1/home/co2">Gaz Carbonique</a></li>
                <li><a href="/zone_1/home/co">Monoxyde de Carbone</a></li>
                <!-- <li><a href="#">Amoniaque</a></li> -->
                <li class="dropdown colortextnav">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user" aria-hidden="true" style="margin-right: 4px;"></i><b><?php echo htmlspecialchars($user->getNickname());?></b><span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="/zone_1/login"><button type="submit" class="btn btn-primary" align="center">Se Deconnecter</button></a></li>
                  </ul>
                </li>
              </ul>
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>
    </header>
<!--****************************** Fin Navigation *****************************-->

<div class="container" id="contenu">  <!-- Pour tout le contenu de notre site -->

<!-- ===========================Le logo et le titre============================ -->
    <div class="row">
        <div class="col-md-12">
            <h1><img src="/img/datastore-logo.png" id="gds-logo" /> PHP & <span class="hidden-xs">Google</span> Cloud Datastore</h1>
        </div>
    </div>
<!-- ====================================================================== -->

    <div align="center">  
        <h4>Amoniaque</h4>
         <div class="mon_slide">
            <div id="slider">
                <div id="nh3" style="height: 400px; min-width: 310px"></div>  <!-- div qui va contenir la courbe -->
                </div>
        </div>
    </div> 

<!-- pour récupérer les valeurs dans la BD -->
    <?php
        try
            {   
                // ========Appel de notre modèle

                // On crée un objet de type Repository.
                $obj_repo = new \GDS\Demo\Repository();
                // Chercher juste la dernières valeurs insérées récemment.
                $arr_posts = $obj_repo->getLatestRecentPost();

                // =========fin appel de notre modèle

               // val ppm
                if(isset($arr_posts)){$ppm_nh3 = $arr_posts->nh3;}   
            }
            catch(\Exception $obj_ex)
                {
                    syslog(LOG_ERR, $obj_ex->getMessage());
                    echo '<em>Whoops, something went wrong!</em>';
                }
     
    ?>
<!-- fin récupération -->
    
<!-- le script de la courbe lui même -->
<script type="text/javascript">
   $(document).ready(function () {
    Highcharts.setOptions({
        global: {
            useUTC: false
        }
    });

    Highcharts.chart('nh3', {
        chart: {
            type: 'spline',
            animation: Highcharts.svg, // Ne pas animer dans l'ancien IE
            marginRight: 10,
            events: {
                load: function () {

                    // Configurer la mise à jour du graphique chaque 4 seconde
                    var series = this.series[0];
                    setInterval(function () {
                        var x = (new Date()).getTime(), // heure actuelle
                            y = <?php echo $ppm_nh3 ; ?>; // les valeurs en ppm sur l'axe des abscisses
                        series.addPoint([x, y], true, true);
                    }, 4000);
                }
            }
        },
        title: {
            text: 'Live nh3 data'
        },
        xAxis: {
            type: 'datetime',
            tickPixelInterval: 150
        },
        yAxis: {
            title: {
                text: 'Value in ppm'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            formatter: function () {
                return '<b>' + this.series.name + '</b><br/>' +
                    Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x) + '<br/>' +
                    Highcharts.numberFormat(this.y, 2);
            }
        },
        legend: {
            enabled: false
        },
        exporting: {
            enabled: false
        },
        series: [{
            name: 'nh3',
            data: (function () {
                var data = [],
                    time = (new Date()).getTime(),
                    i;

                for (i = -19; i <= 0; i += 1) {
                    data.push({
                        x: time + i * 1000,
                        y: <?php echo $ppm_nh3 ; ?> // les valeurs en ppm sur l'axe des abscisses
                    });
                }
                return data;
            }())
        }]
    });
});
</script>
<!-- ===================================== fin script ================================ -->

</div> <!-- fin de container de la page --> 

   <!-- ********************************* Footer ***************************************** -->
    <footer>
    <div class="footer" id="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h3> Contact </h3>
                    <ul>
                        <li> <a href="#"> Lorem Ipsum </a> </li>
                        <li> <a href="#"> Lorem Ipsum </a> </li>
                        <li> <a href="#"> Lorem Ipsum </a> </li>
                        <li> <a href="#"> Lorem Ipsum </a> </li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h3> Important Links </h3>
                    <ul>
                        <li> <a href="#"> Admission </a> </li>
                        <li> <a href="#"> Academic </a> </li>
                        <li> <a href="#"> Career </a> </li>
                        <li> <a href="#"> Administration </a> </li>
                        <li> <a href="#"> Notice </a> </li>
                        <li> <a href="#"> Tender </a> </li>
                        <li> <a href="login.php"> Teacher Login </a> </li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h3> Location </h3>
                    <ul>
                        <li> <a href="#"> Lorem Ipsum </a> </li>
                        <li> <a href="#"> Lorem Ipsum </a> </li>
                        <li> <a href="#"> Lorem Ipsum </a> </li>
                        <li> <a href="#"> Lorem Ipsum </a> </li>
                    </ul>
                </div>
            </div>
            <!--/.row-->
        </div>
        <!--/.container-->
    </div>
    <!--/.footer-->

    <div class="footer-bottom">
        <div class="container">
            <p class="pull-left"> Copyright © 2017, JKKNIU. All rights reserved.</p>
            <div class="pull-right">
                <ul class="nav nav-pills payments">
                    <li><i class="fa fa-cc-visa"></i></li>
                    <li><i class="fa fa-cc-mastercard"></i></li>
                    <li><i class="fa fa-cc-amex"></i></li>
                    <li><i class="fa fa-cc-paypal"></i></li>
                </ul>
            </div>
        </div>
    </div>
    <!--/.footer-bottom-->
</footer>
<!--*********************************** Fin footer **************************************** -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>

</body>
</html>