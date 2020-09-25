<?php

class Router{

    protected $routes = array();

    public function __construct()
    {
        // On ajoute nos routes...

        /**
         * Zone du backoffice
         */
        
        $this->addRoute('/(admin)/{0,1}([a-z]*)/{0,1}([a-zA-Z]*)/{0,1}(.*)', function($area, $controller, $action, $params){
            self::render("administration", $controller, $action, $params);
        });

        $this->addRoute('/([a-z]*)/{0,1}([a-zA-Z]*)/{0,1}(.*)/{0,1}(.*)', function($controller, $action, $id, $postname){
            self::render(null, $controller, $action, $id); 
        });

        
        /**
         * Cette route est la route générique, elle va capter ce type d'URL :
         * /
         * /blog
         * /blog/post
         * /blog/post/?id={id}
         */ 
	    $this->addRoute('/([a-z]*)/{0,1}([a-zA-Z]*)/{0,1}([0-9]*)', function($controller, $action, $params){           
            self::render(null, $controller, $action, $params);
        });

    }

        
    /**
     * addRoute : permet l'ajout de nouvelles routes
     *
     * @param  mixed $pattern
     * @param  mixed $callback
     * @return void
     */
    public function addRoute($pattern, $callback) {
		$pattern = '/^' . str_replace('/', '\/', $pattern) . '$/';
        $this->routes[$pattern] = $callback;
	}
		
	/**
	 * execute : parcours les routes enregistrées et trouve la correspondance dans l'URL
	 *
	 * @param  mixed $url
	 * @return void
	 */
	public function execute($url) {
		foreach ($this->routes as $pattern => $callback) {
			if (preg_match($pattern, $url, $params)) {
                array_shift($params);
                return call_user_func_array($callback, array_values($params));
        	}
        }        
	}

        
    /**
     * render : permet d'instancier le bon Controleur et d'éxecuter l'action désirée
     *
     * @param  mixed $controllerName
     * @param  mixed $actionName
     * @param  mixed $param
     * @return void
     */
    public static function render($area,$controllerName,$actionName,$param = null){

        $dir = !empty($area) ? $area : "app"; // app = dossier public

        // $namespace = ucfirst($dir.'\Controllers');

        if(empty($controllerName)){ // Par défaut on affiche la page d'accueil
            $cont = ($area == "administration") ? "DashboardController" : "HomeController";
            require_once $dir.'/Controllers/'.$cont.'.php';
            $controller = new $cont();
            $controller->setArea($dir);
            $controller->index();
        }else{
        
            $controllerClassName = ucfirst($controllerName).'Controller'; // BlogController
            $controllerFileName = $controllerClassName.'.php'; // BlogController.php
    
            if(!file_exists($dir.'/Controllers/'.$controllerFileName))
                throw new Exception("Le controleur n'existe pas");
    
            require_once $dir.'/Controllers/'.$controllerFileName;
    
            $controller = new $controllerClassName(); // new BlogController()
            $controller->setArea($dir);
            
            if(!empty($actionName)){
                $action = $actionName;
                if(method_exists($controller, $action)){
                    $controller->addRequest("action",$action);
                    $controller->$action($param); // Ici on peut passer $param directement dans la méthode
                }else{
                    $controller->index();
                }
            }else{
                $controller->index();
            }
        }
    
    }

    
}