<?php
//print_r($this->listaEstudiantesNoMatricula);
//echo '<br><br><br>Hola';
//die;
?>
<center>
    <table class="table table-condensed">
        <tr>
            <th colspan="7" class="nombreTabla text-center">ESTUDIANTES NO MATRICULADOS - CURSO LECTIVO <?php echo $this->datosSistema[0]['annio_lectivo']; ?></th>
        </tr>
        <tr>
            <th>N°</th>
            <th>Identificación</th>
            <th>1re apellido</th>
            <th>2do apellido</th>
            <th>Nombre</th>
            <th>Nivel</th>
            <th>Condición</th>
            <th>Último Año Matriculado</th>
        </tr>
        <?php
        $con = 1;
        foreach ($this->listaEstudiantesNoMatricula as $lista => $value) {
            echo '<tr>';
            echo '<td>';
            echo $con;
            echo '</td>';
            echo '<td>';
            echo $value['cedula'];
            echo '</td>';
            echo '<td>';
            echo $value['apellido1'];
            echo '</td>';
            echo '<td>';
            echo $value['apellido2'];
            echo '</td>';
            echo '<td>';
            echo $value['nombre'];
            echo '</td>';
            echo '<td>';
            echo $value['nivel'];
            echo '</td>';
            echo '<td>';
            echo $value['condicion'];
            echo '</td>';
            echo '<td>';
            echo $value['anio'];
            echo '</td>';
            echo '</tr>';
            $con++;
        }
        ?>
        <tr>
            <td colspan='7' class="lineaFin"></td>
        </tr>
        <tr>
            <td colspan='7'>Última línea</td>
        </tr>
    </table>
</center>