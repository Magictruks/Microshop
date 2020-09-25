<?php

class View{
    private $fileName;
    public $layout;
    public $area;

    public function __construct($area, $controllerClassName, $actionName, $fileName = null){

        $this->setArea($area); // On définit la zone de la view

        $fileDirectory = $area."/Views/"; // Nos vues se situeront toujours dans ce dossier
        $directoryName = str_replace('Controller', '', $controllerClassName); // ex : HomeController => Home
        $fileDirectory = $fileDirectory . $directoryName . '/'; // => app/Views/Home/

        if(empty($fileName)){
            if(!empty($actionName)){
                $this->fileName = $fileDirectory . $actionName . ".phtml";
            }else{
                $this->fileName = $fileDirectory . "index.phtml"; // => app/Views/Home/index.phtml
            }
        }else{
            $this->fileName = $fileDirectory . $fileName;
        }
    } 

    public function setArea($a){
        $this->area = $a;
    }

    public function getArea(){
        return $this->area;
    }
    
    /**
     * getFileName 
     *
     * @return void
     */
    public function getFileName(){
        return $this->fileName;
    }
    
    /**
     * render
     *
     * @param  mixed $datas
     * @return void
     */
    public function render($datas){
        extract($datas);
        $bodyContent = $this->renderContent($datas); // On genère le contenu de la vue
        if(isset($this->layout)){
            if(!empty($this->layout)){
                 require_once $this->getArea().'/Views/_Shared/' . $this->layout; // Affichage du layout de la vue
            }else{
                echo $bodyContent;
            }
        }else{
            require_once $this->getArea().'/Views/_Shared/layout.phtml'; // Affichage du layout par defaut
        }
    }
    
    /**
     * renderContent
     *
     * @param  mixed $datas
     * @return void
     */
    private function renderContent($datas){
        if(file_exists($this->getFileName())){
            extract($datas);
            ob_start(); // Début de la tamporisation
            require $this->getFileName(); // ex : require 'app/Views/Home/index.phtml'
            return ob_get_clean(); // Arrêt de la temporisation et renvoi du tampon de sortie
        }else{
            throw new Exception("Fichier '".$this->getFileName()."' introuvable");
        }
    }

}
