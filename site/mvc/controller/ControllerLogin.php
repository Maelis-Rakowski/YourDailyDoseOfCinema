<?php
require_once FILE::build_path(array('view','view.php'));
require_once FILE::build_path(array('model','UserModel.php'));

class ControllerLogin {

    //variable of the view to generate
    private $_view;

    public function __construct() {      
    }

    public function readAll() {               
        $this->_view = new View(array('view','login','viewLogin.php'));
        //Generate the view without data
        $this->_view->generate(array(null));
    }

    public function signin() {
        // $user = new ModelUser($_POST["email"],$_POST["pseudo"],$_POST["password"],0);

        $req =Model::getPDO()->prepare('INSERT INTO user (id,email, pseudo,password,isAdmin) VALUES (5,'.$_POST["email"].','.$_POST["pseudo"].','.$_POST["password"].',0)');


        $req =Model::getPDO()->prepare('SELECT * FROM '.$table);
        $req->execute();
        $req->closeCursor();
    }
}
?>