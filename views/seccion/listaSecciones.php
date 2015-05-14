<center>
<h2>Modulo Secciones</h2>
<?php
//print_r($this->listaEstudiantes);
?>
<table class="table">
    <tr>
        <td colspan="5" class="nombreTabla">Lista Secciones</td>
    </tr>
    <tr>
        <th>N°</th>
        <th>Cedula</th>
        <th>1º Apellido</th>
        <th>2º Apellido</th>
        <th>Nombre</th>
        <th>Fecha Nacimiento</th>
    </tr>
    <?php
    $con = 1;
    foreach ($this->listaSecciones as $lista => $value){
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
                echo $value['fechaNacimiento'];
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