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
    
    public function listaEstudiantesEspecialidad() {
        $this->view->title = 'Lista Estudiantes por Especialidad 2016 - Estudiantes Matriculados';

        //Se manda a ejecutar el header, contenido principal (views/horario/index) y el footer
        $this->view->render('header');
        $this->view->render('actualizarestudiantes/listaEstudiantesEspecialidad');
        $this->view->render('footer');
    }
    
    /* Metodos */
    function cargaProyeccion($idNivel) {
        $this->model->cargaProyeccion($idNivel);
    }
    
    function cargaProyeccionTotal() {
        $this->model->cargaProyeccionTotal();
    }
    
    function cargaProyeccionEspecialidad() {
        $consulta = array();      
        $consulta['nivelSeleccionado'] = $_POST['nivelSeleccionado'];
        $consulta['especialidad'] = $_POST['especialidad'];
        $this->model->cargaProyeccionEspecialidad($consulta);
    }
    
    function cargaProyeccionTotalEspecialidad() {
        $consulta = array();      
        $consulta['nivelSeleccionado'] = $_POST['nivelSeleccionado'];
        $consulta['especialidad'] = $_POST['especialidad'];
        $this->model->cargaProyeccionTotalEspecialidad($consulta);
    }
    
    function cargaProyeccionTotalTodasLasEspecialidad() {
        $consulta = array();      
        $consulta['nivelSeleccionado'] = $_POST['nivelSeleccionado'];
        $consulta['especialidad'] = $_POST['especialidad'];
        $this->model->cargaProyeccionTotalTodasLasEspecialidad($consulta);
    }
    
    function cargaListaEstudiantesEspecialidad() {
        $consulta = array();      
        $consulta['nivelSeleccionado'] = $_POST['nivelSeleccionado'];
        $consulta['especialidad'] = $_POST['especialidad'];
        $this->model->cargaListaEstudiantesEspecialidad($consulta);
    }
    
    function cargaListaEstudiantesMatriculados() {
        $consulta = array();      
        $consulta['nivelSeleccionado'] = $_POST['nivelSeleccionado'];
        $consulta['especialidad'] = $_POST['especialidad'];
        $this->model->cargaListaEstudiantesMatriculados($consulta);
    }
    
    /* Ingreso Personal */
    function ingresarPersonal() {
        $this->view->title = 'Nuevo Ingreso Personal';

        /* CARGAMOS LA LISTA DE PAISES */
        $this->view->consultaPaises = $this->model->consultaPaises();

        $this->view->render('header');
        $this->view->render('actualizarestudiantes/ingresarPersonal');
        $this->view->render('footer');
    }
    
    /* Guardar Ingreso Personal */
    function guardarIngresarPersonal() {
        $datos = array();
        $datos['tf_nacionalidad'] = $_POST['tf_nacionalidad'];
        $datos['tf_cedula'] = strtoupper($_POST['tf_cedula']);
        $datos['tf_ape1'] = strtoupper($_POST['tf_ape1']);
        $datos['tf_ape2'] = strtoupper($_POST['tf_ape2']);
        $datos['tf_nombre'] = strtoupper($_POST['tf_nombre']);
        $datos['tf_fnacpersona'] = $_POST['tf_fnacpersona'];
        $datos['tf_genero'] = $_POST['tf_genero'];
        $datos['tf_rol'] = $_POST['tf_rol'];
        $this->model->guardarIngresarPersonal($datos);

        //Se manda a ejecutar el header, contenido principal (Mensaje) y el footer
        $this->view->mensaje = 'Personal Ingresado Correctamente';
        $this->view->render('header');
        $this->view->render('actualizarestudiantes/msg');
        $this->view->render('footer');
    }

    /* Busco la persona  en la BD del Colegio, para evitar duplicidad en las Llaves Primarias*/
    function verificarPersona($cedula) {
        $this->model->verificarPersona($cedula);
    }

    /* Busco la cedula de la persona en el BD del Registro Nacional*/
    function buscarPersona($cedula) {
        $this->model->buscarPersona($cedula);
    }

    /* Busco al estudiante  en la BD del Colegio, para confirmar que existe*/
    function cargaEstudiantesSeccion() {
        $this->view->estudiantesNoEncontrados = $this->model->buscarCedulaEstudiante();
        $this->view->render('header');
        $this->view->render('actualizarestudiantes/cargaEstudiantesSeccion');
        $this->view->render('footer');
    }

    /* Cargo ausencias de estudiantes */
    function cargarAusencias() {
        $this->view->title = 'Cargar Ausencias Estudiantes';
        $this->view->render('header');
        $this->view->render('actualizarestudiantes/cargarAusencias');
        $this->view->render('footer');
    }

    /* Cargo ausencias de estudiantes */
    function guardarAusencias() {
        //Ruta de carpetas en localhost
        $ruta="../sipce";
        
        //Ruta de carpetas en hostinger.com
        //$ruta="../public_html";
        
        if ($_FILES['archivo']["error"] > 0)
            {
            echo "Error: " . $_FILES['archivo']['error'] . "<br>";
            die;
            }
            else
                {
                $datosArchivo=array();
                $datosArchivo['Nombre'] = $_FILES['archivo']['name'];
                $datosArchivo['Tipo'] = $_FILES['archivo']['type'];
                $datosArchivo['Tamaño'] = ($_FILES["archivo"]["size"] / 1024);
                $datosArchivo['CarpetaTemporal'] = $_FILES['archivo']['tmp_name'];
                
                /*Guardo el archivo en un lugar en especifico, utilizo move_uploaded_file, 
                                    con el if compruebo si tuvo exito el move_uploaded_file, luego continuo con el Model */
                if(move_uploaded_file($_FILES['archivo']['tmp_name'],$ruta . "/public/ausencias/" . $_FILES['archivo']['name'])){
                    $this->view->mensaje = $this->model->guardarAusencias($datosArchivo);
                }else{
                    echo "Error: " . $_FILES['archivo']['error'] . "<br>";
                    die;
                }
            }
        $this->view->title = 'Cargar Ausencias Estudiantes';
        $this->view->render('header');
        $this->view->render('actualizarestudiantes/msg');
        $this->view->render('footer');
    }

    /* Vista del administrador para ver ausencias de estudiantes */
    function verAusencias() {
        $this->view->title = 'Ausencias del Estudiantes';
        $this->view->consultaNiveles = $this->model->consultaNiveles();
        $this->view->render('header');
        $this->view->render('actualizarestudiantes/verAusencias');
        $this->view->render('footer');
    }
    
    /* Carga los Grupos de un nivel en especifico*/
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

    /* Cargo ausencias de estudiantes */
    function consultarAusencias($ced_estudiante = null) {
        $this->view->title = 'Ausencias del Estudiantes';
        if (Session::get('tipoUsuario') == 4){
            $ced_estudiante=Session::get('ced_estudiante');
        }
        $this->view->ausenciasEstudiante = $this->model->ausenciasEstudiante($ced_estudiante);
        $this->view->render('header');
        $this->view->render('actualizarestudiantes/consultarAusencias');
        $this->view->render('footer');
    }

}
