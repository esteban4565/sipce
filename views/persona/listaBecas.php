<div class="row">
    <div class="col-xs-12">
        <table class="table table-condensed" id="listaBecados">
            <tr>
                <td colspan="14" class="nombreTabla text-center">DATOS DEL ESTUDIANTE</td>
            </tr>
            <tr>
                <th>N°</th>
                <th>Identificación</th>
                <th>1º Apellido</th>
                <th>2º Apellido</th>
                <th>Nombre</th>
                <th>Distancia en km</th>
                <th>Distrito</th>
                <th>Grado Académico</th>
                <th>Especialidad</th>
                <th>Ingreso #1</th>
                <th>Ingreso #2</th>
                <th>Ingreso #3</th>
                <th>Ingreso #4</th>
                <th>Cantidad de ingresos</th>
                <th>Acciones</th>
            </tr>
            <?php
            $con = 1;
            foreach ($this->listaEstudianteBecas as $lista => $value) {
                echo '<tr>';
                echo '<td>';
                echo $con;
                echo '</td>';
                echo '<td>';
                echo $value['ced_estudiante'];
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
                echo $value['distancia'];
                echo '</td>';
                echo '<td>';
                echo $value['Distrito'];
                echo '</td>';
                echo '<td>';
                echo $value['nivel'];
                echo '</td>';
                echo '<td>';
                echo $value['nombreEspecialidad'];
                echo '</td>';
                echo '<td>';
                echo $value['ingreso1'];
                echo '</td>';
                echo '<td>';
                echo $value['ingreso2'];
                echo '</td>';
                echo '<td>';
                echo $value['ingreso3'];
                echo '</td>';
                echo '<td>';
                echo $value['ingreso4'];
                echo '</td>';
                echo '<td>';
                echo $value['totalIngreso'];
                echo '</td>';
                echo '<td>';
                echo '<a class="btn-sm btn-primary" href="editarBeca/' . $value['ced_estudiante'] . '">Editar</a>';
                echo '</td>';
                echo '</tr>';
                $con++;
            }
            ?>
            <tr>
                <td colspan='14' class="text-center"></td>
            </tr>
            <tr>
                <td colspan='14'class="text-center">Última línea</td>
            </tr>
        </table>
    </div>
</div>