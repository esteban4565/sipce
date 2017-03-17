<div class="row">
    <div class="col-xs-12">
        <h2>Estudiantes extrangeros</h2>
        <table class="table table-condensed">
            <tr>
                <th colspan="8" class="nombreTabla text-center">LISTA DE ESTUDIANTES</th>
            </tr>
            <tr>
                <th>N°</th>
                <th>Identificación</th>
                <th>1<sup>er</sup> apellido</th>
                <th>2<sup>do</sup> apellido</th>
                <th>Nombre</th>
                <th>Genero</th>
                <th>Fecha Nacimiento</th>
                <th>Nacionalidad</th>
                <th>Nivel</th>
            </tr>
            <?php
            $con = 1;
            foreach ($this->estudiantesExtrangeros as $lista => $value) {
                echo '<tr>';
                echo '<td>';
                echo $con;
                echo '</td>';
                echo '<td>';
                echo $value[0];
                echo '</td>';
                echo '<td>';
                echo $value[1];
                echo '</td>';
                echo '<td>';
                echo $value[2];
                echo '</td>';
                echo '<td>';
                echo $value[3];
                echo '</td>';
                echo '<td>';
                echo $value[4];
                echo '</td>';
                echo '<td>';
                echo $value[5];
                echo '</td>';
                echo '<td>';
                echo $value[6];
                echo '</td>';
                echo '<td>';
                echo $value[7];
                echo '</td>';
                echo '</tr>';
                $con++;
            }

            //print_r($this->personaList);
            ?>
            <tr>
                <td colspan='8' class="text-center"></td>
            </tr>
            <tr>
                <td colspan='8'class="text-center">Última línea</td>
            </tr>
        </table>
    </div>
</div>