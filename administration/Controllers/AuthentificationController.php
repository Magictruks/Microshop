<?php

require_once 'core/Controller.php';
require_once 'administration/Models/UserManager.php';

class AuthentificationController extends Controller{

    public function index(){
        session_destroy(); // On détruit la session
        $this->render(array()); // admin/Views/Authentification/index.phtml
    }

    public function loginPost(){
        // Identification de l'utilisateur
        $manager = new UserManager();
        
        if(empty($this->request['email']))
            throw new Exception("Le nom d'utilisateur est vide");
        
        if(empty($this->request['userpwd']))
            throw new Exception("Le mot de passe doit être saisi");

        $user = $manager->getUserByUsername($this->request['email']);

        if(!$user)
            throw new Exception("Identifiant invalide");

        if($user['roleUser'] == "admin")
            if(password_verify($this->request['userpwd'], $user['userpwd'])){
                // Mise en session de l'utilisateur authentifié
                $_SESSION['user'] = $user;
                unset($_SESSION['user']['userpwd']); // On supprime le mot de passe de la session

                // Redirection vers le tableau de bord 
                header('Location: /admin/dashboard');exit;
            }
        header('Location: /admin/authentification');exit;
    }


}