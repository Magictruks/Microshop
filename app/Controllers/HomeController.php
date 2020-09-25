<?php

require_once 'core/Controller.php';

class HomeController extends Controller
{
	// Affichage de la page d'accueil 
	public function index()
	{
		header('Location: /produit');
		$this->render(array());
	}

}