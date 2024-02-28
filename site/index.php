<?php
	/*
	// initialisation de la session
	// INDISPENSABLE À CETTE POSITION SI UTILISATION DES VARIABLES DE SESSION.
	 ;*/



    require 'oo'.DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR.'File.php';//File.php

    //Gestion des controller à afficher en fonction de l'url, pour en savoir plus, il faut aller voir le routeur !
    
    //Router Creation
    require_once File::build_path(array("controller","Router.php"));

    $router = new Router();
    $router->routeReq();

?>