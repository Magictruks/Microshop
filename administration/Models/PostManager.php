<?php
require_once 'core/Manager.php';
require_once 'administration/Models/ProductCategoryManager.php';

class PostManager extends Manager{

    public function postPost($product){

        $product = array_reverse($product);
        $product['id'] = uniqid();
        $product = array_reverse($product);
        
        self::doQuery("INSERT INTO product (id, label, `description`, imageUrl, prix) VALUES (?,?,?,?,?)", array_values($product));
        return $product['id'];
    }

    public function getPosts(){

        $req = self::doQuery("SELECT * FROM product");
        $posts = $req->fetchAll(PDO::FETCH_ASSOC);
        return $posts;
    }

    public function getPostById($id){
        $req = self::doQuery("SELECT * FROM product WHERE id= ?", array_values(array($id)));
        $post = $req->fetch(PDO::FETCH_ASSOC);
        return $post;
    }

    public function editPost($product, $id){
        array_push($product, $id);
        $req = self::doQuery("UPDATE product SET label = ?, `description` = ?, imageUrl = ?, prix = ? WHERE id = ?", array_values($product));
        return $req;
    }

    public function deletePost($id){
        $req = self::doQuery("DELETE FROM product WHERE id= ?", array_values(array($id)));
        return $req;
    }


}