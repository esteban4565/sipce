<?php
class Matricula extends Controllers {
    function __construct(){
        parent::__construct();
        Auth::handleLogin(); 
        $this->view->js = array('matricula/js/default.js');
    }
    function index(){
        $this->view->title = 'Matricula';
        
        /*CARGAMOS LA LISTA DE ESTADO CIVIL*/
        $this->view->estadoCivilList = $this->model->estadoCivilList();
        
        /*CARGAMOS LA LISTA DE PAISES*/
        $this->view->paisesList = $this->model->paisesList();
        
        $this->view->render('header');
        $this->view->render('matricula/index');
        $this->view->render('footer');
    }
    
    function ratificar(){
        $this->view->title = 'Ratificar Matricula';
        $this->view->listaEstudiantes = $this->model->listaEstudiantes();
        
        /*CARGAMOS LA LISTA DE ESTADO CIVIL*/
        $this->view->estadoCivilList = $this->model->estadoCivilList();
        
        /*CARGAMOS LA LISTA DE PAISES*/
        $this->view->paisesList = $this->model->paisesList();
        
        $this->view->render('header');
        $this->view->render('matricula/ratificar');
        $this->view->render('footer');
    }
    
    function ratificarEstudiante($cedulaEstudiante){
        $this->view->title = 'Ratificar Matricula';
        
        /*CARGAMOS LA LISTA DE ESTADO CIVIL*/
        $this->view->estadoCivilList = $this->model->estadoCivilList();
        
        /*CARGAMOS LA LISTA DE PAISES*/
        $this->view->paisesList = $this->model->paisesList();
        
        /*Cargo informacion del Estudiante*/
        $this->view->infoEstudiante = $this->model->infoEstudiante($cedulaEstudiante);
        
        $this->view->render('header');
        $this->view->render('matricula/ratificarEstudiante');
        $this->view->render('footer');
    }
    
    function nuevoIngreso(){
        $this->view->title = 'Matricula Nuevo Ingreso';
        
        /*CARGAMOS LA LISTA DE ESTADO CIVIL*/
        $this->view->estadoCivilList = $this->model->estadoCivilList();
        
        /*CARGAMOS LA LISTA DE PAISES*/
        $this->view->paisesList = $this->model->paisesList();
        
        $this->view->render('header');
        $this->view->render('matricula/nuevoIngreso');
        $this->view->render('footer');
    }
    
    /*Metodos*/
    function cargaCantones($idProvincia){
        $this->model->cargaCantones($idProvincia);
    }
    function cargaDistritos($idCanton){
        $this->model->cargaDistritos($idCanton);
    }
}
?>
