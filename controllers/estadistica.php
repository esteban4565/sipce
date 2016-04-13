<?php

class Estadistica extends Controllers {

    //Cuando se crea el constructor se verifica si inicio sesion y si tiene permiso
    public function __construct() {
        parent::__construct();
        Auth::handleLogin();
    }

    public function index() {
        $this->view->title = 'Estadisticas de los Estudiantes';

        //Se manda a ejecutar el header, contenido principal (views/horario/index) y el footer
        $this->view->render('header');
        $this->view->render('estadistica/index');
        $this->view->render('footer');
    }

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

    public function matriculaInicialSegunRepitencia() {
        $consulta = array();      
        $consulta['anioActual'] = 2016;
        $consulta['anioInicial'] = 2003;
        $consulta['anioFinal'] = 2004;
        
        $this->view->title = 'Matricula Inicial, Segun Repitencia';

        //Se manda a ejecutar el header, contenido principal (views/horario/index) y el footer
        $this->view->render('header');
        $this->model->consultaRepitencia($consulta);
        $this->view->render('estadistica/matriculaInicialSegunRepitencia');
        $this->view->render('footer');
    }

    public function lugarDeResidencia() {
        $this->view->title = 'Estadistica Lugar De Residencia';

        //Se manda a ejecutar el header, contenido principal (views/horario/index) y el footer
        $this->view->render('header');
        $this->model->consultalugarDeResidencia();
        $this->view->render('estadistica/lugarDeResidencia');
        $this->view->render('footer');
    }

}
