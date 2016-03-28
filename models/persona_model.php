<?php
class Persona_Model extends Models{
    public function __construct(){
        parent::__construct();
        $this->anioActivo = 2016;
    }
    /*METODOS DE BUSQUEDA*/
    public function buscarDocente(){}
    /*METODOS DE RESULTADOS DE BUSQUEDAS*/
    public function resultadobuscarDocente($cedula){
        return $this->db->select("SELECT * FROM sipce_estudiante WHERE cedula = :cedula", array(':cedula'=>$cedula));
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
            return $this->db->select("SELECT * FROM sipce_estudiante WHERE cedula = :cedula", array(':cedula'=>$cedula));
        }else{
            return $this->db->select("SELECT * FROM tpersonapadron WHERE cedula = :cedula", array(':cedula'=>$cedula));
        }
         
    } 
    public function saveDocenteEstudiante($data){
        
        $this->db->insert('sipce_estudiante', array(
           
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
    
    
    
//**Cosas de Esteban**//

    /*Retorna la lista de todo los usuarios*/
    public function listaEstudiantes(){
        return $this->db->select("SELECT cedula,nombre,apellido1,apellido2,nivel,grupo,sub_grupo "
                                ."FROM sipce_estudiante, sipce_grupos "
                                ."WHERE cedula = ced_estudiante "
                                ."AND tipoUsuario = 4 "
                                ."AND annio = ".$this->anioActivo." "
                                ."AND grupo <> 0 "
                                ."ORDER BY apellido1,apellido2,nombre");
    }
    
    /* Carga todas los Niveles */
    public function consultaNiveles() {
        return $this->db->select("SELECT DISTINCT nivel "
                                . "FROM sipce_grupos "
                                . "WHERE annio = ".$this->anioActivo." "
                                . "ORDER BY nivel");
    }

    /* Carga todos los Grupos de un Nivel */

    public function cargaGrupos($idNivel) {
        $resultado = $this->db->select("SELECT DISTINCT grupo FROM sipce_grupos "
                                . "WHERE nivel = :nivel "
                                . "AND annio = ".$this->anioActivo." "
                                . "AND grupo <> 0 "
                                . "ORDER BY grupo", array('nivel' => $idNivel));
        echo json_encode($resultado);
    }

    //Carga la lista de los estudiantes de una seccion en especifico
    public function cargaSeccion($consulta) {
        //campos
        $consultaSQL="SELECT e.cedula,e.nombre,e.apellido1,e.apellido2";
        if($consulta['grupoSeleccionado']!=0){
            $consultaSQL.=",g.sub_grupo";
        }
        if($consulta['chk_email']==1){
            $consultaSQL.=",e.email";
        }
        if($consulta['chk_poliza']==1){
            $consultaSQL.=",p.numero_poliza,p.fecha_vence";
        }
        if($consulta['chk_domicilio']==1){
            $consultaSQL.=",e.domicilio,d.Distrito,c.Canton,pro.nombreProvincia";
        }
        if($consulta['chk_telefonosEstu']==1){
            $consultaSQL.=",e.telefonoCasa,e.telefonoCelular";
        }
        if($consulta['chk_telefonosEncargado']==1){
            $consultaSQL.=",encar.nombre_encargado,encar.apellido1_encargado,encar.apellido2_encargado,encar.telefonoCasaEncargado,encar.telefonoCelularEncargado";
        }
        
        //tablas
        $consultaSQL.=" FROM sipce_estudiante as e,sipce_grupos as g";
        if($consulta['chk_poliza']==1){
            $consultaSQL.=",sipce_poliza as p";
        }
        if($consulta['chk_domicilio']==1){
            $consultaSQL.=",sipce_distritos as d,sipce_cantones as c,sipce_provincias as pro";
        }
        if($consulta['chk_telefonosEncargado']==1){
            $consultaSQL.=",sipce_encargado as encar";
        }
        
        //restricciones
        $consultaSQL.=" WHERE e.cedula = g.ced_estudiante";
        if($consulta['chk_poliza']==1){
            $consultaSQL.=" AND e.cedula = p.ced_estudiante";
        }
        $consultaSQL.=" AND e.tipoUsuario = 4";
        $consultaSQL.=" AND g.nivel = ".$consulta['nivelSeleccionado'];
        if($consulta['grupoSeleccionado']!=0){
            $consultaSQL.=" AND g.grupo = ".$consulta['grupoSeleccionado'];
        }
        if($consulta['chk_domicilio']==1){
            $consultaSQL.=" AND d.IdDistrito = e.IdDistrito "
                         . "AND c.IdCanton = e.IdCanton "
                         . "AND pro.IdProvincia = e.IdProvincia "
                         . "AND d.IdCanton = c.IdCanton "
                         . "AND c.IdProvincia = pro.IdProvincia";
        }
        if($consulta['chk_telefonosEncargado']==1){
            $consultaSQL.=" AND e.cedula = encar.ced_estudiante";
        }
        
        $consultaSQL.=" AND g.annio = ".$this->anioActivo;
        
        //orden
        $consultaSQL.=" ORDER BY ";
        if($consulta['grupoSeleccionado']!=0){
            $consultaSQL.="g.sub_grupo,";
        }
        $consultaSQL.="e.apellido1,e.apellido2,e.nombre";
        
        //consulta
        $resultado2 = $this->db->select($consultaSQL);
        echo json_encode($resultado2);
    }
}

?>