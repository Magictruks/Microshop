<?php

require_once 'vendor/autoload.php';
require_once 'core/Router.php';
require_once 'utils/Sass.php';

// try/catch principal
try{

	session_start(); // Démarrage de la session

	// On créer une nouvelle instance de notre routeur
	$router = new Router();
	$router->execute($_SERVER['REQUEST_URI']); // On "analyse" l'URL saisie pour trouver une correspondance dans nos routes définies (voir Core/Router.php)

}catch(Exception $e){
	die('Error : '.$e->getMessage());
}