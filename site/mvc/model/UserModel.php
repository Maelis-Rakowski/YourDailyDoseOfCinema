<?php
require_once FILE::build_path(array('model','Model.php'));
class UserModel extends Model{

    private $id;
    private $password;

    private $email;
    private $pseudo;
    
    //boolean for administrator
    private $isAdmin;

    //constructor    
    public function __construct($email,$pseudo,$password,$isAdmin) {
        $this->setPassword($password);
        $this->setEmail($email);
        $this->setPseudo($pseudo);
        $this->setIsAdmin($isAdmin);
    }
    
    //id
    public function setId($id){
        $this->id = $id;
    }
    public function getId(){
        return $this->id;
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