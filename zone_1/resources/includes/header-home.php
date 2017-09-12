<header>

        <nav class="navbar navbar-default navbar-fixed-top colornav">
        <div class="date_time">
          <h3 style="display: none;">Follow your healf closely</h3>

          <div id="afficherheure">
          </div> 

          <div class="date">
            <h3><?php echo  date('l jS \of F Y'); ?></h3>
          </div> <!-- end date -->

          <?php if($notif_mail != 0)
                  { 
                    ?>
                    <br><a href="https://mail.google.com/"><img src="/img/gmail-with-notif.png" id="gmail-with-notif" class="shake-rotate" /></a><b id="notif_mail"><?php echo $notif_mail; ?></b> 
                    <?php
                  } 
                  else
                  {?>
                    <br><img src="/img/gmail-no-notif.png" id="gmail-no-notif" />
                    <?php
                  }

          ?>

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
              <a class="navbar-brand colortextnav" href="/zone_1"><b>SDPE - IoT</b></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav">
                <li class="active colortextnav"><a href=""><b><i class="fa fa-home" style="margin-right: 4px;color:#fafafa !important;font-size: 18px;"></i>Home</b><span class="sr-only">(current)</span></a></li>
              </ul>
              <form class="navbar-form navbar-left" style="margin-left: 150px;">
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Search" style="width: 370px;display: none;">
                </div>
                <button type="submit" class="btn btn-default" style="display: none;"><b>Chercher</b></button>
              </form>
              <ul class="nav navbar-nav navbar-right colortextnav">
                <li><a href="/zone_1/home/co2">Gaz Carbonique</a></li>
                <li><a href="/zone_1/home/co">Monoxyde de Carbone</a></li>
                <li><a href="/zone_1/home/nh3">Amoniaque</a></li>
                <li class="dropdown colortextnav">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user" style="font-size: 16px;margin-right: 2px;" aria-hidden="true"></i>
                    <b><?php echo htmlspecialchars($user->getNickname());?></b><span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="/zone_1/logout"><button type="submit" class="btn btn-primary" align="center">Se Deconnecter</button></a></li>
                  </ul>
                </li>
              </ul>
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>
    </header>