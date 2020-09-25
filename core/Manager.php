<?php

abstract class Manager
{    
    /**
     * getDb : connexion à la BDD
     *
     * @return void
     */
    protected static function getDb(){
        try{
            $bdd = new PDO('mysql:host=localhost;dbname=microshop;charset=utf8','root',''); // PHP
        }catch(Exception $e){
            die('Erreur : '.$e->getMessage());
        }
        return $bdd;
    }
    
    /**
     * doQuery : permet d'éxecuter une requête direct ou preparée
     *
     * @param  mixed $sql
     * @param  mixed $params
     * @return void
     */
    protected static function doQuery($sql, array $params = null){
        
            $result = self::getDb()->prepare($sql);
            $result->execute($params);

        return $result;
    }

}
