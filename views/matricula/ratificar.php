<div class="row">
    <div class="col-lg-12">
        <h2>Modulo Matricula</h2>
    </div>
</div>

<div class="row">
    <div class="col-lg-10">
        <table class="table table-condensed">
            <tr>
                <td colspan="5" class="nombreTabla">LISTA DE ESTUDIANTES</td>
            </tr>
            <tr>
                <th>N°</th>
                <th>Identificación</th>
                <th>1º Apellido</th>
                <th>2º Apellido</th>
                <th>Nombre</th>
                <th>Nivel</th>
                <th>Grupo</th>
                <th>Subgrupo</th>
                <th>Acción</th>
            </tr>
            <?php
            $con = 1;
            foreach ($this->listaEstudiantes as $lista => $value) {
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
                echo $value['grupo'];
                echo '</td>';
                echo '<td>';
                echo $value['sub_grupo'];
                echo '</td>';
                echo '<td>';
                echo '<a class="btn-sm btn-primary" href="ratificarEstudiante/'.$value['cedula'].'">Ratificar</a>';
                echo '</td>';
                echo '</tr>';
                $con++;
            }

            //print_r($this->personaList);
            ?>
            <tr>
                <td colspan='5' class="lineaFin"></td>
            </tr>
            <tr>
                <td colspan='5'>Ultima linea</td>
            </tr>
        </table>
    </div>
</div>