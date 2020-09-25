<?php
require_once 'core/Manager.php';

class UserManager extends Manager{

    public function getUsers(){
        $req = self::doQuery("SELECT id, username, email, firstname, lastname, roleUser FROM user");
        return $req;
    }

    public function getUserById($id){
        $data = array($id);
        $req = self::doQuery("SELECT id, username, email, firstname, lastname, roleUser FROM user WHERE id = ?", array_values($data));
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    public function getUserByUsername($email){
        $req = self::doQuery("SELECT id, username, email, userpwd, firstname, lastname, roleUser FROM user WHERE email= ?", array_values(array($email)));
        $user = $req->fetch(PDO::FETCH_ASSOC);
        return $user;
    }

    public function postUser($user){
        array_push($user, "azerty");
        $req = self::doQuery("INSERT INTO user (username, email, firstname, lastname, roleUser, userpwd) VALUES (?,?,?,?,?,?)", array_values($user));
        return $req;
    }
    
    public function editUser($user, $id){
        array_push($user, $id);
        $req = self::doQuery("UPDATE user SET `email` = ?, `username` = ?, `firstname` = ?, `lastname` = ? WHERE id = ?", array_values($user));
        return $req;
    }

    public function deleteUser($id){
        $req = self::doQuery("DELETE FROM user WHERE id= ?", array_values(array($id)));
        return $req;
    }
}