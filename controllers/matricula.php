<?php

class Matricula extends Controllers {

    function __construct() {
        parent::__construct();
        Auth::handleLogin();
        $this->view->js = array('matricula/js/default.js');
    }

    function index() {
        $this->view->title = 'Matricula';
        $this->view->anio = $this->model->anio();

        /* CARGAMOS LA LISTA DE ESTADO CIVIL */
        $this->view->estadoCivilList = $this->model->estadoCivilList();

        /* CARGAMOS LA LISTA DE PAISES */
        $this->view->paisesList = $this->model->paisesList();

        $this->view->render('header');
        $this->view->render('matricula/index');
        $this->view->render('footer');
    }

    function ratificar() {
        $this->view->title = 'Ratificar Matricula';
        $this->view->anio = $this->model->anio();
        $this->view->listaEstudiantes = $this->model->listaEstudiantes();

        /* CARGAMOS LA LISTA DE ESTADO CIVIL */
        $this->view->estadoCivilList = $this->model->estadoCivilList();

        /* CARGAMOS LA LISTA DE PAISES */
        $this->view->paisesList = $this->model->paisesList();

        $this->view->render('header');
        $this->view->render('matricula/ratificar');
        $this->view->render('footer');
    }

    function ratificarEstudiante($cedulaEstudiante) {
        $this->view->title = 'Ratificar Matricula';
        $this->view->anio = $this->model->anio();

        /* CARGAMOS TODAS LAS PROVINCIAS */
        $this->view->consultaProvincias = $this->model->consultaProvincias();
        
        /* CARGAMOS TODOS LOS CANTONES */
        $this->view->consultaCantones = $this->model->consultaCantones();
        
        /* CARGAMOS TODOS LOS DISTRITOS */
        $this->view->consultaDistritos = $this->model->consultaDistritos();

        /* CARGAMOS LA LISTA DE ESTADO CIVIL */
        $this->view->estadoCivilList = $this->model->estadoCivilList();

        /* CARGAMOS LA LISTA DE PAISES */
        $this->view->paisesList = $this->model->paisesList();

        /* Cargo informacion del Estudiante */
        $this->view->infoEstudiante = $this->model->infoEstudiante($cedulaEstudiante);

        /* Cargo informacion del encargado Legal del Estudiante */
        $this->view->encargadoLegal = $this->model->encargadoLegal($cedulaEstudiante);

        /* Cargo informacion de la Madre del Estudiante */
        $this->view->madreEstudiante = $this->model->madreEstudiante($cedulaEstudiante);

        /* Cargo informacion del Padre del Estudiante */
        $this->view->padreEstudiante = $this->model->padreEstudiante($cedulaEstudiante);

        /* Cargo informacion de la Persona en caso de Emergencia del Estudiante */
        $this->view->personaEmergenciaEstudiante = $this->model->personaEmergenciaEstudiante($cedulaEstudiante);

        /* Cargo informacion de las enfermedades del Estudiante */
        $this->view->enfermedadEstudiante = $this->model->enfermedadEstudiante($cedulaEstudiante);

        /* Cargo informacion de la poliza del Estudiante */
        $this->view->polizaEstudiante = $this->model->polizaEstudiante($cedulaEstudiante);

        /* Cargo informacion de la Condicion de Matricula */
        $this->view->infoCondicionMatricula = $this->model->infoCondicionMatricula($cedulaEstudiante);

        /* Cargo informacion de Adelanto/Arrastre */
        $this->view->infoAdelanta = $this->model->infoAdelanta($cedulaEstudiante);

        $this->view->render('header');
        $this->view->render('matricula/ratificarEstudiante');
        $this->view->render('footer');
    }

    function estudiantesMatriculados() {
        //Consulto Cantidad Estudiantes Matriculados
        $this->view->estadoMatricula = $this->model->estadoMatricula();
        
        $this->view->render('header');
        $this->view->render('matricula/estudiantesMatriculados');
        $this->view->render('footer');
    }

    function guardarRatificacion() {
        $datos = array();
        $datos['tf_cedulaEstudiante'] = $_POST['tf_cedulaEstudiante'];
        $datos['tf_genero'] = $_POST['tf_genero'];
        $datos['tf_ape1'] = $_POST['tf_ape1'];
        $datos['tf_ape2'] = $_POST['tf_ape2'];
        $datos['tf_nombre'] = $_POST['tf_nombre'];
        $datos['tf_fnacpersona'] = date("y-m-d h:i:s", strtotime($_POST['tf_fnacpersona']));
        $datos['tf_telcelular'] = $_POST['tf_telcelular'];
        $datos['tf_email'] = $_POST['tf_email'];
        $datos['tf_domicilio'] = $_POST['tf_domicilio'];
        $datos['tf_provincias'] = $_POST['tf_provincias'];
        $datos['tf_cantones'] = $_POST['tf_cantones'];
        $datos['tf_distritos'] = $_POST['tf_distritos'];
        $datos['tf_primaria'] = $_POST['tf_primaria'];
        $datos['sel_enfermedad'] = $_POST['sel_enfermedad'];
        $datos['tf_enfermedadDescripcion'] = $_POST['tf_enfermedadDescripcion'];
        
        $datos['tf_cedulaEncargado'] = $_POST['tf_cedulaEncargado'];
        $datos['tf_ape1Encargado'] = $_POST['tf_ape1Encargado'];
        $datos['tf_ape2Encargado'] = $_POST['tf_ape2Encargado'];
        $datos['tf_nombreEncargado'] = $_POST['tf_nombreEncargado'];
        $datos['tf_telHabitEncargado'] = $_POST['tf_telHabitEncargado'];
        $datos['tf_telcelularEncargado'] = $_POST['tf_telcelularEncargado'];
        $datos['tf_ocupacionEncargado'] = $_POST['tf_ocupacionEncargado'];
        $datos['tf_emailEncargado'] = $_POST['tf_emailEncargado'];
        $datos['sel_parentesco'] = $_POST['sel_parentesco'];
        
        $datos['tf_cedulaMadre'] = $_POST['tf_cedulaMadre'];
        $datos['tf_ape1Madre'] = $_POST['tf_ape1Madre'];
        $datos['tf_ape2Madre'] = $_POST['tf_ape2Madre'];
        $datos['tf_nombreMadre'] = $_POST['tf_nombreMadre'];
        $datos['tf_telHabitMadre'] = $_POST['tf_telHabitMadre'];
        $datos['tf_ocupacionMadre'] = $_POST['tf_ocupacionMadre'];
        
        $datos['tf_cedulaPadre'] = $_POST['tf_cedulaPadre'];
        $datos['tf_ape1Padre'] = $_POST['tf_ape1Padre'];
        $datos['tf_ape2Padre'] = $_POST['tf_ape2Padre'];
        $datos['tf_nombrePadre'] = $_POST['tf_nombrePadre'];
        $datos['tf_telHabitPadre'] = $_POST['tf_telHabitPadre'];
        $datos['tf_ocupacionPadre'] = $_POST['tf_ocupacionPadre'];
        
        $datos['tf_cedulaPersonaEmergencia'] = $_POST['tf_cedulaPersonaEmergencia'];
        $datos['tf_ape1PersonaEmergencia'] = $_POST['tf_ape1PersonaEmergencia'];
        $datos['tf_ape2PersonaEmergencia'] = $_POST['tf_ape2PersonaEmergencia'];
        $datos['tf_nombrePersonaEmergencia'] = $_POST['tf_nombrePersonaEmergencia'];
        $datos['tf_telHabitPersonaEmergencia'] = $_POST['tf_telHabitPersonaEmergencia'];
        $datos['tf_telcelularPersonaEmergencia'] = $_POST['tf_telcelularPersonaEmergencia'];
        $datos['sl_nivelMatricular'] = $_POST['sl_nivelMatricular'];
        $datos['sl_condicion'] = $_POST['sl_condicion'];
        $datos['sl_adelanta'] = $_POST['sl_adelanta'];
        $datos['sl_adecuacion'] = $_POST['sl_adecuacion'];
        $datos['sl_becaAvancemos'] = $_POST['sl_becaAvancemos'];
        $datos['sl_becaComedor'] = $_POST['sl_becaComedor'];
        $datos['tf_poliza'] = $_POST['tf_poliza'];
        $datos['tf_polizaVence'] = $_POST['tf_polizaVence'];
        $datos['anio'] = $this->model->anio();
        
        $this->model->guardarRatificacion($datos);

        //Consulto Cantidad Estudiantes Matriculados
        $this->view->estadoMatricula = $this->model->estadoMatricula();
        
        $this->view->render('header');
        $this->view->render('matricula/estudiantesMatriculados');
        $this->view->render('footer');
    }

    function nuevoIngreso() {
        $this->view->title = 'Matricula Nuevo Ingreso';

        /* CARGAMOS LA LISTA DE ESTADO CIVIL */
        $this->view->estadoCivilList = $this->model->estadoCivilList();

        /* CARGAMOS LA LISTA DE PAISES */
        $this->view->paisesList = $this->model->paisesList();

        $this->view->render('header');
        $this->view->render('matricula/nuevoIngreso');
        $this->view->render('footer');
    }

    /* Metodos */
    //Carga los cantones de una Provincia en especifico
    function cargaCantones($idProvincia) {
        $this->model->cargaCantones($idProvincia);
    }

    //Carga los distritos de un Canton en especifico
    function cargaDistritos($idCanton) {
        $this->model->cargaDistritos($idCanton);
    }

    function buscarEncargado($ced_encargado) {
        $this->model->buscarEncargado($ced_encargado);
    }

    function buscarMadre($ced_madre) {
        $this->model->buscarMadre($ced_madre);
    }

    function buscarPadre($ced_padre) {
        $this->model->buscarPadre($ced_padre);
    }

    function buscarPersonaEmergencia($ced_personaEmergencia) {
        $this->model->buscarPersonaEmergencia($ced_personaEmergencia);
    }

}

?>