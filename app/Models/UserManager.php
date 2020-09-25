<?php
require_once 'core/Manager.php';

class UserManager extends Manager{

    public function postUser($user){
        $req = self::doQuery("INSERT INTO user (username, email, firstname, lastname, userpwd, roleUser) VALUES (?,?,?,?,?,?)", array_values($user));
        return $req;
    }

    public function getUserByUsername($username){
        $req = self::doQuery("SELECT id, email, username, userpwd, firstname, lastname, roleUser FROM user WHERE username= ?", array_values(array($username)));
        $user = $req->fetch(PDO::FETCH_ASSOC);
        return $user;
    }

    public function getUserByEmail($email){
        $req = self::doQuery("SELECT id, email, username, userpwd, firstname, lastname, roleUser FROM user WHERE email= ?", array_values(array($email)));
        $user = $req->fetch(PDO::FETCH_ASSOC);
        return $user;
    }

}