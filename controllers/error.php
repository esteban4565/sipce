<?php

class Error extends Controllers{
    function __construct() {
        parent::__construct();   
    }
    function index(){
        $this->view->title = 'Error'; 
        $this->view->msg = 'Error pagina solicitada no existe...';
        $this->view->render('header');
        $this->view->render('error/index');
        $this->view->render('footer');
    }
}
?>
