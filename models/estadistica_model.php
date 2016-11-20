<?php

class Estadistica_Model extends Models {

    //El constructor invoca al padre que esta en "libs/Model", este posee una variable llamada "db" con el acceso a la BD
    //db es un objeto "Database" y posee las siguientes funciones: select, insert, update y delete
    public function __construct() {
        parent::__construct();
        $consultaAnnio=$this->db->select('SELECT annio_lectivo FROM sipce_configuracion');
        $this->anioActivo = $consultaAnnio[0]['annio_lectivo'];
        
        $consultaDirector=$this->db->select('SELECT director FROM sipce_configuracion');
        $this->director = $consultaDirector[0]['director'];
    }

    //Esta Estadistica se debe realizar una vez concluida la matricula
    public function consultaEdades($consulta) {
        $arraySalida='<table class="table table-condensed"><thead><tr><th class="danger">Desde</th><th class="danger">Hasta</th><th class="text-center" colspan="3">7°</th><th class="text-center" colspan="3">8°</th><th class="text-center" colspan="3">9°</th><th class="text-center" colspan="3">10°</th><th class="text-center" colspan="3">11°</th><th class="text-center" colspan="3">12°</th></tr>' .
        $arraySalida='<tr><th class="danger">16-11</th><th class="danger">15-11</th><th>Total</th><th>Hombres</th><th>Mujeres</th><th>Total</th><th>Hombres</th><th>Mujeres</th><th>Total</th><th>Hombres</th><th>Mujeres</th><th>Total</th><th>Hombres</th><th>Mujeres</th><th>Total</th><th>Hombres</th><th>Mujeres</th><th>Total</th><th>Hombres</th><th>Mujeres</th></tr></thead><tbody>';
        for($j=0;$j<=10;$j++){
            $nivel=7;
            $arraySalida .='<tr><td class="danger">' . ($consulta['anioInicial'] - $j) . '</td><td class="danger">' . ($consulta['anioFinal'] - $j) . '</td>';
            for($i=0;$i<=5;$i++){
                $consultaFechaNacimiento = $this->db->select("SELECT cedula, fechaNacimiento, sexo "
                                . "FROM sipce_estudiante, sipce_matricularatificacion "
                                . "WHERE cedula = ced_estudiante "
                                . "AND anio = " . $consulta['anioActual'] . " "
                                . "AND nivel = " . ($nivel + $i) . " "
                                . "AND fechaNacimiento BETWEEN '" . ($consulta['anioInicial'] - $j) . "-11-16' AND '" . ($consulta['anioFinal'] - $j) . "-11-15'");

                $total=0;
                $totalMujeres=0;
                $totalHombres=0;
                
                foreach ($consultaFechaNacimiento as $value) {
                     if($value['sexo']==0){
                         $totalMujeres++;
                     }
                     if($value['sexo']==1){
                         $totalHombres++;
                     }
                     $total++;
                }
                if($total !=0 ){
                    $arraySalida .='<td class="warning text-center">' . $total . '</td><td class="warning text-center">' . $totalHombres . '</td><td class="warning text-center">' . $totalMujeres . "</td>";
                }else{
                    $arraySalida .= '<td class="text-center">' . $total . '</td><td class="text-center">' . $totalHombres . '</td><td class="text-center">' . $totalMujeres . '</td>';
                }
            }
            $arraySalida .='</tr>';
        }
        $arraySalida.="</tbody></table><br>";
        print_r($arraySalida);
    }

    //Esta Estadistica se debe realizar una vez concluida la matricula
    public function consultaRepitencia($consulta) {
        $arraySalida='<table class="table table-condensed"><thead><tr><th class="danger">Desde</th><th class="danger">Hasta</th><th class="text-center" colspan="3">7°</th><th class="text-center" colspan="3">8°</th><th class="text-center" colspan="3">9°</th><th class="text-center" colspan="3">10°</th><th class="text-center" colspan="3">11°</th><th class="text-center" colspan="3">12°</th></tr>' .
        $arraySalida='<tr><th class="danger">16-11</th><th class="danger">15-11</th><th>Total</th><th>Hombres</th><th>Mujeres</th><th>Total</th><th>Hombres</th><th>Mujeres</th><th>Total</th><th>Hombres</th><th>Mujeres</th><th>Total</th><th>Hombres</th><th>Mujeres</th><th>Total</th><th>Hombres</th><th>Mujeres</th><th>Total</th><th>Hombres</th><th>Mujeres</th></tr></thead><tbody>';
        for($j=0;$j<=10;$j++){
            $nivel=7;
            $arraySalida .='<tr><td class="danger">' . ($consulta['anioInicial'] - $j) . '</td><td class="danger">' . ($consulta['anioFinal'] - $j) . '</td>';
            for($i=0;$i<=5;$i++){
                $consultaFechaNacimiento = $this->db->select("SELECT cedula, fechaNacimiento, sexo "
                                . "FROM sipce_estudiante, sipce_matricularatificacion "
                                . "WHERE cedula = ced_estudiante "
                                . "AND anio = " . $consulta['anioActual'] . " "
                                . "AND nivel = " . ($nivel + $i) . " "
                                . "AND condicion = 'Repite' "
                                . "AND fechaNacimiento BETWEEN '" . ($consulta['anioInicial'] - $j) . "-11-16' AND '" . ($consulta['anioFinal'] - $j) . "-11-15'");

                $total=0;
                $totalMujeres=0;
                $totalHombres=0;
                
                foreach ($consultaFechaNacimiento as $value) {
                     if($value['sexo']==0){
                         $totalMujeres++;
                     }
                     if($value['sexo']==1){
                         $totalHombres++;
                     }
                     $total++;
                }
                if($total !=0 ){
                    $arraySalida .='<td class="warning text-center">' . $total . '</td><td class="warning text-center">' . $totalHombres . '</td><td class="warning text-center">' . $totalMujeres . "</td>";
                }else{
                    $arraySalida .= '<td class="text-center">' . $total . '</td><td class="text-center">' . $totalHombres . '</td><td class="text-center">' . $totalMujeres . '</td>';
                }
            }
            $arraySalida .='</tr>';
        }
        $arraySalida.="</tbody></table><br>";
        print_r($arraySalida);
    }

    //Esta Estadistica se debe realizar una vez concluida la matricula
    public function consultalugarDeResidencia() {
        $arraySalida='<table class="table table-condensed"><thead><tr><th class="text-center">Lugar</th><th class="text-center">Total</th><th class="text-center">Hombres</th><th class="text-center">Mujeres</th></tr></thead><tbody>';
        
        //Estudiantes que residen en Carrizal
        $arraySalida .='<tr><td class="text-center">Carrizal</td>';
        $consultaEstudiantesCarrizal = $this->db->select("SELECT sexo "
                            . "FROM sipce_estudiante "
                            . "WHERE IdDistrito = 124");

        $totalCarrizal=0;
        $totalMujeresCarrizal=0;
        $totalHombresCarrizal=0;

        foreach ($consultaEstudiantesCarrizal as $value) {
             if($value['sexo']==0){
                 $totalMujeresCarrizal++;
             }
             if($value['sexo']==1){
                 $totalHombresCarrizal++;
             }
             $totalCarrizal++;
        }
        $arraySalida .='<td class="text-center">' . $totalCarrizal . '</td><td class="text-center">' . $totalHombresCarrizal . '</td><td class="text-center">' . $totalMujeresCarrizal . "</td></tr>";
            
        //Estudiantes que residen en Alajuela
        $arraySalida .='<tr><td class="text-center">Alajuela</td>';
        $consultaEstudiantesAlajuela = $this->db->select("SELECT sexo "
                            . "FROM sipce_estudiante "
                            . "WHERE IdProvincia = 2 "
                            . "AND IdDistrito <> 124");

        $totalAlajuela=0;
        $totalMujeresAlajuela=0;
        $totalHombresAlajuela=0;

        foreach ($consultaEstudiantesAlajuela as $value) {
             if($value['sexo']==0){
                 $totalMujeresAlajuela++;
             }
             if($value['sexo']==1){
                 $totalHombresAlajuela++;
             }
             $totalAlajuela++;
        }
        $arraySalida .='<td class="text-center">' . $totalAlajuela . '</td><td class="text-center">' . $totalHombresAlajuela . '</td><td class="text-center">' . $totalMujeresAlajuela . "</td></tr>";
            
        //Estudiantes que residen en Heredia
        $arraySalida .='<tr><td class="text-center">Alajuela</td>';
        $consultaEstudiantesHeredia = $this->db->select("SELECT sexo "
                            . "FROM sipce_estudiante "
                            . "WHERE IdProvincia = 4");

        $totalHeredia=0;
        $totalMujeresHeredia=0;
        $totalHombresHeredia=0;

        foreach ($consultaEstudiantesHeredia as $value) {
             if($value['sexo']==0){
                 $totalMujeresHeredia++;
             }
             if($value['sexo']==1){
                 $totalHombresHeredia++;
             }
             $totalHeredia++;
        }
        $arraySalida .='<td class="text-center">' . $totalHeredia . '</td><td class="text-center">' . $totalHombresHeredia . '</td><td class="text-center">' . $totalMujeresHeredia . "</td></tr>";
        
        //Totalizo datos y cierro tabla
        $arraySalida .='<tr><td class="text-center">Total</td><td class="text-center">' . ($totalHeredia + $totalAlajuela + $totalCarrizal) . '</td><td class="text-center">' . ($totalHombresHeredia  + $totalHombresAlajuela  + $totalHombresCarrizal)  . '</td><td class="text-center">' . ($totalMujeresHeredia  + $totalMujeresAlajuela  + $totalMujeresCarrizal) . "</td></tr>";
        $arraySalida.="</tbody></table><br>";
        print_r($arraySalida);
    }

    //Esta Estadistica se debe realizar una vez concluida la matricula
    public function consultSegunModalidad() {
        $arraySalida='<table class="table table-condensed"><thead><tr><th>Modalidad y especialidad</th><th class="text-center" colspan="3">10°</th><th class="text-center" colspan="3">11°</th><th class="text-center" colspan="3">12°</th></tr>' .
        $arraySalida='<tr><th> &nbsp; </th><th>Total</th><th>Hombres</th><th>Mujeres</th><th>Total</th><th>Hombres</th><th>Mujeres</th><th>Total</th><th>Hombres</th><th>Mujeres</th></tr></thead><tbody>';
        
        $consultaEspecialidades = $this->db->select("SELECT * "
                                                . "FROM sipce_especialidad ");
        
        foreach ($consultaEspecialidades as $especialidadIterante) {
            $nombreEspecialidad=$especialidadIterante['nombreEspecialidad'];
            $codEspecialidad=$especialidadIterante['codigoEspecialidad'];
            $nivel=10;
            $arraySalida .='<tr><td>' . $nombreEspecialidad . '</td>';
            for($i=0;$i<=2;$i++){
                $consultaEstudiantesSegunModalidad = $this->db->select("SELECT es.sexo "
                                . "FROM sipce_estudiante as es, sipce_matricularatificacion as mr, sipce_especialidad_estudiante as ee "
                                . "WHERE es.cedula = mr.ced_estudiante "
                                . "AND es.cedula = ee.ced_estudiante "
                                . "AND mr.anio = " . $this->anioActivo . " "
                                . "AND mr.nivel = " . ($nivel + $i) . " "
                                . "AND ee.cod_especialidad = " . $codEspecialidad . " ");
                $total=0;
                $totalMujeres=0;
                $totalHombres=0;

                foreach ($consultaEstudiantesSegunModalidad as $value) {
                     if($value['sexo']==0){
                         $totalMujeres++;
                     }
                     if($value['sexo']==1){
                         $totalHombres++;
                     }
                     $total++;
                }
                if($total !=0 ){
                    $arraySalida .='<td class="warning text-center">' . $total . '</td><td class="warning text-center">' . $totalHombres . '</td><td class="warning text-center">' . $totalMujeres . "</td>";
                }else{
                    $arraySalida .= '<td class="text-center">' . $total . '</td><td class="text-center">' . $totalHombres . '</td><td class="text-center">' . $totalMujeres . '</td>';
                }
            }
            $arraySalida .='</tr>';
        }
        
        $arraySalida.="</tbody></table><br>";
        print_r($arraySalida);
    }
}
