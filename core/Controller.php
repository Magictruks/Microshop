<?php

require_once 'core/View.php';

abstract class Controller{

    protected $request;
    protected $area;

    public function __construct(){
        $this->request = array_merge($_GET, $_POST);
    }

    public function setArea($a){
        $this->area = $a;
    }

    public function getArea(){
        return $this->area;
    }

    /*
     Méthode abstraite correspondant à l'action par défaut
     Oblige les classes dérivées à implémenter cette action par défaut
    */
    public abstract function index();
    
    /**
     * render
     *
     * @param  mixed $data
     * @param  mixed $filename
     * @return void
     */
    public function render($data, $filename = null){
        $controllerClassName = get_class($this); // ex: HomeController
        $actionName = !empty($this->request['action']) ? $this->request['action'] : "index";
        $view = new View($this->getArea(), $controllerClassName, $actionName, $filename);
        $view->render($data);
    }
    
    /**
     * addRequest
     *
     * @param  mixed $key
     * @param  mixed $value
     * @return void
     */
    public function addRequest($key, $value){
        $this->request[$key] = $value;
    }

}