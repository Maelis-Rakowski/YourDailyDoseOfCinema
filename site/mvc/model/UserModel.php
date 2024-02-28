<?php

class UserModel extends Model{

    private $login;
    private $password;

    private $email;
    private $pseudo;
    
    //boolean for administrator
    private $isAdmin;

    //constructor
    public function __construct($login,$password,$email,$pseudo,$isAdmin) {
        $this->setLogin($login);
        $this->setPassword($password);
        $this->setEmail($email);
        $this->setPseudo($pseudo);
        $this->setIdAdmin($isAdmin);
        $this->$users[] = $this;
    }

    
    //Login
    public function setLogin($login){
        $this->login = $login;
    }
    public function getLogin(){
        return $this->login;
    }

    //Password
    public function setPassword($password){
        $this->password = $password;
    }
    public function getPassword(){
        return $this->password;
    }

     //Email
    public function setEmail($email){
        $this->email = $email;
    }
    public function getEmail(){
        return $this->email;
    }

    //Pseudo
    public function setPseudo($pseudo){
        $this->pseudo = $pseudo;
    }
    public function getPseudo(){
        return $this->pseudo;
    }

    //isAdmin
    public function setIsAdmin($isAdmin){
        $this->isAdmin = $isAdmin;
    }
    public function getIsAdmin(){
        return $this->isAdmin;
    }
}
?>