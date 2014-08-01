<?php
Class Help extends Controllers {
    
    function __construct(){
        parent::__construct();
    }
    function index(){
        $this->view->title = 'Ayuda'; 
        $this->view->render('header');
        $this->view->render('help/index');
        $this->view->render('footer');
    }
}
?>
