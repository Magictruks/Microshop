<?php
require_once 'administration/Controllers/AdminController.php';
require_once 'administration/Models/CategoryManager.php';
require_once 'administration/Models/ProductCategoryManager.php';


class CategoryController extends AdminController{

    public function index(){

        $manager = new CategoryManager();
        $manager2 = new ProductCategoryManager();
        $categories = $manager->getCategories();

        $products = array();
        foreach($categories as $category){
            array_push($products, $manager2->getProductCategoryByCategort($category['id']));
        }

        $data = array(
            "categories" => $manager->getCategories(),
            "products" => $products
        );
        $this->render($data);
    }

    public function add(){

        $manager = new CategoryManager();

        if(empty($_POST)){
            $this->render(array());
        }

        if(empty($this->request['name'])){
            throw new Exception("Le nom est vide");
        }

        unset($this->request['action']);
        $post = $manager->postCategory($this->request);
        if(!$post){
            throw new Exception("Requete invalide");
        }

        header('Location: /admin/category');
        exit;

    }

    public function edit($id){

        $manager = new CategoryManager();

        if(empty($_POST)) {
            $data = array(
                "category" => $manager->getCategoryById($id)
            );
            $this->render($data);
        }

        if(empty($this->request['name'])){
            throw new Exception("Le nom est vide");
        }

        unset($this->request['action']);
        $post = $manager->editCategory($this->request, $id);
        if(!$post){
            throw new Exception("Requete invalide");
        }

        header('Location: /admin/category');
        exit;
        
    }

    public function delete($id){
        $manager = new CategoryManager();
        $manager->deleteCategory($id);
        header('Location: /admin/category'); 
        
        exit;
    }

}