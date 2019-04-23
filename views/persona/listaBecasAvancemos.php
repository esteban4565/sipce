<div class="row">
    <div class="col-xs-12">
        <table class="table table-condensed" id="listaBecados">
            <tr>
                <td colspan="28" class="nombreTabla text-center">DATOS DEL ESTUDIANTE</td>
            </tr>
            <tr>
                <th>N°</th>
                <th>Id consecutivo</th>
                <th>Identificación</th>
                <th>1º Apellido</th>
                <th>2º Apellido</th>
                <th>Nombre</th>
                <th>Nivel</th>
                <th>Telefono Estudiante</th>
                <th>Ingreso1</th>
                <th>Ingreso2</th>
                <th>Ingreso3</th>
                <th>Ingreso4</th>
                <th>Cantidad de miembros</th>
                <th>Per cápita</th>
                <th>Identificación Encargado</th>
                <th>Nombre Encargado</th>
                <th>Tel. Cel Encargado</th>
                <th>Tel. Hab Encargado</th>
                <th>Provincia</th>
                <th>Canton</th>
                <th>Distrito</th>
                <th>Dirección</th>
                <th colspan="2" class="text-center">Acciones</th>
            </tr>
            <?php
            $con = 1;
            foreach ($this->listaEstudianteBecas as $lista => $value) {
                echo '<tr>';
                echo '<td>';
                echo $con;
                echo '</td>';
                echo '<td>';
                echo $value['id_consecutivo'];
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
                echo $value['nivel'];
                echo '</td>';
                echo '<td>';
                echo $value['telefonoEstudiante'];
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
                echo $value['totalMiembros'];
                echo '</td>';
                echo '<td>';
                echo $value['perCapita'];
                echo '</td>';
                echo '<td>';
                echo $value['ced_encargadoCheque'];
                echo '</td>';
                echo '<td>';
                echo $value['nombre_encargado'] . ' ' . $value['apellido1_encargado'] . ' ' . $value['apellido2_encargado'];
                echo '</td>';
                echo '<td>';
                echo $value['telefonoCelularEncargado'];
                echo '</td>';
                echo '<td>';
                echo $value['telefonoCasaEncargado'];
                echo '</td>';
                echo '<td>';
                echo $value['nombreProvincia'];
                echo '</td>';
                echo '<td>';
                echo $value['nombreCanton'];
                echo '</td>';
                echo '<td>';
                echo $value['nombreDistrito'];
                echo '</td>';
                echo '<td>';
                echo $value['direccion'];
                echo '</td>';
                echo '<td>';
                echo '<a class="btn-sm btn-warning" href="editarBecaComedor/' . $value['ced_estudiante'] . '">Editar</a>';
                echo '</td>';
                echo '<td>';
                if (Session::get('tipoUsuario') <= 2) {
                    ?>
                    <a class="btn-sm btn-primary" href="<?php echo 'eliminarBecaComedor/' . $value['ced_estudiante']; ?>" onclick="return confirm('¿Está seguro que desea eliminar este registro?');">Eliminar</a>
                    <?php
                }
                echo '</td>';
                echo '</tr>';
                $con++;
            }
            ?>
            <tr>
                <td colspan='28' class="text-center"></td>
            </tr>
            <tr>
                <td colspan='28'class="text-center">Última línea</td>
            </tr>
        </table>
    </div>
</div>