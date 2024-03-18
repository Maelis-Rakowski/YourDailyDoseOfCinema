<?php
    require 'mvc'.DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR.'File.php';//File.php

    $url = $_SERVER['REQUEST_URI'];
    $url = ltrim($url, '/');
    $urlParts = explode('?', $url);
    $urlPaths = explode('/', $urlParts[0]);

    if ($urlPaths[0] == "admin") {
        if (isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"]) {
            unset($urlPaths[0]);
            redirect($urlPaths, 1);
        } else {
            $controller = "error";
            $action = "show401";
            //Router Creation
            require_once File::build_path(array("controller","Router.php"));

            $router = new Router($controller, $action);
            $router->routeReq();
        }
    } else {
        redirect($urlPaths, 0);
    }

    function redirect($urlPaths, $controller_index) {
        $controller = null;
        $action = null;
        switch (count($urlPaths)) {
            case 1:
                $controller = $urlPaths[$controller_index];
                break;
            case 2:
                $controller = $urlPaths[$controller_index];
                $action = $urlPaths[$controller_index + 1];
                break;
            default:
                $controller = "error";
                $action = "show404";
                break;
        }

         //Router Creation
        require_once File::build_path(array("controller","Router.php"));

        $router = new Router($controller, $action);
        $router->routeReq();
    }

?>