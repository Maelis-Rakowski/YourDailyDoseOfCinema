<?php
    require 'mvc'.DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR.'File.php';//File.php

    $url = $_SERVER['REQUEST_URI'];
    $url = ltrim($url, '/');
    $urlParts = explode('/', $url);
    $controller = null;
    $action = null;

    switch (count($urlParts)) {
        case 1:
            $controller = $urlParts[0];
            break;
        case 2:
            $controller = $urlParts[0];
            $action = $urlParts[1];
            break;
        default:
            $controller = "404";
            $action = "show404";
            break;
    }

    //Router Creation
    require_once File::build_path(array("controller","Router.php"));

    $router = new Router($controller, $action);
    $router->routeReq();

?>