<?php
class Seccion extends Controllers {
    function __construct(){
        parent::__construct();
        Auth::handleLogin(); 
        $this->view->js = array('seccion/js/default.js');
    }
    function index(){
        /*CARGAMOS NIVELES*/
        $this->view->consultaNiveles = $this->model->consultaNiveles();
        $this->view->title = 'Secciones';
        $this->view->render('header');
        $this->view->render('seccion/index');
        $this->view->render('footer');
        
    }
    function listaSecciones(){
        /*CARGAMOS NIVELES*/
        $this->view->consultaNiveles = $this->model->consultaNiveles();
        $this->view->title = 'Lista Secciones'; 
        $this->view->listaSecciones = $this->model->listaSecciones();
        $this->view->render('header');
        $this->view->render('seccion/listaSecciones');
        $this->view->render('footer');
        
    }
    
    function cargaGrupos($idNivel){
        $this->model->cargaGrupos($idNivel);
    }
    function cargaSubGrupos($idGrupo){
        $this->model->cargaSubGrupos($idGrupo);
    }
}
?>
