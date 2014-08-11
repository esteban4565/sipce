<?php
class Persona extends Controllers {
    function __construct(){
        parent::__construct();
        Auth::handleLogin(); 
        $this->view->js = array('persona/js/default.js');
    }
    function index(){
        $this->view->title = 'Usuarios'; 
        $this->view->personaList = $this->model->personaList();
        /*CARGAMOS LA LISTA DE ESTADO CIVIL*/
        $this->view->estadoCivilList = $this->model->estadoCivilList();
        
        /*CARGAMOS LA LISTA DE PAISES*/
        $this->view->paisesList = $this->model->paisesList();
        
        $this->view->render('header');
        $this->view->render('persona/index');
        $this->view->render('footer');
    }
    /*METODOS DE BUSQUEDA*/
    function buscarDocente(){
        $this->view->title = 'Buscar docente';
        $this->view->render('header');
        $this->view->render('persona/buscarDocente');
        $this->view->render('footer');
    }
    function buscarEstudiante(){
        $this->view->render('header');
        $this->view->render('persona/buscarEstudiante');
        $this->view->render('footer');
    }
    /*METODOS DE RESULTADOS DE BUSQUEDAS*/
    function resultadoBuscarDocente(){
        
        /*CARGAMOS PROVINCIAS*/
        $this->view->consultaProvincias = $this->model->consultaProvincias();
        /*CARGAMOS LOS PERMISOS*/
        $this->view->permisos = $this->model->CargaPermisos();
        /*CARGAMOS LA LISTA DE PAISES*/
        $this->view->paisesList = $this->model->paisesList();
        /*CARGAMOS LISTA DE ESTADO CIVIL*/
        $this->view->estadoCivilList = $this->model->estadoCivilList();
        
        /*OBTENEMOS LA CEDULA A BUSCAR*/
        $cedula = $_POST['tf_cedula'];
               
        $files_bd_sipce = $this->model->personaUnicaLista($cedula,"bd_sipce");
        $files_bd_padron = $this->model->personaUnicaLista($cedula,"bd_padron");
        
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
                if($count_bd_padron > 0){
                    $this->view->personaNueva = $this->model->personaUnicaLista($cedula,"bd_padron");
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
    function otra(){
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
    function ListaEstudiantes(){
        $this->view->title = 'Estudintes'; 
        $this->view->ListaEstudiantes = $this->model->ListaEstudiantes();
        $this->view->render('header');
        $this->view->render('persona/ListaEstudiantes');
        $this->view->render('footer');
    }
    /*Funcion que permite guardar el registro de un docente o estudiante*/
    function saveDocenteEstudiante(){
        
        $data = array();      
        $data['cedulaP']        = $_POST['tf_cedula'];
        $data['sexoP']          = $_POST['tf_sexo'];
        $data['ape1P']          = $_POST['tf_ape1'];
        $data['ape2P']          = $_POST['tf_ape2'];
        $data['nombreP']        = $_POST['tf_nombre'];
        $data['fnacimientoP']   = $_POST['tf_fnacpersona'];
        $data['nacionalidadP']  = $_POST['tf_nacionalidad'];
        $data['estadocivilP']   = $_POST['tf_estadocivil'];
        $data['telcelularP']    = $_POST['tf_telcelular'];
        $data['telcasaP']       = $_POST['tf_telcasa'];
        $data['domicilioP']     = $_POST['tf_domicilio'];
        $data['provinciaP']     = $_POST['tf_provincias'];
        $data['cantonP']        = $_POST['tf_cantones'];
        $data['distritoP']      = $_POST['tf_distritos'];
        $data['passwordP']      = $_POST['tf_cedula'];
        $data['emailP']         = $_POST['tf_email'];
        $data['roleP']          = $_POST['tf_role'];
        $data['estadoactualP']  = $_POST['tf_estadoactual'];
        
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
    function edit($cedula){
        //fetch individual de personas
        $this->view->persona = $this->model->personaUnicaLista($cedula);
        $this->view->title = 'Modificar-Usuarios'; 
        $this->view->render('header');
        $this->view->render('persona/edit');
        $this->view->render('footer');
    }
    function editSave($cedula){
        
        $data = array();      
        $data['cedula']     = $_POST['tf_cedula'];
        $data['ape1']       = $_POST['tf_ape1'];
        $data['ape2']       = $_POST['tf_ape2'];
        $data['nombre']     = $_POST['tf_nombre'];
        $data['sexo']       = $_POST['tf_sexo'];
        $data['username']   = $_POST['tf_usuario'];
        $data['password']   = $_POST['tf_clave'];
        $data['role']       = $_POST['tf_role'];
        $data['email']      = $_POST['tf_email'];
        
        //Checar los errores
        $this->model->editSave($data);
        header('location:'. URL .'persona');
    } 
    function delete($cedula){
        
        $this->model->delete($cedula);
        header('location:'.URL.'persona');
    }
    function buscarPersona($tipo){
        if($tipo == 1){
            $this->view->tipo = $tipo;
            $this->view->title = 'Buscar Docente';
            $this->view->mensaje = 'Modulo Usuario - Buscar Docente';
            
        }
        else{ 
            $this->view->tipo = $tipo;
            $this->view->title = 'Buscar Estudiante';
            $this->view->mensaje = 'Modulo Usuario - Buscar Estudiante';
        }
        $this->view->render('header');
        $this->view->render('persona/buscarPersona');
        $this->view->render('footer');
    }
    function resultadoBuscarPersona(){
        
        /*CARGAMOS PROVINCIAS*/
        $this->view->consultaProvincias = $this->model->consultaProvincias();
        /*CARGAMOS LOS PERMISOS*/
        $this->view->permisos = $this->model->CargaPermisos();
        /*CARGAMOS LA LISTA DE PAISES*/
        $this->view->paisesList = $this->model->paisesList();
        /*CARGAMOS LISTA DE ESTADO CIVIL*/
        $this->view->estadoCivilList = $this->model->estadoCivilList();
        
        /*Obtemos la cedula a buscar*/
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
    function cargaCantones($idProvincia){
        $this->model->cargaCantones($idProvincia);
    }
    function cargaDistritos($idCanton){
        $this->model->cargaDistritos($idCanton);
    }
    
}
?>
