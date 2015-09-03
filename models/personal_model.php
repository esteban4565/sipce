<?php

class Personal_Model extends Models {

    public function __construct() {
        parent::__construct();
    }

    /* Carga el año lectivo */

    public function anio() {
        return 2016;
    }

    /* Carga Director (a) */

    public function director() {
        return "Msc. Ingrid Jiménez López";
    }
    /* Carga lista de provincias */
    public function consultaProvincias() {
        return $this->db->select("SELECT * FROM sipce_provincias ORDER BY nombreProvincia", array());
    }
    /*Carga lista de universidades*/
    public function CargaUniversidades(){
        return $this->db->select("SELECT * FROM sipce_universidades ORDER BY nombre", array());
    }
    /* Carga todas las Cantones */

    public function consultaCantones() {
        return $this->db->select("SELECT * FROM sipce_cantones ORDER BY Canton", array());
    }

    /* Carga todas los Distritos */

    public function consultaDistritos() {
        return $this->db->select("SELECT * FROM sipce_distritos ORDER BY Distrito", array());
    }

    /* Carga los cantones de una Provincia en especifico */

    public function cargaCantones($idProvincia) {

        $resultado = $this->db->select("SELECT * FROM sipce_cantones WHERE IdProvincia = :idProvincia ORDER BY Canton", array('idProvincia' => $idProvincia));
        echo json_encode($resultado);
    }

    /* Carga los distritos de un Canton en especifico */

    public function cargaDistritos($idCanton) {

        $resultado = $this->db->select("SELECT * FROM sipce_distritos WHERE IdCanton = :idCanton ORDER BY Distrito", array('idCanton' => $idCanton));
        echo json_encode($resultado);
    }
    //Carga las escuela//
    function cargaEscuela($idDistrito){
       $resultado = $this->db->select("SELECT * FROM sipce_escuelas WHERE IdDistrito = :idDistrito ORDER BY nombre", array('idDistrito' => $idDistrito));
        echo json_encode($resultado); 
    }
    //Carga los colegios//
    public function cargaColegio($idDistrito){
       $resultado = $this->db->select("SELECT * FROM sipce_colegios WHERE IdDistrito = :idDistrito ORDER BY nombre", array('idDistrito' => $idDistrito));
        echo json_encode($resultado); 
    }

    /* Retorna la lista de estado civil */

    public function estadoCivilList() {
        return $this->db->select("SELECT * FROM sipce_estadocivil", array());
    }

    /* Retorna la lista de paises */

    public function consultaPaises() {
        return $this->db->select("SELECT * FROM sipce_paises", array());
    }
    /*Retorna la lista de colegios*/
    public function CargaEscuelas() {
        return $this->db->select("SELECT * FROM sipce_escuelas ORDER BY nombre", array());
    }
    /*Retorna la lista de colegios*/
    public function CargaColegios() {
        return $this->db->select("SELECT * FROM sipce_colegios ORDER BY nombre", array());
    }
    /* Retorna la lista de Especialidades */

    public function consultaEspecialidades() {
        return $this->db->select("SELECT * FROM sipce_especialidad", array());
    }

    /* Retorna la lista de todo los Estudiantes por Ratificar */

    public function listaEstudiantes() {
        return $this->db->select("SELECT cedula,nombre,apellido1,apellido2,nivel,grupo,sub_grupo "
                        . "FROM sipce_persona, sipce_grupos "
                        . "WHERE cedula NOT IN (select ced_estudiante from sipce_matricularatificacion) "
                        . "AND cedula = ced_estudiante "
                        . "AND tipoUsuario = 3 "
                        . "ORDER BY apellido1,apellido2");
    }

    /* Retorna Datos de Estudiante por Ratificar */

    public function buscarEstuRatif($ced_estudiante) {
        $resultado = $this->db->select("SELECT cedula,nombre,apellido1,apellido2,nivel,grupo,sub_grupo "
                . "FROM sipce_persona, sipce_grupos "
                . "WHERE cedula NOT IN (select ced_estudiante from sipce_matricularatificacion) "
                . "AND cedula = ced_estudiante "
                . "AND cedula = '" . $ced_estudiante . "'");

        echo json_encode($resultado);
    }

    /* Retorna la informacion del Estudiante */

    public function infoEstudiante($cedulaEstudiante) {
        return $this->db->select("SELECT p.cedula,p.nombre,p.apellido1,p.apellido2,p.sexo,p.fechaNacimiento,"
                        . "p.telefonoCasa,p.telefonoCelular,p.email,p.domicilio,p.escuela_procedencia,p.telefonoCasa,p.IdProvincia,"
                        . "p.IdCanton,p.IdDistrito,p.nacionalidad,g.nivel "
                        . "FROM sipce_persona as p,sipce_grupos as g "
                        . "WHERE p.cedula = g.ced_estudiante "
                        . "AND p.cedula = '" . $cedulaEstudiante . "' ");
    }

    /* Retorna la informacion de la especialidad del Estudiante */

    public function especialidadEstudiante($cedulaEstudiante) {
        return $this->db->select("SELECT cod_especialidad, nombreEspecialidad "
                        . "FROM sipce_especialidad_estudiante, sipce_especialidad  "
                        . "WHERE ced_estudiante = '" . $cedulaEstudiante . "' "
                        . "AND codigoEspecialidad = cod_especialidad");
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
        return $this->db->select("SELECT ced_personaEmergencia,parentesco,nombre_personaEmergencia,apellido1_personaEmergencia,"
                        . "apellido2_personaEmergencia,telefonoCasaPersonaEmergencia,telefonoCelularPersonaEmergencia "
                        . "FROM sipce_personaemergencia  "
                        . "WHERE ced_estudiante = '" . $cedulaEstudiante . "' ");
    }

    /* Retorna enfermedades del Estudiante */

    public function enfermedadEstudiante($cedulaEstudiante) {
        return $this->db->select("SELECT descripcion "
                        . "FROM sipce_enfermedades  "
                        . "WHERE cedula = '" . $cedulaEstudiante . "' ");
    }

    /* Retorna adecuacio del Estudiante */

    public function adecuacionEstudiante($cedulaEstudiante) {
        return $this->db->select("SELECT adecuacion "
                        . "FROM sipce_adecuacion  "
                        . "WHERE ced_estudiante = '" . $cedulaEstudiante . "' ");
    }

    /* Retorna adecuacio del Estudiante */

//Ojo año quemado, buscar solucion
    public function becasEstudiante($cedulaEstudiante) {
        return $this->db->select("SELECT * "
                        . "FROM sipce_beca  "
                        . "WHERE ced_estudiante = '" . $cedulaEstudiante . "' "
                        . "AND anio = 2016 ");
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

    /* Retorna datos del Estudiante */

    public function buscarEstudiante($ced_estudiante) {
        $resultado = $this->db->select("SELECT * "
                . "FROM tpersonapadron "
                . "WHERE cedula = '" . $ced_estudiante . "' ");
        echo json_encode($resultado);
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

    /* Ratifica(Update) estudiante en la BD */

    public function guardarRatificacion($datos) {
        //'estado' 1 = Matricula Ratificada
        //'estado' 2 = Matricula Ratificada Editada
        //'estado' 3 = Matricula Nuevo Ingreso
        //Consulto si ya existe la matricula
        $consultaExistenciaMatricula = $this->db->select("SELECT * FROM sipce_matricularatificacion "
                . "WHERE ced_estudiante = '" . $datos['tf_cedulaEstudiante'] . "' "
                . "AND anio = " . $datos['anio']);

        if ($consultaExistenciaMatricula != null) {
            //Actualizo datos y 'estado' Matricula Ratificada Editada
            $posData = array(
                'nivel' => $datos['sl_nivelMatricular'],
                'condicion' => $datos['sl_condicion'],
                'estado' => 2);
            $this->db->update('sipce_matricularatificacion', $posData, "`ced_estudiante` = '{$datos['tf_cedulaEstudiante']}'");
        } else {
            //Sino Inserto datos y 'estado' Matricula Ratificada
            $this->db->insert('sipce_matricularatificacion', array(
                'ced_estudiante' => $datos['tf_cedulaEstudiante'],
                'anio' => $datos['anio'],
                'nivel' => $datos['sl_nivelMatricular'],
                'condicion' => $datos['sl_condicion'],
                'estado' => 1));
        }

        //Consulto si ya existe la Enfermedad
        $consultaExistenciaEnfermedad = $this->db->select("SELECT * FROM sipce_enfermedades "
                . "WHERE cedula = '" . $datos['tf_cedulaEstudiante'] . "' "
                . "AND anio = " . $datos['anio']);

        if ($datos['sel_enfermedad'] == 1) {
            if ($consultaExistenciaEnfermedad != null) {
                //Actualizo datos
                $posData = array(
                    'descripcion' => $datos['tf_enfermedadDescripcion']);
                $this->db->update('sipce_enfermedades', $posData, "`cedula` = '{$datos['tf_cedulaEstudiante']}'");
            } else {
                //Sino Inserto datos
                $this->db->insert('sipce_enfermedades', array(
                    'cedula' => $datos['tf_cedulaEstudiante'],
                    'anio' => $datos['anio'],
                    'descripcion' => $datos['tf_enfermedadDescripcion']));
            }
        } else {
            if ($consultaExistenciaEnfermedad != null) {
                //Borro datos
                $sth = $this->db->prepare("DELETE FROM sipce_enfermedades WHERE cedula ='" . $datos['tf_cedulaEstudiante'] . "' AND anio = " . $datos['anio']);
                $sth->execute();
            }
        }

        //Consulto si ya existe la Adecuacion
        $consultaExistenciaAdecuacion = $this->db->select("SELECT * FROM sipce_adecuacion "
                . "WHERE ced_estudiante = '" . $datos['tf_cedulaEstudiante'] . "' "
                . "AND anio = " . $datos['anio']);

        if ($datos['sl_adecuacion'] != 'No') {
            if ($consultaExistenciaAdecuacion != null) {
                //Actualizo datos
                $posData = array(
                    'adecuacion' => $datos['sl_adecuacion']);
                $this->db->update('sipce_adecuacion', $posData, "`ced_estudiante` = '{$datos['tf_cedulaEstudiante']}'");
            } else {
                //Sino Inserto datos
                $this->db->insert('sipce_adecuacion', array(
                    'ced_estudiante' => $datos['tf_cedulaEstudiante'],
                    'anio' => $datos['anio'],
                    'adecuacion' => $datos['sl_adecuacion']));
            }
        } else {
            if ($consultaExistenciaAdecuacion != null) {
                //Borro datos
                $sth = $this->db->prepare("DELETE FROM sipce_adecuacion WHERE ced_estudiante ='" . $datos['tf_cedulaEstudiante'] . "' AND anio = " . $datos['anio']);
                $sth->execute();
            }
        }

        //Consulto si ya existe Becas Avancemos
        $consultaExistenciaBecaAvancemos = $this->db->select("SELECT * FROM sipce_beca "
                . "WHERE ced_estudiante = '" . $datos['tf_cedulaEstudiante'] . "' "
                . "AND anio = " . $datos['anio']);

        if ($datos['sl_becaAvancemos'] != 'No') {
            if ($consultaExistenciaBecaAvancemos != null) {
                //Actualizo datos
                $posData = array(
                    'becaAvancemos' => 1);
                $this->db->update('sipce_beca', $posData, "`ced_estudiante` = '{$datos['tf_cedulaEstudiante']}'");
            } else {
                //Sino Inserto datos
                $this->db->insert('sipce_beca', array(
                    'ced_estudiante' => $datos['tf_cedulaEstudiante'],
                    'anio' => $datos['anio'],
                    'becaAvancemos' => 1));
            }
        } else {
            if ($consultaExistenciaBecaAvancemos != null) {
                //Actualizo datos
                $posData = array(
                    'becaAvancemos' => 0);
                $this->db->update('sipce_beca', $posData, "`ced_estudiante` = '{$datos['tf_cedulaEstudiante']}'");
            }
        }

        //Consulto si ya existe Becas Comedor
        $consultaExistenciaBecaComedor = $this->db->select("SELECT * FROM sipce_beca "
                . "WHERE ced_estudiante = '" . $datos['tf_cedulaEstudiante'] . "' "
                . "AND anio = " . $datos['anio']);

        if ($datos['sl_becaComedor'] != 'No') {
            if ($consultaExistenciaBecaComedor != null) {
                //Actualizo datos
                $posData = array(
                    'becaComedor' => 1);
                $this->db->update('sipce_beca', $posData, "`ced_estudiante` = '{$datos['tf_cedulaEstudiante']}'");
            } else {
                //Sino Inserto datos
                $this->db->insert('sipce_beca', array(
                    'ced_estudiante' => $datos['tf_cedulaEstudiante'],
                    'anio' => $datos['anio'],
                    'becaComedor' => 1));
            }
        } else {
            if ($consultaExistenciaBecaComedor != null) {
                //Actualizo datos
                $posData = array(
                    'becaComedor' => 0);
                $this->db->update('sipce_beca', $posData, "`ced_estudiante` = '{$datos['tf_cedulaEstudiante']}'");
            }
        }

        //Consulto si ya existe Becas Transporte
        $consultaExistenciaBecaTransporte = $this->db->select("SELECT * FROM sipce_beca "
                . "WHERE ced_estudiante = '" . $datos['tf_cedulaEstudiante'] . "' "
                . "AND anio = " . $datos['anio']);

        if ($datos['sl_becaTransporte'] != 'No') {
            if ($consultaExistenciaBecaTransporte != null) {
                //Actualizo datos
                $posData = array(
                    'becaTransporte' => 1);
                $this->db->update('sipce_beca', $posData, "`ced_estudiante` = '{$datos['tf_cedulaEstudiante']}'");
            } else {
                //Sino Inserto datos
                $this->db->insert('sipce_beca', array(
                    'ced_estudiante' => $datos['tf_cedulaEstudiante'],
                    'anio' => $datos['anio'],
                    'becaTransporte' => 1));
            }
        } else {
            if ($consultaExistenciaBecaTransporte != null) {
                //Actualizo datos
                $posData = array(
                    'becaTransporte' => 0);
                $this->db->update('sipce_beca', $posData, "`ced_estudiante` = '{$datos['tf_cedulaEstudiante']}'");
            }
        }

        //Consulto si el estudiante esta asignado a un Nivel, Grupo, Subgrupo
        $consultaExistenciaNivel = $this->db->select("SELECT * FROM sipce_grupos "
                . "WHERE ced_estudiante = '" . $datos['tf_cedulaEstudiante'] . "' ");

        if ($consultaExistenciaNivel != null) {
            //Actualizo nivel del Estudiante
            $datosNivel = array(
                'nivel' => $datos['sl_nivelMatricular']);

            $this->db->update('sipce_grupos', $datosNivel, "`ced_estudiante` = '{$datos['tf_cedulaEstudiante']}'");
        } else {
            //Sino Inserto datos en sipce_grupos
            $this->db->insert('sipce_grupos', array(
                'ced_estudiante' => $datos['tf_cedulaEstudiante'],
                'nivel' => $datos['sl_nivelMatricular']));
        }

        //Actualizo datos del expediente Estudiante
        $posData = array(
            'nacionalidad' => $datos['tf_nacionalidad'],
            'cedula' => $datos['tf_cedulaEstudiante'],
            'apellido1' => $datos['tf_ape1'],
            'apellido2' => $datos['tf_ape2'],
            'nombre' => $datos['tf_nombre'],
            'sexo' => $datos['tf_genero'],
            'fechaNacimiento' => $datos['tf_fnacpersona'],
            'telefonoCasa' => $datos['tf_telHabitEstudiante'],
            'telefonoCelular' => $datos['tf_telcelular'],
            'escuela_procedencia' => $datos['tf_primaria'],
            'email' => $datos['tf_email'],
            'domicilio' => $datos['tf_domicilio'],
            'idProvincia' => $datos['tf_provincias'],
            'IdCanton' => $datos['tf_cantones'],
            'IdDistrito' => $datos['tf_distritos']);

        $this->db->update('sipce_persona', $posData, "`cedula` = '{$datos['tf_cedulaEstudiante']}'");
        /* Falta
          'estadoCivil'=>$datos['estadocivilP'],
          'telefonoCasa'=>$datos['telcasaP'], */


        //Consulto si el nivel es superio a Noveno
        if ($datos['sl_nivelMatricular'] >= 9) {
            //Consulto si ya tiene asignado una especialidad
            $consultaExistenciaEspecialidad = $this->db->select("SELECT * FROM sipce_especialidad_estudiante "
                    . "WHERE ced_estudiante = '" . $datos['tf_cedulaEstudiante'] . "' ");

            if ($consultaExistenciaEspecialidad != null) {
                //Actualizo datos de la especialidad
                $posData = array(
                    'cod_especialidad' => $datos['tf_especialidad']);
                $this->db->update('sipce_especialidad_estudiante', $posData, "`ced_estudiante` = '{$datos['tf_cedulaEstudiante']}'");
            } else {
                //Sino Inserto especialidad matriculada
                $this->db->insert('sipce_especialidad_estudiante', array(
                    'ced_estudiante' => $datos['tf_cedulaEstudiante'],
                    'cod_especialidad' => $datos['tf_especialidad']));
            }
        }

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
                'telefonoCasaPadre' => $datos['tf_telCelPadre'],
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
                'telefonoCasaPadre' => $datos['tf_telCelPadre'],
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
                'telefonoCasaMadre' => $datos['tf_telCelMadre'],
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
                'telefonoCasaMadre' => $datos['tf_telCelMadre'],
                'ocupacionMadre' => $datos['tf_ocupacionMadre']));
        }

        //Consulto si ya existe Persona Emergencia
        $consultaExistenciaPersonaEmergencia = $this->db->select("SELECT * FROM sipce_personaemergencia WHERE ced_estudiante = '" . $datos['tf_cedulaEstudiante'] . "' ");

        if ($consultaExistenciaPersonaEmergencia != null) {
            //Si ya existe la Persona Emergencia la actualizo
            $posData = array(
                'ced_personaEmergencia' => $datos['tf_cedulaPersonaEmergencia'],
                'parentesco' => $datos['sel_parentescoCasoEmergencia'],
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
                'parentesco' => $datos['sel_parentescoCasoEmergencia'],
                'nombre_personaEmergencia' => $datos['tf_nombrePersonaEmergencia'],
                'apellido1_personaEmergencia' => $datos['tf_ape1PersonaEmergencia'],
                'apellido2_personaEmergencia' => $datos['tf_ape2PersonaEmergencia'],
                'telefonoCasaPersonaEmergencia' => $datos['tf_telHabitPersonaEmergencia'],
                'telefonoCelularPersonaEmergencia' => $datos['tf_telcelularPersonaEmergencia']));
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
        $consultaExistenciaAdelanta = $this->db->select("SELECT * FROM sipce_adelanta WHERE ced_estudiante = '" . $datos['tf_cedulaEstudiante'] . "' ");

        if ($datos['sl_adelanta'] == "si" && $datos['sl_condicion'] == "Repite") {
            if ($consultaExistenciaAdelanta != null) {
                //Si ya existe  Adelanto/Arraste, actualizo
                $posData = array(
                    'anio' => $datos['anio'],
                    'nivel' => $datos['sl_nivelMatricular'],
                    'nivel_adelanta' => $datos['sl_nivelMatricular'] + 1);
                $this->db->update('sipce_adelanta', $posData, "`ced_estudiante` = '{$datos['tf_cedulaEstudiante']}'");
            } else {
                //Si no, inserto los datos de la Poliza
                $this->db->insert('sipce_adelanta', array(
                    'ced_estudiante' => $datos['tf_cedulaEstudiante'],
                    'anio' => $datos['anio'],
                    'nivel' => $datos['sl_nivelMatricular'],
                    'nivel_adelanta' => $datos['sl_nivelMatricular'] + 1));
            }
        } else {
            if ($consultaExistenciaAdelanta != null) {
                //Borro datos
                $sth = $this->db->prepare("DELETE FROM sipce_adelanta WHERE ced_estudiante ='" . $datos['tf_cedulaEstudiante'] . "' AND anio = " . $datos['anio']);
                $sth->execute();
            }
        }
    }

    /* Inserta estudiante Nuevo Ingreso en la BD */

    public function guardarNuevoIngreso($datos) {
        //'estado' 1 = Matricula Ratificada
        //'estado' 2 = Matricula Ratificada Editada
        //'estado' 3 = Matricula Nuevo Ingreso
        //Consulto si ya existe la matricula
        $consultaExistenciaMatricula = $this->db->select("SELECT * FROM sipce_matricularatificacion "
                . "WHERE ced_estudiante = '" . $datos['tf_cedulaEstudiante'] . "' "
                . "AND anio = " . $datos['anio']);

        if ($consultaExistenciaMatricula != null) {
            //No se puede hacer nuevo ingreso xq ya existe
            echo '<h1>ya existe estudiante en sipce_matricularatificacion';
            die;
        } else {
            //Sino Inserto datos y 'estado' Matricula Nuevo Ingreso
            $this->db->insert('sipce_matricularatificacion', array(
                'ced_estudiante' => $datos['tf_cedulaEstudiante'],
                'anio' => $datos['anio'],
                'nivel' => $datos['sl_nivelMatricular'],
                'condicion' => $datos['sl_condicion'],
                'estado' => 3));
        }

        //Consulto si ya existe la Enfermedad
        $consultaExistenciaEnfermedad = $this->db->select("SELECT * FROM sipce_enfermedades "
                . "WHERE cedula = '" . $datos['tf_cedulaEstudiante'] . "' "
                . "AND anio = " . $datos['anio']);

        if ($datos['sel_enfermedad'] == 1) {
            if ($consultaExistenciaEnfermedad != null) {
                //No se puede hacer nuevo ingreso xq ya existe
                echo '<h1>ya existe estudiante en sipce_enfermedades';
                die;
            } else {
                //Sino Inserto datos
                $this->db->insert('sipce_enfermedades', array(
                    'cedula' => $datos['tf_cedulaEstudiante'],
                    'anio' => $datos['anio'],
                    'descripcion' => $datos['tf_enfermedadDescripcion']));
            }
        }

        //Consulto si ya existe la Adecuacion
        $consultaExistenciaAdecuacion = $this->db->select("SELECT * FROM sipce_adecuacion "
                . "WHERE ced_estudiante = '" . $datos['tf_cedulaEstudiante'] . "' "
                . "AND anio = " . $datos['anio']);

        if ($datos['sl_adecuacion'] != 'No') {
            if ($consultaExistenciaAdecuacion != null) {
                //No se puede hacer nuevo ingreso xq ya existe
                echo '<h1>ya existe estudiante en sipce_adecuacion';
                die;
            } else {
                //Sino Inserto datos
                $this->db->insert('sipce_adecuacion', array(
                    'ced_estudiante' => $datos['tf_cedulaEstudiante'],
                    'anio' => $datos['anio'],
                    'adecuacion' => $datos['sl_adecuacion']));
            }
        }

        //Consulto si ya existe Becas Avancemos
        $consultaExistenciaBecaAvancemos = $this->db->select("SELECT * FROM sipce_beca "
                . "WHERE ced_estudiante = '" . $datos['tf_cedulaEstudiante'] . "' "
                . "AND anio = " . $datos['anio']);

        if ($datos['sl_becaAvancemos'] != 'No') {
            if ($consultaExistenciaBecaAvancemos != null) {
                //No se puede hacer nuevo ingreso xq ya existe
                echo '<h1>ya existe BecaAvancemos del estudiante en sipce_beca';
            } else {
                //Sino Inserto datos
                $this->db->insert('sipce_beca', array(
                    'ced_estudiante' => $datos['tf_cedulaEstudiante'],
                    'anio' => $datos['anio'],
                    'becaAvancemos' => 1));
            }
        } else {
            if ($consultaExistenciaBecaAvancemos != null) {
                //Actualizo datos
                $posData = array(
                    'becaAvancemos' => 0);
                $this->db->update('sipce_beca', $posData, "`ced_estudiante` = '{$datos['tf_cedulaEstudiante']}'");
            }
        }

        //Consulto si ya existe Becas Comedor
        $consultaExistenciaBecaComedor = $this->db->select("SELECT * FROM sipce_beca "
                . "WHERE ced_estudiante = '" . $datos['tf_cedulaEstudiante'] . "' "
                . "AND anio = " . $datos['anio']);

        if ($datos['sl_becaComedor'] != 'No') {
            if ($consultaExistenciaBecaComedor != null) {
                //No se puede hacer nuevo ingreso xq ya existe
                echo '<h1>ya existe BecaComedor del estudiante en sipce_beca';
            } else {
                //Sino Inserto datos
                $this->db->insert('sipce_beca', array(
                    'ced_estudiante' => $datos['tf_cedulaEstudiante'],
                    'anio' => $datos['anio'],
                    'becaComedor' => 1));
            }
        }

        //Consulto si ya existe Becas Transporte
        $consultaExistenciaBecaTransporte = $this->db->select("SELECT * FROM sipce_beca "
                . "WHERE ced_estudiante = '" . $datos['tf_cedulaEstudiante'] . "' "
                . "AND anio = " . $datos['anio']);

        if ($datos['sl_becaTransporte'] != 'No') {
            if ($consultaExistenciaBecaTransporte != null) {
                //No se puede hacer nuevo ingreso xq ya existe
                echo '<h1>ya existe BecaTransporte del estudiante en sipce_beca';
            } else {
                //Sino Inserto datos
                $this->db->insert('sipce_beca', array(
                    'ced_estudiante' => $datos['tf_cedulaEstudiante'],
                    'anio' => $datos['anio'],
                    'becaTransporte' => 1));
            }
        }

//        print_r($datos['tf_cedulaEstudiante']);
//        echo '<br>';
//        print_r($datos['sl_nivelMatricular']);
//        die;
        //Consulto si el estudiante esta asignado a un Nivel, Grupo, Subgrupo
        $consultaExistenciaNivel = $this->db->select("SELECT * FROM sipce_grupos "
                . "WHERE ced_estudiante = '" . $datos['tf_cedulaEstudiante'] . "' ");

        if ($consultaExistenciaNivel != null) {
            //No deberia estar asignado a ningun grupoya que es Nuevo Ingreso
            echo '<h1>ya existe estudiante en sipce_grupos';
            die;
        } else {
            //Sino Inserto datos en sipce_grupos
            $this->db->insert('sipce_grupos', array(
                'ced_estudiante' => $datos['tf_cedulaEstudiante'],
                'nivel' => $datos['sl_nivelMatricular']));
        }

        //Consulto si ya existe datos en el expediente (para editarla)
        $consultaExistenciaEstudiante = $this->db->select("SELECT * FROM sipce_persona "
                . "WHERE cedula = '" . $datos['tf_cedulaEstudiante'] . "' ");

        if ($consultaExistenciaEstudiante != null) {
            //No se puede hacer nuevo ingreso xq ya existe
            echo '<h1>ya existe estudiante en sipce_persona';
            die;
        } else {
            //Sino Inserto datos del expediente Estudiante
            $this->db->insert('sipce_persona', array(
                'nacionalidad' => $datos['tf_nacionalidad'],
                'cedula' => $datos['tf_cedulaEstudiante'],
                'apellido1' => $datos['tf_ape1'],
                'apellido2' => $datos['tf_ape2'],
                'nombre' => $datos['tf_nombre'],
                'sexo' => $datos['tf_genero'],
                'fechaNacimiento' => $datos['tf_fnacpersona'],
                'telefonoCasa' => $datos['tf_telHabitEstudiante'],
                'telefonoCelular' => $datos['tf_telcelular'],
                'escuela_procedencia' => $datos['tf_primaria'],
                'email' => $datos['tf_email'],
                'domicilio' => $datos['tf_domicilio'],
                'idProvincia' => $datos['tf_provincias'],
                'IdCanton' => $datos['tf_cantones'],
                'IdDistrito' => $datos['tf_distritos']));
        }
        /* Falta
          'estadoCivil'=>$datos['estadocivilP']
         */


        //Consulto si el nivel es superio a Noveno
        if ($datos['sl_nivelMatricular'] >= 9) {
            //Consulto si ya tiene asignado una especialidad
            $consultaExistenciaEspecialidad = $this->db->select("SELECT * FROM sipce_especialidad_estudiante "
                    . "WHERE ced_estudiante = '" . $datos['tf_cedulaEstudiante'] . "' ");

            if ($consultaExistenciaEspecialidad != null) {
                //Actualizo datos de la especialidad
                $posData = array(
                    'cod_especialidad' => $datos['tf_especialidad']);
                $this->db->update('sipce_especialidad_estudiante', $posData, "`ced_estudiante` = '{$datos['tf_cedulaEstudiante']}'");
            } else {
                //Sino Inserto especialidad matriculada
                $this->db->insert('sipce_especialidad_estudiante', array(
                    'ced_estudiante' => $datos['tf_cedulaEstudiante'],
                    'cod_especialidad' => $datos['tf_especialidad']));
            }
        }

        //Consulto si ya existe Encargado Legal
        $consultaExistenciaEncargado = $this->db->select("SELECT * FROM sipce_encargado WHERE ced_estudiante = '" . $datos['tf_cedulaEstudiante'] . "' ");

        if ($consultaExistenciaEncargado != null) {
            //No puede existir xq es Nuevo Ingreso
            echo '<h1>ya existe estudiante en sipce_encargado';
            die;
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
            //No puede existir xq es Nuevo Ingreso
            echo '<h1>ya existe estudiante en sipce_padre';
            die;
        } else {
            //Si no, inserto los datos del Padre
            $this->db->insert('sipce_padre', array(
                'ced_estudiante' => $datos['tf_cedulaEstudiante'],
                'ced_padre' => $datos['tf_cedulaPadre'],
                'nombre_padre' => $datos['tf_nombrePadre'],
                'apellido1_padre' => $datos['tf_ape1Padre'],
                'apellido2_padre' => $datos['tf_ape2Padre'],
                'telefonoCasaPadre' => $datos['tf_telCelPadre'],
                'ocupacionPadre' => $datos['tf_ocupacionPadre']));
        }

        //Consulto si ya existe Madre
        $consultaExistenciaMadre = $this->db->select("SELECT * FROM sipce_madre WHERE ced_estudiante = '" . $datos['tf_cedulaEstudiante'] . "' ");

        if ($consultaExistenciaMadre != null) {
            //No puede existir xq es Nuevo Ingreso
            echo '<h1>ya existe estudiante en sipce_madre';
            die;
        } else {
            //Si no, inserto los datos de la Madre
            $this->db->insert('sipce_madre', array(
                'ced_estudiante' => $datos['tf_cedulaEstudiante'],
                'ced_madre' => $datos['tf_cedulaMadre'],
                'nombre_madre' => $datos['tf_nombreMadre'],
                'apellido1_madre' => $datos['tf_ape1Madre'],
                'apellido2_madre' => $datos['tf_ape2Madre'],
                'telefonoCasaMadre' => $datos['tf_telCelMadre'],
                'ocupacionMadre' => $datos['tf_ocupacionMadre']));
        }

        //Consulto si ya existe Persona Emergencia
        $consultaExistenciaPersonaEmergencia = $this->db->select("SELECT * FROM sipce_personaemergencia WHERE ced_estudiante = '" . $datos['tf_cedulaEstudiante'] . "' ");

        if ($consultaExistenciaPersonaEmergencia != null) {
            //No puede existir xq es Nuevo Ingreso
            echo '<h1>ya existe estudiante en sipce_personaemergencia';
            die;
        } else {
            //Si no, inserto los datos de la Persona Emergencia
            $this->db->insert('sipce_personaemergencia', array(
                'ced_estudiante' => $datos['tf_cedulaEstudiante'],
                'ced_personaEmergencia' => $datos['tf_cedulaPersonaEmergencia'],
                'parentesco' => $datos['sel_parentescoCasoEmergencia'],
                'nombre_personaEmergencia' => $datos['tf_nombrePersonaEmergencia'],
                'apellido1_personaEmergencia' => $datos['tf_ape1PersonaEmergencia'],
                'apellido2_personaEmergencia' => $datos['tf_ape2PersonaEmergencia'],
                'telefonoCasaPersonaEmergencia' => $datos['tf_telHabitPersonaEmergencia'],
                'telefonoCelularPersonaEmergencia' => $datos['tf_telcelularPersonaEmergencia']));
        }

        //Consulto si ya existe Poliza
        $consultaExistenciaPoliza = $this->db->select("SELECT * FROM sipce_poliza WHERE ced_estudiante = '" . $datos['tf_cedulaEstudiante'] . "' ");

        if ($consultaExistenciaPoliza != null) {
            //No puede existir xq es Nuevo Ingreso
            echo '<h1>ya existe estudiante en sipce_poliza';
            die;
        } else {
            //Si no, inserto los datos de la Poliza
            $this->db->insert('sipce_poliza', array(
                'ced_estudiante' => $datos['tf_cedulaEstudiante'],
                'numero_poliza' => $datos['tf_poliza'],
                'fecha_vence' => $datos['tf_polizaVence']));
        }

        //Consulto si ya existe Adelanto/Arraste
        $consultaExistenciaAdelanta = $this->db->select("SELECT * FROM sipce_adelanta WHERE ced_estudiante = '" . $datos['tf_cedulaEstudiante'] . "' ");

        if ($datos['sl_adelanta'] == "si" && $datos['sl_condicion'] == "Repite") {
            if ($consultaExistenciaAdelanta != null) {
                //Si ya existe  Adelanto/Arraste, actualizo
                $posData = array(
                    'anio' => $datos['anio'],
                    'nivel' => $datos['sl_nivelMatricular'],
                    'nivel_adelanta' => $datos['sl_nivelMatricular'] + 1);
                $this->db->update('sipce_adelanta', $posData, "`ced_estudiante` = '{$datos['tf_cedulaEstudiante']}'");
            } else {
                //Si no, inserto los datos de la Poliza
                $this->db->insert('sipce_adelanta', array(
                    'ced_estudiante' => $datos['tf_cedulaEstudiante'],
                    'anio' => $datos['anio'],
                    'nivel' => $datos['sl_nivelMatricular'],
                    'nivel_adelanta' => $datos['sl_nivelMatricular'] + 1));
            }
        } else {
            if ($consultaExistenciaAdelanta != null) {
                //Borro datos
                $sth = $this->db->prepare("DELETE FROM sipce_adelanta WHERE ced_estudiante ='" . $datos['tf_cedulaEstudiante'] . "' AND anio = " . $datos['anio']);
                $sth->execute();
            }
        }
    }

    /* Carga todos los estudiantes matriculados */

    public function estadoMatricula() {
        return $this->db->select("SELECT cedula,nombre,apellido1,apellido2,nivel,condicion "
                        . "FROM sipce_persona,sipce_matricularatificacion "
                        . "WHERE cedula = ced_estudiante");
    }

    //Metodos extras para impresion de certificado de matricula
    public function consultaDatosEstudiante($cedulaEstudiante) {
        return $this->db->select("SELECT p.cedula,p.nombre,p.apellido1,p.apellido2,p.sexo,p.fechaNacimiento,"
                        . "p.telefonoCasa,p.telefonoCelular,p.email,p.domicilio,p.escuela_procedencia,p.telefonoCasa,j.nombreProvincia,"
                        . "c.Canton,d.Distrito,p.nacionalidad,g.nivel, m.condicion "
                        . "FROM sipce_persona as p,sipce_grupos as g,sipce_provincias as j,sipce_cantones as c,sipce_distritos as d, sipce_matricularatificacion as m "
                        . "WHERE p.cedula = g.ced_estudiante "
                        . "AND p.cedula = '" . $cedulaEstudiante . "' "
                        . "AND m.ced_estudiante = '" . $cedulaEstudiante . "' "
                        . "AND p.IdProvincia = j.IdProvincia "
                        . "AND p.IdCanton = c.IdCanton "
                        . "AND p.IdDistrito = d.IdDistrito");
    }

//    public function estadoMatricula() {
//        return $this->db->select("SELECT cedula,nombre,apellido1,apellido2,nivel,condicion "
//                        . "FROM sipce_persona,sipce_matricularatificacion "
//                        . "WHERE cedula = ced_estudiante");
//    }

    /* Ejemplo clasico de join entre tablas */

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