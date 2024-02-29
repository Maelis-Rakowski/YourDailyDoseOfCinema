<?php
require_once FILE::build_path(array('view','view.php'));
class ControllerHome {

    //variable of the view to generate
    private $_view;

    public function __construct(){}

    public function readAll() {
        $this->_view = new View(array('view', 'home', 'viewHome.php'));
        //Generate the view without data
        $this->_view->generate(array(null));
    }
}
?>