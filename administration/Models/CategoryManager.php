<?php
require_once 'core/Manager.php';

class CategoryManager extends Manager{

    public function postCategory($category){
        $req = self::doQuery("INSERT INTO category (`name`) VALUES (?)", array_values($category));
        return $req;
    }

    public function getCategories(){
        $req = self::doQuery("SELECT * FROM category");
        $posts = $req->fetchAll(PDO::FETCH_ASSOC);
        return $posts;
    }

    public function getCategoryById($id){
        $req = self::doQuery("SELECT * FROM category WHERE id= ?", array_values(array($id)));
        $post = $req->fetch(PDO::FETCH_ASSOC);
        return $post;
    }

    public function editCategory($category, $id){
        array_push($category, $id);
        $req = self::doQuery("UPDATE category SET `name` = ? WHERE id = ?", array_values($category));
        return $req;
    }

    public function deleteCategory($id){
        $req = self::doQuery("DELETE FROM category WHERE id= ?", array_values(array($id)));
        return $req;
    }


}