<?php
require_once FILE::build_path(array('view','view.php'));
require_once FILE::build_path(array('model','UserModel.php'));
class ControllerUser {

    //variable of the view to generate
    private $_view;

    public function __construct(){
      
    }

    public function readAll(){
        $this->showUsers();
    }


    private function showUsers() {       
        $this->_view = new View(array('view','user','viewUserList.php'));
        //Generate the view without data
        $users = UserModel::GetAll("users","UserModel");
        $this->_view->generate(array('users'=>$users));
    }
}
?>