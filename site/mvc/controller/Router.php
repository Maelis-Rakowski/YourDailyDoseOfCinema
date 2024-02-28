<?php

//Require all the controllers
require_once File::build_path(array("controller","ControllerHome.php"));



class Router{

    //Variable to keep the current active controller
    private $_controller;

    //Variable to keep the current active view
    private $_view;

    //Load the controller and view to show
    public function routeReq(){
       
        //if an action is set, the action will be call the linked function. Else, by default, the action is readAll
        if(isset($_GET['action'])){

            $action=$_GET['action'];
        }
        else {
            $action='readAll';
        }
        
        //call the linked controller automatically based on the name of the file.
        if(isset($_GET['controller'])) {
            $controller = $_GET['controller'];
            $controller_class = "Controller".ucfirst($controller);
            if(class_exists($controller_class)) {
               
                //Create a new controller
                $this->_controller = new $controller_class;

                //Call the specified fonction based on the action name (action and function have to have the same spelling)
                $this->_controller->$action();
            }
            else  $action='error';
        }

        //if no controller is set, it's the readAll of the default page
        else {
            
             $home = new ControllerHome();
             $home->readAll();

        }
    }
}