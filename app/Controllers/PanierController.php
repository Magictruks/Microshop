<?php

require_once 'core/Controller.php';
require_once 'app/Models/ProduitManager.php';
require_once 'app/Models/CommandeManager.php';

class PanierController extends Controller
{
    
	public function index()
	{
        $manager = new ProduitManager();
        //array_key_exists n 
        if($this->request){
            empty($_SESSION['somme']) ? $_SESSION['somme'] = 0 : "";
            empty($_SESSION['panier']) ? $_SESSION['panier'] = array() : "";
            $produit = $manager->getProduitById($this->request['produit']);
            $produit['quantity'] = $this->request['quantity'];
            $_SESSION['somme'] += $produit['quantity']*$produit['prix'];
            array_push($_SESSION['panier'], $produit);
        }
        // unset($this->request);
		$this->render(array());
    }
    
    public function delete($id)
    {
        $_SESSION['somme'] -= $_SESSION['panier'][$id]['prix']*$_SESSION['panier'][$id]['quantity'];
        unset($_SESSION['panier'][$id]);
        header('Location: /panier');
        exit;
    }

    public function recap(){
        $this->render(array());
    }

    public function credit()
    {
        if(empty($_SESSION['user'])){
            header('Location: /user/login');
            exit;
        }

        $manager = new CommandeManager();
        $idCommande = uniqid();
        $manager->postCommande($_SESSION['panier'], $_SESSION['user']['id'], $idCommande);
        $somme = $manager->getCommandeProductSommeById($idCommande);
        $this->render(array(
            "total" => $somme['total'],
            "idCommande" => $idCommande
        ));
    }

    public function payment($idCommande)
    {

        $manager = new CommandeManager();
        $manager->postValidCommande($idCommande);
        unset($_SESSION['panier']);
        unset($_SESSION['somme']);
        
        header('Location: /produit');
    }

}