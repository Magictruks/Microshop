<?php

require 'administration/Controllers/AdminController.php';
require 'administration/Models/CommandeManager.php';

class DashboardController extends AdminController{ // On hérite ici de AdminController pour tous les contrôleur "d'interface"

    public function index(){

        $manager = new CommandeManager();

        $data = array(
            "user" => $_SESSION['user'],
            "commandes" => $manager->getCommandeValid()[0]
        );
        $this->render($data); // admin/Views/Dashboard/index.phtml
    }

}