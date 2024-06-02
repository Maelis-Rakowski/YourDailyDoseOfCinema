<?php
require_once FILE::build_path(array('view','view.php'));
class ControllerError {
    private $_view;
    public function __construct() {
      
    }

    /**
     * Generate the 404 page
     */
    public function show404() {
        $this->_view = new View(array('view', '404.php'));
        $this->_view->generate(array(null));
    }

    /**
     * Generate the 401 page
     */
    public function show401() {
        $this->_view = new View(array('view', '401.php'));
        $this->_view->generate(array(null));
    }
}
?>