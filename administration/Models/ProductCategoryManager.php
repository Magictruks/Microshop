<?php
require_once 'core/Manager.php';

class ProductCategoryManager extends Manager{

    public function postProductCategory($idcategories, $idpost){
        $data = array();
        foreach($idcategories as $key => $idcategory){
                $data += ["id_category".$key => $idcategory];
                $data += ["id_product".$key => $idpost];
                $value .= "(?, ?),";
        }
        $value = rtrim($value, ",");

        $req = self::doQuery("INSERT INTO product_category (id_category, id_product) VALUES ". $value."", array_values($data));
        if(!$req){
            throw new Exception("Requete invalide ProductCategory");
        }
    }

    public function getProductCategoryByProduct($id){
        $req = self::doQuery("SELECT category.id, category.name FROM category INNER JOIN product_category ON category.id = product_category.id_category WHERE id_product = ?", array_values(array($id)));
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductCategoryByCategort($id){
        $req = self::doQuery("SELECT product.id, product.label, product.description, product.imageUrl, product.prix, product.created_at FROM product INNER JOIN product_category ON product.id = product_category.id_product WHERE id_category = ?", array_values(array($id)));
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductCategoryCountByCategory($id){
        $req = self::doQuery("SELECT category.id, COUNT(category.id)
        FROM category
        INNER JOIN product_category
        ON product_category.id_category = ?
        GROUP BY = ?", array_values(array($id, $id)));
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }
}