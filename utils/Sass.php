<?php

use ScssPhp\ScssPhp\Compiler;

class Sass{
    
    /**
     * compile : compile un fichier .scss et créer un fichier .css
     *
     * @param  mixed $sassFile
     * @return void
     */
    public static function compile($sassFile){

        $sassFilesDirectory = "app/Content/scss/";
        $cssFilesDirectory = "app/Content/css/";

        if(file_exists($sassFilesDirectory.$sassFile)){

            $cssFile = str_replace('.scss','.css',$sassFile);

            $sassFileDate = date("Ymd h:i:s", filemtime($sassFilesDirectory.$sassFile));

            if(file_exists($cssFilesDirectory.$cssFile)){
                $cssFileDate = date("Ymd h:i:s", filemtime($cssFilesDirectory.$cssFile));
            }else{
                $cssFileDate = -1;
            }

            if($sassFileDate > $cssFileDate){ // Si le fichier .scss est plus récent on compile
                $sassFileContent = file_get_contents($sassFilesDirectory.$sassFile);
                
                $sassCompiler = new Compiler();
                $sassCompiler->setFormatter("ScssPhp\ScssPhp\Formatter\Compressed"); // Minification
                
                $compilatedCss = $sassCompiler->compile($sassFileContent);

                $newCssFile = fopen($cssFilesDirectory.$cssFile,'w+');
                file_put_contents($cssFilesDirectory.$cssFile, $compilatedCss);
            }

            return "<link rel='stylesheet' href='".$cssFilesDirectory.$cssFile."' />";

        }
    }

}