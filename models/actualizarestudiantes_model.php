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
        return $this->db->select('SELECT cedula, nombre, apellido1, apellido2 FROM sipce_persona WHERE sexo = :texto', array('texto' => '3'));
    }

    public function actuEstu() {
        $consulta_cedulas = $this->db->select('SELECT cedula FROM  sipce_persona');
        
            //recorro el registro de la consulta, le asigno la cedula a la variable $estudiante (array)
            foreach ($consulta_cedulas as $key => $estudiante) {
        	//consulto si existe la cedula en el padron...
                $consulta_datos = $this->db->select('SELECT sexo, fechaNacimiento FROM tpersonapadron 
                                                            WHERE cedula= :cedula', array('cedula' => $estudiante['cedula']));
                
		//si el resultado de la consulta es diferente a nulo, si existe
		if($consulta_datos != null){
                    //recorro el registro de la consulta y realizo el update en la tabla sipce_persona
                    foreach ($consulta_datos as $key => $value) {
                        $postData = array('sexo' => $value['sexo'],
                                          'fechaNacimiento' => $value['fechaNacimiento'],
                                            );
                        $this->db->update('sipce_persona', $postData, "`cedula` = '{$estudiante['cedula']}'");
                    }
		//si es nulo realizo un update para colocarle 3 en el campo sexo, para identificarlo posteriormente
                }else{
                    $postData = array('sexo' =>3,
                                          'fechaNacimiento' => 0,
                                            );
                    $this->db->update('sipce_persona', $postData, "`cedula` = '{$estudiante['cedula']}'");
                }
            }
    }
}
