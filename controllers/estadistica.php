<?php

class Estadistica extends Controllers {

    //Cuando se crea el constructor se verifica si inicio sesion y si tiene permiso
    public function __construct() {
        parent::__construct();
        Auth::handleLogin();
        //$this->view->js = array('estadistica/js/default.js');
    }

    //La funcion Index carga dos variables, "title" es utilizada para el Header de la pagina
    //profeLista posee un array con todos los docentes que se encuentran en la tabla persona de la BD
    //Estas variables seran utilizadas en el View del Objeto (views/horario/index y views/horario/edit)
    public function index() {
        $this->view->title = 'Estadisticas de los Estudiantes';

        //Se manda a ejecutar el header, contenido principal (views/horario/index) y el footer
        $this->view->render('header');
        $this->view->render('estadistica/index');
        $this->view->render('footer');
    }

    //La funcion Index carga dos variables, "title" es utilizada para el Header de la pagina
    //profeLista posee un array con todos los docentes que se encuentran en la tabla persona de la BD
    //Estas variables seran utilizadas en el View del Objeto (views/horario/index y views/horario/edit)
    public function matriculaInicialSegunEdad() {
        $consulta = array();      
        $consulta['anioActual'] = 2016;
        $consulta['anioInicial'] = 2003;
        $consulta['anioFinal'] = 2004;
        
        $this->view->title = 'Matricula Inicial, Segun Edad';

        //Se manda a ejecutar el header, contenido principal (views/horario/index) y el footer
        $this->view->render('header');
        $this->model->consultaEdades($consulta);
        $this->view->render('estadistica/matriculaInicialSegunEdad');
        $this->view->render('footer');
    }

}
