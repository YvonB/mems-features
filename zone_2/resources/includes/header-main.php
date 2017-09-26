    <div class="container-fluid banner">
        <div class="ban">
            <video id = "video" src="medias/la_pollution.mp4" type="video/mp4" autoplay="autoplay" loop="loop" muted="muted" >   
            </video>
        </div> 

        <div class="inner-banner">
            <h3 class="sub_title_ban"><img src="/img/datastore-logo.png"  class="logo_ban" />Detecteur - Analyseur Web des Gaz polluants SDP - IoT</h3>
            <h1>Know what really exists in the air you breathe</h1>
            <h3 class="sub_title_ban" style="padding-bottom: 20px;">Follow your health closely</h3>
            <a href="<?php require 'href-home-or-login.php'; ?>">
            <button type="submit" class="btn btn-primary">
              <?php 
                if(isset($user)) 
                  {echo "Go Home<i class='fa fa-arrow-right' style='margin-left: 15px;'></i>";}
                else 
                  {echo "See More Content";}
              ?>
            </button></a>
        </div>
    </div>

<div data-spy="affix" data-offset-top="763.8">
        <nav class="navbar-default colornav"> 

        <div class="container-fluid">

            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand colortextnav" href="/"><b>SDPE - IoT</b></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <!-- Page courante -->
              <ul class="nav navbar-nav">
                <li class="active colortextnav"><a href="" style="color:#fafafa !important;"><b>Welcome</b><span class="sr-only">(current)</span></a></li>
              </ul>
              <!-- Recherche -->
              <form class="navbar-form navbar-left" style="margin-left: 150px;">
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Search" style="width: 370px; display: none;">
                </div>
                <button type="submit" class="btn btn-default" style="display: none;"><b>Chercher</b></button>
              </form>

              <ul class="nav navbar-nav navbar-right colortextnav">
                <li class="dropdown colortextnav">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v" style="font-size: 17px;" aria-hidden="true"></i>
                    <!-- <span class="caret" style="margin-left: 8px;"></span> --></a>
                  <ul class="dropdown-menu">
                    <li><a href="/home/co2" style="text-transform: lowercase;">
                        Voir l'état de CO2</a></li>
                    <li><a href="/home/co" style="text-transform: lowercase;">
                        Voir l'état de CO</a></li>
                    <li><a href="/home/nh3" style="text-transform: lowercase;">
                        Voir l'état de NH3</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="<?php require_once 'href-login-or-logout.php'; ?>">
                    <button type="submit" class="btn btn-primary connect-btn" align="center"><?php echo (isset($user) ? "Deconnexion" : "Se Connecter"); ?></button></a></li>
                  </ul>
                </li>
              </ul>
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
    </nav><!-- end nav -->
</div>
