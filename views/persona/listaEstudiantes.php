<center>
    <h2>Módulo Estudiantes</h2>
    <?php
//print_r($this->listaEstudiantes);
    ?>
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
            <th>Nivel</th>
            <th>Grupo</th>
            <th>SubGrupo</th>
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
</center>