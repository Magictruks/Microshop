<?php

require_once 'core/Controller.php';
require_once 'app/Models/ProduitManager.php';
require_once 'app/Models/CategoryManager.php';
require_once 'app/Models/ProductCategoryManager.php';


class CategoryController extends Controller
{
	public function index()
	{
		$manager = new CategoryManager();

		$datas = array(
			"categories" => $manager->getCategories()
		);
		
		$this->render($datas);
    }
    
    public function details($id)
    {
		$manager = new CategoryManager();
        $manager2 = new ProductCategoryManager();

        $datas = array(
            "category" => $manager->getCategoryById($id),
			"produits" => $manager2->getProductCategoryByCategort($id)
        );
        
        $this->render($datas);
    }

}