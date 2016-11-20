<?php

class ConfigSistema extends Controllers {

    function __construct() {
        parent::__construct();
        Auth::handleLogin();
        $this->view->js = array('configSistema/js/default.js');
    }

    function index() {
        $this->view->title = 'configuración del sistema';
        $this->view->datosSistema = $this->model->datosSistema();
        $this->view->render('header');
        $this->view->render('configSistema/index');
        $this->view->render('footer');
    }

    function modificarDatos() {
        $this->view->title = 'Modificar datos del sistema';
        $this->view->datosSistema = $this->model->datosSistema();
        $this->view->render('header');
        $this->view->render('configSistema/modificarDatos');
        $this->view->render('footer');
    }

    function guardarDatosSistema() {
        $datos = array();
        $datos['annio_lectivo'] = $_POST['annio_lectivo'];
        $datos['director'] = $_POST['director'];
        $this->view->datosSistema = $this->model->guardarDatosSistema($datos);
        $this->view->render('header');
        $this->view->render('configSistema/index');
        $this->view->render('footer');        
    }

}

?>
