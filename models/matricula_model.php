<?php
class Matricula_Model extends Models{
    public function __construct(){
        parent::__construct();
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

    /*Retorna la lista de estado civil*/
    public function estadoCivilList(){
       return $this->db->select("SELECT * FROM sipce_estadocivil", array()); 
    }
    
    /*Retorna la lista de paises*/
    public function paisesList(){
       return $this->db->select("SELECT * FROM sipce_paises", array()); 
    }
    
    /*Retorna la lista de todo los usuarios*/
    public function listaEstudiantes(){
       return $this->db->select("SELECT cedula,nombre,apellido1,apellido2,nivel,grupo,sub_grupo "
                                ."FROM sipce_persona, sipce_grupos "
                                ."WHERE cedula = ced_estudiante "
                                ."AND tipoUsuario = 3 "
                                ."ORDER BY apellido1,apellido2"); 
    }
    
    /*Retorna la informacion del Estudiante*/
    public function infoEstudiante($cedulaEstudiante){
       return $this->db->select("SELECT cedula,nombre,apellido1,apellido2,sexo,fechaNacimiento,"
                                ."telefonoCelular,email,domicilio,escuela_procedencia "
                                ."FROM sipce_persona  "
                                ."WHERE cedula = '".$cedulaEstudiante."' "
                                ."AND tipoUsuario = 3 "); 
    }
    
    /*Retorna enfermedades del Estudiante*/
    public function enfermedadEstudiante($cedulaEstudiante){
       return $this->db->select("SELECT descripcion "
                                ."FROM sipce_enfermedades  "
                                ."WHERE cedula = '".$cedulaEstudiante."' "); 
    }
}

?>