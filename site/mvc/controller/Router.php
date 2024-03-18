<?php

//Require all the controllers
require_once File::build_path(array("controller","ControllerHome.php"));
require_once File::build_path(array("controller", "ControllerError.php"));
require_once File::build_path(array("controller", "ControllerUser.php"));
require_once File::build_path(array("controller", "ControllerLogin.php"));
require_once File::build_path(array("controller", "ControllerMovie.php"));

class Router{

    //Variable to keep the current active controller
    private $_controller;

    private $_action;

    //Variable to keep the current active view
    private $_view;

    public function __construct($_controller = NULL, $_action = NULL)
    {
        $this->_controller = $_controller;
        $this->_action = $_action; 
    }

    //Load the controller and view to show
    public function routeReq() { 
        //if an action is set, the action will be call the linked function. Else, by default, the action is readAll
        $action = $this->_action != null ? $this->_action : 'readAll';
        $controller = $this->_controller != null ? $this->_controller : 'home';
        //build the controller class name
        $controller_class = "Controller".ucfirst($controller);

        try {
            $this->_controller = new $controller_class;
            $this->_controller->$action();
        } catch (\Throwable $th) {
            if(!class_exists($controller_class) | !method_exists($controller_class, $action)) {
                $this->_controller = new ControllerError();
                $this->_controller->show404();
            }
            echo $th;
        }
    }
}

