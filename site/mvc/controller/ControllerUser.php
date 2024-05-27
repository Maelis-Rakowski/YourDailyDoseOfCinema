<?php
    require_once FILE::build_path(array('view','view.php'));
    require_once FILE::build_path(array('model','UserModel.php'));

    class ControllerUser {
        //variable of the view to generate
        private $_view;

        public function __construct() {      
        }

        public function details() {
            if (isset($_SESSION["pseudo"])) {
                $user = UserModel::getUserByPseudo($_SESSION["pseudo"]);
                if(!empty($user)) {
                    $user = $user[0];
                    $this->_view = new View(array('view', 'user', 'viewUser.php'));
                    $this->_view->generate(array('user' => $user));
                } else {
                    $controllerError = new ControllerError();
                    $controllerError->show404();
                }
                
            } else {
                $controllerError = new ControllerError();
                $controllerError->show401();
            }
        }
    }