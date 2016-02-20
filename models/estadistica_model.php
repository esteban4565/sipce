<?php

class Estadistica_Model extends Models {

    //El constructor invoca al padre que esta en "libs/Model", este posee una variable llamada "db" con el acceso a la BD
    //db es un objeto "Database" y posee las siguientes funciones: select, insert, update y delete
    public function __construct() {
        parent::__construct();
        $this->anioActivo = 2015;
    }

    //Esta Estadistica se debe realizar una vez concluida la matricula
    public function consultaEdades($consulta) {
        $arraySalida='<table class="table table-condensed"><thead><tr><th class="danger">Desde</th><th class="danger">Hasta</th><th class="text-center" colspan="3">7°</th><th class="text-center" colspan="3">8°</th><th class="text-center" colspan="3">9°</th><th class="text-center" colspan="3">10°</th><th class="text-center" colspan="3">11°</th><th class="text-center" colspan="3">12°</th></tr>' .
        $arraySalida='<tr><th class="danger">-</th><th class="danger">-</th><th>Total</th><th>Hombres</th><th>Mujeres</th><th>Total</th><th>Hombres</th><th>Mujeres</th><th>Total</th><th>Hombres</th><th>Mujeres</th><th>Total</th><th>Hombres</th><th>Mujeres</th><th>Total</th><th>Hombres</th><th>Mujeres</th><th>Total</th><th>Hombres</th><th>Mujeres</th></tr></thead><tbody>';
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
}
