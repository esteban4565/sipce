<div class="row">
    <div class="col-xs-12">
        <h2>Ausencias del Estudiante</h2>
    </div>
     <?php if($this->ausenciasEstudiante != null){?>
    <div class="col-xs-8">
        <table class="table table-condensed" id="tablaRatificar">
            <tr>
                <th>Asignatura</th>
                <th>Ausencias Justificadas</th>
                <th>Ausencias Injustificadas</th>
                <th>Tardias</th>
                <th>Escapes</th>
            </tr>
            <?php
            foreach ($this->ausenciasEstudiante as $lista => $value) {
                echo '<tr>';
                echo '<td>';
                echo $value['descripcion'];
                echo '</td>';
                if($value['cantidadAusenciasJustificadas'] !=0 ){
                    echo '<td class="warning text-center">' . $value['cantidadAusenciasJustificadas'] . '</td>';
                }else{
                    echo '<td class="text-center">' . $value['cantidadAusenciasJustificadas'] . '</td>';
                }
                echo '</td>';
                if($value['cantidadAusenciasInjustificadas'] !=0 ){
                    echo '<td class="warning text-center">' . $value['cantidadAusenciasInjustificadas'] . '</td>';
                }else{
                    echo '<td class="text-center">' . $value['cantidadAusenciasInjustificadas'] . '</td>';
                }
                echo '</td>';
                if($value['cantidadTardias'] !=0 ){
                    echo '<td class="warning text-center">' . $value['cantidadTardias'] . '</td>';
                }else{
                    echo '<td class="text-center">' . $value['cantidadTardias'] . '</td>';
                }
                echo '</td>';
                if($value['cantidadEscapes'] !=0 ){
                    echo '<td class="warning text-center">' . $value['cantidadEscapes'] . '</td>';
                }else{
                    echo '<td class="text-center">' . $value['cantidadEscapes'] . '</td>';
                }
                echo '</tr>';
            }
            ?>
        </table>
    </div>
     <?php }else{
     echo '<div class="col-xs-12"><h3>Estudiante no encontrado</h3></div>';
    } ?>
</div>