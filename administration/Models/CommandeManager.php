<?php
require_once 'core/Manager.php';

class CommandeManager extends Manager{

    public function getCommandes(){
        $req = self::doQuery("SELECT * FROM commande
                                INNER JOIN product_commande ON product_commande.id_commande = commande.id
                                INNER JOIN product ON product_commande.id_product = product.id
                                GROUP BY commande.id");
        $commande = $req->fetchAll(PDO::FETCH_ASSOC);
        return $commande;
    }

    public function getCommandeValid(){
        $req = self::doQuery("SELECT
        (SELECT COUNT(*) FROM commande) as total,
        (SELECT COUNT(*) FROM commande WHERE validate = ?) as totalvalidate,
		(SELECT SUM(product.prix * product_commande.quantity)
         FROM commande 
         INNER JOIN product_commande ON commande.id = product_commande.id_commande
         INNER JOIN product ON product.id = product_commande.id_product) as totalprix", array_values(array(1)));
        return $req->fetchAll();
    }
}

