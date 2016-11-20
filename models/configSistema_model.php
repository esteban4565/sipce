<?php

class ConfigSistema_Model extends Models {

    public function __construct() {
        parent::__construct();
        $this->datosSistema = $this->db->select('SELECT * FROM sipce_configuracion WHERE id=1');
    }

    /* Carga datos del sistema */

    public function datosSistema() {
        return $this->datosSistema;
    }

    /* Guarda datos del sistema */

    public function guardarDatosSistema($datos) {
        $posData = array(
            'annio_lectivo' => $datos['annio_lectivo'],
            'director' => $datos['director']);
        $this->db->update('sipce_configuracion', $posData, "`id` = 1");
    
        return $this->db->select('SELECT * FROM sipce_configuracion WHERE id=1');
    }

}

?>