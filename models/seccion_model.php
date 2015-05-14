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
}

?>