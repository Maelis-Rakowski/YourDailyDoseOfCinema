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

        $email = $_POST["email"];
        $pseudo = $_POST["pseudo"];
        $password = $_POST["password"];

        UserModel::create($email,$pseudo,$password);

        $this->_view = new View(array('view','login','viewConnected.php'));
        //Generate the view without data
        $this->_view->generate(array(null));
        

       
    }
}
?>