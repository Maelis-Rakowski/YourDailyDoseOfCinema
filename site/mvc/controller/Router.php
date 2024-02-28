<?php

//Require all the controllers
require_once File::build_path(array("controller","ControllerHome.php"));
require_once File::build_path(array("controller", "Controller404.php"));

class Router{

    //Variable to keep the current active controller
    private $_controller;

    //Variable to keep the current active view
    private $_view;

    //Load the controller and view to show
    public function routeReq(){
       
        //if an action is set, the action will be call the linked function. Else, by default, the action is readAll
        $action = isset($_GET['action']) ? $_GET['action'] : 'readAll';
        $controller = isset($_GET['controller']) ? $_GET['controller'] : 'home';
        //build the controller class name
        $controller_class = "Controller".ucfirst($controller);

        try {
            $this->_controller = new $controller_class;
            $this->_controller->$action();
        } catch (\Throwable $th) {
            $this->_controller = new Controller404();
            $this->_controller->show404();
        }
    }
}