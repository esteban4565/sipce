<?php

class Persona extends Controllers {

    function __construct() {
        parent::__construct();
        Auth::handleLogin();
        $this->view->js = array('persona/js/default.js');
    }

    function datosSistemaJavaScript() {
        echo json_encode($this->model->datosSistema());
    }

    function index() {
        $this->view->title = 'Usuarios';
        $this->view->personaList = $this->model->personaList();
        /* CARGAMOS LA LISTA DE ESTADO CIVIL */
        $this->view->estadoCivilList = $this->model->estadoCivilList();

        /* CARGAMOS LA LISTA DE PAISES */
        $this->view->paisesList = $this->model->paisesList();

        $this->view->render('header');
        $this->view->render('persona/index');
        $this->view->render('footer');
    }

    /* METODOS DE BUSQUEDA */

    function buscarDocente() {
        $this->view->title = 'Buscar docente';
        $this->view->render('header');
        $this->view->render('persona/buscarDocente');
        $this->view->render('footer');
    }

    function buscarEstudiante() {
        $this->view->render('header');
        $this->view->render('persona/buscarEstudiante');
        $this->view->render('footer');
    }

    /* METODOS DE RESULTADOS DE BUSQUEDAS */

    function resultadoBuscarDocente() {

        /* CARGAMOS PROVINCIAS */
        $this->view->consultaProvincias = $this->model->consultaProvincias();
        /* CARGAMOS LOS PERMISOS */
        $this->view->permisos = $this->model->CargaPermisos();
        /* CARGAMOS LA LISTA DE PAISES */
        $this->view->paisesList = $this->model->paisesList();
        /* CARGAMOS LISTA DE ESTADO CIVIL */
        $this->view->estadoCivilList = $this->model->estadoCivilList();

        /* OBTENEMOS LA CEDULA A BUSCAR */
        $cedula = $_POST['tf_cedula'];

        $files_bd_sipce = $this->model->personaUnicaLista($cedula, "bd_sipce");
        $files_bd_padron = $this->model->personaUnicaLista($cedula, "bd_padron");

        $count_bd_sipce = count($files_bd_sipce);
        $count_bd_padron = count($files_bd_padron);

        if ($cedula != "") {
            if ($count_bd_sipce > 0) {
                $this->view->msg = "El docente ya esta registrado en el sistema, sólo se podrá actualizar la información";
                $this->view->estado = "2";
                $this->view->title = 'Resultado de la busqueda';
                $this->view->render('header');
                $this->view->render('persona/errorBusqueda');
                $this->view->render('footer');
            } else {
                if ($count_bd_padron > 0) {
                    $this->view->personaNueva = $this->model->personaUnicaLista($cedula, "bd_padron");
                    $this->view->msg = "Docente encontrado";
                    $this->view->estado = "0";
                    $this->view->title = 'Registrar docente';
                    $this->view->render('header');
                    $this->view->render('persona/resultadoBuscarDocente');
                    $this->view->render('footer');
                }
            }
        } else {
            $this->view->msg = "Valor de busqueda invalido";
            $this->view->estado = "3";
            $this->view->title = 'Resultado Busqueda';
            $this->view->render('header');
            $this->view->render('persona/errorBusqueda');
            $this->view->render('footer');
        }
    }

    function otra() {
        $this->view->personaList = $this->model->personaUnicaLista($cedula);
        $files = $this->model->personaUnicaLista($cedula);
        $count = count($files);
        if ($cedula != "") {
            if ($count > 0) {
                if ($files[0]['tipoUsuario'] != '3') {
                    /*
                      $this->view->msg = "DOCENTE ENCONTRADO";
                      $this->view->estado = "0";
                      $this->view->title = 'Resultado Busqueda';
                      $this->view->render('header');
                      $this->view->render('persona/resultadoBuscarDocente');
                      $this->view->render('footer');
                     * 
                     */
                } else {
                    $this->view->msg = "LA PERSONA A BUSCAR NO ES UN DOCENTE";
                    $this->view->estado = "1";
                    $this->view->title = 'Resultado Busqueda';
                    $this->view->render('header');
                    $this->view->render('persona/errorBusqueda');
                    $this->view->render('footer');
                }
            } else {
                $this->view->msg = "DOCENTE NO EXISTE";
                $this->view->estado = "2";
                $this->view->title = 'Resultado Busqueda';
                $this->view->render('header');
                $this->view->render('persona/errorBusqueda');
                $this->view->render('footer');
            }
        } else {
            $this->view->msg = "VALOR DE BUSQUEDA INVALIDO";
            $this->view->estado = "3";
            $this->view->title = 'Resultado Busqueda';
            $this->view->render('header');
            $this->view->render('persona/errorBusqueda');
            $this->view->render('footer');
        }
    }

    /* Funcion que permite guardar el registro de un docente o estudiante */

    function saveDocenteEstudiante() {

        $data = array();
        $data['cedulaP'] = $_POST['tf_cedula'];
        $data['sexoP'] = $_POST['tf_sexo'];
        $data['ape1P'] = $_POST['tf_ape1'];
        $data['ape2P'] = $_POST['tf_ape2'];
        $data['nombreP'] = $_POST['tf_nombre'];
        $data['fnacimientoP'] = $_POST['tf_fnacpersona'];
        $data['nacionalidadP'] = $_POST['tf_nacionalidad'];
        $data['estadocivilP'] = $_POST['tf_estadocivil'];
        $data['telcelularP'] = $_POST['tf_telcelular'];
        $data['telcasaP'] = $_POST['tf_telcasa'];
        $data['domicilioP'] = $_POST['tf_domicilio'];
        $data['provinciaP'] = $_POST['tf_provincias'];
        $data['cantonP'] = $_POST['tf_cantones'];
        $data['distritoP'] = $_POST['tf_distritos'];
        $data['passwordP'] = $_POST['tf_cedula'];
        $data['emailP'] = $_POST['tf_email'];
        $data['roleP'] = $_POST['tf_role'];
        $data['estadoactualP'] = $_POST['tf_estadoactual'];

        //print_r($data);
        //die;
        //Checar los errores
        $this->model->saveDocenteEstudiante($data);
        //header('location:'. URL .'persona');
        //$this->view->title = 'Buscar docente';
        //$this->view->render('header');
        //$this->view->render('persona/buscarDocente');
        //$this->view->render('footer');
    }

    function edit($cedula) {
        //fetch individual de personas
        $this->view->persona = $this->model->personaUnicaLista($cedula);
        $this->view->title = 'Modificar-Usuarios';
        $this->view->render('header');
        $this->view->render('persona/edit');
        $this->view->render('footer');
    }

    function editSave($cedula) {

        $data = array();
        $data['cedula'] = $_POST['tf_cedula'];
        $data['ape1'] = $_POST['tf_ape1'];
        $data['ape2'] = $_POST['tf_ape2'];
        $data['nombre'] = $_POST['tf_nombre'];
        $data['sexo'] = $_POST['tf_sexo'];
        $data['username'] = $_POST['tf_usuario'];
        $data['password'] = $_POST['tf_clave'];
        $data['role'] = $_POST['tf_role'];
        $data['email'] = $_POST['tf_email'];

        //Checar los errores
        $this->model->editSave($data);
        header('location:' . URL . 'persona');
    }

    function delete($cedula) {

        $this->model->delete($cedula);
        header('location:' . URL . 'persona');
    }

    function buscarPersona($tipo) {
        if ($tipo == 1) {
            $this->view->tipo = $tipo;
            $this->view->title = 'Buscar Docente';
            $this->view->mensaje = 'Modulo Usuario - Buscar Docente';
        } else {
            $this->view->tipo = $tipo;
            $this->view->title = 'Buscar Estudiante';
            $this->view->mensaje = 'Modulo Usuario - Buscar Estudiante';
        }
        $this->view->render('header');
        $this->view->render('persona/buscarPersona');
        $this->view->render('footer');
    }

    function resultadoBuscarPersona() {

        /* CARGAMOS PROVINCIAS */
        $this->view->consultaProvincias = $this->model->consultaProvincias();
        /* CARGAMOS LOS PERMISOS */
        $this->view->permisos = $this->model->CargaPermisos();
        /* CARGAMOS LA LISTA DE PAISES */
        $this->view->paisesList = $this->model->paisesList();
        /* CARGAMOS LISTA DE ESTADO CIVIL */
        $this->view->estadoCivilList = $this->model->estadoCivilList();

        /* Obtemos la cedula a buscar */
        $cedula = $_POST['tf_cedula'];

        $this->view->personaList = $this->model->personaUnicaLista($cedula);
        $files = $this->model->personaUnicaLista($cedula);
        $count = count($files);
        if ($cedula != "") {
            if ($count > 0) {
                if ($files[0]['tipoUsuario'] == '3') {
                    $this->view->msg = "ESTUDIANTE ENCONTRADO";
                    $this->view->estado = "0";
                    $this->view->title = 'Resultado Busqueda';
                    $this->view->render('header');
                    $this->view->render('persona/index');
                    $this->view->render('footer');
                } else {
                    $this->view->msg = "ESTA PERSONA NO ES UN ESTUDIANTE";
                    $this->view->estado = "1";
                    $this->view->title = 'Resultado Busqueda';
                    $this->view->render('header');
                    $this->view->render('persona/resultadoBuscarPersona');
                    $this->view->render('footer');
                }
            } else {
                $this->view->msg = "ESTUDIANTE NO EXISTE";
                $this->view->estado = "2";
                $this->view->title = 'Resultado Busqueda';
                $this->view->render('header');
                $this->view->render('persona/resultadoBuscarPersona');
                $this->view->render('footer');
            }
        } else {
            $this->view->msg = "VALOR DE BUSQUEDA INVALIDO";
            $this->view->estado = "3";
            $this->view->title = 'Resultado Busqueda';
            $this->view->render('header');
            $this->view->render('persona/resultadoBuscarPersona');
            $this->view->render('footer');
        }
    }

    function cargaCantones($idProvincia) {
        $this->model->cargaCantones($idProvincia);
    }

    function cargaDistritos($idCanton) {
        $this->model->cargaDistritos($idCanton);
    }

//**Cosas de Esteban**//
    //Lista en orden alfabetico todos los estudiantes de la institución
    function listaEstudiantes() {
        $this->view->title = 'Lista Estudintes';
        $this->view->listaEstudiantes = $this->model->listaEstudiantes();
        $this->view->render('header');
        $this->view->render('persona/listaEstudiantes');
        $this->view->render('footer');
    }

    //Brinda la opcion de ver datos personales de los estudiantes de la institución
    function datosEstudiantes() {
        $this->view->title = 'Datos Estudintes';
        $this->view->consultaNiveles = $this->model->consultaNiveles();
        $this->view->render('header');
        $this->view->render('persona/datosEstudiantes');
        $this->view->render('footer');
    }

    /* Carga los Grupos de un nivel en especifico */

    function cargaGrupos($idNivel) {
        $this->model->cargaGrupos($idNivel);
    }

    /* Carga la lista de estudiantes de una seccion en especifico */

    function cargaSeccion() {
        $consulta = array();
        $consulta['nivelSeleccionado'] = $_POST['nivelSeleccionado'];
        $consulta['grupoSeleccionado'] = $_POST['grupoSeleccionado'];
        $consulta['chk_email'] = $_POST['chk_email'];
        $consulta['chk_poliza'] = $_POST['chk_poliza'];
        $consulta['chk_domicilio'] = $_POST['chk_domicilio'];
        $consulta['chk_telefonosEstu'] = $_POST['chk_telefonosEstu'];
        $consulta['chk_telefonosEncargado'] = $_POST['chk_telefonosEncargado'];
        $this->model->cargaSeccion($consulta);
    }

    function nuevoIngresoTardio() {
        $this->view->title = 'Nuevo ingreso';

        /* CARGAMOS TODAS LAS PROVINCIAS */
        $this->view->consultaProvincias = $this->model->consultaProvincias();

        /* CARGAMOS LA LISTA DE PAISES */
        $this->view->consultaPaises = $this->model->consultaPaises();

        /* CARGAMOS LA LISTA DE ESPECIALIDADES */
        $this->view->consultaEspecialidades = $this->model->consultaEspecialidades();

        $this->view->render('header');
        $this->view->render('persona/nuevoIngresoTardio');
        $this->view->render('footer');
    }

    function guardarNuevoIngresoTardio() {
        $datos = array();
        $datos['tf_nacionalidad'] = $_POST['tf_nacionalidad'];
        $datos['tf_cedulaEstudiante'] = strtoupper($_POST['tf_cedulaEstudiante']);
        $datos['tf_ape1'] = strtoupper($_POST['tf_ape1']);
        $datos['tf_ape2'] = strtoupper($_POST['tf_ape2']);
        $datos['tf_nombre'] = strtoupper($_POST['tf_nombre']);
        $datos['tf_fnacpersona'] = $_POST['tf_fnacpersona'];
        $datos['tf_genero'] = $_POST['tf_genero'];
        $datos['tf_telHabitEstudiante'] = $_POST['tf_telHabitEstudiante'];
        $datos['tf_telcelular'] = $_POST['tf_telcelular'];
        $datos['tf_email'] = $_POST['tf_email'];
        $datos['tf_domicilio'] = $_POST['tf_domicilio'];
        $datos['tf_provincias'] = $_POST['tf_provincias_NI'];
        $datos['tf_cantones'] = $_POST['tf_cantones_NI'];
        $datos['tf_distritos'] = $_POST['tf_distritos_NI'];
        $datos['tf_primaria'] = $_POST['tf_primaria'];
        $datos['sel_enfermedad'] = $_POST['sel_enfermedad'];
        $datos['tf_enfermedadDescripcion'] = $_POST['tf_enfermedadDescripcion'];

        $datos['tf_cedulaEncargado'] = strtoupper($_POST['tf_cedulaEncargado_NI']);
        $datos['tf_ape1Encargado'] = strtoupper($_POST['tf_ape1Encargado_NI']);
        $datos['tf_ape2Encargado'] = strtoupper($_POST['tf_ape2Encargado_NI']);
        $datos['tf_nombreEncargado'] = strtoupper($_POST['tf_nombreEncargado_NI']);
        $datos['tf_telHabitEncargado'] = $_POST['tf_telHabitEncargado'];
        $datos['tf_telcelularEncargado'] = $_POST['tf_telcelularEncargado'];
        $datos['tf_ocupacionEncargado'] = $_POST['tf_ocupacionEncargado'];
        $datos['tf_emailEncargado'] = $_POST['tf_emailEncargado'];
        $datos['sel_parentesco'] = $_POST['sel_parentesco'];

        $datos['tf_cedulaMadre'] = strtoupper($_POST['tf_cedulaMadre_NI']);
        $datos['tf_ape1Madre'] = strtoupper($_POST['tf_ape1Madre_NI']);
        $datos['tf_ape2Madre'] = strtoupper($_POST['tf_ape2Madre_NI']);
        $datos['tf_nombreMadre'] = strtoupper($_POST['tf_nombreMadre_NI']);
        $datos['tf_telCelMadre'] = $_POST['tf_telCelMadre'];
        $datos['tf_ocupacionMadre'] = $_POST['tf_ocupacionMadre'];

        $datos['tf_cedulaPadre'] = strtoupper($_POST['tf_cedulaPadre_NI']);
        $datos['tf_ape1Padre'] = strtoupper($_POST['tf_ape1Padre_NI']);
        $datos['tf_ape2Padre'] = strtoupper($_POST['tf_ape2Padre_NI']);
        $datos['tf_nombrePadre'] = strtoupper($_POST['tf_nombrePadre_NI']);
        $datos['tf_telCelPadre'] = $_POST['tf_telCelPadre'];
        $datos['tf_ocupacionPadre'] = $_POST['tf_ocupacionPadre'];

        $datos['tf_cedulaPersonaEmergencia'] = strtoupper($_POST['tf_cedulaPersonaEmergencia_NI']);
        $datos['tf_ape1PersonaEmergencia'] = strtoupper($_POST['tf_ape1PersonaEmergencia_NI']);
        $datos['tf_ape2PersonaEmergencia'] = strtoupper($_POST['tf_ape2PersonaEmergencia_NI']);
        $datos['tf_nombrePersonaEmergencia'] = strtoupper($_POST['tf_nombrePersonaEmergencia_NI']);
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

        $this->model->guardarNuevoIngresoTardio($datos);

        $this->view->render('header');
        $this->view->render('persona/listaEstudiantes');
        $this->view->render('footer');
    }

    function buscarEstudiantePadron($ced_estudiante) {
        $this->model->buscarEstudiante($ced_estudiante);
    }

    //Brinda la opcion de ver el expediente de los estudiantes de la institución
    function expedientesEstudiantes() {
        $this->view->title = 'Expedientes Estudintes';
        $this->view->consultaNiveles = $this->model->consultaNiveles();
        $this->view->render('header');
        $this->view->render('persona/expedientesEstudiantes');
        $this->view->render('footer');
    }

    function editarExpedienteEstudiante($cedulaEstudiante) {
        $this->view->title = 'Editar Expediente';

        /* CARGAMOS DATOS DEL SISTEMA: AÑO LECTIVO, DIRECTOR, ETC */
        $this->view->datosSistema = $this->model->datosSistema();

        /* CARGAMOS TODAS LAS PROVINCIAS */
        $this->view->consultaProvincias = $this->model->consultaProvincias();

        /* CARGAMOS TODOS LOS CANTONES */
        $this->view->consultaCantones = $this->model->consultaCantones();

        /* CARGAMOS TODOS LOS DISTRITOS */
        $this->view->consultaDistritos = $this->model->consultaDistritos();

        /* CARGAMOS TODAS LAS ESCUELAS */
        $this->view->consultaEscuelas = $this->model->consultaEscuelas();

        /* CARGAMOS LA LISTA DE PAISES */
        $this->view->consultaPaises = $this->model->consultaPaises();

        /* CARGAMOS LA LISTA DE ESPECIALIDADES */
        $this->view->consultaEspecialidades = $this->model->consultaEspecialidades();

        /* Cargo informacion del Estudiante Para Editar */
        $this->view->infoEstudiante = $this->model->infoEstudianteEditar($cedulaEstudiante);

        /* Cargo informacion de la especialidad del Estudiante */
        $this->view->especialidadEstudiante = $this->model->especialidadEstudiante($cedulaEstudiante);

        /* CARGAMOS LA ESCUELA DEL ESTUDIANTE */
        $this->view->escuelaEstudiante = $this->model->escuelaEstudiante($cedulaEstudiante);

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
        $this->view->render('persona/editarExpedienteEstudiante');
        $this->view->render('footer');
    }

    function guardarExpedienteEstudiante() {
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
        $datos['tf_provincias'] = $_POST['tf_provinciasExpediente'];
        $datos['tf_cantones'] = $_POST['tf_cantonesExpediente'];
        $datos['tf_distritos'] = $_POST['tf_distritosExpediente'];
        $datos['tf_primaria'] = $_POST['tf_primariaExpe'];
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
        $datos['sel_parentesco'] = $_POST['sel_parentescoExpediente'];

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
        $datos['sel_parentescoCasoEmergencia'] = $_POST['sel_parentescoCasoEmergenciaExpediente'];

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

        $this->model->guardarExpedienteEstudiante($datos);

        $this->expedientesEstudiantes();
    }

    function imprimirExpedienteEstudiante($cedulaEstudiante) {
        /* CARGAMOS DATOS DEL SISTEMA: AÑO LECTIVO, DIRECTOR, ETC */
        $this->view->datosSistema = $this->model->datosSistema();
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

        $this->view->render('persona/imprimirExpedienteEstudiante');
    }

    //Carga las escuela//
    function cargaEscuela($idDistrito) {
        $this->model->cargaEscuela($idDistrito);
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

    //2016 Becas

    function beca() {
        $this->view->title = 'Ingresar beca';
        $this->view->mensaje = '';

        $this->view->render('header');
        $this->view->render('persona/becas');
        $this->view->render('footer');
    }

    function buscarEstudianteBecas($ced_estudiante = null) {
        $this->model->buscarEstudianteBecas($ced_estudiante);
    }

    function guardarDatosBeca($ced_estudiante = null) {
        $datos = array();
        if($ced_estudiante == null){
            $datos['ced_estudiante'] = $_POST['ced_estudiante'];
        }else{
            $datos['ced_estudiante'] = $ced_estudiante;
        }
        
        $datos['distancia'] = $_POST['distancia'];
        $datos['ingreso1'] = $_POST['ingreso1'];
        $datos['ingreso2'] = $_POST['ingreso2'];
        $datos['ingreso3'] = $_POST['ingreso3'];
        $datos['ingreso4'] = $_POST['ingreso4'];
        $datos['totalIngreso'] = $_POST['totalIngreso'];
        $this->model->guardarDatosBeca($datos);
        
        $this->view->mensaje = 'Datos guardados correctamente';

        $this->view->render('header');
        $this->view->render('persona/becas');
        $this->view->render('footer');
    }

    function listaBecas() {
        $this->view->title = 'Lista becas';
        $this->view->listaEstudianteBecas = $this->model->listaEstudianteBecas();

        $this->view->render('header');
        $this->view->render('persona/listaBecas');
        $this->view->render('footer');
    }

    function editarBeca($ced_estudiante = null) {
        $this->view->title = 'Editar beca';
        $this->view->datosEstudiante = $this->model->datosEstudiante($ced_estudiante);

        $this->view->render('header');
        $this->view->render('persona/editarBeca');
        $this->view->render('footer');
    }

}

?>
