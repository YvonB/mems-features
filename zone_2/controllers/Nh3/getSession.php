<?php
use google\appengine\api\users\User;
use google\appengine\api\users\UserService;

# Recherche la session de compte Google actuelle
$user = UserService::getCurrentUser();

# ne pas afficher l'erreur
ini_set("display_errors",0);error_reporting(0);