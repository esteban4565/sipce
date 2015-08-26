<?php

class Personal extends Controllers {

    function __construct() {
        parent::__construct();
        Auth::handleLogin();
        $this->view->js = array('personal/js/jsNuevoIngreso.js'); 
    }

    function index() {
        
        $this->view->title = 'Personal';
        
        
        $this->view->anio = $this->model->anio();

        /* CARGAMOS LA LISTA DE ESTADO CIVIL */
        $this->view->estadoCivilList = $this->model->estadoCivilList();

        /* CARGAMOS LA LISTA DE PAISES */
        $this->view->paisesList = $this->model->paisesList();
                
        /*CARGAMOS LA LISTA DE LAS INSTITUCIONES*/
        $this->view->Secundaria = $this->model->secundariaList();
        
        /**/
        $this->view->render('header');
        $this->view->render('personal/index');
        $this->view->render('footer');
        
        
    }
    function nuevoIngreso() {
        
        //Titulo para la vista//
        $this->view->title = 'Nuevo Ingreso Personal';
        
        $this->view->anio = $this->model->anio();
        
        //Cargamos la lista de paises//
        $this->view->consultaPaises = $this->model->consultaPaises();
        
        /*Cargamos la lista de escuelas publicas y privadas*/
        $this->view->escuelas = $this->model->CargaEscuelas();
        
        /*Cargamos la lista de colegios publicos y privados*/
        $this->view->colegios = $this->model->CargaColegios();
        
        /*Cargamos la lista de Universidades*/
        $this->view->universidad = $this->model->CargaUniversidades();

        //Cargamos la lista de provincias//
        $this->view->consultaProvincias = $this->model->consultaProvincias();
               
        //Cargamos la lista de estado civil//
        $this->view->estadoCivilList = $this->model->estadoCivilList();

        

        /* CARGAMOS LA LISTA DE ESPECIALIDADES */
        //$this->view->consultaEspecialidades = $this->model->consultaEspecialidades();

        $this->view->render('header');
        $this->view->render('personal/nuevoIngreso');
        $this->view->render('footer');
    }
    function guardarNuevoIngreso() {
        $datos = array();
        $datos['slt_nacionalidad'] = $_POST['slt_nacionalidad'];
        $datos['txt_cedulaPersonal'] = strtoupper($_POST['txt_cedulaPersonal']);		
        $datos['txt_apellido1'] = strtoupper($_POST['txt_apellido1']);
        $datos['txt_apellido2'] = strtoupper($_POST['txt_apellido2']);
        $datos['txt_nombre'] = strtoupper($_POST['txt_nombre']);
        $datos['txt_fnacpersona'] = $_POST['txt_fnacpersona'];
        $datos['txt_edad'] = $_POST['txt_edad'];
        $datos['slt_genero'] = $_POST['slt_genero'];
        $datos['txt_telHabPersonal'] = $_POST['txt_telHabPersonal'];
        $datos['txt_telCelPersonal'] = $_POST['txt_telCelPersonal'];
        $datos['txt_email'] = $_POST['txt_email'];
        
        $datos['txta_domicilio'] = strtoupper($_POST['txta_domicilio']);
        $datos['slt_provinciaDom'] = $_POST['slt_provinciaDom'];
        $datos['slt_cantonDom'] = $_POST['slt_cantonDom'];
        $datos['slt_distritoDom'] = $_POST['slt_distritoDom'];
        
        $datos['txta_domicilioClases'] = strtoupper($_POST['txta_domicilioClases']);
        $datos['slt_provinciaClases'] = $_POST['slt_provinciaClases'];
        $datos['slt_cantonClases'] = $_POST['slt_cantonClases'];
        $datos['slt_distritoClases'] = $_POST['slt_distritoClases'];
        
        $datos['slt_enfermedad'] = $_POST['slt_enfermedad'];
        $datos['txt_enfermedadDesc'] = $_POST['txt_enfermedadDesc'];

        $datos['anio'] = date("Y-m-d");
        
        
        print_r($datos);
        die;
        
        //$this->model->guardarNuevoIngreso($datos);

        $this->view->render('header');
        $this->view->render('matricula/estudiantesMatriculados');
        $this->view->render('footer');
    }
    function editarMatricula($cedulaEstudiante) {
        $this->view->title = 'Editar Matricula';
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
        $this->view->consultaPaises = $this->model->consultaPaises();

        /* CARGAMOS LA LISTA DE ESPECIALIDADES */
        $this->view->consultaEspecialidades = $this->model->consultaEspecialidades();

        /* Cargo informacion del Estudiante */
        $this->view->infoEstudiante = $this->model->infoEstudiante($cedulaEstudiante);

        /* Cargo informacion de la especialidad del Estudiante */
        $this->view->especialidadEstudiante = $this->model->especialidadEstudiante($cedulaEstudiante);

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

        /* Cargo informacion de la adecuacio del Estudiante */
        $this->view->adecuacionEstudiante = $this->model->adecuacionEstudiante($cedulaEstudiante);

        /* Cargo informacion de Becas */
        $this->view->becasEstudiante = $this->model->becasEstudiante($cedulaEstudiante);

        /* Cargo informacion de la poliza del Estudiante */
        $this->view->polizaEstudiante = $this->model->polizaEstudiante($cedulaEstudiante);

        /* Cargo informacion de la Condicion de Matricula */
        $this->view->infoCondicionMatricula = $this->model->infoCondicionMatricula($cedulaEstudiante);

        /* Cargo informacion de Adelanto/Arrastre */
        $this->view->infoAdelanta = $this->model->infoAdelanta($cedulaEstudiante);

        $this->view->render('header');
        $this->view->render('matricula/editarMatricula');
        $this->view->render('footer');
    }

    function estudiantesMatriculados() {
        //Consulto Cantidad Estudiantes Matriculados
        $this->view->estadoMatricula = $this->model->estadoMatricula();
        
        $this->view->render('header');
        $this->view->render('matricula/estudiantesMatriculados');
        $this->view->render('footer');
    }

    function imprimirMatricula($cedulaEstudiante) {
        //Muestro documento para impresion
        $this->view->anio = $this->model->anio();
        $this->view->director = $this->model->director();
        $this->view->consultaDatosEstudiante = $this->model->consultaDatosEstudiante($cedulaEstudiante);

        /* Cargo informacion de las enfermedades del Estudiante */
        $this->view->enfermedadEstudiante = $this->model->enfermedadEstudiante($cedulaEstudiante);
        
        /* Cargo informacion de la adecuacio del Estudiante */
        $this->view->adecuacionEstudiante = $this->model->adecuacionEstudiante($cedulaEstudiante);

        /* Cargo informacion de Becas */
        $this->view->becasEstudiante = $this->model->becasEstudiante($cedulaEstudiante);

        /* Cargo informacion del encargado Legal del Estudiante */
        $this->view->encargadoLegal = $this->model->encargadoLegal($cedulaEstudiante);

        /* Cargo informacion de la Madre del Estudiante */
        $this->view->madreEstudiante = $this->model->madreEstudiante($cedulaEstudiante);

        /* Cargo informacion del Padre del Estudiante */
        $this->view->padreEstudiante = $this->model->padreEstudiante($cedulaEstudiante);

        /* Cargo informacion de la Persona en caso de Emergencia del Estudiante */
        $this->view->personaEmergenciaEstudiante = $this->model->personaEmergenciaEstudiante($cedulaEstudiante);

        /* Cargo informacion de la poliza del Estudiante */
        $this->view->polizaEstudiante = $this->model->polizaEstudiante($cedulaEstudiante);

        /* Cargo informacion de la Condicion de Matricula */
        $this->view->infoCondicionMatricula = $this->model->infoCondicionMatricula($cedulaEstudiante);

        /* Cargo informacion de la especialidad del Estudiante */
        $this->view->especialidadEstudiante = $this->model->especialidadEstudiante($cedulaEstudiante);

        /* Cargo informacion de Adelanto/Arrastre */
        $this->view->infoAdelanta = $this->model->infoAdelanta($cedulaEstudiante);
        
        $this->view->render('matricula/imprimirMatricula');
    }

    function guardarRatificacion() {
        $datos = array();
        $datos['tf_nacionalidad'] = $_POST['tf_nacionalidad'];
        $datos['tf_telHabitEstudiante'] = $_POST['tf_telHabitEstudiante'];
        $datos['tf_cedulaEstudiante'] = strtoupper($_POST['tf_cedulaEstudiante']);
        $datos['tf_genero'] = $_POST['tf_genero'];
        $datos['tf_ape1'] = strtoupper($_POST['tf_ape1']);
        $datos['tf_ape2'] = strtoupper($_POST['tf_ape2']);
        $datos['tf_nombre'] = strtoupper($_POST['tf_nombre']);
        $datos['tf_fnacpersona'] = $_POST['tf_fnacpersona'];
        $datos['tf_telcelular'] = $_POST['tf_telcelular'];
        $datos['tf_email'] = $_POST['tf_email'];
        $datos['tf_domicilio'] = $_POST['tf_domicilio'];
        $datos['tf_provincias'] = $_POST['tf_provincias'];
        $datos['tf_cantones'] = $_POST['tf_cantones'];
        $datos['tf_distritos'] = $_POST['tf_distritos'];
        $datos['tf_primaria'] = $_POST['tf_primaria'];
        $datos['sel_enfermedad'] = $_POST['sel_enfermedad'];
        $datos['tf_enfermedadDescripcion'] = $_POST['tf_enfermedadDescripcion'];
        
        $datos['tf_cedulaEncargado'] = strtoupper($_POST['tf_cedulaEncargado']);
        $datos['tf_ape1Encargado'] = strtoupper($_POST['tf_ape1Encargado']);
        $datos['tf_ape2Encargado'] = strtoupper($_POST['tf_ape2Encargado']);
        $datos['tf_nombreEncargado'] = strtoupper($_POST['tf_nombreEncargado']);
        $datos['tf_telHabitEncargado'] = $_POST['tf_telHabitEncargado'];
        $datos['tf_telcelularEncargado'] = $_POST['tf_telcelularEncargado'];
        $datos['tf_ocupacionEncargado'] = $_POST['tf_ocupacionEncargado'];
        $datos['tf_emailEncargado'] = $_POST['tf_emailEncargado'];
        $datos['sel_parentesco'] = $_POST['sel_parentesco'];
        
        $datos['tf_cedulaMadre'] = strtoupper($_POST['tf_cedulaMadre']);
        $datos['tf_ape1Madre'] = strtoupper($_POST['tf_ape1Madre']);
        $datos['tf_ape2Madre'] = strtoupper($_POST['tf_ape2Madre']);
        $datos['tf_nombreMadre'] = strtoupper($_POST['tf_nombreMadre']);
        $datos['tf_telCelMadre'] = $_POST['tf_telCelMadre'];
        $datos['tf_ocupacionMadre'] = $_POST['tf_ocupacionMadre'];
        
        $datos['tf_cedulaPadre'] = strtoupper($_POST['tf_cedulaPadre']);
        $datos['tf_ape1Padre'] = strtoupper($_POST['tf_ape1Padre']);
        $datos['tf_ape2Padre'] = strtoupper($_POST['tf_ape2Padre']);
        $datos['tf_nombrePadre'] = strtoupper($_POST['tf_nombrePadre']);
        $datos['tf_telCelPadre'] = $_POST['tf_telCelPadre'];
        $datos['tf_ocupacionPadre'] = $_POST['tf_ocupacionPadre'];
        
        $datos['tf_cedulaPersonaEmergencia'] = strtoupper($_POST['tf_cedulaPersonaEmergencia']);
        $datos['tf_ape1PersonaEmergencia'] = strtoupper($_POST['tf_ape1PersonaEmergencia']);
        $datos['tf_ape2PersonaEmergencia'] = strtoupper($_POST['tf_ape2PersonaEmergencia']);
        $datos['tf_nombrePersonaEmergencia'] = strtoupper($_POST['tf_nombrePersonaEmergencia']);
        $datos['tf_telHabitPersonaEmergencia'] = $_POST['tf_telHabitPersonaEmergencia'];
        $datos['tf_telcelularPersonaEmergencia'] = $_POST['tf_telcelularPersonaEmergencia'];
        $datos['sel_parentescoCasoEmergencia'] = $_POST['sel_parentescoCasoEmergencia'];
        
        $datos['sl_nivelMatricular'] = $_POST['sl_nivelMatricular'];
        if ($_POST['sl_nivelMatricular'] > 9) {
            $datos['tf_especialidad'] = $_POST['tf_especialidad'];
        }
        $datos['sl_condicion'] = $_POST['sl_condicion'];
        $datos['sl_adelanta'] = $_POST['sl_adelanta'];
        $datos['sl_adecuacion'] = $_POST['sl_adecuacion'];
        $datos['sl_becaAvancemos'] = $_POST['sl_becaAvancemos'];
        $datos['sl_becaComedor'] = $_POST['sl_becaComedor'];
        $datos['sl_becaTransporte'] = $_POST['sl_becaTransporte'];
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

    /* Metodos */
    //Carga los cantones de una Provincia en especifico
    function cargaCantones($idProvincia) {
        $this->model->cargaCantones($idProvincia);
    }

    //Carga los distritos de un Canton en especifico
    function cargaDistritos($idCanton) {
        $this->model->cargaDistritos($idCanton);
    }

    function buscarEstudiante($ced_estudiante) {
        $this->model->buscarEstudiante($ced_estudiante);
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

    function buscarEstuRatif($ced_estudiante) {
        $this->model->buscarEstuRatif($ced_estudiante);
    }

}

?>
