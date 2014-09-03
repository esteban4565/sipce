<?php

class Horario_Model extends Models {

    //El constructor invoca al padre que esta en "libs/Model", este posee una variable llamada "db" con el acceso a la BD
    //db es un objeto "Database" y posee las siguientes funciones: select, insert, update y delete
    public function __construct() {
        parent::__construct();
    }

    //esta funcion retorna un Array con todos los usuarios tipo "docente" que se encuentran en la BD
    public function profeLista() {
        //La sentencia SQL se manda a la variable db del Model y se ejecuta la funcion, 
        //dependiendo de la tarea devuelve un registro o simplemente hace un insert en la BD
        return $this->db->select('SELECT cedula, nombre, apellido1, apellido2 FROM sipce_persona WHERE tipoUsuario = 4');
    }

    //esta funcion retorna una matriz que posee el codigo y nombre de las asignaturas que imparte un docente en especifico
    public function asignaturasDocente($cedula) {
        $consulta_asignaturas = $this->db->select('SELECT codigo,nombre FROM sipce_asignaturas, sipce_asignaturas_docente 
                                                    WHERE ced_docente= :cedula
                                                    AND cod_asignatura= codigo', array('cedula' => $cedula));

        $contador1 = 0;
        //recorro el registro de la consulta y cargo la matriz a mi gusto
        foreach ($consulta_asignaturas as $key => $value) {
            $contador2 = 0;
            $matriz[$contador1][$contador2] = $value['codigo'];
            $contador2++;
            $matriz[$contador1][$contador2] = $value['nombre'];
            $contador1++;
        }
        //Le agrego un "-" al ultimo grupo para que aparesca como Default
        $matriz[$contador1][0] = '-';
        $matriz[$contador1][1] = '-';
        return $matriz;
    }

    //esta funcion consulta en la BD si el docente en especifico ya posee el horario en la tabla "horario"
    //Si no se encuentra se devuelve vacio al Controller
    public function profeSingleList($cedula) {
        return $this->db->select('SELECT * FROM sipce_horario WHERE ced_docente = :cedula ORDER BY leccion, dia', array('cedula' => $cedula));
    }

    //esta funcion consulta en la BD cuantas secciones existen en la institucion, 
    //la informacion se carga a una matriz y se devuelve al Controller
    public function gruposLista() {
        $consulta_grupos = $this->db->select('SELECT codigo, numero, numnivel FROM sipce_grupos_cod');
        $contador3 = 0;
        $matrizGrupos = null;
        //recorro el registro de la consulta y cargo la matriz a mi gusto
        foreach ($consulta_grupos as $key => $value) {
            $contador4 = 0;
            $matrizGrupos[$contador3][$contador4] = $value['codigo'];
            $contador4++;
            $matrizGrupos[$contador3][$contador4] = $value['numnivel'] . '-' . $value['numero'];
            $contador3++;
        }
        //Le agrego un "-" al ultimo grupo para que aparesca como Default
        $matrizGrupos[$contador3][0] = '-';
        $matrizGrupos[$contador3][1] = '-';
        return $matrizGrupos;
    }

    public function create($data) {
        $this->db->insert('note', array(
            'title' => $data['title'],
            'userid' => $_SESSION['userid'],
            'content' => $data['content'],
            'date_added' => date('Y-m-d H:i:s') // use GMT aka UTC 0:00
        ));
    }

    public function ingresarHorario($ced_docente, $matrizHorario, $estado) {
        $dia = 1;
        if($estado==0){
            //Este while ingresa el horario de cada dia
            while ($dia < 6) {
                $leccion = 1;
                //Este while ingresa el horario de las lecciones del dia
                while ($leccion < 13) {
                    //inserto la leccion en la tabla Horario
                    $this->db->insert('sipce_horario', array(
                        'ced_docente' => $ced_docente,
                        'dia' => $dia,
                        'leccion' => $leccion,
                        'cod_grupo' => $matrizHorario[$dia][$leccion]['cod_grupo'],
                        'cod_asignatura' => $matrizHorario[$dia][$leccion]['cod_asignatura']
                    ));
                    $leccion++;
                }
                $dia++;
            }
        }
        else {
            //Este while ingresa el horario de cada dia
            while ($dia < 6) {
                $leccion = 1;
                //Este while ingresa el horario de las lecciones del dia
                while ($leccion < 13) {
                $postData = array(
                                'cod_grupo' => $matrizHorario[$dia][$leccion]['cod_grupo'],
                                'cod_asignatura' => $matrizHorario[$dia][$leccion]['cod_asignatura']
                            );
                $this->db->update('sipce_horario', $postData, "`ced_docente` = '{$ced_docente}' AND dia = '{$dia}' AND leccion = '{$leccion}'");
                $leccion++;
                }
                $dia++;
            }
        }
    }

    public function editSave($data) {
        $postData = array(
            'title' => $data['title'],
            'content' => $data['content'],
        );

        $this->db->update('note', $postData, "`noteid` = '{$data['noteid']}' AND userid = '{$_SESSION['userid']}'");
    }

    public function delete($id) {
        $this->db->delete('note', "`noteid` = {$data['noteid']} AND userid = '{$_SESSION['userid']}'");
    }

}
