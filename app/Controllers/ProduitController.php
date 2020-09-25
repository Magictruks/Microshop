<?php

require_once 'core/Controller.php';
require_once 'app/Models/ProduitManager.php';
require_once 'app/Models/CategoryManager.php';
require_once 'app/Models/ProductCategoryManager.php';


class ProduitController extends Controller
{
	// Affichage de la page d'accueil 
	public function index()
	{
		$manager2 = new CategoryManager();
		$manager3 = new ProductCategoryManager();

		$categories = $manager2->getCategories();
		$produits = array();

		foreach($categories as $key => $category) {
			array_push($categories[$key], $manager3->getProductCategoryByCategort($category['id']));
			foreach($categories[$key][0] as $produit){
				array_push($produits,  $produit);
			}
		}

		$datas = array(
			"produits" => $produits,
			"categories" => $categories
		);
		
		$this->render($datas);
    }
    
    public function details($id)
    {
		$manager = new ProduitManager();
		$manager2 = new ProductCategoryManager();
        $datas = array(
			"produit" => $manager->getProduitById($id),
			"categories" => $manager2->getProductCategoryByProduct($id)
        );
        
        $this->render($datas);
    }

}