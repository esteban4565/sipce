<?php
//print_r($this->estadoMatricula);
//die;
?>
<center>
    <table class="table table-condensed">
        <tr>
            <th colspan="8" class="nombreTabla text-center">ESTUDIANTES MATRICULADOS</th>
        </tr>
        <tr>
            <th>N°</th>
            <th>Identificación</th>
            <th>1º Apellido</th>
            <th>2º Apellido</th>
            <th>Nombre</th>
            <th>Nivel</th>
            <th>Condicón</th>
            <th>Acción</th>
        </tr>
        <?php
        $con = 1;
        foreach ($this->estadoMatricula as $lista => $value) {
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
            echo '<a class="btn-sm btn-primary" href="ratificarEstudiante/' . $value['cedula'] . '">Editar</a>';
            echo '</td>';
            echo '</tr>';
            $con++;
        }
        ?>
        <tr>
            <td colspan='5' class="lineaFin"></td>
        </tr>
        <tr>
            <td colspan='5'>Ultima linea</td>
        </tr>
    </table>
</center>