<?php
require_once FILE::build_path(array('view','view.php'));
class Controller404 {
    private $_view;
    public function __construct(){
      
    }

    public function show404() {
        $this->_view = new View(array('view', '404.php'));
        $this->_view->generate(array(null));
    }
}
?>