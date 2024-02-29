<?php
require_once FILE::build_path(array('model','Model.php'));
class UserModel extends Model{

    private $id;
    private $password;
    private $email;
    private $pseudo;    
    private $isAdmin;

    //constructor    
    public function __construct($id = NULL, $email = NULL, $pseudo = NULL, $password = NULL, $isAdmin = NULL) {
        if (!is_null($id) && !is_null($email) && !is_null($pseudo) && !is_null($password) && !is_null($isAdmin)) {
            $this->setId($id);
            $this->setPassword($password);
            $this->setEmail($email);
            $this->setPseudo($pseudo);
            $this->setIsAdmin($isAdmin);
        }
    }

    public static function getUserById($id){
        $sql = "SELECT * FROM users WHERE id = :user_id;";
        $rep = Model::getPDO() -> prepare($sql);
        $value = array(
            "user_id" => $id,
        );
        $rep->execute($value);
        $rep->setFetchMode(PDO::FETCH_CLASS, "UserModel");
        return $rep->fetchAll();
    }

    public static function deleteUserById($id){
        $sql = "DELETE FROM users WHERE id = :user_id;";
        $rep = Model::getPDO() -> prepare($sql);
        $value = array("user_id" => $id);
        $rep->execute($value);
    }

    public static function updateUser($user_id, $user_password, $user_email, $user_pseudo, $user_isAdmin) {
        $sql = "UPDATE users 
        SET email = :user_email, pseudo = :user_pseudo, password = :user_password, isAdmin = :user_isAdmin
        WHERE id = :user_id";
        $rep = Model::getPDO() -> prepare($sql);
        $value = array(
            "user_id" => $user_id,
            "user_password" => $user_password,
            "user_email" => $user_email,
            "user_pseudo" => $user_pseudo,
            "user_isAdmin" => $user_isAdmin
        );
        $rep->execute($value);
        $rep->setFetchMode(PDO::FETCH_CLASS, "UserModel");
        return $rep->fetchAll();
    }
    
    public static function create($email, $pseudo, $password) {
        $sql = "INSERT INTO users (email, pseudo, password, isAdmin) VALUES (:email, :pseudo, :password, :isAdmin)";
        $req = Model::getPDO()->prepare($sql);

        $values = array(
            "email" => $email,
            "pseudo" => $pseudo,
            "password" => $password,
            "isAdmin" => 0
        );
        
        $req->execute($values);
        $req->closeCursor();
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