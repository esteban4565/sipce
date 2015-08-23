<?php

class ActualizarEstudiantes_Model extends Models {

    //El constructor invoca al padre que esta en "libs/Model", este posee una variable llamada "db" con el acceso a la BD
    //db es un objeto "Database" y posee las siguientes funciones: select, insert, update y delete
    public function __construct() {
        parent::__construct();
    }

    //esta funcion retorna un Array con todos los usuarios tipo "docente" que se encuentran en la BD
    public function estudiantesCedulaMala() {
        //La sentencia SQL se manda a la variable db del Model y se ejecuta la funcion, 
        //dependiendo de la tarea devuelve un registro o simplemente hace un insert en la BD
        return $this->db->select('SELECT cedula, nombre, apellido1, apellido2 FROM sipce_estudiante WHERE sexo = :texto', array('texto' => '3'));
    }

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
        $consulta_cedulasFechaNacimiento = $this->db->select('SELECT cedula FROM  sipce_estudiante');
        
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
//                        print_r($fechaOrdenada);
//                        die;
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
}
