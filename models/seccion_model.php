<?php
class Seccion_Model extends Models{
    public function __construct(){
        parent::__construct();
    }
    
    /*Retorna la lista de todo los usuarios*/
    public function listaSecciones(){
       return $this->db->select("SELECT cedula,nombre,apellido1,apellido2,fechaNacimiento "
                                ."FROM sipce_persona, sipce_grupos "
                                ."WHERE cedula = ced_estudiante "
                                ."AND tipoUsuario = 3 "
                                ."AND nivel = 10 "
                                ."AND grupo = 3 "
                                ."AND sub_grupo = 'A' "
                                ."ORDER BY apellido1,apellido2"); 
    }
    
    
    /*Carga todas los Niveles*/
    public function consultaNiveles(){
        return $this->db->select('SELECT DISTINCT nivel FROM sipce_grupos ORDER BY nivel');
    }
    /*Carga todos los cantones*/
    public function cargaGrupos($idNivel){
       
        $resultado = $this->db->select("SELECT DISTINCT grupo FROM sipce_grupos "
                                ."WHERE nivel = :nivel "
                                ."ORDER BY grupo", 
                                array('nivel' => $idNivel));
        echo json_encode($resultado);
    }
    /*Carga todos los distritos*/
    public function cargaSubGrupos($idGrupo){
        
        $resultado = $this->db->select("SELECT DISTINCT sub_grupo FROM sipce_grupos "
                                ."WHERE grupo = :grupo ORDER BY sub_grupo",
                array('grupo' => $idGrupo));
        echo json_encode($resultado);  
    }
}

?>