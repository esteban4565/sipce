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

    function configSecciones() {
        /* CARGAMOS ZONAS */
        $this->view->consultaZonasEscuelas = $this->model->consultaZonasEscuelas();

        /* CARGAMOS TODAS LAS PROVINCIAS */
        $this->view->consultaProvincias = $this->model->consultaProvincias();
        
        $this->view->title = 'Configuración Conjunto Secciones';
        $this->view->render('header');
        $this->view->render('seccion/configSecciones');
        $this->view->render('footer');
    }
    
    /* Metodos */
    function cargaGrupos($idNivel) {
        $this->model->cargaGrupos($idNivel);
    }

    function cargaSubGrupos($idGrupo) {
        $this->model->cargaSubGrupos($idGrupo);
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
    function cargaEscuela($idDistrito)
    {
        $this->model->cargaEscuela($idDistrito);
    }
    
    //Carga las escuela//
    function consultaEscuelaZona($id_zona)
    {
        $this->model->consultaEscuelaZona($id_zona);
    }
    
    function agregarZona($txt_zona) {
        $this->model->agregarZona($txt_zona);
    }
    
    function eliminarZona($id) {
        $this->model->eliminarZona($id);
    }
    
    function agregarEscuela() {
        $consulta = array();      
        $consulta['id_zona'] = $_POST['id_zona'];
        $consulta['id_escuela'] = $_POST['id_escuela'];
        $this->model->agregarEscuela($consulta);
    }

    function xhrSeccion2() {
        $consulta = array();      
        $consulta['nivelSeleccionado'] = $_POST['nivelSeleccionado'];
        $consulta['grupoSeleccionado'] = $_POST['grupoSeleccionado'];
        $this->model->xhrSeccion2($consulta);
    }

    function xhrInsert() {
        $this->model->xhrInsert();
    }

    function xhrGetListings() {
        $this->model->xhrGetListings();
    }

}

?>
