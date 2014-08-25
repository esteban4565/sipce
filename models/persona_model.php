<?php
class Persona_Model extends Models{
    public function __construct(){
        parent::__construct();
    }
    /*METODOS DE BUSQUEDA*/
    public function buscarDocente(){}
    /*METODOS DE RESULTADOS DE BUSQUEDAS*/
    public function resultadobuscarDocente($cedula){
        return $this->db->select("SELECT * FROM sipce_persona WHERE cedula = :cedula", array(':cedula'=>$cedula));
    }

    /*Carga todos los paises*/
    public function CargaPais(){
        
    }
    /*Carga todas las provincias*/
    public function consultaProvincias(){
        return $this->db->select("SELECT * FROM sipce_provincias ORDER BY nombreProvincia", array());
    }
    /*Carga todos los cantones*/
    public function cargaCantones($idProvincia){
       
        $resultado = $this->db->select("SELECT * FROM sipce_cantones WHERE IdProvincia = :idProvincia ORDER BY Canton", 
                array('idProvincia' => $idProvincia));
        echo json_encode($resultado);
    }
    /*Carga todos los distritos*/
    public function cargaDistritos($idCanton){
        
        $resultado = $this->db->select("SELECT * FROM sipce_distritos WHERE IdCanton = :idCanton ORDER BY Distrito",
                array('idCanton' => $idCanton));
        echo json_encode($resultado);  
    }
    /*Retorna la lista de todo los usuarios*/
    public function ListaEstudiantes(){
       return $this->db->select("SELECT * FROM sipce_persona ORDER BY apellido1, apellido2", array()); 
    }

    /*Retorna los roles de permisos*/
    public function CargaPermisos(){
       return $this->db->select("SELECT * FROM sipce_permisos", array()); 
    }

    /*Retorna la lista de estado civil*/
    public function estadoCivilList(){
       return $this->db->select("SELECT * FROM sipce_estadocivil", array()); 
    }
    
    /*Retorna la lista de paises*/
    public function paisesList(){
       return $this->db->select("SELECT * FROM sipce_paises", array()); 
    }

    public function personaList(){
        
        return $this->db->select("SELECT * FROM tbl_user", array());
    } 
    public function personaUnicaLista($cedula, $basedatos){
        
        if($basedatos == "bd_sipce"){
            return $this->db->select("SELECT * FROM sipce_persona WHERE cedula = :cedula", array(':cedula'=>$cedula));
        }else{
            return $this->db->select("SELECT * FROM tpersonapadron WHERE cedula = :cedula", array(':cedula'=>$cedula));
        }
         
    } 
    public function saveDocenteEstudiante($data){
        
        $this->db->insert('sipce_persona', array(
           
        'cedula'=>$data['cedulaP'],
        'sexo'=>$data['sexoP'],
        'apellido1'=>$data['ape1P'],
        'apellido2'=>$data['ape2P'],
        'nombre'=>$data['nombreP'],
        'fechaNacimiento'=>$data['fnacimientoP'],
        'nacionalidad'=>$data['nacionalidadP'],
        'estadoCivil'=>$data['estadocivilP'],
        'telefonoCelular'=>$data['telcelularP'],
        'telefonoCasa'=>$data['telcasaP'],
        'domicilio'=>$data['domicilioP'],
        'idProvincia'=>$data['provinciaP'],
        'idCanton'=>$data['cantonP'],
        'idDistrito'=>$data['distritoP'],
        'passwords'=>Hash::create('md5',$data['passwordP'], HASH_PASSWORD_KEY),
        'email'=>$data['emailP'],
        'tipoUsuario'=>$data['roleP'],
        'estadoActual'=>$data['estadoactualP']      
        )); 
        /*
        return $sth->fetchAll();
        */
    }
    public function editSave($data){
        
        $posData = array(
        'cedula'    =>$data['cedula'], 
        'ape1'      =>$data['ape1'], 
        'ape2'      =>$data['ape2'], 
        'nombre'    =>$data['nombre'], 
        'sexo'      =>$data['sexo'], 
        'username'  =>$data['username'], 
        'password'  =>Hash::create('md5',$data['password'], HASH_PASSWORD_KEY), 
        'role'      =>$data['role'], 
        'email'     =>$data['email']);
        
        $this->db->update('tbl_user', $posData, "`cedula` = {$data['cedula']}");     
    }
    public function delete($cedula){
        
        $result = $this->db->select("SELECT role FROM tbl_user WHERE cedula = :cedula", array(':cedula' => $cedula));
        
        if($result[0]['role'] == 'ADMIN'){
            return false;
        }
        
        $this->db->delete('tbl_user', "cedula = '$cedula'");
        $sth = $this->db->prepare("DELETE FROM tbl_user WHERE cedula = :cedula");
        $sth->execute(array(':cedula'=>$cedula));
        
  
    }
}

?>