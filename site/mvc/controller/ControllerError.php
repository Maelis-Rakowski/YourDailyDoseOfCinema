<?php
require_once FILE::build_path(array('view','view.php'));
class ControllerError {
    private $_view;
    public function __construct() {
      
    }

    public function show404() {
        $this->_view = new View(array('view', '404.php'));
        $this->_view->generate(array(null));
    }

    public function show401() {
        $this->_view = new View(array('view', '401.php'));
        $this->_view->generate(array(null));
    }
}
?>