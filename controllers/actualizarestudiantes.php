<?php

class ActualizarEstudiantes extends Controllers {

    //Cuando se crea el constructor se verifica si inicio sesion y si tiene permiso
    public function __construct() {
        parent::__construct();
        Auth::handleLogin();
        $this->view->js = array('actualizarestudiantes/js/default.js');
    }

    //La funcion Index carga dos variables, "title" es utilizada para el Header de la pagina
    //profeLista posee un array con todos los docentes que se encuentran en la tabla persona de la BD
    //Estas variables seran utilizadas en el View del Objeto (views/horario/index y views/horario/edit)
    public function index() {
        $this->view->title = 'Actualizar Estudiantes';
        $this->view->estudiantesCedulaMala = $this->model->estudiantesCedulaMala();

        //Se manda a ejecutar el header, contenido principal (views/horario/index) y el footer
        $this->view->render('header');
        $this->view->render('actualizarestudiantes/index');
        $this->view->render('footer');
    }
    
    public function actuEstu() {
        $this->model->actuEstu();
        $this->index();
    }
    
    public function actuPasswordEstu() {
        $this->model->actuPasswordEstu();
        $this->index();
    }
    
    public function actuPasswordDocente() {
        $this->view->title = 'Reseteo Contraseñas Docentes';
        $this->view->docentesCedulaMala = $this->model->docentesCedulaMala();
        $this->model->actuPasswordDocente();

        //Se manda a ejecutar el header, contenido principal (views/horario/index) y el footer
        $this->view->render('header');
        $this->view->render('actualizarestudiantes/actuPasswordDocente');
        $this->view->render('footer');
    }
    
    public function estudiantesVoca() {
        $this->view->title = 'Estudiantes Pre-Seleccionados Vocacional Alajuela';
        $this->view->estudiantesCedulaVoca = $this->model->estudiantesCedulaVoca();
        $this->view->estudiantesNuevosSolicitudEspecialidad = $this->model->estudiantesNuevosSolicitudEspecialidad();

        //Se manda a ejecutar el header, contenido principal (views/horario/index) y el footer
        $this->view->render('header');
        $this->view->render('actualizarestudiantes/estudiantesVoca');
        $this->view->render('footer');
    }
    
    public function proyeccionMatricula() {
        $this->view->title = 'Proyección para el 2016 - Estudiantes Matriculados';

        //Se manda a ejecutar el header, contenido principal (views/horario/index) y el footer
        $this->view->render('header');
        $this->view->render('actualizarestudiantes/proyeccionMatricula');
        $this->view->render('footer');
    }
    
    /* Metodos */
    function cargaProyeccion($idNivel) {
        $this->model->cargaProyeccion($idNivel);
    }
    
    /* Metodos */
    function cargaProyeccionTotal() {
        $this->model->cargaProyeccionTotal();
    }

}
