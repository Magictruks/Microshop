<?php
require_once 'core/Manager.php';

class CommandeManager extends Manager{


    public function getCommandes(){
        $req = self::doQuery("SELECT * FROM commande
                                INNER JOIN product_commande ON product_commande.id_commande = commande.id
                                INNER JOIN product ON product_commande.id_product = product.id");
        $commande = $req->fetchAll(PDO::FETCH_ASSOC);
        return $commande;
    }

    public function getCommandeValid(){
        $req = self::doQuery("SELECT
        (SELECT COUNT(*) FROM commande) as total,
        (SELECT COUNT(*) FROM commande WHERE validate = 1) as totalvalidate");
        return $req;
    }

    public function postCommande($produits, $idUser, $idCommande){
        $commande = array($idCommande, $idUser, 0);
        self::doQuery("INSERT INTO commande (id, id_user, validate) VALUES (?, ?, ?)", array_values($commande));
        $value = "";
        $data = array();
        foreach($produits as $key => $produit){
            $data += ['id_product'.$key => $produit['id']];
            $data += ['id_commande'.$key => $idCommande];
            $data += ['quantity'.$key => $produit['quantity']];
            $value .= "(?, ?, ?),";
        }
        
        $value = rtrim($value, ",");
        self::doQuery("INSERT INTO product_commande (id_product, id_commande, quantity) VALUES ". $value."", array_values($data));
    }

    public function getCommandeProductSommeById($idCommande){
        $data = ($idCommande);
        $req = self::doQuery("SELECT commande.id, SUM(product.prix * product_commande.quantity) as total
        FROM commande 
        INNER JOIN product_commande ON commande.id = product_commande.id_commande
        INNER JOIN product ON product.id = product_commande.id_product
        WHERE commande.id = '" . $idCommande . "'");
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    public function postValidCommande($idCommande){
        $data = array(1, $idCommande);
        $req = self::doQuery("UPDATE commande SET validate = ? WHERE id = ?", array_values($data));
        return $req;
    }
}

