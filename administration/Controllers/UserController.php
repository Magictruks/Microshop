<?php

require_once 'administration/Controllers/AdminController.php';
require_once 'administration/Models/UserManager.php';

class UserController extends AdminController{

    function __construct(){
        parent::__construct(); // Appel du constructeur de Controller

        // On vérifie qu'un utilisateur est connecté
        if(empty($_SESSION['user']) || $_SESSION['user']['roleUser'] != 'admin'){ // Si non on redirige versd la page de connection
            header('Location: /admin/authentification');
            exit;
        }

        // Si oui on continue ...
    }

    public function index(){

        $manager = new UserManager();

        $data = array(
            "users" => $manager->getUsers()
        );

        $this->render($data); 
    }

    public function add(){
        
        $manager = new UserManager();

        if(empty($_POST)){
            $data = array(
                
            );
            $this->render($data);
        }

        if(empty($this->request['email'])){
            throw new Exception("Le label est vide");
        }

        if(empty($this->request['username'])){
            throw new Exception("La description est vide");
        }

        if(empty($this->request['firstname'])){
            throw new Exception("L' imageUrl est vide");
        }

        if(empty($this->request['lastname'])){
            throw new Exception("Le prix est vide");
        }

        if(empty($this->request['roleUser'])){
            throw new Exception("Le prix est vide");
        }
        
        unset($this->request['action']);
        
        $post = $manager->postUser($this->request);
        var_dump($post);
        if(!$post){
            throw new Exception("Requete invalide");
        }

        header('Location: /admin/user');
        exit;
    }

    public function edit($id){

        $manager = new UserManager();

        if(empty($_POST)){
            $data = array(
                'user' => $manager->getUserById($id)
            );
            $this->render($data);
        }
        var_dump($this->request);
        if(empty($this->request['email'])){
            throw new Exception("Le label est vide");
        }

        if(empty($this->request['username'])){
            throw new Exception("La description est vide");
        }

        if(empty($this->request['firstname'])){
            throw new Exception("L' imageUrl est vide");
        }

        if(empty($this->request['lastname'])){
            throw new Exception("Le prix est vide");
        }
        
        unset($this->request['action']);
        
        $post = $manager->editUser($this->request, $id);
        var_dump($post);
        if(!$post){
            throw new Exception("Requete invalide");
        }

        header('Location: /admin/user');
        exit;
    }

    public function delete($id){
        $manager = new UserManager();
        $manager->deleteUser($id);
        header('Location: /admin/user'); 
        
        exit;
    }


}