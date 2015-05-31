<?php

class Matricula_Model extends Models {

    public function __construct() {
        parent::__construct();
    }

    /* Carga el año lectivo */

    public function anio() {
        return 2016;
    }

    /* Carga todas las provincias */

    public function consultaProvincias() {
        return $this->db->select("SELECT * FROM sipce_provincias ORDER BY nombreProvincia", array());
    }

    /* Carga todas las Cantones */

    public function consultaCantones() {
        return $this->db->select("SELECT * FROM sipce_cantones ORDER BY Canton", array());
    }

    /* Carga todas los Distritos */

    public function consultaDistritos() {
        return $this->db->select("SELECT * FROM sipce_distritos ORDER BY Distrito", array());
    }

    /* Carga los cantones de una Provincia en especifico*/

    public function cargaCantones($idProvincia) {

        $resultado = $this->db->select("SELECT * FROM sipce_cantones WHERE IdProvincia = :idProvincia ORDER BY Canton", array('idProvincia' => $idProvincia));
        echo json_encode($resultado);
    }

    /* Carga los distritos de un Canton en especifico*/

    public function cargaDistritos($idCanton) {

        $resultado = $this->db->select("SELECT * FROM sipce_distritos WHERE IdCanton = :idCanton ORDER BY Distrito", array('idCanton' => $idCanton));
        echo json_encode($resultado);
    }

    /* Retorna la lista de estado civil */

    public function estadoCivilList() {
        return $this->db->select("SELECT * FROM sipce_estadocivil", array());
    }

    /* Retorna la lista de paises */

    public function paisesList() {
        return $this->db->select("SELECT * FROM sipce_paises", array());
    }

    /* Retorna la lista de todo los usuarios */

    public function listaEstudiantes() {
        return $this->db->select("SELECT cedula,nombre,apellido1,apellido2,nivel,grupo,sub_grupo "
                        . "FROM sipce_persona, sipce_grupos "
                        . "WHERE cedula = ced_estudiante "
                        . "AND tipoUsuario = 3 "
                        . "ORDER BY apellido1,apellido2");
    }

    /* Retorna la informacion del Estudiante */

    public function infoEstudiante($cedulaEstudiante) {
        return $this->db->select("SELECT p.cedula,p.nombre,p.apellido1,p.apellido2,p.sexo,p.fechaNacimiento,"
                        . "p.telefonoCelular,p.email,p.domicilio,p.escuela_procedencia,p.telefonoCasa,p.IdProvincia,"
                        . "p.IdCanton,p.IdDistrito,p.nacionalidad,g.nivel "
                        . "FROM sipce_persona as p,sipce_grupos as g "
                        . "WHERE p.cedula = g.ced_estudiante "
                        . "AND p.cedula = '" . $cedulaEstudiante . "' ");
    }

    /* Retorna la informacion del encargado Legal Estudiante */

    public function encargadoLegal($cedulaEstudiante) {
        return $this->db->select("SELECT ced_encargado,parentesco,nombre_encargado,apellido1_encargado,apellido2_encargado,"
                        . "telefonoCasaEncargado,telefonoCelularEncargado,emailEncargado,ocupacionEncargado "
                        . "FROM sipce_encargado  "
                        . "WHERE ced_estudiante = '" . $cedulaEstudiante . "' ");
    }

    /* Retorna la informacion de la Madre Estudiante */

    public function madreEstudiante($cedulaEstudiante) {
        return $this->db->select("SELECT ced_madre,nombre_madre,apellido1_madre,apellido2_madre,"
                        . "telefonoCasaMadre,ocupacionMadre "
                        . "FROM sipce_madre  "
                        . "WHERE ced_estudiante = '" . $cedulaEstudiante . "' ");
    }

    /* Retorna la informacion de la Padre Estudiante */

    public function padreEstudiante($cedulaEstudiante) {
        return $this->db->select("SELECT ced_padre,nombre_padre,apellido1_padre,apellido2_padre,"
                        . "telefonoCasaPadre,ocupacionPadre "
                        . "FROM sipce_padre  "
                        . "WHERE ced_estudiante = '" . $cedulaEstudiante . "' ");
    }

    /* Retorna la informacion de la Padre Estudiante */

    public function personaEmergenciaEstudiante($cedulaEstudiante) {
        return $this->db->select("SELECT ced_personaEmergencia,nombre_personaEmergencia,apellido1_personaEmergencia,"
                        . "apellido2_personaEmergencia,telefonoCasaPersonaEmergencia,telefonoCelularPersonaEmergencia "
                        . "FROM sipce_personaEmergencia  "
                        . "WHERE ced_estudiante = '" . $cedulaEstudiante . "' ");
    }

    /* Retorna enfermedades del Estudiante */

    public function enfermedadEstudiante($cedulaEstudiante) {
        return $this->db->select("SELECT descripcion "
                        . "FROM sipce_enfermedades  "
                        . "WHERE cedula = '" . $cedulaEstudiante . "' ");
    }

    /* Retorna informacion de la poliza del del Estudiante */

    public function polizaEstudiante($cedulaEstudiante) {
        return $this->db->select("SELECT numero_poliza,fecha_vence "
                        . "FROM sipce_poliza "
                        . "WHERE ced_estudiante = '" . $cedulaEstudiante . "' ");
    }

    /* Carga todos los estudiantes matriculados */

    public function infoCondicionMatricula($cedulaEstudiante) {
        return $this->db->select("SELECT condicion "
                        . "FROM sipce_matricularatificacion "
                        . "WHERE ced_estudiante = '" . $cedulaEstudiante . "' ");
    }

    /* Carga todos los estudiantes matriculados */

    public function infoAdelanta($cedulaEstudiante) {
        return $this->db->select("SELECT * "
                        . "FROM sipce_adelanta "
                        . "WHERE ced_estudiante = '" . $cedulaEstudiante . "' ");
    }

    /* Retorna datos del Encargado */

    public function buscarEncargado($ced_encargado) {
        $resultado = $this->db->select("SELECT nombre,primerApellido,segundoApellido "
                . "FROM tpersonapadron "
                . "WHERE cedula = '" . $ced_encargado . "' ");
        echo json_encode($resultado);
    }

    /* Retorna datos de la Madre */

    public function buscarMadre($ced_madre) {
        $resultado = $this->db->select("SELECT nombre,primerApellido,segundoApellido "
                . "FROM tpersonapadron "
                . "WHERE cedula = '" . $ced_madre . "' ");
        echo json_encode($resultado);
    }

    /* Retorna datos de la Madre */

    public function buscarPadre($ced_padre) {
        $resultado = $this->db->select("SELECT nombre,primerApellido,segundoApellido "
                . "FROM tpersonapadron "
                . "WHERE cedula = '" . $ced_padre . "' ");
        echo json_encode($resultado);
    }

    /* Retorna datos de la Persona encargada en caso de Emergencia */

    public function buscarPersonaEmergencia($ced_personaEmergencia) {
        $resultado = $this->db->select("SELECT nombre,primerApellido,segundoApellido "
                . "FROM tpersonapadron "
                . "WHERE cedula = '" . $ced_personaEmergencia . "' ");
        echo json_encode($resultado);
    }

    /* Inserta estudiante matriculado */

    public function guardarRatificacion($datos) {
        //Consulto si ya existe la matricula (para editarla)
        $consultaExistenciaMatricula = $this->db->select("SELECT * FROM sipce_matricularatificacion "
                . "WHERE ced_estudiante = '" . $datos['tf_cedulaEstudiante'] . "' "
                . "AND anio = " . $datos['anio']);

        if ($consultaExistenciaMatricula != null) {
            //Actualizo datos de la matricula
            $posData = array(
                'nivel' => $datos['sl_nivelMatricular'],
                'condicion' => $datos['sl_condicion'],
                'estado' => 2);
            $this->db->update('sipce_matricularatificacion', $posData, "`ced_estudiante` = '{$datos['tf_cedulaEstudiante']}'");
        } else {
            //Sino Inserto estado matriculado año proximo
            $this->db->insert('sipce_matricularatificacion', array(
                'ced_estudiante' => $datos['tf_cedulaEstudiante'],
                'anio' => $datos['anio'],
                'nivel' => $datos['sl_nivelMatricular'],
                'condicion' => $datos['sl_condicion'],
                'estado' => 1));
        }

        //Actualizo datos del expediente Estudiante
        $posData = array(
            'cedula' => $datos['tf_cedulaEstudiante'],
            'apellido1' => $datos['tf_ape1'],
            'apellido2' => $datos['tf_ape2'],
            'nombre' => $datos['tf_nombre'],
            'sexo' => $datos['tf_genero'],
            'fechaNacimiento' => $datos['tf_fnacpersona'],
            'telefonoCelular' => $datos['tf_telcelular'],
            'escuela_procedencia' => $datos['tf_primaria'],
            'email' => $datos['tf_email'],
            'domicilio' => $datos['tf_domicilio'],
            'idProvincia' => $datos['tf_provincias'],
            'IdCanton' => $datos['tf_cantones'],
            'IdDistrito' => $datos['tf_distritos']);

        $this->db->update('sipce_persona', $posData, "`cedula` = '{$datos['tf_cedulaEstudiante']}'");
        /* Falta        
          'nacionalidad'=>$datos['nacionalidadP'],
          'estadoCivil'=>$datos['estadocivilP'],
          'telefonoCasa'=>$datos['telcasaP'], */

        //Consulto si ya existe Encargado Legal
        $consultaExistenciaEncargado = $this->db->select("SELECT * FROM sipce_encargado WHERE ced_estudiante = '" . $datos['tf_cedulaEstudiante'] . "' ");

        if ($consultaExistenciaEncargado != null) {
            //Si ya existe el encargado lo actualizo
            $posData = array(
                'ced_encargado' => $datos['tf_cedulaEncargado'],
                'parentesco' => $datos['sel_parentesco'],
                'anio' => $datos['anio'],
                'nombre_encargado' => $datos['tf_nombreEncargado'],
                'apellido1_encargado' => $datos['tf_ape1Encargado'],
                'apellido2_encargado' => $datos['tf_ape2Encargado'],
                'telefonoCasaEncargado' => $datos['tf_telHabitEncargado'],
                'telefonoCelularEncargado' => $datos['tf_telcelularEncargado'],
                'ocupacionEncargado' => $datos['tf_ocupacionEncargado'],
                'emailEncargado' => $datos['tf_emailEncargado']);
            $this->db->update('sipce_encargado', $posData, "`ced_estudiante` = '{$datos['tf_cedulaEstudiante']}'");
        } else {
            //Si no, inserto los datos del Encargado Legal
            $this->db->insert('sipce_encargado', array(
                'ced_estudiante' => $datos['tf_cedulaEstudiante'],
                'ced_encargado' => $datos['tf_cedulaEncargado'],
                'parentesco' => $datos['sel_parentesco'],
                'anio' => $datos['anio'],
                'nombre_encargado' => $datos['tf_nombreEncargado'],
                'apellido1_encargado' => $datos['tf_ape1Encargado'],
                'apellido2_encargado' => $datos['tf_ape2Encargado'],
                'telefonoCasaEncargado' => $datos['tf_telHabitEncargado'],
                'telefonoCelularEncargado' => $datos['tf_telcelularEncargado'],
                'ocupacionEncargado' => $datos['tf_ocupacionEncargado'],
                'emailEncargado' => $datos['tf_emailEncargado']));
        }

        //Consulto si ya existe Padre
        $consultaExistenciaPadre = $this->db->select("SELECT * FROM sipce_padre WHERE ced_estudiante = '" . $datos['tf_cedulaEstudiante'] . "' ");

        if ($consultaExistenciaPadre != null) {
            //Si ya existe el Padre lo actualizo
            $posData = array(
                'ced_padre' => $datos['tf_cedulaPadre'],
                'nombre_padre' => $datos['tf_nombrePadre'],
                'apellido1_padre' => $datos['tf_ape1Padre'],
                'apellido2_padre' => $datos['tf_ape2Padre'],
                'telefonoCasaPadre' => $datos['tf_telHabitPadre'],
                'ocupacionPadre' => $datos['tf_ocupacionPadre']);
            $this->db->update('sipce_padre', $posData, "`ced_estudiante` = '{$datos['tf_cedulaEstudiante']}'");
        } else {
            //Si no, inserto los datos del Padre
            $this->db->insert('sipce_padre', array(
                'ced_estudiante' => $datos['tf_cedulaEstudiante'],
                'ced_padre' => $datos['tf_cedulaPadre'],
                'nombre_padre' => $datos['tf_nombrePadre'],
                'apellido1_padre' => $datos['tf_ape1Padre'],
                'apellido2_padre' => $datos['tf_ape2Padre'],
                'telefonoCasaPadre' => $datos['tf_telHabitPadre'],
                'ocupacionPadre' => $datos['tf_ocupacionPadre']));
        }

        //Consulto si ya existe Madre
        $consultaExistenciaMadre = $this->db->select("SELECT * FROM sipce_madre WHERE ced_estudiante = '" . $datos['tf_cedulaEstudiante'] . "' ");

        if ($consultaExistenciaMadre != null) {
            //Si ya existe la Madre la actualizo
            $posData = array(
                'ced_madre' => $datos['tf_cedulaMadre'],
                'nombre_madre' => $datos['tf_nombreMadre'],
                'apellido1_madre' => $datos['tf_ape1Madre'],
                'apellido2_madre' => $datos['tf_ape2Madre'],
                'telefonoCasaMadre' => $datos['tf_telHabitMadre'],
                'ocupacionMadre' => $datos['tf_ocupacionMadre']);
            $this->db->update('sipce_madre', $posData, "`ced_estudiante` = '{$datos['tf_cedulaEstudiante']}'");
        } else {
            //Si no, inserto los datos de la Madre
            $this->db->insert('sipce_madre', array(
                'ced_estudiante' => $datos['tf_cedulaEstudiante'],
                'ced_madre' => $datos['tf_cedulaMadre'],
                'nombre_madre' => $datos['tf_nombreMadre'],
                'apellido1_madre' => $datos['tf_ape1Madre'],
                'apellido2_madre' => $datos['tf_ape2Madre'],
                'telefonoCasaMadre' => $datos['tf_telHabitMadre'],
                'ocupacionMadre' => $datos['tf_ocupacionMadre']));
        }

        //Consulto si ya existe Persona Emergencia
        $consultaExistenciaPersonaEmergencia = $this->db->select("SELECT * FROM sipce_personaemergencia WHERE ced_estudiante = '" . $datos['tf_cedulaEstudiante'] . "' ");

        if ($consultaExistenciaPersonaEmergencia != null) {
            //Si ya existe la Persona Emergencia la actualizo
            $posData = array(
                'ced_personaEmergencia' => $datos['tf_cedulaPersonaEmergencia'],
                'nombre_personaEmergencia' => $datos['tf_nombrePersonaEmergencia'],
                'apellido1_personaEmergencia' => $datos['tf_ape1PersonaEmergencia'],
                'apellido2_personaEmergencia' => $datos['tf_ape2PersonaEmergencia'],
                'telefonoCasaPersonaEmergencia' => $datos['tf_telHabitPersonaEmergencia'],
                'telefonoCelularPersonaEmergencia' => $datos['tf_telHabitPersonaEmergencia']);
            $this->db->update('sipce_personaemergencia', $posData, "`ced_estudiante` = '{$datos['tf_cedulaEstudiante']}'");
        } else {
            //Si no, inserto los datos de la Persona Emergencia
            $this->db->insert('sipce_personaemergencia', array(
                'ced_estudiante' => $datos['tf_cedulaEstudiante'],
                'ced_personaEmergencia' => $datos['tf_cedulaPersonaEmergencia'],
                'nombre_personaEmergencia' => $datos['tf_nombrePersonaEmergencia'],
                'apellido1_personaEmergencia' => $datos['tf_ape1PersonaEmergencia'],
                'apellido2_personaEmergencia' => $datos['tf_ape2PersonaEmergencia'],
                'telefonoCasaPersonaEmergencia' => $datos['tf_telHabitPersonaEmergencia']));
        }

        //Consulto si ya existe Poliza
        $consultaExistenciaPoliza = $this->db->select("SELECT * FROM sipce_poliza WHERE ced_estudiante = '" . $datos['tf_cedulaEstudiante'] . "' ");

        if ($consultaExistenciaPoliza != null) {
            //Si ya existe la Poliza, la actualizo
            $posData = array(
                'numero_poliza' => $datos['tf_poliza'],
                'fecha_vence' => $datos['tf_polizaVence']);
            $this->db->update('sipce_poliza', $posData, "`ced_estudiante` = '{$datos['tf_cedulaEstudiante']}'");
        } else {
            //Si no, inserto los datos de la Poliza
            $this->db->insert('sipce_poliza', array(
                'ced_estudiante' => $datos['tf_cedulaEstudiante'],
                'numero_poliza' => $datos['tf_poliza'],
                'fecha_vence' => $datos['tf_polizaVence']));
        }

        //Consulto si ya existe Adelanto/Arraste
        $consultaExistenciaAdelta = $this->db->select("SELECT * FROM sipce_adelanta WHERE ced_estudiante = '" . $datos['tf_cedulaEstudiante'] . "' ");

        if ($consultaExistenciaAdelta != null) {
            //Si ya existe  Adelanto/Arraste, actualizo
            $posData = array(
                'anio' => $datos['anio'],
                'nivel' => $datos['sl_nivelMatricular']);
            $this->db->update('sipce_adelanta', $posData, "`ced_estudiante` = '{$datos['tf_cedulaEstudiante']}'");
        } else {
            //Si no, inserto los datos de la Poliza
            $this->db->insert('sipce_adelanta', array(
                'ced_estudiante' => $datos['tf_cedulaEstudiante'],
                'anio' => $datos['anio'],
                'nivel' => $datos['sl_nivelMatricular']));
        }
    }

    /* Carga todos los estudiantes matriculados */

    public function estadoMatricula() {
        return $this->db->select("SELECT cedula,nombre,apellido1,apellido2,nivel,condicion "
                        . "FROM sipce_persona,sipce_matricularatificacion "
                        . "WHERE cedula = ced_estudiante");
    }

    
    
    
    /*Ejemplo clasico de join entre tablas*/
    public function ejemploJoin($cedulaEstudiante) {
        return $this->db->select("SELECT p.cedula,p.nombre,p.apellido1,p.apellido2,p.sexo,p.fechaNacimiento,"
                        . "p.telefonoCelular,p.email,p.domicilio,p.escuela_procedencia,p.telefonoCasa,p.IdProvincia,"
                        . "p.IdCanton,p.IdDistrito,p.nacionalidad,g.nivel,j.nombreProvincia,c.Canton,d.Distrito "
                        . "FROM sipce_persona as p,sipce_grupos as g,sipce_provincias as j,sipce_cantones as c,sipce_distritos as d "
                        . "WHERE p.cedula = g.ced_estudiante "
                        . "AND p.cedula = '" . $cedulaEstudiante . "' "
                        . "AND p.IdProvincia = j.IdProvincia "
                        . "AND p.IdCanton = c.IdCanton "
                        . "AND p.IdDistrito = d.IdDistrito");
    }
}

?>