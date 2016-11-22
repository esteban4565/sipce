<?php

class Persona_Model extends Models {

    public function __construct() {
        parent::__construct();
        $this->datosSistema = $this->db->select('SELECT * FROM sipce_configuracion WHERE id=1');
    }

    /* Carga datos del sistema */

    public function datosSistema() {
        return $this->datosSistema;
    }

    /* Retorna la lista de paises */

    public function consultaPaises() {
        return $this->db->select("SELECT * FROM sipce_paises ORDER BY nombrePais", array());
    }

    /* Retorna la lista de Especialidades */

    public function consultaEspecialidades() {
        return $this->db->select("SELECT * FROM sipce_especialidad", array());
    }

    /* Retorna datos del Estudiante */

    public function buscarEstudiante($ced_estudiante) {
        $resultado = $this->db->select("SELECT * "
                . "FROM tpersonapadron "
                . "WHERE cedula = '" . $ced_estudiante . "' ");
        echo json_encode($resultado);
    }

    /* METODOS DE BUSQUEDA */

    public function buscarDocente() {
        
    }

    /* METODOS DE RESULTADOS DE BUSQUEDAS */

    public function resultadobuscarDocente($cedula) {
        return $this->db->select("SELECT * FROM sipce_estudiante WHERE cedula = :cedula", array(':cedula' => $cedula));
    }

    /* Carga todos los paises */

    public function CargaPais() {
        
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

    /* Carga todas las Escuelas */

    public function consultaEscuelas() {
        return $this->db->select("SELECT * FROM sipce_escuelas", array());
    }

    /* Carga todos los cantones */

    public function cargaCantones($idProvincia) {

        $resultado = $this->db->select("SELECT * FROM sipce_cantones WHERE IdProvincia = :idProvincia ORDER BY Canton", array('idProvincia' => $idProvincia));
        echo json_encode($resultado);
    }

    /* Carga todos los distritos */

    public function cargaDistritos($idCanton) {

        $resultado = $this->db->select("SELECT * FROM sipce_distritos WHERE IdCanton = :idCanton ORDER BY Distrito", array('idCanton' => $idCanton));
        echo json_encode($resultado);
    }

    /* Retorna los roles de permisos */

    public function CargaPermisos() {
        return $this->db->select("SELECT * FROM sipce_permisos", array());
    }

    /* Retorna la lista de estado civil */

    public function estadoCivilList() {
        return $this->db->select("SELECT * FROM sipce_estadocivil", array());
    }

    /* Retorna la lista de paises */

    public function paisesList() {
        return $this->db->select("SELECT * FROM sipce_paises", array());
    }

    public function personaList() {

        return $this->db->select("SELECT * FROM tbl_user", array());
    }

    public function personaUnicaLista($cedula, $basedatos) {

        if ($basedatos == "bd_sipce") {
            return $this->db->select("SELECT * FROM sipce_estudiante WHERE cedula = :cedula", array(':cedula' => $cedula));
        } else {
            return $this->db->select("SELECT * FROM tpersonapadron WHERE cedula = :cedula", array(':cedula' => $cedula));
        }
    }

    public function saveDocenteEstudiante($data) {

        $this->db->insert('sipce_estudiante', array(
            'cedula' => $data['cedulaP'],
            'sexo' => $data['sexoP'],
            'apellido1' => $data['ape1P'],
            'apellido2' => $data['ape2P'],
            'nombre' => $data['nombreP'],
            'fechaNacimiento' => $data['fnacimientoP'],
            'nacionalidad' => $data['nacionalidadP'],
            'estadoCivil' => $data['estadocivilP'],
            'telefonoCelular' => $data['telcelularP'],
            'telefonoCasa' => $data['telcasaP'],
            'domicilio' => $data['domicilioP'],
            'idProvincia' => $data['provinciaP'],
            'idCanton' => $data['cantonP'],
            'idDistrito' => $data['distritoP'],
            'passwords' => Hash::create('md5', $data['passwordP'], HASH_PASSWORD_KEY),
            'email' => $data['emailP'],
            'tipoUsuario' => $data['roleP'],
            'estadoActual' => $data['estadoactualP']
        ));
        /*
          return $sth->fetchAll();
         */
    }

    public function editSave($data) {

        $posData = array(
            'cedula' => $data['cedula'],
            'ape1' => $data['ape1'],
            'ape2' => $data['ape2'],
            'nombre' => $data['nombre'],
            'sexo' => $data['sexo'],
            'username' => $data['username'],
            'password' => Hash::create('md5', $data['password'], HASH_PASSWORD_KEY),
            'role' => $data['role'],
            'email' => $data['email']);

        $this->db->update('tbl_user', $posData, "`cedula` = {$data['cedula']}");
    }

    public function delete($cedula) {

        $result = $this->db->select("SELECT role FROM tbl_user WHERE cedula = :cedula", array(':cedula' => $cedula));

        if ($result[0]['role'] == 'ADMIN') {
            return false;
        }

        $this->db->delete('tbl_user', "cedula = '$cedula'");
        $sth = $this->db->prepare("DELETE FROM tbl_user WHERE cedula = :cedula");
        $sth->execute(array(':cedula' => $cedula));
    }

//**Cosas de Esteban**//

    /* Retorna la lista de todo los usuarios */
    public function listaEstudiantes() {
        return $this->db->select("SELECT cedula,nombre,apellido1,apellido2,nivel,grupo,sub_grupo "
                        . "FROM sipce_estudiante, sipce_grupos "
                        . "WHERE cedula = ced_estudiante "
                        . "AND tipoUsuario = 4 "
                        . "AND annio = " . $this->datosSistema[0]['annio_lectivo'] . " "
                        . "AND grupo <> 0 "
                        . "ORDER BY apellido1,apellido2,nombre");
    }

    /* Carga todas los Niveles */

    public function consultaNiveles() {
        return $this->db->select("SELECT DISTINCT nivel "
                        . "FROM sipce_grupos "
                        . "WHERE annio = " . $this->datosSistema[0]['annio_lectivo'] . " "
                        . "ORDER BY nivel");
    }

    /* Carga todos los Grupos de un Nivel */

    public function cargaGrupos($idNivel) {
        $resultado = $this->db->select("SELECT DISTINCT grupo FROM sipce_grupos "
                . "WHERE nivel = :nivel "
                . "AND annio = " . $this->datosSistema[0]['annio_lectivo'] . " "
                . "AND grupo <> 0 "
                . "ORDER BY grupo", array('nivel' => $idNivel));
        echo json_encode($resultado);
    }

    //Carga la lista de los estudiantes de una seccion en especifico
    public function cargaSeccion($consulta) {
        //campos
        $consultaSQL = "SELECT sipce_estudiante.cedula, sipce_estudiante.nombre, sipce_estudiante.apellido1, sipce_estudiante.apellido2";
        if ($consulta['grupoSeleccionado'] != 0) {
            $consultaSQL.=",sipce_grupos.sub_grupo";
        }
        if ($consulta['chk_email'] == 1) {
            $consultaSQL.=",sipce_estudiante.email";
        }
        if ($consulta['chk_poliza'] == 1) {
            $consultaSQL.=",sipce_poliza.numero_poliza,sipce_poliza.fecha_vence";
        }
        if ($consulta['chk_domicilio'] == 1) {
            $consultaSQL.=",sipce_estudiante.domicilio,sipce_distritos.Distrito,sipce_cantones.Canton,sipce_provincias.nombreProvincia";
        }
        if ($consulta['chk_telefonosEstu'] == 1) {
            $consultaSQL.=",sipce_estudiante.telefonoCasa,sipce_estudiante.telefonoCelular";
        }
        if ($consulta['chk_telefonosEncargado'] == 1) {
            $consultaSQL.=",sipce_encargado.nombre_encargado,sipce_encargado.apellido1_encargado,sipce_encargado.apellido2_encargado,sipce_encargado.telefonoCasaEncargado,sipce_encargado.telefonoCelularEncargado";
        }

        //tablas
        $consultaSQL.=" FROM sipce_grupos LEFT JOIN " . DB_NAME . ".sipce_estudiante ON sipce_grupos.ced_estudiante = sipce_estudiante.cedula";
        if ($consulta['chk_poliza'] == 1) {
            $consultaSQL.=" LEFT JOIN " . DB_NAME . ".sipce_poliza ON sipce_estudiante.cedula = sipce_poliza.ced_estudiante";
        }
        if ($consulta['chk_domicilio'] == 1) {
            $consultaSQL.=" LEFT JOIN " . DB_NAME . ".sipce_cantones ON sipce_estudiante.IdCanton = sipce_cantones.IdCanton LEFT JOIN " . DB_NAME . ".sipce_distritos ON sipce_estudiante.IdDistrito = sipce_distritos.IdDistrito LEFT JOIN " . DB_NAME . ".sipce_provincias ON sipce_estudiante.IdProvincia = sipce_provincias.IdProvincia ";
        }
        if ($consulta['chk_telefonosEncargado'] == 1) {
            $consultaSQL.=" LEFT JOIN " . DB_NAME . ".sipce_encargado ON sipce_estudiante.cedula = sipce_encargado.ced_estudiante";
        }

        //restricciones
        $consultaSQL.=" WHERE ((sipce_grupos.nivel = " . $consulta['nivelSeleccionado'] . ") AND (sipce_grupos.annio = " . $this->datosSistema[0]['annio_lectivo'] . ")";

        if ($consulta['grupoSeleccionado'] != 0) {
            $consultaSQL.=" AND (sipce_grupos.grupo = " . $consulta['grupoSeleccionado'] . ")";
        }

        $consultaSQL.=" )";

        //orden
        $consultaSQL.=" ORDER BY ";
        if ($consulta['grupoSeleccionado'] != 0) {
            $consultaSQL.="sipce_grupos.sub_grupo ASC,";
        }
        $consultaSQL.="sipce_estudiante.apellido1 ASC, sipce_estudiante.apellido2 ASC, sipce_estudiante.nombre ASC";
        //consulta
        $resultado2 = $this->db->select($consultaSQL);
        echo json_encode($resultado2);
    }

    /* Inserta estudiante Nuevo Ingreso en la BD */

    public function guardarNuevoIngresoTardio($datos) {
        //'estado' 1 = Matricula Ratificada
        //'estado' 2 = Matricula Ratificada Editada
        //'estado' 3 = Matricula Nuevo Ingreso
        //Consulto si ya existe la matricula
        $consultaExistenciaMatricula = $this->db->select("SELECT * FROM sipce_matricularatificacion "
                . "WHERE ced_estudiante = '" . $datos['tf_cedulaEstudiante'] . "' "
                . "AND anio = " . $this->datosSistema[0]['annio_lectivo']);

        if ($consultaExistenciaMatricula != null) {
            //No se puede hacer nuevo ingreso xq ya existe
            echo '<h1>ya existe estudiante en sipce_matricularatificacion';
            die;
        } else {
            //Sino Inserto datos y 'estado' Matricula Nuevo Ingreso
            $this->db->insert('sipce_matricularatificacion', array(
                'ced_estudiante' => $datos['tf_cedulaEstudiante'],
                'anio' => $this->datosSistema[0]['annio_lectivo'],
                'nivel' => $datos['sl_nivelMatricular'],
                'condicion' => $datos['sl_condicion'],
                'estado' => 3));
        }

        //Consulto si ya existe la Enfermedad
        $consultaExistenciaEnfermedad = $this->db->select("SELECT * FROM sipce_enfermedades "
                . "WHERE cedula = '" . $datos['tf_cedulaEstudiante'] . "' "
                . "AND anio = " . $this->datosSistema[0]['annio_lectivo']);

        if ($datos['sel_enfermedad'] == 1) {
            if ($consultaExistenciaEnfermedad != null) {
                //No se puede hacer nuevo ingreso xq ya existe
                echo '<h1>ya existe estudiante en sipce_enfermedades';
                die;
            } else {
                //Sino Inserto datos
                $this->db->insert('sipce_enfermedades', array(
                    'cedula' => $datos['tf_cedulaEstudiante'],
                    'anio' => $this->datosSistema[0]['annio_lectivo'],
                    'descripcion' => $datos['tf_enfermedadDescripcion']));
            }
        }

        //Consulto si ya existe la Adecuacion
        $consultaExistenciaAdecuacion = $this->db->select("SELECT * FROM sipce_adecuacion "
                . "WHERE ced_estudiante = '" . $datos['tf_cedulaEstudiante'] . "' "
                . "AND anio = " . $this->datosSistema[0]['annio_lectivo']);

        if ($datos['sl_adecuacion'] != 'No') {
            if ($consultaExistenciaAdecuacion != null) {
                //No se puede hacer nuevo ingreso xq ya existe
                echo '<h1>ya existe estudiante en sipce_adecuacion';
                die;
            } else {
                //Sino Inserto datos
                $this->db->insert('sipce_adecuacion', array(
                    'ced_estudiante' => $datos['tf_cedulaEstudiante'],
                    'anio' => $this->datosSistema[0]['annio_lectivo'],
                    'adecuacion' => $datos['sl_adecuacion']));
            }
        }

        //Consulto si ya existe Becas Avancemos
        $consultaExistenciaBecaAvancemos = $this->db->select("SELECT * FROM sipce_beca "
                . "WHERE ced_estudiante = '" . $datos['tf_cedulaEstudiante'] . "' "
                . "AND anio = " . $this->datosSistema[0]['annio_lectivo']);

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
                    'anio' => $this->datosSistema[0]['annio_lectivo'],
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
                . "AND anio = " . $this->datosSistema[0]['annio_lectivo']);

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
                    'anio' => $this->datosSistema[0]['annio_lectivo'],
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
                . "AND anio = " . $this->datosSistema[0]['annio_lectivo']);

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
                    'anio' => $this->datosSistema[0]['annio_lectivo'],
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
            //No deberia estar asignado a ningun grupoya que es Nuevo Ingreso
            echo '<h1>ya existe estudiante en sipce_grupos';
            die;
        } else {
            //Sino Inserto datos en sipce_grupos
            $this->db->insert('sipce_grupos', array(
                'ced_estudiante' => $datos['tf_cedulaEstudiante'],
                'nivel' => $datos['sl_nivelMatricular'],
                'annio' => $this->datosSistema[0]['annio_lectivo']));
        }

        //Consulto si ya existe datos en el expediente (para editarla)
        $consultaExistenciaEstudiante = $this->db->select("SELECT * FROM sipce_estudiante "
                . "WHERE cedula = '" . $datos['tf_cedulaEstudiante'] . "' ");

        if ($consultaExistenciaEstudiante != null) {
            //No se puede hacer nuevo ingreso xq ya existe
            echo '<h1>ya existe estudiante en sipce_estudiante';
            die;
        } else {
            //Sino Inserto datos del expediente Estudiante
            $this->db->insert('sipce_estudiante', array(
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
                'anio' => $this->datosSistema[0]['annio_lectivo'],
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
                    'anio' => $this->datosSistema[0]['annio_lectivo'],
                    'nivel' => $datos['sl_nivelMatricular'],
                    'nivel_adelanta' => $datos['sl_nivelMatricular'] + 1);
                $this->db->update('sipce_adelanta', $posData, "`ced_estudiante` = '{$datos['tf_cedulaEstudiante']}'");
            } else {
                //Si no, inserto los datos de la Poliza
                $this->db->insert('sipce_adelanta', array(
                    'ced_estudiante' => $datos['tf_cedulaEstudiante'],
                    'anio' => $this->datosSistema[0]['annio_lectivo'],
                    'nivel' => $datos['sl_nivelMatricular'],
                    'nivel_adelanta' => $datos['sl_nivelMatricular'] + 1));
            }
        } else {
            if ($consultaExistenciaAdelanta != null) {
                //Borro datos
                $sth = $this->db->prepare("DELETE FROM sipce_adelanta WHERE ced_estudiante ='" . $datos['tf_cedulaEstudiante'] . "' AND anio = " . $this->datosSistema[0]['annio_lectivo']);
                $sth->execute();
            }
        }
    }

    /* Retorna la informacion del Estudiante para Editar Matricula */

    public function infoEstudianteEditar($cedulaEstudiante) {
        return $this->db->select("SELECT p.cedula,p.nombre,p.apellido1,p.apellido2,p.sexo,p.fechaNacimiento,"
                        . "p.telefonoCasa,p.telefonoCelular,p.email,p.domicilio,p.telefonoCasa,p.IdProvincia,"
                        . "p.IdCanton,p.IdDistrito,p.nacionalidad,g.nivel "
                        . "FROM sipce_estudiante as p,sipce_grupos as g "
                        . "WHERE p.cedula = g.ced_estudiante "
                        . "AND g.annio = '" . ($this->datosSistema[0]['annio_lectivo']) . "' "
                        . "AND p.cedula = '" . $cedulaEstudiante . "' ");
    }

    /* Retorna la informacion de la especialidad del Estudiante */

    public function especialidadEstudiante($cedulaEstudiante) {
        return $this->db->select("SELECT cod_especialidad, nombreEspecialidad "
                        . "FROM sipce_especialidad_estudiante, sipce_especialidad  "
                        . "WHERE ced_estudiante = '" . $cedulaEstudiante . "' "
                        . "AND codigoEspecialidad = cod_especialidad");
    }

    /* Retorna la informacion de la especialidad del Estudiante */

    public function escuelaEstudiante($cedulaEstudiante) {
        return $this->db->select("SELECT ec.id, ec.IdProvincia, ec.IdCanton, ec.IdDistrito "
                        . "FROM sipce_escuelas as ec, sipce_estudiante as es "
                        . "WHERE es.cedula = '" . $cedulaEstudiante . "' "
                        . "AND es.escuela_procedencia = ec.id");
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
                        . "AND anio = " . $this->datosSistema[0]['annio_lectivo'] . " ");
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

    /* Ratifica(Update) estudiante en la BD */

    public function guardarExpedienteEstudiante($datos) {
        $consultaExistenciaMatricula = $this->db->select("SELECT * FROM sipce_matricularatificacion "
                . "WHERE ced_estudiante = '" . $datos['tf_cedulaEstudiante'] . "' "
                . "AND anio = " . $this->datosSistema[0]['annio_lectivo']);

        if ($consultaExistenciaMatricula != null) {
            //Actualizo datos del expediente Estudiante
            $posData = array(
                'nivel' => $datos['sl_nivelMatricular'],
                'condicion' => $datos['sl_condicion']);

            $this->db->update('sipce_matricularatificacion', $posData, "`ced_estudiante` = '{$datos['tf_cedulaEstudiante']}' AND `anio` = '{$this->datosSistema[0]['annio_lectivo']}'");
        } else {
            //No se puede editar xq No existe
            echo '<h1>No se puede editar xq No existe estudiante en sipce_matricularatificacion';
            die;
        }

        //Consulto si ya existe datos en el expediente (para editarla)
        $consultaExistenciaEstudiante = $this->db->select("SELECT * FROM sipce_estudiante "
                . "WHERE cedula = '" . $datos['tf_cedulaEstudiante'] . "' ");

        if ($consultaExistenciaEstudiante != null) {
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
                'IdProvincia' => $datos['tf_provincias'],
                'IdCanton' => $datos['tf_cantones'],
                'IdDistrito' => $datos['tf_distritos']);

            $this->db->update('sipce_estudiante', $posData, "`cedula` = '{$datos['tf_cedulaEstudiante']}'");
        } else {
            //No se puede editar xq No existe
            echo '<h1>No se puede editar xq No existe estudiante en sipce_estudiante';
            die;
        }

        //Consulto si ya existe la Enfermedad
        $consultaExistenciaEnfermedad = $this->db->select("SELECT * FROM sipce_enfermedades "
                . "WHERE cedula = '" . $datos['tf_cedulaEstudiante'] . "' "
                . "AND anio = " . $this->datosSistema[0]['annio_lectivo']);

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
                    'anio' => $this->datosSistema[0]['annio_lectivo'],
                    'descripcion' => $datos['tf_enfermedadDescripcion']));
            }
        } else {
            if ($consultaExistenciaEnfermedad != null) {
                //Borro datos
                $sth = $this->db->prepare("DELETE FROM sipce_enfermedades WHERE cedula ='" . $datos['tf_cedulaEstudiante'] . "' AND anio = " . $this->datosSistema[0]['annio_lectivo']);
                $sth->execute();
            }
        }

        //Consulto si ya existe la Adecuacion
        $consultaExistenciaAdecuacion = $this->db->select("SELECT * FROM sipce_adecuacion "
                . "WHERE ced_estudiante = '" . $datos['tf_cedulaEstudiante'] . "' "
                . "AND anio = " . $this->datosSistema[0]['annio_lectivo']);

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
                    'anio' => $this->datosSistema[0]['annio_lectivo'],
                    'adecuacion' => $datos['sl_adecuacion']));
            }
        } else {
            if ($consultaExistenciaAdecuacion != null) {
                //Borro datos
                $sth = $this->db->prepare("DELETE FROM sipce_adecuacion WHERE ced_estudiante ='" . $datos['tf_cedulaEstudiante'] . "' AND anio = " . $this->datosSistema[0]['annio_lectivo']);
                $sth->execute();
            }
        }

        //Consulto si ya existe Becas Avancemos
        $consultaExistenciaBecaAvancemos = $this->db->select("SELECT * FROM sipce_beca "
                . "WHERE ced_estudiante = '" . $datos['tf_cedulaEstudiante'] . "' "
                . "AND anio = " . $this->datosSistema[0]['annio_lectivo']);

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
                    'anio' => $this->datosSistema[0]['annio_lectivo'],
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
                . "AND anio = " . $this->datosSistema[0]['annio_lectivo']);

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
                    'anio' => $this->datosSistema[0]['annio_lectivo'],
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
                . "AND anio = " . $this->datosSistema[0]['annio_lectivo']);

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
                    'anio' => $this->datosSistema[0]['annio_lectivo'],
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
                . "WHERE ced_estudiante = '" . $datos['tf_cedulaEstudiante'] . "' "
                . "AND annio = " . $this->datosSistema[0]['annio_lectivo']);

        if ($consultaExistenciaNivel != null) {
            //Actualizo nivel del Estudiante
            $datosNivel = array(
                'nivel' => $datos['sl_nivelMatricular']);

            $this->db->update('sipce_grupos', $datosNivel, "`ced_estudiante` = '{$datos['tf_cedulaEstudiante']}'");
        } else {
            //Sino Inserto datos en sipce_grupos
            $this->db->insert('sipce_grupos', array(
                'ced_estudiante' => $datos['tf_cedulaEstudiante'],
                'nivel' => $datos['sl_nivelMatricular'],
                'annio' => $this->datosSistema[0]['annio_lectivo']));
        }

        //Consulto si el nivel es superio a Noveno
        if ($datos['sl_nivelMatricular'] > 9) {
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
                'anio' => $this->datosSistema[0]['annio_lectivo'],
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
                'anio' => $this->datosSistema[0]['annio_lectivo'],
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
                    'anio' => $this->datosSistema[0]['annio_lectivo'],
                    'nivel' => $datos['sl_nivelMatricular'],
                    'nivel_adelanta' => $datos['sl_nivelMatricular'] + 1);
                $this->db->update('sipce_adelanta', $posData, "`ced_estudiante` = '{$datos['tf_cedulaEstudiante']}'");
            } else {
                //Si no, inserto los datos de la Poliza
                $this->db->insert('sipce_adelanta', array(
                    'ced_estudiante' => $datos['tf_cedulaEstudiante'],
                    'anio' => $this->datosSistema[0]['annio_lectivo'],
                    'nivel' => $datos['sl_nivelMatricular'],
                    'nivel_adelanta' => $datos['sl_nivelMatricular'] + 1));
            }
        } else {
            if ($consultaExistenciaAdelanta != null) {
                //Borro datos
                $sth = $this->db->prepare("DELETE FROM sipce_adelanta WHERE ced_estudiante ='" . $datos['tf_cedulaEstudiante'] . "' AND anio = " . $this->datosSistema[0]['annio_lectivo']);
                $sth->execute();
            }
        }
    }

    //Metodos extras para impresion de certificado de matricula
    public function consultaDatosEstudiante($cedulaEstudiante) {
        return $this->db->select("SELECT p.cedula,p.nombre,p.apellido1,p.apellido2,p.sexo,p.fechaNacimiento,"
                        . "p.telefonoCasa,p.telefonoCelular,p.email,p.domicilio,e.nombre as escuela_procedencia,p.telefonoCasa,j.nombreProvincia,"
                        . "c.Canton,d.Distrito,p.nacionalidad,g.nivel, m.condicion "
                        . "FROM sipce_estudiante as p,sipce_escuelas as e,sipce_grupos as g,sipce_provincias as j,sipce_cantones as c,sipce_distritos as d, sipce_matricularatificacion as m "
                        . "WHERE p.cedula = g.ced_estudiante "
                        . "AND p.cedula = '" . $cedulaEstudiante . "' "
                        . "AND g.annio = '" . $this->datosSistema[0]['annio_lectivo'] . "' "
                        . "AND m.ced_estudiante = '" . $cedulaEstudiante . "' "
                        . "AND p.escuela_procedencia = e.id "
                        . "AND p.IdProvincia = j.IdProvincia "
                        . "AND p.IdCanton = c.IdCanton "
                        . "AND p.IdDistrito = d.IdDistrito");
    }

    //Carga las escuela//
    function cargaEscuela($idDistrito) {
        $resultado = $this->db->select("SELECT * FROM sipce_escuelas WHERE IdDistrito = :idDistrito ORDER BY nombre", array('idDistrito' => $idDistrito));
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

    //2016 Becas
    /* Retorna Datos de Estudiante JavaScript */
    public function buscarEstudianteBecas($ced_estudiante) {

        //verifico si el estudiante posee especialidad
        $consultaEstudianteEspecialidad = $this->db->select("SELECT * FROM sipce_especialidad_estudiante WHERE ced_estudiante = '" . $ced_estudiante . "' ");

        if ($consultaEstudianteEspecialidad != null) {
            $resultado = $this->db->select("SELECT e.cedula,e.nombre,e.apellido1,e.apellido2,g.nivel, d.Distrito, esp.nombreEspecialidad "
                    . "FROM sipce_estudiante as e, sipce_grupos as g, sipce_distritos as d, sipce_especialidad as esp, sipce_especialidad_estudiante as ee "
                    . "WHERE e.cedula = g.ced_estudiante "
                    . "AND e.cedula = ee.ced_estudiante "
                    . "AND e.cedula = '" . $ced_estudiante . "'"
                    . "AND e.IdDistrito = d.IdDistrito "
                    . "AND esp.codigoEspecialidad = ee.cod_especialidad "
                    . "AND g.annio = " . $this->datosSistema[0]['annio_lectivo'] . " ");
        } else {
            $resultado = $this->db->select("SELECT e.cedula,e.nombre,e.apellido1,e.apellido2,g.nivel, d.Distrito "
                    . "FROM sipce_estudiante as e, sipce_grupos as g, sipce_distritos as d "
                    . "WHERE e.cedula = g.ced_estudiante "
                    . "AND e.cedula = '" . $ced_estudiante . "'"
                    . "AND e.IdDistrito = d.IdDistrito "
                    . "AND g.annio = " . $this->datosSistema[0]['annio_lectivo'] . " ");
        }

        echo json_encode($resultado);
    }

    /* Retorna Datos de Estudiante php */

    public function datosEstudiante($ced_estudiante) {

        if ($ced_estudiante != null) {
            //verifico si el estudiante posee especialidad
            $consultaEstudianteEspecialidad = $this->db->select("SELECT * FROM sipce_especialidad_estudiante WHERE ced_estudiante = '" . $ced_estudiante . "' ");

            if ($consultaEstudianteEspecialidad != null) {
                $resultado = $this->db->select("SELECT e.cedula,e.apellido1,e.apellido2,e.nombre,eb.distancia,"
                        . "d.Distrito,g.nivel,esp.nombreEspecialidad,eb.ingreso1,eb.ingreso2,eb.ingreso3,eb.ingreso4,eb.totalIngreso "
                        . "FROM sipce_estudiante as e, sipce_grupos as g, sipce_distritos as d, sipce_especialidad as esp, "
                        . "sipce_especialidad_estudiante as ee, sipce_estudiante_beca as eb "
                        . "WHERE e.cedula = g.ced_estudiante "
                        . "AND e.cedula = ee.ced_estudiante "
                        . "AND e.cedula = eb.ced_estudiante "
                        . "AND e.cedula = '" . $ced_estudiante . "' "
                        . "AND e.IdDistrito = d.IdDistrito "
                        . "AND esp.codigoEspecialidad = ee.cod_especialidad "
                        . "AND g.annio = " . $this->datosSistema[0]['annio_lectivo'] . " ");
            } else {
                $resultado = $this->db->select("SELECT e.cedula,e.apellido1,e.apellido2,e.nombre,eb.distancia,"
                        . "d.Distrito,g.nivel,eb.ingreso1,eb.ingreso2,eb.ingreso3,eb.ingreso4,eb.totalIngreso "
                        . "FROM sipce_estudiante as e, sipce_grupos as g, sipce_distritos as d, sipce_estudiante_beca as eb "
                        . "WHERE e.cedula = g.ced_estudiante "
                        . "AND e.cedula = eb.ced_estudiante "
                        . "AND e.cedula = '" . $ced_estudiante . "' "
                        . "AND e.IdDistrito = d.IdDistrito "
                        . "AND g.annio = " . $this->datosSistema[0]['annio_lectivo'] . " ");
            }

            return $resultado;
        } else {
            
        }
    }

    /* Guarda datos del formulario d **Insertar Beca* */

    public function guardarDatosBeca($datos) {
        //Consulto si ya existe datos en el expediente
        $consultaExistenciaEstudianteBeca = $this->db->select("SELECT * FROM sipce_estudiante_beca "
                . "WHERE ced_estudiante = '" . $datos['ced_estudiante'] . "' ");

        if ($consultaExistenciaEstudianteBeca != null) {
            //Actualizo datos del estudiante
            $posData = array(
                'distancia' => $datos['distancia'],
                'ingreso1' => $datos['ingreso1'],
                'ingreso2' => $datos['ingreso2'],
                'ingreso3' => $datos['ingreso3'],
                'ingreso4' => $datos['ingreso4'],
                'totalIngreso' => $datos['totalIngreso']);

            $this->db->update('sipce_estudiante_beca', $posData, "`ced_estudiante` = '{$datos['ced_estudiante']}'");
        } else {
            //Sino Inserto datos 
            $this->db->insert('sipce_estudiante_beca', array(
                'ced_estudiante' => $datos['ced_estudiante'],
                'distancia' => $datos['distancia'],
                'ingreso1' => $datos['ingreso1'],
                'ingreso2' => $datos['ingreso2'],
                'ingreso3' => $datos['ingreso3'],
                'ingreso4' => $datos['ingreso4'],
                'totalIngreso' => $datos['totalIngreso']));
        }
    }

    /* Retorna lista de Estudiante becados */

    public function listaEstudianteBecas() {
        $datos = array();
        //enlisto todas las cedulas de estudiantes becados
        $listaEstudianteBecas = $this->db->select("SELECT ced_estudiante FROM sipce_estudiante_beca");

        foreach ($listaEstudianteBecas as $lista => $value) {
            //Cedula
            $estudiante['ced_estudiante'] = $value['ced_estudiante'];

            //verifico si el estudiante posee especialidad
            $consultaEstudianteEspecialidad = $this->db->select("SELECT * FROM sipce_especialidad_estudiante WHERE ced_estudiante = '" . $value['ced_estudiante'] . "' ");

            if ($consultaEstudianteEspecialidad != null) {
                $resultado = $this->db->select("SELECT e.cedula,e.apellido1,e.apellido2,e.nombre,eb.distancia,"
                        . "d.Distrito,g.nivel,esp.nombreEspecialidad,eb.ingreso1,eb.ingreso2,eb.ingreso3,eb.ingreso4,eb.totalIngreso "
                        . "FROM sipce_estudiante as e, sipce_grupos as g, sipce_distritos as d, sipce_especialidad as esp, "
                        . "sipce_especialidad_estudiante as ee, sipce_estudiante_beca as eb "
                        . "WHERE e.cedula = g.ced_estudiante "
                        . "AND e.cedula = ee.ced_estudiante "
                        . "AND e.cedula = eb.ced_estudiante "
                        . "AND e.cedula = '" . $value['ced_estudiante'] . "' "
                        . "AND e.IdDistrito = d.IdDistrito "
                        . "AND esp.codigoEspecialidad = ee.cod_especialidad "
                        . "AND g.annio = " . $this->datosSistema[0]['annio_lectivo'] . " ");

                $estudiante['apellido1'] = $resultado[0]['apellido1'];
                $estudiante['apellido2'] = $resultado[0]['apellido2'];
                $estudiante['nombre'] = $resultado[0]['nombre'];
                $estudiante['distancia'] = $resultado[0]['distancia'];
                $estudiante['Distrito'] = $resultado[0]['Distrito'];
                $estudiante['nivel'] = $resultado[0]['nivel'];
                $estudiante['nombreEspecialidad'] = $resultado[0]['nombreEspecialidad'];
                $estudiante['ingreso1'] = $resultado[0]['ingreso1'];
                $estudiante['ingreso2'] = $resultado[0]['ingreso2'];
                $estudiante['ingreso3'] = $resultado[0]['ingreso3'];
                $estudiante['ingreso4'] = $resultado[0]['ingreso4'];
                $estudiante['totalIngreso'] = $resultado[0]['totalIngreso'];
            } else {
                $resultado = $this->db->select("SELECT e.cedula,e.apellido1,e.apellido2,e.nombre,eb.distancia,"
                        . "d.Distrito,g.nivel,eb.ingreso1,eb.ingreso2,eb.ingreso3,eb.ingreso4,eb.totalIngreso "
                        . "FROM sipce_estudiante as e, sipce_grupos as g, sipce_distritos as d, sipce_estudiante_beca as eb "
                        . "WHERE e.cedula = g.ced_estudiante "
                        . "AND e.cedula = eb.ced_estudiante "
                        . "AND e.cedula = '" . $value['ced_estudiante'] . "' "
                        . "AND e.IdDistrito = d.IdDistrito "
                        . "AND g.annio = " . $this->datosSistema[0]['annio_lectivo'] . " ");

                $estudiante['apellido1'] = $resultado[0]['apellido1'];
                $estudiante['apellido2'] = $resultado[0]['apellido2'];
                $estudiante['nombre'] = $resultado[0]['nombre'];
                $estudiante['distancia'] = $resultado[0]['distancia'];
                $estudiante['Distrito'] = $resultado[0]['Distrito'];
                $estudiante['nivel'] = $resultado[0]['nivel'];
                $estudiante['nombreEspecialidad'] = "-";
                $estudiante['ingreso1'] = $resultado[0]['ingreso1'];
                $estudiante['ingreso2'] = $resultado[0]['ingreso2'];
                $estudiante['ingreso3'] = $resultado[0]['ingreso3'];
                $estudiante['ingreso4'] = $resultado[0]['ingreso4'];
                $estudiante['totalIngreso'] = $resultado[0]['totalIngreso'];
            }
            $datos[] = $estudiante;
            $estudiante = "";
        }
        return $datos;
    }

    /* Guarda datos del formulario de **Modificar Cédula* */

    public function guardarCedulaNueva($estudiante) {
        //Consulto si ya existe datos en sipce_estudiante
        $consultaExistenciaMatriculaestudiante = $this->db->select("SELECT * FROM sipce_estudiante "
                . "WHERE cedula = '" . $estudiante['ced_estudiante'] . "' ");

        if ($consultaExistenciaMatriculaestudiante != null) {
            //Guardo datos del estudiante en el array $estudiante
            $i = 0;
            foreach ($consultaExistenciaMatriculaestudiante as $lista => $value) {
                $sipce_estudiante[$i]['nombre'] = $value['nombre'];
                $sipce_estudiante[$i]['apellido1'] = $value['apellido1'];
                $sipce_estudiante[$i]['apellido2'] = $value['apellido2'];
                $sipce_estudiante[$i]['sexo'] = $value['sexo'];
                $sipce_estudiante[$i]['fechaNacimiento'] = $value['fechaNacimiento'];
                $sipce_estudiante[$i]['nacionalidad'] = $value['nacionalidad'];
                $sipce_estudiante[$i]['domicilio'] = $value['domicilio'];
                $sipce_estudiante[$i]['IdProvincia'] = $value['IdProvincia'];
                $sipce_estudiante[$i]['IdCanton'] = $value['IdCanton'];
                $sipce_estudiante[$i]['IdDistrito'] = $value['IdDistrito'];
                $sipce_estudiante[$i]['telefonoCasa'] = $value['telefonoCasa'];
                $sipce_estudiante[$i]['telefonoCelular'] = $value['telefonoCelular'];
                $sipce_estudiante[$i]['email'] = $value['email'];
                $sipce_estudiante[$i]['tipoUsuario'] = $value['tipoUsuario'];
                $sipce_estudiante[$i]['passwords'] = $value['passwords'];
                $sipce_estudiante[$i]['estadoActual'] = $value['estadoActual'];
                $sipce_estudiante[$i]['escuela_procedencia'] = $value['escuela_procedencia'];
                $i++;
            }
        } else {
            //Guardo nulos los datos del estudiante en el array $estudiante
            $sipce_estudiante = null;
        }
        $estudiante['sipce_estudiante'] = $sipce_estudiante;


        //Consulto si ya existe datos en sipce_matricularatificacion
        $consultaExistenciaMatriculaRatificacion = $this->db->select("SELECT * FROM sipce_matricularatificacion "
                . "WHERE ced_estudiante = '" . $estudiante['ced_estudiante'] . "' ");

        if ($consultaExistenciaMatriculaRatificacion != null) {
            //Guardo datos del estudiante en el array $estudiante
            $i = 0;
            foreach ($consultaExistenciaMatriculaRatificacion as $lista => $value) {
                $sipce_matricularatificacion[$i]['anio'] = $value['anio'];
                $sipce_matricularatificacion[$i]['estado'] = $value['estado'];
                $sipce_matricularatificacion[$i]['nivel'] = $value['nivel'];
                $sipce_matricularatificacion[$i]['condicion'] = $value['condicion'];
                $i++;
            }
        } else {
            //Guardo nulos los datos del estudiante en el array $estudiante
            $sipce_matricularatificacion = null;
        }
        $estudiante['sipce_matricularatificacion'] = $sipce_matricularatificacion;


        //Consulto si ya existe datos en sipce_adecuacion
        $consultaExistenciaadecuacion = $this->db->select("SELECT * FROM sipce_adecuacion "
                . "WHERE ced_estudiante = '" . $estudiante['ced_estudiante'] . "' ");

        if ($consultaExistenciaadecuacion != null) {
            //Guardo datos del estudiante en el array $estudiante
            $i = 0;
            foreach ($consultaExistenciaadecuacion as $lista => $value) {
                $sipce_adecuacion[$i]['anio'] = $value['anio'];
                $sipce_adecuacion[$i]['adecuacion'] = $value['adecuacion'];
                $i++;
            }
        } else {
            //Guardo nulos los datos del estudiante en el array $estudiante
            $sipce_adecuacion = null;
        }
        $estudiante['sipce_adecuacion'] = $sipce_adecuacion;


        //Consulto si ya existe datos en sipce_adelanta
        $consultaExistenciaadelanta = $this->db->select("SELECT * FROM sipce_adelanta "
                . "WHERE ced_estudiante = '" . $estudiante['ced_estudiante'] . "' ");

        if ($consultaExistenciaadelanta != null) {
            //Guardo datos del estudiante en el array $estudiante
            $i = 0;
            foreach ($consultaExistenciaadelanta as $lista => $value) {
                $sipce_adelanta[$i]['anio'] = $value['anio'];
                $sipce_adelanta[$i]['nivel'] = $value['nivel'];
                $sipce_adelanta[$i]['nivel_adelanta'] = $value['nivel_adelanta'];
                $i++;
            }
        } else {
            //Guardo nulos los datos del estudiante en el array $estudiante
            $sipce_adelanta = null;
        }
        $estudiante['sipce_adelanta'] = $sipce_adelanta;


        //Consulto si ya existe datos en sipce_ausencias
        $consultaExistenciaausencias = $this->db->select("SELECT * FROM sipce_ausencias "
                . "WHERE ced_estudiante = '" . $estudiante['ced_estudiante'] . "' ");

        if ($consultaExistenciaausencias != null) {
            //Guardo datos del estudiante en el array $estudiante
            $i = 0;
            foreach ($consultaExistenciaausencias as $lista => $value) {
                $sipce_ausencias[$i]['annio'] = $value['annio'];
                $sipce_ausencias[$i]['cod_asignatura'] = $value['cod_asignatura'];
                $sipce_ausencias[$i]['periodo'] = $value['periodo'];
                $sipce_ausencias[$i]['cantidadAusenciasJustificadas'] = $value['cantidadAusenciasJustificadas'];
                $sipce_ausencias[$i]['cantidadAusenciasInjustificadas'] = $value['cantidadAusenciasInjustificadas'];
                $sipce_ausencias[$i]['cantidadTardias'] = $value['cantidadTardias'];
                $sipce_ausencias[$i]['cantidadEscapes'] = $value['cantidadEscapes'];
                $i++;
            }
        } else {
            //Guardo nulos los datos del estudiante en el array $estudiante
            $sipce_ausencias = null;
        }
        $estudiante['sipce_ausencias'] = $sipce_ausencias;


        //Consulto si ya existe datos en sipce_beca
        $consultaExistenciabeca = $this->db->select("SELECT * FROM sipce_beca "
                . "WHERE ced_estudiante = '" . $estudiante['ced_estudiante'] . "' ");

        if ($consultaExistenciabeca != null) {
            //Guardo datos del estudiante en el array $estudiante
            $i = 0;
            foreach ($consultaExistenciabeca as $lista => $value) {
                $sipce_beca[$i]['anio'] = $value['anio'];
                $sipce_beca[$i]['becaAvancemos'] = $value['becaAvancemos'];
                $sipce_beca[$i]['becaComedor'] = $value['becaComedor'];
                $sipce_beca[$i]['becaTransporte'] = $value['becaTransporte'];
                $i++;
            }
        } else {
            //Guardo nulos los datos del estudiante en el array $estudiante
            $sipce_beca = null;
        }
        $estudiante['sipce_beca'] = $sipce_beca;


        //Consulto si ya existe datos en sipce_encargado
        $consultaExistenciaencargado = $this->db->select("SELECT * FROM sipce_encargado "
                . "WHERE ced_estudiante = '" . $estudiante['ced_estudiante'] . "' ");

        if ($consultaExistenciaencargado != null) {
            //Guardo datos del estudiante en el array $estudiante
            $i = 0;
            foreach ($consultaExistenciaencargado as $lista => $value) {
                $sipce_encargado[$i]['anio'] = $value['anio'];
                $sipce_encargado[$i]['ced_encargado'] = $value['ced_encargado'];
                $sipce_encargado[$i]['parentesco'] = $value['parentesco'];
                $sipce_encargado[$i]['nombre_encargado'] = $value['nombre_encargado'];
                $sipce_encargado[$i]['apellido1_encargado'] = $value['apellido1_encargado'];
                $sipce_encargado[$i]['apellido2_encargado'] = $value['apellido2_encargado'];
                $sipce_encargado[$i]['telefonoCasaEncargado'] = $value['telefonoCasaEncargado'];
                $sipce_encargado[$i]['telefonoCelularEncargado'] = $value['telefonoCelularEncargado'];
                $sipce_encargado[$i]['ocupacionEncargado'] = $value['ocupacionEncargado'];
                $sipce_encargado[$i]['emailEncargado'] = $value['emailEncargado'];
                $i++;
            }
        } else {
            //Guardo nulos los datos del estudiante en el array $estudiante
            $sipce_encargado = null;
        }
        $estudiante['sipce_encargado'] = $sipce_encargado;


        //Consulto si ya existe datos en sipce_enfermedades
        $consultaExistenciaenfermedades = $this->db->select("SELECT * FROM sipce_enfermedades "
                . "WHERE cedula = '" . $estudiante['ced_estudiante'] . "' ");

        if ($consultaExistenciaenfermedades != null) {
            //Guardo datos del estudiante en el array $estudiante
            $i = 0;
            foreach ($consultaExistenciaenfermedades as $lista => $value) {
                $sipce_enfermedades[$i]['anio'] = $value['anio'];
                $sipce_enfermedades[$i]['descripcion'] = $value['descripcion'];
                $i++;
            }
        } else {
            //Guardo nulos los datos del estudiante en el array $estudiante
            $sipce_enfermedades = null;
        }
        $estudiante['sipce_enfermedades'] = $sipce_enfermedades;


        //Consulto si ya existe datos en sipce_especialidad_estudiante
        $consultaExistenciaespecialidad = $this->db->select("SELECT * FROM sipce_especialidad_estudiante "
                . "WHERE ced_estudiante = '" . $estudiante['ced_estudiante'] . "' ");

        if ($consultaExistenciaespecialidad != null) {
            //Guardo datos del estudiante en el array $estudiante
            $i = 0;
            foreach ($consultaExistenciaespecialidad as $lista => $value) {
                $sipce_especialidad_estudiante[$i]['cod_especialidad'] = $value['cod_especialidad'];
                $i++;
            }
        } else {
            //Guardo nulos los datos del estudiante en el array $estudiante
            $sipce_especialidad_estudiante = null;
        }
        $estudiante['sipce_especialidad_estudiante'] = $sipce_especialidad_estudiante;


        //Consulto si ya existe datos en sipce_estudiante_beca
        $consultaExistenciaEstudianteBeca = $this->db->select("SELECT * FROM sipce_estudiante_beca "
                . "WHERE ced_estudiante = '" . $estudiante['ced_estudiante'] . "' ");

        if ($consultaExistenciaEstudianteBeca != null) {
            //Guardo datos del estudiante en el array $estudiante
            $i = 0;
            foreach ($consultaExistenciaEstudianteBeca as $lista => $value) {
                $sipce_estudiante_beca[$i]['distancia'] = $value['distancia'];
                $sipce_estudiante_beca[$i]['ingreso1'] = $value['ingreso1'];
                $sipce_estudiante_beca[$i]['ingreso2'] = $value['ingreso2'];
                $sipce_estudiante_beca[$i]['ingreso3'] = $value['ingreso3'];
                $sipce_estudiante_beca[$i]['ingreso4'] = $value['ingreso4'];
                $sipce_estudiante_beca[$i]['totalIngreso'] = $value['totalIngreso'];
                $i++;
            }
        } else {
            //Guardo nulos los datos del estudiante en el array $estudiante
            $sipce_estudiante_beca = null;
        }
        $estudiante['sipce_estudiante_beca'] = $sipce_estudiante_beca;


        //Consulto si ya existe datos en sipce_grupos
        $consultaExistenciaEstudiantegrupos = $this->db->select("SELECT * FROM sipce_grupos "
                . "WHERE ced_estudiante = '" . $estudiante['ced_estudiante'] . "' ");

        if ($consultaExistenciaEstudiantegrupos != null) {
            //Guardo datos del estudiante en el array $estudiante
            $i = 0;
            foreach ($consultaExistenciaEstudiantegrupos as $lista => $value) {
                $sipce_grupos[$i]['annio'] = $value['annio'];
                $sipce_grupos[$i]['nivel'] = $value['nivel'];
                $sipce_grupos[$i]['grupo'] = $value['grupo'];
                $sipce_grupos[$i]['sub_grupo'] = $value['sub_grupo'];
                $i++;
            }
        } else {
            //Guardo nulos los datos del estudiante en el array $estudiante
            $sipce_grupos = null;
        }
        $estudiante['sipce_grupos'] = $sipce_grupos;


        //Consulto si ya existe datos en sipce_madre
        $consultaExistenciaEstudiantemadre = $this->db->select("SELECT * FROM sipce_madre "
                . "WHERE ced_estudiante = '" . $estudiante['ced_estudiante'] . "' ");

        if ($consultaExistenciaEstudiantemadre != null) {
            //Guardo datos del estudiante en el array $estudiante
            $i = 0;
            foreach ($consultaExistenciaEstudiantemadre as $lista => $value) {
                $sipce_madre[$i]['ced_madre'] = $value['ced_madre'];
                $sipce_madre[$i]['nombre_madre'] = $value['nombre_madre'];
                $sipce_madre[$i]['apellido1_madre'] = $value['apellido1_madre'];
                $sipce_madre[$i]['apellido2_madre'] = $value['apellido2_madre'];
                $sipce_madre[$i]['telefonoCasaMadre'] = $value['telefonoCasaMadre'];
                $sipce_madre[$i]['ocupacionMadre'] = $value['ocupacionMadre'];
                $sipce_madre[$i]['telefonoCelMadre'] = $value['telefonoCelMadre'];
                $i++;
            }
        } else {
            //Guardo nulos los datos del estudiante en el array $estudiante
            $sipce_madre = null;
        }
        $estudiante['sipce_madre'] = $sipce_madre;


        //Consulto si ya existe datos en sipce_padre
        $consultaExistenciaEstudiantepadre = $this->db->select("SELECT * FROM sipce_padre "
                . "WHERE ced_estudiante = '" . $estudiante['ced_estudiante'] . "' ");

        if ($consultaExistenciaEstudiantepadre != null) {
            //Guardo datos del estudiante en el array $estudiante
            $i = 0;
            foreach ($consultaExistenciaEstudiantepadre as $lista => $value) {
                $sipce_padre[$i]['ced_padre'] = $value['ced_padre'];
                $sipce_padre[$i]['nombre_padre'] = $value['nombre_padre'];
                $sipce_padre[$i]['apellido1_padre'] = $value['apellido1_padre'];
                $sipce_padre[$i]['apellido2_padre'] = $value['apellido2_padre'];
                $sipce_padre[$i]['telefonoCasaPadre'] = $value['telefonoCasaPadre'];
                $sipce_padre[$i]['ocupacionPadre'] = $value['ocupacionPadre'];
                $sipce_padre[$i]['telefonoCelPadre'] = $value['telefonoCelPadre'];
                $i++;
            }
        } else {
            //Guardo nulos los datos del estudiante en el array $estudiante
            $sipce_padre = null;
        }
        $estudiante['sipce_padre'] = $sipce_padre;


        //Consulto si ya existe datos en sipce_personaemergencia
        $consultaExistenciaEstudiantepersonaemergencia = $this->db->select("SELECT * FROM sipce_personaemergencia "
                . "WHERE ced_estudiante = '" . $estudiante['ced_estudiante'] . "' ");

        if ($consultaExistenciaEstudiantepersonaemergencia != null) {
            //Guardo datos del estudiante en el array $estudiante
            $i = 0;
            foreach ($consultaExistenciaEstudiantepersonaemergencia as $lista => $value) {
                $sipce_personaemergencia[$i]['ced_personaEmergencia'] = $value['ced_personaEmergencia'];
                $sipce_personaemergencia[$i]['nombre_personaEmergencia'] = $value['nombre_personaEmergencia'];
                $sipce_personaemergencia[$i]['apellido1_personaEmergencia'] = $value['apellido1_personaEmergencia'];
                $sipce_personaemergencia[$i]['apellido2_personaEmergencia'] = $value['apellido2_personaEmergencia'];
                $sipce_personaemergencia[$i]['telefonoCasaPersonaEmergencia'] = $value['telefonoCasaPersonaEmergencia'];
                $sipce_personaemergencia[$i]['telefonoCelularPersonaEmergencia'] = $value['telefonoCelularPersonaEmergencia'];
                $sipce_personaemergencia[$i]['parentesco'] = $value['parentesco'];
                $i++;
            }
        } else {
            //Guardo nulos los datos del estudiante en el array $estudiante
            $sipce_personaemergencia = null;
        }
        $estudiante['sipce_personaemergencia'] = $sipce_personaemergencia;


        //Consulto si ya existe datos en sipce_poliza
        $consultaExistenciaEstudiantepersonapoliza = $this->db->select("SELECT * FROM sipce_poliza "
                . "WHERE ced_estudiante = '" . $estudiante['ced_estudiante'] . "' ");

        if ($consultaExistenciaEstudiantepersonapoliza != null) {
            //Guardo datos del estudiante en el array $estudiante
            $i = 0;
            foreach ($consultaExistenciaEstudiantepersonapoliza as $lista => $value) {
                $sipce_poliza[$i]['numero_poliza'] = $value['numero_poliza'];
                $sipce_poliza[$i]['fecha_vence'] = $value['fecha_vence'];
                $i++;
            }
        } else {
            //Guardo nulos los datos del estudiante en el array $estudiante
            $sipce_poliza = null;
        }
        $estudiante['sipce_poliza'] = $sipce_poliza;


        
        //**Hago los insert de la nueva cedula**
        //sipce_estudiante
        if ($estudiante['sipce_estudiante'] != null) {
            $i = 0;
            foreach ($estudiante['sipce_estudiante'] as $lista => $value) {
                $this->db->insert('sipce_estudiante', array(
                    'cedula' => $estudiante['ced_nueva'],
                    'nombre' => $estudiante['sipce_estudiante'][$i]['nombre'],
                    'apellido1' => $estudiante['sipce_estudiante'][$i]['apellido1'],
                    'apellido2' => $estudiante['sipce_estudiante'][$i]['apellido2'],
                    'sexo' => $estudiante['sipce_estudiante'][$i]['sexo'],
                    'fechaNacimiento' => $estudiante['sipce_estudiante'][$i]['fechaNacimiento'],
                    'nacionalidad' => $estudiante['sipce_estudiante'][$i]['nacionalidad'],
                    'domicilio' => $estudiante['sipce_estudiante'][$i]['domicilio'],
                    'IdProvincia' => $estudiante['sipce_estudiante'][$i]['IdProvincia'],
                    'IdCanton' => $estudiante['sipce_estudiante'][$i]['IdCanton'],
                    'IdDistrito' => $estudiante['sipce_estudiante'][$i]['IdDistrito'],
                    'telefonoCasa' => $estudiante['sipce_estudiante'][$i]['telefonoCasa'],
                    'telefonoCelular' => $estudiante['sipce_estudiante'][$i]['telefonoCelular'],
                    'email' => $estudiante['sipce_estudiante'][$i]['email'],
                    'tipoUsuario' => $estudiante['sipce_estudiante'][$i]['tipoUsuario'],
                    'passwords' => $estudiante['sipce_estudiante'][$i]['passwords'],
                    'estadoActual' => $estudiante['sipce_estudiante'][$i]['estadoActual'],
                    'escuela_procedencia' => $estudiante['sipce_estudiante'][$i]['escuela_procedencia']));
                $i++;
            }
        }


        //sipce_matricularatificacion
        if ($estudiante['sipce_matricularatificacion'] != null) {
            $i = 0;
            foreach ($estudiante['sipce_matricularatificacion'] as $lista => $value) {
                $this->db->insert('sipce_matricularatificacion', array(
                    'ced_estudiante' => $estudiante['ced_nueva'],
                    'anio' => $estudiante['sipce_matricularatificacion'][$i]['anio'],
                    'nivel' => $estudiante['sipce_matricularatificacion'][$i]['nivel'],
                    'condicion' => $estudiante['sipce_matricularatificacion'][$i]['condicion'],
                    'estado' => $estudiante['sipce_matricularatificacion'][$i]['estado']));
                $i++;
            }
        }


        //sipce_adecuacion
        if ($estudiante['sipce_adecuacion'] != null) {
            $i = 0;
            foreach ($estudiante['sipce_adecuacion'] as $lista => $value) {
                $this->db->insert('sipce_adecuacion', array(
                    'ced_estudiante' => $estudiante['ced_nueva'],
                    'anio' => $estudiante['sipce_adecuacion'][$i]['anio'],
                    'adecuacion' => $estudiante['sipce_adecuacion'][$i]['adecuacion']));
                $i++;
            }
        }


        //sipce_adelanta
        if ($estudiante['sipce_adelanta'] != null) {
            $i = 0;
            foreach ($estudiante['sipce_adelanta'] as $lista => $value) {
                $this->db->insert('sipce_adelanta', array(
                    'ced_estudiante' => $estudiante['ced_nueva'],
                    'anio' => $estudiante['sipce_adelanta'][$i]['anio'],
                    'nivel' => $estudiante['sipce_adelanta'][$i]['nivel'],
                    'nivel_adelanta' => $estudiante['sipce_adelanta'][$i]['nivel_adelanta']));
                $i++;
            }
        }


        //sipce_ausencias
        if ($estudiante['sipce_ausencias'] != null) {
            $i = 0;
            foreach ($estudiante['sipce_ausencias'] as $lista => $value) {
                $this->db->insert('sipce_ausencias', array(
                    'ced_estudiante' => $estudiante['ced_nueva'],
                    'annio' => $estudiante['sipce_ausencias'][$i]['annio'],
                    'cod_asignatura' => $estudiante['sipce_ausencias'][$i]['cod_asignatura'],
                    'periodo' => $estudiante['sipce_ausencias'][$i]['periodo'],
                    'cantidadAusenciasJustificadas' => $estudiante['sipce_ausencias'][$i]['cantidadAusenciasJustificadas'],
                    'cantidadAusenciasInjustificadas' => $estudiante['sipce_ausencias'][$i]['cantidadAusenciasInjustificadas'],
                    'cantidadTardias' => $estudiante['sipce_ausencias'][$i]['cantidadTardias'],
                    'cantidadEscapes' => $estudiante['sipce_ausencias'][$i]['cantidadEscapes']));
                $i++;
            }
        }


        //sipce_beca
        if ($estudiante['sipce_beca'] != null) {
            $i = 0;
            foreach ($estudiante['sipce_beca'] as $lista => $value) {
                $this->db->insert('sipce_beca', array(
                    'ced_estudiante' => $estudiante['ced_nueva'],
                    'anio' => $estudiante['sipce_beca'][$i]['anio'],
                    'becaAvancemos' => $estudiante['sipce_beca'][$i]['becaAvancemos'],
                    'becaComedor' => $estudiante['sipce_beca'][$i]['becaComedor'],
                    'becaTransporte' => $estudiante['sipce_beca'][$i]['becaTransporte']));
                $i++;
            }
        }


        //sipce_encargado
        if ($estudiante['sipce_encargado'] != null) {
            $i = 0;
            foreach ($estudiante['sipce_encargado'] as $lista => $value) {
                $this->db->insert('sipce_encargado', array(
                    'ced_estudiante' => $estudiante['ced_nueva'],
                    'ced_encargado' => $estudiante['sipce_encargado'][$i]['ced_encargado'],
                    'parentesco' => $estudiante['sipce_encargado'][$i]['parentesco'],
                    'anio' => $estudiante['sipce_encargado'][$i]['anio'],
                    'nombre_encargado' => $estudiante['sipce_encargado'][$i]['nombre_encargado'],
                    'apellido1_encargado' => $estudiante['sipce_encargado'][$i]['apellido1_encargado'],
                    'apellido2_encargado' => $estudiante['sipce_encargado'][$i]['apellido2_encargado'],
                    'telefonoCasaEncargado' => $estudiante['sipce_encargado'][$i]['telefonoCasaEncargado'],
                    'telefonoCelularEncargado' => $estudiante['sipce_encargado'][$i]['telefonoCelularEncargado'],
                    'ocupacionEncargado' => $estudiante['sipce_encargado'][$i]['ocupacionEncargado'],
                    'emailEncargado' => $estudiante['sipce_encargado'][$i]['emailEncargado']));
                $i++;
            }
        }


        //sipce_enfermedades
        if ($estudiante['sipce_enfermedades'] != null) {
            $i = 0;
            foreach ($estudiante['sipce_enfermedades'] as $lista => $value) {
                $this->db->insert('sipce_enfermedades', array(
                    'cedula' => $estudiante['ced_nueva'],
                    'anio' => $estudiante['sipce_enfermedades'][$i]['anio'],
                    'descripcion' => $estudiante['sipce_enfermedades'][$i]['descripcion']));
                $i++;
            }
        }


        //sipce_especialidad_estudiante
        if ($estudiante['sipce_especialidad_estudiante'] != null) {
            $i = 0;
            foreach ($estudiante['sipce_especialidad_estudiante'] as $lista => $value) {
                $this->db->insert('sipce_especialidad_estudiante', array(
                    'ced_estudiante' => $estudiante['ced_nueva'],
                    'cod_especialidad' => $estudiante['sipce_especialidad_estudiante'][$i]['cod_especialidad']));
                $i++;
            }
        }


        //sipce_estudiante_beca
        if ($estudiante['sipce_estudiante_beca'] != null) {
            $i = 0;
            foreach ($estudiante['sipce_estudiante_beca'] as $lista => $value) {
                $this->db->insert('sipce_estudiante_beca', array(
                    'ced_estudiante' => $estudiante['ced_nueva'],
                    'distancia' => $estudiante['sipce_estudiante_beca'][$i]['distancia'],
                    'ingreso1' => $estudiante['sipce_estudiante_beca'][$i]['ingreso1'],
                    'ingreso2' => $estudiante['sipce_estudiante_beca'][$i]['ingreso2'],
                    'ingreso3' => $estudiante['sipce_estudiante_beca'][$i]['ingreso3'],
                    'ingreso4' => $estudiante['sipce_estudiante_beca'][$i]['ingreso4'],
                    'totalIngreso' => $estudiante['sipce_estudiante_beca'][$i]['totalIngreso']));
                $i++;
            }
        }


        //sipce_grupos
        if ($estudiante['sipce_grupos'] != null) {
            $i = 0;
            foreach ($estudiante['sipce_grupos'] as $lista => $value) {
                $this->db->insert('sipce_grupos', array(
                    'ced_estudiante' => $estudiante['ced_nueva'],
                    'nivel' => $estudiante['sipce_grupos'][$i]['nivel'],
                    'grupo' => $estudiante['sipce_grupos'][$i]['grupo'],
                    'sub_grupo' => $estudiante['sipce_grupos'][$i]['sub_grupo'],
                    'annio' => $estudiante['sipce_grupos'][$i]['annio']));
                $i++;
            }
        }


        //sipce_madre
        if ($estudiante['sipce_madre'] != null) {
            $i = 0;
            foreach ($estudiante['sipce_madre'] as $lista => $value) {
                $this->db->insert('sipce_madre', array(
                    'ced_estudiante' => $estudiante['ced_nueva'],
                    'ced_madre' => $estudiante['sipce_madre'][$i]['ced_madre'],
                    'nombre_madre' => $estudiante['sipce_madre'][$i]['nombre_madre'],
                    'apellido1_madre' => $estudiante['sipce_madre'][$i]['apellido1_madre'],
                    'apellido2_madre' => $estudiante['sipce_madre'][$i]['apellido2_madre'],
                    'telefonoCasaMadre' => $estudiante['sipce_madre'][$i]['telefonoCasaMadre'],
                    'ocupacionMadre' => $estudiante['sipce_madre'][$i]['ocupacionMadre'],
                    'telefonoCelMadre' => $estudiante['sipce_madre'][$i]['telefonoCelMadre']));
                $i++;
            }
        }


        //sipce_padre
        if ($estudiante['sipce_padre'] != null) {
            $i = 0;
            foreach ($estudiante['sipce_padre'] as $lista => $value) {
                $this->db->insert('sipce_padre', array(
                    'ced_estudiante' => $estudiante['ced_nueva'],
                    'ced_padre' => $estudiante['sipce_padre'][$i]['ced_padre'],
                    'nombre_padre' => $estudiante['sipce_padre'][$i]['nombre_padre'],
                    'apellido1_padre' => $estudiante['sipce_padre'][$i]['apellido1_padre'],
                    'apellido2_padre' => $estudiante['sipce_padre'][$i]['apellido2_padre'],
                    'telefonoCasaPadre' => $estudiante['sipce_padre'][$i]['telefonoCasaPadre'],
                    'ocupacionPadre' => $estudiante['sipce_padre'][$i]['ocupacionPadre'],
                    'telefonoCelPadre' => $estudiante['sipce_padre'][$i]['telefonoCelPadre']));
                $i++;
            }
        }


        //sipce_padre
        if ($estudiante['sipce_personaemergencia'] != null) {
            $i = 0;
            foreach ($estudiante['sipce_personaemergencia'] as $lista => $value) {
                $this->db->insert('sipce_personaemergencia', array(
                    'ced_estudiante' => $estudiante['ced_nueva'],
                    'ced_personaEmergencia' => $estudiante['sipce_personaemergencia'][$i]['ced_personaEmergencia'],
                    'nombre_personaEmergencia' => $estudiante['sipce_personaemergencia'][$i]['nombre_personaEmergencia'],
                    'apellido1_personaEmergencia' => $estudiante['sipce_personaemergencia'][$i]['apellido1_personaEmergencia'],
                    'apellido2_personaEmergencia' => $estudiante['sipce_personaemergencia'][$i]['apellido2_personaEmergencia'],
                    'telefonoCasaPersonaEmergencia' => $estudiante['sipce_personaemergencia'][$i]['telefonoCasaPersonaEmergencia'],
                    'telefonoCelularPersonaEmergencia' => $estudiante['sipce_personaemergencia'][$i]['telefonoCelularPersonaEmergencia'],
                    'parentesco' => $estudiante['sipce_personaemergencia'][$i]['parentesco']));
                $i++;
            }
        }


        //sipce_poliza
        if ($estudiante['sipce_poliza'] != null) {
            $i = 0;
            foreach ($estudiante['sipce_poliza'] as $lista => $value) {
                $this->db->insert('sipce_poliza', array(
                    'ced_estudiante' => $estudiante['ced_nueva'],
                    'numero_poliza' => $estudiante['sipce_poliza'][$i]['numero_poliza'],
                    'fecha_vence' => $estudiante['sipce_poliza'][$i]['fecha_vence']));
                $i++;
            }
        }


        //Borro datos antiguos
        if ($estudiante['sipce_estudiante'] != null) {
        $sth = $this->db->prepare("DELETE FROM sipce_estudiante WHERE cedula ='" . $estudiante['ced_estudiante'] . "'");
        $sth->execute();
        }
        
        if ($estudiante['sipce_matricularatificacion'] != null) {
        $sth = $this->db->prepare("DELETE FROM sipce_matricularatificacion WHERE ced_estudiante ='" . $estudiante['ced_estudiante'] . "'");
        $sth->execute();
        }
        
        if ($estudiante['sipce_adecuacion'] != null) {
        $sth = $this->db->prepare("DELETE FROM sipce_adecuacion WHERE ced_estudiante ='" . $estudiante['ced_estudiante'] . "'");
        $sth->execute();
        }
        
        if ($estudiante['sipce_adelanta'] != null) {
        $sth = $this->db->prepare("DELETE FROM sipce_adelanta WHERE ced_estudiante ='" . $estudiante['ced_estudiante'] . "'");
        $sth->execute();
        }
        
        if ($estudiante['sipce_ausencias'] != null) {
        $sth = $this->db->prepare("DELETE FROM sipce_ausencias WHERE ced_estudiante ='" . $estudiante['ced_estudiante'] . "'");
        $sth->execute();
        }
        
        if ($estudiante['sipce_beca'] != null) {
        $sth = $this->db->prepare("DELETE FROM sipce_beca WHERE ced_estudiante ='" . $estudiante['ced_estudiante'] . "'");
        $sth->execute();
        }
        
        if ($estudiante['sipce_encargado'] != null) {
        $sth = $this->db->prepare("DELETE FROM sipce_encargado WHERE ced_estudiante ='" . $estudiante['ced_estudiante'] . "'");
        $sth->execute();
        }
        
        if ($estudiante['sipce_enfermedades'] != null) {
        $sth = $this->db->prepare("DELETE FROM sipce_enfermedades WHERE cedula ='" . $estudiante['ced_estudiante'] . "'");
        $sth->execute();
        }
        
        if ($estudiante['sipce_estudiante_beca'] != null) {
        $sth = $this->db->prepare("DELETE FROM sipce_estudiante_beca WHERE ced_estudiante ='" . $estudiante['ced_estudiante'] . "'");
        $sth->execute();
        }
        
        if ($estudiante['sipce_grupos'] != null) {
        $sth = $this->db->prepare("DELETE FROM sipce_grupos WHERE ced_estudiante ='" . $estudiante['ced_estudiante'] . "'");
        $sth->execute();
        }
        
        if ($estudiante['sipce_madre'] != null) {
        $sth = $this->db->prepare("DELETE FROM sipce_madre WHERE ced_estudiante ='" . $estudiante['ced_estudiante'] . "'");
        $sth->execute();
        }
        
        if ($estudiante['sipce_padre'] != null) {
        $sth = $this->db->prepare("DELETE FROM sipce_padre WHERE ced_estudiante ='" . $estudiante['ced_estudiante'] . "'");
        $sth->execute();
        }
        
        if ($estudiante['sipce_personaemergencia'] != null) {
        $sth = $this->db->prepare("DELETE FROM sipce_personaemergencia WHERE ced_estudiante ='" . $estudiante['ced_estudiante'] . "'");
        $sth->execute();
        }
        
        if ($estudiante['sipce_poliza'] != null) {
        $sth = $this->db->prepare("DELETE FROM sipce_poliza WHERE ced_estudiante ='" . $estudiante['ced_estudiante'] . "'");
        $sth->execute();
        }
    }

}

?>