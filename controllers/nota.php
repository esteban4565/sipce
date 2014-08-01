<?php
class Nota extends Controllers {
    public function __construct(){
        parent::__construct();
        Auth::handleLogin();
    }
    public function index(){
        $this->view->personaList = $this->model->personaList();
        $this->view->render('header');
        $this->view->render('nota/index');
        $this->view->render('footer');
    }
    public function create(){
        
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
        
        print_r($data);
        die;
        //Checar los errores
        $this->model->create($data);
        
        header('location:'. URL .'persona');
    }
    public function edit($cedula){
        
        //fetch individual de personas
        $this->view->persona = $this->model->personaUnicaLista($cedula);
        $this->view->render('persona/edit');
    }
    public function editSave($cedula){
        
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
    public function delete($cedula){
        
        $this->model->delete($cedula);
        header('location:'.URL.'persona');
    }
}
?>
