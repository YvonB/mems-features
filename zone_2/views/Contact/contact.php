<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>SDPE - IoT Order</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <meta name="author" content="Yvon Benahita">
    <link rel="icon" type="image/png" href="/img/datastore-logo.png" />
	<link rel="stylesheet" type="text/css" href="/css/demo.css">
</head>
<body>
<div class="container">
<br>
<div class="panel panel-default">

	<div class="panel-heading" style="font-size: 20px;">Envoyer nous votre commande</div>
	<div class="panel-body">
	<form id="contact" method="post" action="/contact_action">
	<fieldset class="col-md-6"><legend>Vos coordonnées</legend>
		<div class="form-group"><label for="nom">Nom :</label><input class="form-control input_cmd" type="text" id="nom" name="nom" tabindex="1" /></div>
		<div class="form-group"><label for="email">Email :</label><input class="form-control input_cmd" type="text" id="email" name="email" tabindex="2" placeholder="anything@[APP_NAME].appspotmail.com" /></div>
	</fieldset>
 	<div class="clearfix"></div>
 	<br>
	<fieldset class="col-md-6"><legend>Votre message :</legend>
		<div class="form-group"><label for="objet">Objet :</label><input class="form-control input_cmd" type="text" id="objet" name="objet" tabindex="3" /></div>
		<div class="form-group"><label for="message">Message :</label><textarea class="form-control input_cmd" id="message" name="message" tabindex="4" cols="30" rows="8"></textarea></div>
	</fieldset>
 	<div class="clearfix"></div>
 	<br>
	<div style="text-align:center;"><button class="btn btn-sucess" type="submit" name="envoi">Envoyer ma commande</button></div>
	</form> <!-- end form -->

</div><!-- end panel body -->
</div> <!-- end panel default -->
</div> <!-- end container -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
</body>
</html>

