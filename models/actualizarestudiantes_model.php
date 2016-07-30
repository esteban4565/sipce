<?php

class ActualizarEstudiantes_Model extends Models {

    //El constructor invoca al padre que esta en "libs/Model", este posee una variable llamada "db" con el acceso a la BD
    //db es un objeto "Database" y posee las siguientes funciones: select, insert, update y delete
    public function __construct() {
        parent::__construct();
        $this->anioActivo = 2016;

    //Ruta de carpetas en localhost o hostinger.com.....   local o web
        $this->entorno = 'local';
    }

    //esta funcion retorna un Array con todos los usuarios tipo "docente" que se encuentran en la BD
    public function estudiantesCedulaMala() {
        //La sentencia SQL se manda a la variable db del Model y se ejecuta la funcion, 
        //dependiendo de la tarea devuelve un registro o simplemente hace un insert en la BD
        return $this->db->select('SELECT cedula, nombre, apellido1, apellido2 FROM sipce_estudiante WHERE sexo = :texto', array('texto' => '3'));
    }

    //esta funcion retorna un Array con todos los usuarios tipo "docente" que se encuentran en la BD
    public function docentesCedulaMala() {
        //La sentencia SQL se manda a la variable db del Model y se ejecuta la funcion, 
        //dependiendo de la tarea devuelve un registro o simplemente hace un insert en la BD
        return $this->db->select('SELECT cedula, nombre, apellido1, apellido2 FROM sipce_personal WHERE sexo = :texto', array('texto' => '3'));
    }

    //Metodo obsoleto, re-escribia datos del estudiantes con los datos del Padron
    public function actuEstu() {
        $consulta_cedulas = $this->db->select('SELECT cedula FROM  sipce_estudiante');
        
            //recorro el registro de la consulta, le asigno la cedula a la variable $estudiante (array)
            foreach ($consulta_cedulas as $key => $estudiante) {
        	//consulto si existe la cedula en el padron...
                $consulta_datos = $this->db->select('SELECT nombre, primerApellido, segundoApellido, sexo, fechaNacimiento FROM tpersonapadron 
                                                            WHERE cedula= :cedula', array('cedula' => $estudiante['cedula']));
                
		//si el resultado de la consulta es diferente a nulo, si existe
		if($consulta_datos != null){
                    //recorro el registro de la consulta y realizo el update en la tabla sipce_estudiante
                    foreach ($consulta_datos as $key => $value) {
                        $postData = array('nombre' => $value['nombre'],
                                          'apellido1' => $value['primerApellido'],
                                          'apellido2' => $value['segundoApellido'],
                                          'sexo' => $value['sexo'],
                                          'fechaNacimiento' => $value['fechaNacimiento'],
                                          'nacionalidad' => '506',
                                            );
                        $this->db->update('sipce_estudiante', $postData, "`cedula` = '{$estudiante['cedula']}'");
                    }
		//si es nulo realizo un update para colocarle 3 en el campo sexo, para identificarlo posteriormente
                }else{
                    $postData = array('sexo' =>3,
                                      'fechaNacimiento' => 0,
                                      'nacionalidad' => 0,
                                            );
                    $this->db->update('sipce_estudiante', $postData, "`cedula` = '{$estudiante['cedula']}'");
                }
            }
    }

    public function actuPasswordEstu() {
        $consulta_cedulasFechaNacimiento = $this->db->select('SELECT cedula FROM sipce_estudiante');
        
            //recorro el registro de la consulta, le asigno la cedula a la variable $estudiante (array)
            foreach ($consulta_cedulasFechaNacimiento as $key => $estudiante) {
        	//consulto si existe la cedula en el padron...
                $consulta_datos = $this->db->select('SELECT fechaNacimiento FROM tpersonapadron 
                                                            WHERE cedula= :cedula', array('cedula' => $estudiante['cedula']));
                
		//si el resultado de la consulta es diferente a nulo, si existe
		if($consulta_datos != null){
                    //recorro el registro de la consulta y realizo el update en la tabla sipce_estudiante
                    foreach ($consulta_datos as $key => $value) {
                        $dia=substr($value['fechaNacimiento'],8,2);
                        $mes=substr($value['fechaNacimiento'],5,2);
                        $anio=substr($value['fechaNacimiento'],0,4);
                        $fechaOrdenada=$dia.$mes.$anio;
                        $passTemporal=Hash::create('md5', $fechaOrdenada, HASH_PASSWORD_KEY);
                        $postData = array('passwords' => $passTemporal
                                            );
                        $this->db->update('sipce_estudiante', $postData, "`cedula` = '{$estudiante['cedula']}'");
                    }
		//si es nulo realizo un update para colocarle 123queso en el campo passwords, para identificarlo posteriormente
                }else{
                    $passTemporal=Hash::create('md5', '123queso', HASH_PASSWORD_KEY);
                    $postData = array('passwords' =>$passTemporal
                                            );
                    $this->db->update('sipce_estudiante', $postData, "`cedula` = '{$estudiante['cedula']}'");
                }
            }
    }

    public function actuPasswordDocente() {
        $consulta_cedulasFechaNacimiento = $this->db->select('SELECT cedula FROM  sipce_personal');
        
            //recorro el registro de la consulta, le asigno la cedula a la variable $estudiante (array)
            foreach ($consulta_cedulasFechaNacimiento as $key => $docete) {
        	//consulto si existe la cedula en el padron...
                $consulta_datos = $this->db->select('SELECT  nombre, primerApellido, segundoApellido, sexo, fechaNacimiento FROM tpersonapadron 
                                                            WHERE cedula= :cedula', array('cedula' => $docete['cedula']));
                
		//si el resultado de la consulta es diferente a nulo, si existe
		if($consulta_datos != null){
                    //recorro el registro de la consulta y realizo el update en la tabla sipce_estudiante
                    foreach ($consulta_datos as $key => $value) {
                        $dia=substr($value['fechaNacimiento'],8,2);
                        $mes=substr($value['fechaNacimiento'],5,2);
                        $anio=substr($value['fechaNacimiento'],0,4);
                        $fechaOrdenada=$dia.$mes.$anio;
//                        print_r($fechaOrdenada);
//                        die;
                        $passTemporal=Hash::create('md5', $fechaOrdenada, HASH_PASSWORD_KEY);
                        $postData = array('nombre' => $value['nombre'],
                                          'apellido1' => $value['primerApellido'],
                                          'apellido2' => $value['segundoApellido'],
                                          'sexo' => $value['sexo'],
                                          'fechaNacimiento' => $value['fechaNacimiento'],
                                          'nacionalidad' => '506',
                                          'passwords' => $passTemporal
                                           );
                        $this->db->update('sipce_personal', $postData, "`cedula` = '{$docete['cedula']}'");
                    }
		//si es nulo realizo un update para colocarle 123queso en el campo passwords, para identificarlo posteriormente
                }else{
                    $postData = array('sexo' =>3,
                                      'fechaNacimiento' => 0,
                                      'nacionalidad' => 0,
                                            );
                    $this->db->update('sipce_personal', $postData, "`cedula` = '{$docete['cedula']}'");
                }
            }
    }

    public function estudiantesCedulaVoca() {
        
        return $this->db->select("SELECT p.cedula,p.nombre,p.apellido1,p.apellido2,g.especialidad "
                        . "FROM sipce_estudiante as p,admitidos_voca as g "
                        . "WHERE p.cedula = g.ced_estudiante "
                        . "order by p.apellido1");
    }

    public function estudiantesNuevosSolicitudEspecialidad() {
        
        return $this->db->select("SELECT p.primerApellido,p.segundoApellido,p.nombre,n.ced_estudiante,n.especialidad as Espe_Carrizal,g.especialidad as Espe_Voca  "
                        . "FROM nuevos_solicitud_especialidad as n,admitidos_voca as g, tpersonapadron as p "
                        . "WHERE g.ced_estudiante = n.ced_estudiante "
                        . "AND p.cedula = n.ced_estudiante "
                        . "order by p.primerApellido");
    }
    
    /* Carga la estadistica de un nivel en especifico */

    public function cargaProyeccion($idNivel) {
        $edadReferencia=$idNivel+6;
        
        $hombres=0;
        $menoresHombre=0;
        $mayoresHombre=0;
        $nacionalesHombre=0;
        $extrangerosHombre=0;
        
        $mujeres=0;
        $menoresMujer=0;
        $mayoresMujer=0;
        $nacionalesMujer=0;
        $extrangerosMujer=0;
        
        $datos = array();
        
        $resultado = $this->db->select("SELECT p.sexo,p.fechaNacimiento,p.nacionalidad "
                        . "FROM sipce_estudiante as p,sipce_grupos as g "
                        . "WHERE g.nivel = " . $idNivel . " "
                        . "AND g.annio = '" . ($this->anioActivo + 1) . "' "
                        . "AND p.cedula = g.ced_estudiante ");
        
        if($resultado!=NULL){
            foreach ($resultado as $key => $value) {
                    $anio=substr($value['fechaNacimiento'],0,4);
                    $edad=($this->anioActivo + 1)-$anio;
                    
                    if($value['sexo']==1){
                        $hombres++;
                        if($edad<=$edadReferencia){
                        $menoresHombre++;
                        }else{
                            $mayoresHombre++;
                        }
                        if($value['nacionalidad']==506){
                            $nacionalesHombre++;
                        }else{
                            $extrangerosHombre++;
                        }
                    }else{
                        $mujeres++;
                        if($edad<=$edadReferencia){
                        $menoresMujer++;
                        }else{
                            $mayoresMujer++;
                        }
                        if($value['nacionalidad']==506){
                            $nacionalesMujer++;
                        }else{
                            $extrangerosMujer++;
                        }
                    }
            }
        }
        $datos['edadReferencia'] =$edadReferencia;
        
        $datos['hombres'] =$hombres;
        $datos['menoresHombre'] =$menoresHombre;
        $datos['mayoresHombre'] =$mayoresHombre;
        $datos['nacionalesHombre'] =$nacionalesHombre;
        $datos['extrangerosHombre'] =$extrangerosHombre;
        
        $datos['mujeres'] =$mujeres;
        $datos['menoresMujer'] =$menoresMujer;
        $datos['mayoresMujer'] =$mayoresMujer;
        $datos['nacionalesMujer'] =$nacionalesMujer;
        $datos['extrangerosMujer'] =$extrangerosMujer;
        
        echo json_encode($datos);
    }
    
    /* Carga la estadistica de todos los niveles */

    public function cargaProyeccionTotal() {
        $totalSetimo=0;
        $totalOctavo=0;
        $totalNoveno=0;
        $totalDecino=0;
        $totalUndecino=0;
        $totalDuodecino=0;
        
        $datos = array();
        
        $resultado = $this->db->select("SELECT g.nivel "
                        . "FROM sipce_grupos as g "
                        . "WHERE g.annio = '" . ($this->anioActivo + 1) . "' ");
        
        if($resultado!=NULL){
            foreach ($resultado as $key => $value) {
                    if($value['nivel']==7){
                        $totalSetimo++;
                    }
                    if($value['nivel']==8){
                        $totalOctavo++;
                    }
                    if($value['nivel']==9){
                        $totalNoveno++;
                    }
                    if($value['nivel']==10){
                        $totalDecino++;
                    }
                    if($value['nivel']==11){
                        $totalUndecino++;
                    }
                    if($value['nivel']==12){
                        $totalDuodecino++;
                    }
            }
        }
        $datos['totalSetimo'] =$totalSetimo;
        $datos['totalOctavo'] =$totalOctavo;
        $datos['totalNoveno'] =$totalNoveno;
        $datos['totalDecino'] =$totalDecino;
        $datos['totalUndecino'] =$totalUndecino;
        $datos['totalDuodecino'] =$totalDuodecino;
        
        echo json_encode($datos);
    }
    
    /* Carga la estadistica de una Especialidad y Niveles en Especifico*/

    public function cargaProyeccionEspecialidad($consulta) {
        
        $edadReferencia=$consulta['nivelSeleccionado'] + 6;
        
        $hombres=0;
        $menoresHombre=0;
        $mayoresHombre=0;
        $nacionalesHombre=0;
        $extrangerosHombre=0;
        
        $mujeres=0;
        $menoresMujer=0;
        $mayoresMujer=0;
        $nacionalesMujer=0;
        $extrangerosMujer=0;
        
        $datos = array();
        
        $resultado = $this->db->select("SELECT p.sexo,p.fechaNacimiento,p.nacionalidad "
                        . "FROM sipce_estudiante as p,sipce_grupos as g,sipce_especialidad_estudiante as e "
                        . "WHERE g.nivel = " . $consulta['nivelSeleccionado'] . " "
                        . "AND g.annio = '" . ($this->anioActivo + 1) . "' "
                        . "AND p.cedula = g.ced_estudiante "
                        . "AND g.ced_estudiante = e.ced_estudiante "
                        . "AND e.cod_especialidad = " . $consulta['especialidad'] . " ");
        
        if($resultado!=NULL){
            foreach ($resultado as $key => $value) {
                    $anio=substr($value['fechaNacimiento'],0,4);
                    $edad=($this->anioActivo + 1)-$anio;
                    
                    if($value['sexo']==1){
                        $hombres++;
                        if($edad<=$edadReferencia){
                        $menoresHombre++;
                        }else{
                            $mayoresHombre++;
                        }
                        if($value['nacionalidad']==506){
                            $nacionalesHombre++;
                        }else{
                            $extrangerosHombre++;
                        }
                    }else{
                        $mujeres++;
                        if($edad<=$edadReferencia){
                        $menoresMujer++;
                        }else{
                            $mayoresMujer++;
                        }
                        if($value['nacionalidad']==506){
                            $nacionalesMujer++;
                        }else{
                            $extrangerosMujer++;
                        }
                    }
            }
        }
        $datos['edadReferencia'] =$edadReferencia;
        
        $datos['hombres'] =$hombres;
        $datos['menoresHombre'] =$menoresHombre;
        $datos['mayoresHombre'] =$mayoresHombre;
        $datos['nacionalesHombre'] =$nacionalesHombre;
        $datos['extrangerosHombre'] =$extrangerosHombre;
        
        $datos['mujeres'] =$mujeres;
        $datos['menoresMujer'] =$menoresMujer;
        $datos['mayoresMujer'] =$mayoresMujer;
        $datos['nacionalesMujer'] =$nacionalesMujer;
        $datos['extrangerosMujer'] =$extrangerosMujer;
        echo json_encode($datos);
    }
    
    /* Carga la estadistica de una especialidad en especifico en todos los niveles */

    public function cargaProyeccionTotalEspecialidad($consulta) {
        $totalDecino=0;
        $totalUndecino=0;
        $totalDuodecino=0;
        
        $datos = array();
        
        $resultado = $this->db->select("SELECT g.nivel "
                        . "FROM sipce_grupos as g,sipce_especialidad_estudiante as e "
                        . "WHERE g.annio = '" . ($this->anioActivo + 1) . "' "
                        . "AND g.ced_estudiante = e.ced_estudiante "
                        . "AND e.cod_especialidad = " . $consulta['especialidad'] . " ");
        
        if($resultado!=NULL){
            foreach ($resultado as $key => $value) {
                    if($value['nivel']==10){
                        $totalDecino++;
                    }
                    if($value['nivel']==11){
                        $totalUndecino++;
                    }
                    if($value['nivel']==12){
                        $totalDuodecino++;
                    }
            }
        }
        $datos['totalDecino'] =$totalDecino;
        $datos['totalUndecino'] =$totalUndecino;
        $datos['totalDuodecino'] =$totalDuodecino;
        
        echo json_encode($datos);
    }
    
    /* Carga la estadistica de una especialidad en especifico en todos los niveles */

    public function cargaProyeccionTotalTodasLasEspecialidad($consulta) {
        $aduanasDecino=0;
        $aduanasUndecino=0;
        $aduanasDuodecino=0;
        $ejecutivoDecino=0;
        $ejecutivoUndecino=0;
        $ejecutivoDuodecino=0;
        $contaDecino=0;
        $contaUndecino=0;
        $contaDuodecino=0;
        
        $bancaDecino=0;
        $bancaUndecino=0;
        $bancaDuodecino=0;
        $softwareDecino=0;
        $softwareUndecino=0;
        $softwareDuodecino=0;
        $dibujoDecino=0;
        $dibujoUndecino=0;
        $dibujoDuodecino=0;
        
        $agroDecino=0;
        $agroUndecino=0;
        $agroDuodecino=0;
        $turismoDecino=0;
        $turismoUndecino=0;
        $turismoDuodecino=0;
        $electroDecino=0;
        $electroUndecino=0;
        $electroDuodecino=0;
        
        $datos = array();
        
        $resultado = $this->db->select("SELECT g.nivel,e.cod_especialidad "
                        . "FROM sipce_grupos as g,sipce_especialidad_estudiante as e "
                        . "WHERE g.annio = '" . ($this->anioActivo + 1) . "' "
                        . "AND g.ced_estudiante = e.ced_estudiante ");
        
        if($resultado!=NULL){
            foreach ($resultado as $key => $value) {
                    if($value['nivel']==10){
                         if($value['cod_especialidad']==1){
                            $aduanasDecino++;
                         }
                         if($value['cod_especialidad']==2){
                            $ejecutivoDecino++;
                         }
                         if($value['cod_especialidad']==3){
                            $contaDecino++;
                         }
                         if($value['cod_especialidad']==4){
                            $bancaDecino++;
                         }
                         if($value['cod_especialidad']==5){
                            $softwareDecino++;
                         }
                         if($value['cod_especialidad']==6){
                            $dibujoDecino++;
                         }
                         if($value['cod_especialidad']==7){
                            $agroDecino++;
                         }
                         if($value['cod_especialidad']==8){
                            $turismoDecino++;
                         }
                         if($value['cod_especialidad']==9){
                            $electroDecino++;
                         }
                    }
                    if($value['nivel']==11){
                         if($value['cod_especialidad']==1){
                            $aduanasUndecino++;
                         }
                         if($value['cod_especialidad']==2){
                            $ejecutivoUndecino++;
                         }
                         if($value['cod_especialidad']==3){
                            $contaUndecino++;
                         }
                         if($value['cod_especialidad']==4){
                            $bancaUndecino++;
                         }
                         if($value['cod_especialidad']==5){
                            $softwareUndecino++;
                         }
                         if($value['cod_especialidad']==6){
                            $dibujoUndecino++;
                         }
                         if($value['cod_especialidad']==7){
                            $agroUndecino++;
                         }
                         if($value['cod_especialidad']==8){
                            $turismoUndecino++;
                         }
                         if($value['cod_especialidad']==9){
                            $electroUndecino++;
                         }
                    }
                    if($value['nivel']==12){
                         if($value['cod_especialidad']==1){
                            $aduanasDuodecino++;
                         }
                         if($value['cod_especialidad']==2){
                            $ejecutivoDuodecino++;
                         }
                         if($value['cod_especialidad']==3){
                            $contaDuodecino++;
                         }
                         if($value['cod_especialidad']==4){
                            $bancaDuodecino++;
                         }
                         if($value['cod_especialidad']==5){
                            $softwareDuodecino++;
                         }
                         if($value['cod_especialidad']==6){
                            $dibujoDuodecino++;
                         }
                         if($value['cod_especialidad']==7){
                            $agroDuodecino++;
                         }
                         if($value['cod_especialidad']==8){
                            $turismoDuodecino++;
                         }
                         if($value['cod_especialidad']==9){
                            $electroDuodecino++;
                         }
                    }
            }
        }
        
        $totalDecino=$aduanasDecino+$ejecutivoDecino+$contaDecino+$bancaDecino+$softwareDecino+$dibujoDecino+$agroDecino+$turismoDecino+$electroDecino;
        $totalUndecino=$aduanasUndecino+$ejecutivoUndecino+$contaUndecino+$bancaUndecino+$softwareUndecino+$dibujoUndecino+$agroUndecino+$turismoUndecino+$electroUndecino;
        $totalDuodecino=$aduanasDuodecino+$ejecutivoDuodecino+$contaDuodecino+$bancaDuodecino+$softwareDuodecino+$dibujoDuodecino+$agroDuodecino+$turismoDuodecino+$electroDuodecino;
        
        $datos['aduanasDecino'] = $aduanasDecino;
        $datos['aduanasUndecino'] = $aduanasUndecino;
        $datos['aduanasDuodecino'] = $aduanasDuodecino;
        
        $datos['ejecutivoDecino'] = $ejecutivoDecino;
        $datos['ejecutivoUndecino'] = $ejecutivoUndecino;
        $datos['ejecutivoDuodecino'] = $ejecutivoDuodecino;
        
        $datos['contaDecino'] = $contaDecino;
        $datos['contaUndecino'] = $contaUndecino;
        $datos['contaDuodecino'] = $contaDuodecino;
        
        $datos['bancaDecino'] = $bancaDecino;
        $datos['bancaUndecino'] = $bancaUndecino;
        $datos['bancaDuodecino'] = $bancaDuodecino;
        
        $datos['softwareDecino'] = $softwareDecino;
        $datos['softwareUndecino'] = $softwareUndecino;
        $datos['softwareDuodecino'] = $softwareDuodecino;
        
        $datos['dibujoDecino'] = $dibujoDecino;
        $datos['dibujoUndecino'] = $dibujoUndecino;
        $datos['dibujoDuodecino'] = $dibujoDuodecino;
        
        $datos['agroDecino'] = $agroDecino;
        $datos['agroUndecino'] = $agroUndecino;
        $datos['agroDuodecino'] = $agroDuodecino;
        
        $datos['turismoDecino'] = $turismoDecino;
        $datos['turismoUndecino'] = $turismoUndecino;
        $datos['turismoDuodecino'] = $turismoDuodecino;
        
        $datos['electroDecino'] = $electroDecino;
        $datos['electroUndecino'] = $electroUndecino;
        $datos['electroDuodecino'] = $electroDuodecino;
        
        $datos['totalDecino'] = $totalDecino;
        $datos['totalUndecino'] = $totalUndecino;
        $datos['totalDuodecino'] = $totalDuodecino;
        
        echo json_encode($datos);
    }
    
    /* Carga la estadistica de una especialidad en especifico en todos los niveles */

    public function cargaListaEstudiantesEspecialidad($consulta) {
        $resultado = $this->db->select("SELECT p.cedula,p.nombre,p.apellido1,p.apellido2,p.telefonoCasa,p.telefonoCelular "
                        . "FROM sipce_grupos as g,sipce_estudiante as p,sipce_especialidad_estudiante as e  "
                        . "WHERE g.annio = " . ($this->anioActivo + 1) . " "
                        . "AND g.nivel = " . $consulta['nivelSeleccionado']. " "
                        . "AND g.ced_estudiante = p.cedula "
                        . "AND g.ced_estudiante = e.ced_estudiante "
                        . "AND e.cod_especialidad = " . $consulta['especialidad']. " "
                        . "ORDER BY p.apellido1,p.apellido2 ");
        
        echo json_encode($resultado);
    }
    
    /* Carga la estadistica de una especialidad en especifico en todos los niveles */

    public function cargaListaEstudiantesMatriculados($consulta) {
        $resultado = $this->db->select("SELECT p.cedula,p.nombre,p.apellido1,p.apellido2 "
                        . "FROM sipce_grupos as g,sipce_estudiante as p "
                        . "WHERE g.annio = " . ($this->anioActivo + 1) . " "
                        . "AND g.nivel = " . $consulta['nivelSeleccionado']. " "
                        . "AND g.ced_estudiante = p.cedula "
                        . "ORDER BY p.apellido1,p.apellido2 ");
        
        echo json_encode($resultado);
    }
    
    /* Ingreso Personal */
    function guardarIngresarPersonal($datos) {
        $dia=substr($datos['tf_fnacpersona'],8,2);
        $mes=substr($datos['tf_fnacpersona'],5,2);
        $anio=substr($datos['tf_fnacpersona'],0,4);
        $fechaOrdenada=$dia.$mes.$anio;

        $passTemporal=Hash::create('md5', $fechaOrdenada, HASH_PASSWORD_KEY);
        $this->db->insert('sipce_personal', array(
                          'cedula' => $datos['tf_cedula'],
                          'nombre' => $datos['tf_nombre'],
                          'apellido1' => $datos['tf_ape1'],
                          'apellido2' => $datos['tf_ape2'],
                          'sexo' => $datos['tf_genero'],
                          'fechaNacimiento' => $datos['tf_fnacpersona'],
                          'nacionalidad' => $datos['tf_nacionalidad'],
                          'tipoUsuario' => $datos['tf_rol'],
                          'passwords' => $passTemporal));
    }

    /* Retorna la lista de paises */
    public function consultaPaises() {
        return $this->db->select("SELECT * FROM sipce_paises ORDER BY nombrePais", array());
    }

    /* Verifica si la Identificación de la persona ya existe en la BD */
    public function verificarPersona($cedula) {
        $resultado = $this->db->select("SELECT * "
                . "FROM sipce_personal "
                . "WHERE cedula = '" . $cedula . "' ");
        echo json_encode($resultado);
    }

    /* Retorna datos de la Persona */

    public function buscarPersona($cedula) {
        $resultado = $this->db->select("SELECT * "
                . "FROM tpersonapadron "
                . "WHERE cedula = '" . $cedula . "' ");
        echo json_encode($resultado);
    }

    /* Retorna Estudiantes No encontrados */

    public function buscarCedulaEstudiante() {
        $arraySalida="";
        if (($gestor = fopen("c:\\UpdateSeccionesTodos.csv", "r")) !== FALSE) {
            while (($datos = fgetcsv($gestor, 1000, ";")) !== FALSE) {
                
                $resultado = $this->db->select("SELECT * "
                                                . "FROM sipce_grupos "
                                                . "WHERE ced_estudiante = '" . $datos[0] . "' "
                                                . "AND annio = " . $datos[1] . " ");
                if($resultado == null){
                    $arraySalida.= "Estudiante no encontrado: " . $datos[0] . " en año: " . $datos[1] . "<br />";
                }else{
                    //actualizo datos
                    $posData = array(
                        'nivel' => $datos[2],
                        'grupo' => $datos[3],
                        'sub_grupo' => $datos[4]);
                    $this->db->update('sipce_grupos', $posData, "`ced_estudiante` = '{$datos[0]}' AND `annio` = {$datos[1]}");
                }
            }
            fclose($gestor);
        }else{
            $arraySalida.= "Error al abrir el archivo";
        }
        return $arraySalida;
    }

    /* Guarda Ausencias, Recorre archivo y Retorna Estudiantes No encontrados */

    public function guardarAusencias($datosArchivo) {
        //Ruta de carpetas en localhost o hostinger.com
        if($this->entorno == 'local'){
            $ruta="../sipce";
        }else if($this->entorno == 'web'){
            $ruta="../public_html";
        }
        
        $archivo= $ruta . "/public/ausencias/" . $datosArchivo['Nombre'];        
        
        //Variables estadisticas de salida
        $registrosActualizados=0;
        $registrosAgregados=0;
        $arraySalida="";
        $numFila=1;
        
        //si se puede abrir el archivo lo recorro con un while
        if (($gestor = fopen($archivo, "r")) !== FALSE) {
            while (($datos = fgetcsv($gestor, 1000, ";")) !== FALSE) {
                //Variables Locales para avanzar dentro del vector (filas del archivo csv)
                $ced_estudiante=0;
                $periodo=1;
                $cod_asignatura=2;
                $tardias=3;
                $ausenciasInjustificadas=4;
                $ausenciasJustificadas=5;
                $escapes=6;

                //Primero verifico que la fila no venga vacia !="0"
                if($datos[$ced_estudiante]!="0" && $datos[$ced_estudiante]!=null){
                    //Luego verifico si el estudiante existe en la tabla grupos
                    $consultaExistenciaEstudiante = $this->db->select("SELECT * "
                                                    . "FROM sipce_grupos "
                                                    . "WHERE ced_estudiante = '" . $datos[$ced_estudiante] . "' "
                                                    . "AND annio = " . $this->anioActivo . " ");

                    //Si existe procedo a actualizar ausencias, sino imprimo cedula para corroborar estudiante
                    if($consultaExistenciaEstudiante != null){
                        //Utilizo un for para avanzar en las once asignaturas
                        for ($i=1; $i<=10; $i++){
                            //Corroboro de que exista el codigo de asignatura !=0
                            if($datos[$cod_asignatura]!=0){
                                //Consulto si el estudiante ya posee un registro de asistencia de esa asignatura en especifico
                                $consultaAsistencia = $this->db->select("SELECT * "
                                                                . "FROM sipce_ausencias "
                                                                . "WHERE ced_estudiante = '" . $datos[$ced_estudiante] . "' "
                                                                . "AND annio = " . $this->anioActivo . " "
                                                                . "AND cod_asignatura = " . $datos[$cod_asignatura] . " "
                                                                . "AND periodo = " . $datos[$periodo] . " ");
                                
                                //Si ya existe actualizo datos, sino inserto el registro
                                if($consultaAsistencia != null){
                                    $posData = array(
                                        'cantidadTardias' => $datos[$tardias],
                                        'cantidadAusenciasInjustificadas' => $datos[$ausenciasInjustificadas],
                                        'cantidadAusenciasJustificadas' => $datos[$ausenciasJustificadas],
                                        'cantidadEscapes' => $datos[$escapes]);
                                    $this->db->update('sipce_ausencias', $posData, "`ced_estudiante` = '{$datos[$ced_estudiante]}' 
                                                        AND `annio` = {$this->anioActivo} AND `cod_asignatura` = {$datos[$cod_asignatura]} 
                                                        AND `periodo` = {$datos[$periodo]}");
                                    $registrosActualizados++;
                                }else{
                                    $this->db->insert('sipce_ausencias', array(
                                          'ced_estudiante' => $datos[$ced_estudiante],
                                          'annio' => $this->anioActivo,
                                          'cod_asignatura' => $datos[$cod_asignatura],
                                          'periodo' => $datos[$periodo],
                                          'cantidadTardias' => $datos[$tardias],
                                          'cantidadAusenciasInjustificadas' => $datos[$ausenciasInjustificadas],
                                          'cantidadAusenciasJustificadas' => $datos[$ausenciasJustificadas],
                                          'cantidadEscapes' => $datos[$escapes]));
                                    $registrosAgregados++;
                                }
                            }else{
                                if($datos[$cod_asignatura] > 0){
                                $arraySalida.= "Código de Asignatura no encontrado: " . $datos[$cod_asignatura] . " en sipce_puestos [1 - 134]<br />";
                                }
                            }
                                
                            //antes de avanzar en el ciclo del for, incremento en 5 las variables locales para avanzar dentro del vector, 
                            //esto me deja en la posicion de la siguiente asignatura
                            $cod_asignatura+=5;
                            $tardias+=5;
                            $ausenciasInjustificadas+=5;
                            $ausenciasJustificadas+=5;
                            $escapes+=5;
                       }
                    }  else {
                        $arraySalida.= "Estudiante <font color='red'>" . $datos[$ced_estudiante] . "</font> no encontrado en el año: "
                                    . $this->anioActivo . " -*- Fila de archivo csv: " . $numFila . "<br />";
                    }
                }
                $numFila++;
            }
            fclose($gestor);
        }else{
            $arraySalida.= "Error al abrir el archivo";
        }
        $arraySalida.= "<br>Registros Actualizados: " . $registrosActualizados;
        $arraySalida.= "<br>Registros Agregados: " . $registrosAgregados;
        return $arraySalida;
    }

    /* Retorna Ausencias de un estudiante en especifico */

    public function ausenciasEstudiante($ced_estudiante) {
        $resultado = $this->db->select("SELECT p.descripcion,a.cantidadAusenciasJustificadas,a.cantidadAusenciasInjustificadas,a.cantidadTardias,a.cantidadEscapes "
                                        . "FROM sipce_ausencias as a,sipce_puesto as p "
                                        . "WHERE a.ced_estudiante = '" . $ced_estudiante . "' "
                                        . "AND a.annio = " . $this->anioActivo . " "
                                        . "AND p.codigo = a.cod_asignatura");
        return $resultado;
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
        $resultado2 = $this->db->select("SELECT e.cedula,e.nombre,e.apellido1,e.apellido2,g.sub_grupo,r.condicion "
                . "FROM sipce_estudiante as e, sipce_grupos as g, sipce_matricularatificacion as r "
                . "WHERE e.cedula = g.ced_estudiante "
                . "AND e.cedula = r.ced_estudiante "
                . "AND e.tipoUsuario = 4 "
                . "AND g.nivel = " . $consulta['nivelSeleccionado'] . " "
                . "AND g.grupo = " . $consulta['grupoSeleccionado'] . " "
                . "AND g.annio = " . $this->anioActivo . " "
                . "ORDER BY g.sub_grupo,e.apellido1,e.apellido2,e.nombre");
        echo json_encode($resultado2);
    }
}
