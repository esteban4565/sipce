<?php

class Seccion_Model extends Models {

    public function __construct() {
        parent::__construct();
    }

    /* Retorna la lista de todo los usuarios */

    public function listaSecciones() {
        return $this->db->select("SELECT cedula,nombre,apellido1,apellido2,fechaNacimiento "
                        . "FROM sipce_persona, sipce_grupos "
                        . "WHERE cedula = ced_estudiante "
                        . "AND tipoUsuario = 3 "
                        . "AND nivel = 10 "
                        . "AND grupo = 3 "
                        . "AND sub_grupo = 'A' "
                        . "ORDER BY apellido1,apellido2");
    }

    /* Carga todas los Niveles */

    public function consultaNiveles() {
        return $this->db->select('SELECT DISTINCT nivel FROM sipce_grupos ORDER BY nivel');
    }

    /* Carga todos los cantones */

    public function cargaGrupos($idNivel) {

        $resultado = $this->db->select("SELECT DISTINCT grupo FROM sipce_grupos "
                . "WHERE nivel = :nivel "
                . "ORDER BY grupo", array('nivel' => $idNivel));
        echo json_encode($resultado);
    }

    /* Carga todos los distritos */

    public function cargaSubGrupos($idGrupo) {
        $resultado = $this->db->select("SELECT DISTINCT sub_grupo FROM sipce_grupos "
                . "WHERE grupo = :grupo ORDER BY sub_grupo", array('grupo' => $idGrupo));
        echo json_encode($resultado);
    }

    public function xhrSeccion($idGrupo) {
        $resultado2 = $this->db->select("SELECT cedula,nombre,apellido1,apellido2 "
                . "FROM sipce_persona, sipce_grupos "
                . "WHERE cedula = ced_estudiante "
                . "AND tipoUsuario = 3 "
                . "AND nivel = 10 "
                . "AND grupo = :grupo "
                . "ORDER BY apellido1,apellido2", array(':grupo' => $idGrupo));
        echo json_encode($resultado2);
    }

    public function xhrSeccion2($consulta) {
        $resultado2 = $this->db->select("SELECT cedula,nombre,apellido1,apellido2,sub_grupo "
                . "FROM sipce_persona, sipce_grupos "
                . "WHERE cedula = ced_estudiante "
                . "AND tipoUsuario = 3 "
                . "AND nivel = :nivel "
                . "AND grupo = :grupo "
                . "ORDER BY sub_grupo,apellido1", array(':nivel' => $consulta['nivelSeleccionado'], 
                                                                  ':grupo' => $consulta['grupoSeleccionado']));
        echo json_encode($resultado2);
    }

    function xhrInsert() {
        $text = $_POST['text'];

        $sth = $this->db->prepare('INSERT INTO data (text) VALUES (:text)');
        $sth->execute(array(':text' => $text));

        $data = array('text' => $text, 'id' => $this->db->lastInsertId());
        echo json_encode($data);
    }

    function xhrGetListings() {
        $sth = $this->db->prepare('SELECT * FROM data');
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute();
        $data = $sth->fetchAll();
        echo json_encode($data);
    }

}

?>