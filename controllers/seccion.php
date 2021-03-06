<?php

class Seccion extends Controllers {

    function __construct() {
        parent::__construct();
        Auth::handleLogin();
        $this->view->js = array('seccion/js/default.js');
    }

    function index() {
        /* CARGAMOS NIVELES */
        $this->view->consultaNiveles = $this->model->consultaNiveles();
        $this->view->title = 'Secciones';
        $this->view->render('header');
        $this->view->render('seccion/index');
        $this->view->render('footer');
    }

    function listaSecciones() {
        /* CARGAMOS NIVELES */
        $this->view->consultaNiveles = $this->model->consultaNiveles();
        $this->view->title = 'Lista Secciones';
        $this->view->listaSecciones = $this->model->listaSecciones();
        $this->view->render('header');
        $this->view->render('seccion/listaSecciones');
        $this->view->render('footer');
    }

    function indexConfigSecciones() {
        $this->view->render('header');
        $this->view->render('seccion/indexConfigSecciones');
        $this->view->render('footer');
    }

    function configSecciones($nivel) {

        if ($nivel >= 7 && $nivel <= 9) {

            /* CARGAMOS NIVEL */
            $this->view->nivel = $nivel;

            /* CARGAMOS ZONAS */
            $this->view->consultaZonasEscuelas = $this->model->consultaZonasEscuelas($nivel);

            /* CARGAMOS TODAS LAS PROVINCIAS */
            $this->view->consultaProvincias = $this->model->consultaProvincias();

            /* CARGAMOS cantidad de distritos */
            $this->view->consultaEstadisticaZona = $this->model->consultaEstadisticaZona($nivel);

            /* CARGAMOS SECCIONES POR ZONAS */
            $this->view->consultaSeccionesZona = $this->model->consultaSeccionesZona($nivel);

            $this->view->title = 'Configuración Conjunto Secciones';
            $this->view->render('header');
            $this->view->render('seccion/configSecciones');
            $this->view->render('footer');
        } else {
            if ($nivel >= 10 && $nivel <= 12) {
                /* CARGAMOS NIVEL */
                $this->view->nivel = $nivel;

                /* CARGAMOS LA ESTADISTICA DE ESPECIALIDADES */
                $this->view->consultaEstadisticaEspecialidad = $this->model->consultaEstadisticaEspecialidad($nivel);

                /* CARGAMOS cantidad de distritos */
                $this->view->consultaEstadisticaZona = $this->model->consultaEstadisticaZona($nivel);

                /* CARGAMOS SECCIONES POR NIVEL */
                $this->view->consultaSeccionesDiversificada = $this->model->consultaSeccionesDiversificada($nivel);

                /* CARGAMOS ESPECIALIDADES DEL NIVEL */
                $this->view->consultaEspecialidadNivel = $this->model->consultaEspecialidadNivel($nivel);

                $this->view->title = 'Configuración Conjunto Secciones';
                $this->view->render('header');
                $this->view->render('seccion/configSeccionesDiversificada');
                $this->view->render('footer');
            } else {
                echo 'Nivel elegido erroneo...';
                die();
            }
        }
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
        $this->model->cargaSeccion($consulta);
    }

    //Carga los cantones de una Provincia en especifico
    function cargaCantones($idProvincia) {
        $this->model->cargaCantones($idProvincia);
    }

    //Carga los distritos de un Canton en especifico
    function cargaDistritos($idCanton) {
        $this->model->cargaDistritos($idCanton);
    }

    //Carga las escuela//
    function cargaEscuela($idDistrito) {
        $this->model->cargaEscuela($idDistrito);
    }

    //Carga las escuela//
    function consultaEscuelaZona($id_zona) {
        $this->model->consultaEscuelaZona($id_zona);
    }

    //Carga las escuela//
    function consultaDistritoZona($id_zona) {
        $this->model->consultaDistritoZona($id_zona);
    }

    //Carga estadistica de distritos estudiantes de setimo//
    function consultaEstadisticaZona() {
        $this->model->consultaEstadisticaZona();
    }

    function agregarZona() {
        $consulta = array();
        $consulta['txt_zona'] = $_POST['txt_zona'];
        $consulta['nivel'] = $_POST['nivel'];
        $this->model->agregarZona($consulta);
    }

    function eliminarZona() {
        $consulta = array();
        $consulta['id'] = $_POST['id'];
        $consulta['nivel'] = $_POST['nivel'];
        $this->model->eliminarZona($consulta);
    }

    function agregarEscuela() {
        $consulta = array();
        $consulta['id_zona'] = $_POST['id_zona'];
        $consulta['id_escuela'] = $_POST['id_escuela'];
        $consulta['nivel'] = $_POST['nivel'];
        $this->model->agregarEscuela($consulta);
    }

    function eliminarEscuela() {
        $consulta = array();
        $consulta['id_zona'] = $_POST['id_zona'];
        $consulta['id_escuela'] = $_POST['id_escuela'];
        $this->model->eliminarEscuela($consulta);
    }

    function agregarDistrito() {
        $consulta = array();
        $consulta['id_zona'] = $_POST['id_zona'];
        $consulta['id_distrito'] = $_POST['id_distrito'];
        $consulta['nivel'] = $_POST['nivel'];
        $this->model->agregarDistrito($consulta);
    }

    function eliminarDistrito() {
        $consulta = array();
        $consulta['id_zona'] = $_POST['id_zona'];
        $consulta['id_distrito'] = $_POST['id_distrito'];
        $this->model->eliminarDistrito($consulta);
    }

    function guardarCantidadSecciones() {
        $consulta = array();
        $consulta['id_zona'] = $_POST['id_zona'];
        $consulta['cantidadSecciones'] = $_POST['cantidadSecciones'];
        $consulta['nivel'] = $_POST['nivel'];
        $this->model->guardarCantidadSecciones($consulta);
    }

    /*  voy por aqui, se debe crear varias tablas nuevas, secciones_diversificada, seccion_especialidad, etc */

    function guardarCantidadSeccionesDiversificada() {
        $consulta = array();
        $consulta['cantidadSecciones'] = $_POST['cantidadSecciones'];
        $consulta['nivel'] = $_POST['nivel'];
        $this->model->guardarCantidadSeccionesDiversificada($consulta);
    }

    //Carga las especialidades de la sección guardades en la BD//
    function consultaEspecialidadesSeccion() {
        $consulta = array();
        $consulta['nivelSeleccionado'] = $_POST['nivelSeleccionado'];
        $consulta['grupoSeleccionado'] = $_POST['grupoSeleccionado'];
        $this->model->consultaEspecialidadesSeccion($consulta);
    }

    function agregarEspecialidad() {
        $consulta = array();
        $consulta['nivelSeleccionado'] = $_POST['nivelSeleccionado'];
        $consulta['grupoSeleccionado'] = $_POST['grupoSeleccionado'];
        $consulta['especialidad'] = $_POST['especialidad'];
        $this->model->agregarEspecialidad($consulta);
    }

    function eliminarEspecialidad() {
        $consulta = array();
        $consulta['nivelSeleccionado'] = $_POST['nivelSeleccionado'];
        $consulta['grupoSeleccionado'] = $_POST['grupoSeleccionado'];
        $consulta['especialidad'] = $_POST['especialidad'];
        $this->model->eliminarEspecialidad($consulta);
    }

    function proyectarSeccionesDiversificada($nivel) {
        $this->model->proyectarSeccionesDiversificada($nivel);
    }

    function consultaSeccionesProyectadas() {
        $this->model->consultaSeccionesProyectadas();
    }

    //ETAPA CRUZZZIAL -Opcion A//
    function consultaZonas() {
        $this->model->consultaZonas();
    }

    function consultaDistritosZona($id_zona) {
        $this->model->consultaDistritosZona($id_zona);
    }

    function consultaEstudiantesDistritosZona($id_distrito) {
        $this->model->consultaEstudiantesDistritosZona($id_distrito);
    }

    //ETAPA CRUZZZIAL -Opcion B//
    function consultaZonasOpcionB($nivel) {
        $this->model->consultaZonasOpcionB($nivel);
    }

    function consultaCantidadSeccionesZona($idDistrito) {
        $this->model->consultaCantidadSeccionesZona($idDistrito);
    }

    /* Modificar Sección */

    function modificarSeccion($ced_estudiante) {
        $this->view->datosEstudiante = $this->model->datosEstudiante($ced_estudiante);
        $this->view->consultaNiveles = $this->model->consultaNiveles();
        $this->view->title = 'Modificar Sección';
        $this->view->render('header');
        $this->view->render('seccion/modificarSeccion');
        $this->view->render('footer');
    }

    /* Carga los SubGrupos de un nivel en especifico */

    function cargaSubGrupos() {
        $consulta = array();
        $consulta['nivelSeleccionado'] = $_POST['nivelSeleccionado'];
        $consulta['grupoSeleccionado'] = $_POST['grupoSeleccionado'];
        $this->model->cargaSubGrupos($consulta);
    }

    /* Guardo la nueva seccion del estudiante */

    function guardarAsignarSeccion() {
        $datos = array();
        $datos['ced_estudiante'] = $_POST['ced_estudiante'];
        $datos['nivel'] = $_POST['sl_NivelesAsignarSeccion'];
        $datos['grupo'] = $_POST['sl_GruposAsignarSeccion'];
        $datos['subGrupo'] = $_POST['sl_SubGruposAsignarSeccion'];
        $this->view->msg = $this->model->guardarAsignarSeccion($datos);
        $this->view->render('header');
        $this->view->render('seccion/guardarAsignarSeccion');
        $this->view->render('footer');
    }

    function xhrInsert() {
        $this->model->xhrInsert();
    }

    function xhrGetListings() {
        $this->model->xhrGetListings();
    }

}

?>
