<?php
//namespace Administration\Controllers;

require_once 'core/Controller.php';
require_once 'administration/Models/UserManager.php';

class AdminController extends Controller{

    function __construct(){
        parent::__construct(); // Appel du constructeur de Controller

        // On vérifie qu'un utilisateur est connecté
        if(empty($_SESSION['user'])){ // Si non on redirige versd la page de connection
            header('Location: /admin/authentification');
            exit;
        } else {
            $manager = new UserManager();
            $user = $manager->getUserByUsername($_SESSION['user']['email']);
            if($user['roleUser'] !== "admin"){
                header('Location: /admin/authentification');
                exit;
            }
        }

        // Si oui on continue ...
    }

    public function index(){
        /* ne sert pas à grande chose ici */
    }

}