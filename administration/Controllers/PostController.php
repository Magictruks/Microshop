<?php
require_once 'administration/Controllers/AdminController.php';
require_once 'administration/Models/PostManager.php';
require_once 'administration/Models/CategoryManager.php';
require_once 'administration/Models/ProductCategoryManager.php';


class PostController extends AdminController{

    public function index(){

        $manager = new PostManager();

        $data = array(
            "products" => $manager->getPosts()
        );
        $this->render($data);
    }

    public function add(){

        $manager = new PostManager();
        $manager2 = new CategoryManager();
        $manager3 = new ProductCategoryManager();

        if(empty($_POST)){
            $data = array(
                "categories" => $manager2->getCategories()
            );
            $this->render($data);
        }

        if(empty($this->request['label'])){
            throw new Exception("Le label est vide");
        }

        if(empty($this->request['description'])){
            throw new Exception("La description est vide");
        }

        if(empty($this->request['imageUrl'])){
            throw new Exception("L' imageUrl est vide");
        }

        if(empty($this->request['prix'])){
            throw new Exception("Le prix est vide");
        }

        $category = $this->request['category'];
        unset($this->request['category']);
        unset($this->request['action']);
        
        $post = $manager->postPost($this->request);
        var_dump($post);
        if(!$post){
            throw new Exception("Requete invalide");
        }

        $manager3->postProductCategory($category, $post);
        header('Location: /admin/post');
        exit;

    }

    public function edit($id){

        $manager = new PostManager();

        if(empty($_POST)) {
            $data = array(
                "product" => $manager->getPostById($id)
            );
            $this->render($data);
        }

        if(empty($this->request['label'])){
            throw new Exception("Le label est vide");
        }

        if(empty($this->request['description'])){
            throw new Exception("La description est vide");
        }

        if(empty($this->request['imageUrl'])){
            throw new Exception("L' imageUrl est vide");
        }

        if(empty($this->request['prix'])){
            throw new Exception("Le prix est vide");
        }

        unset($this->request['action']);
        $post = $manager->editPost($this->request, $id);
        if(!$post){
            throw new Exception("Requete invalide");
        }

        header('Location: /admin/post/edit/'.$id);
        exit;
        
    }

    public function delete($id){
        $manager = new PostManager();
        $manager->deletePost($id);
        header('Location: /admin/post');
        exit;
    }

}