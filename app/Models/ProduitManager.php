<?php
require_once 'core/Manager.php';

class ProduitManager extends Manager{

    public function getProduits(){
        $req = self::doQuery("SELECT * FROM product ORDER BY created_at DESC");
        $posts = $req->fetchAll(PDO::FETCH_ASSOC);
        return $posts;
    }

    public function getProduitById($id){
        $data = array($id);
        $req = self::doQuery("SELECT * FROM product WHERE id= ?", array_values($data));
        $post = $req->fetch(PDO::FETCH_ASSOC);
        return $post;
    }

}