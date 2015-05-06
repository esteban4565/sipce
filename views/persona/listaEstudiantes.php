<center>
<h2>Modulo Estudiantes</h2>
<?php
//print_r($this->listaEstudiantes);
?>
<table class="table">
    <tr>
        <td colspan="5" class="nombreTabla">LISTA DE ESTUDIANTES</td>
    </tr>
    <tr>
        <th>N°</th>
        <th>IDENTIFICACION</th>
        <th>1.ER APELLIDO</th>
        <th>2.DO APELLIDO</th>
        <th>NOMBRE</th>
        <th>NIVEL</th>
        <th>GRUPO</th>
        <th>SUBGRUPO</th>
    </tr>
    <?php
    $con = 1;
    foreach ($this->listaEstudiantes as $lista => $value){
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
        <td colspan='5' class="lineaFin"></td>
    </tr>
    <tr>
        <td colspan='5'>Ultima linea</td>
    </tr>
</table>
</center>