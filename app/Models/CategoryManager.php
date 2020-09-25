<?php
require_once 'core/Manager.php';

class CategoryManager extends Manager{

    public function getCategories(){
        $req = self::doQuery("SELECT * FROM category ORDER BY `name` DESC");
        $posts = $req->fetchAll(PDO::FETCH_ASSOC);
        return $posts;
    }

    public function getCategoryById($id){
        $data = array($id);
        $req = self::doQuery("SELECT * FROM category WHERE id=", array_values($data));
        $post = $req->fetch(PDO::FETCH_ASSOC);
        return $post;
    }
}