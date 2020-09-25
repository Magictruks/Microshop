<?php

require_once 'core/Controller.php';
require_once 'app/Models/UserManager.php';

class UserController extends Controller
{
	// Affichage de la page d'accueil 
	public function index()
	{
        empty($_SESSION['user']) ? header('Location: /produit') : $this->render(array());
		
    }
    
    public function register()
	{
        if(empty($_SESSION['user'])){
            $manager = new UserManager();
            if(!empty($this->request['email']) && !empty($this->request['username']) && !empty($this->request['firstname']) && !empty($this->request['lastname']) && !empty($this->request['userpwd'])){
                unset($this->request['action']);
                $this->request['userpwd'] = password_hash($this->request['userpwd'], PASSWORD_BCRYPT);
                $this->request['roleUser'] = 'user';
                var_dump($this->request);
                $user = $manager->postUser($this->request);
                if(!$user)
                    throw new Exception("Requete invalide");
                
                header('Location: /produit');
                exit;
    
            }
    
            $this->render(array());
        } else {
            header('Location: /user');
            exit;
        }
    }
    
    public function login()
    {
        if(empty($_SESSION['user'])){
            $manager = new UserManager();
            if(!empty($this->request['email']) && !empty($this->request['userpwd'])){
                unset($this->request['action']);
    
                $user = $manager->getUserByEmail($this->request['email']);
    
                if(!$user)
                    throw new Exception("Identifiant invalide");
    
                if(password_verify($this->request['userpwd'], $user['userpwd'])){
                    $_SESSION['user'] = $user;
                    unset($_SESSION['user']['userpwd']);
    
                    header('Location: /user');
                    exit;
                }
    
            }
            $this->render(array());
        } else {
            header('Location: /user');
            exit;
        }
    }

    public function logout()
    {
        if(!empty($_SESSION['user'])){
            session_destroy();
            header('Location: /produit');
            exit;
        } else {
            header('Location: /produit');
            exit;
        }
        
    }

}