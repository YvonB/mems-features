<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>SDPE - IoT Order</title>
</head>
<body>
	<form id="contact" method="post" action="/contact_action">
	<fieldset><legend>Vos coordonnées</legend>
		<p><label for="nom">Nom :</label><input type="text" id="nom" name="nom" tabindex="1" /></p>
		<p><label for="email">Email :</label><input type="text" id="email" name="email" tabindex="2" placeholder="anything@[APP_NAME].appspotmail.com" /></p>
	</fieldset>
 
	<fieldset><legend>Votre message :</legend>
		<p><label for="objet">Objet :</label><input type="text" id="objet" name="objet" tabindex="3" /></p>
		<p><label for="message">Message :</label><textarea id="message" name="message" tabindex="4" cols="30" rows="8"></textarea></p>
	</fieldset>
 
	<div style="text-align:center;"><input type="submit" name="envoi" value="Envoyer ma commande !" /></div>
</form>
</body>
</html>

