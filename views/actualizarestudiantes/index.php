<h1>Estudiantes no encontrados...</h1>
Las siguientes cédulas no existen en la base de datos del padrón de Registro Civil (2016), favor verificar datos... 
<br/><hr />

<table>
    <tr>
        <th># Registro</th>
        <th>Cédula Estudiante</th>
        <th>Nombre Estudiante</th>
        <th>Primer Apellido</th>
        <th>Segundo Apellido</th>
    </tr>
<?php
    $i=1;
    foreach($this->estudiantesCedulaMala as $key => $value) {
        echo '<tr>';
        echo '<td>' . $i . '</td>';
        echo '<td>' . $value['cedula'] . '</td>';
        echo '<td>' . $value['nombre'] . '</td>';
        echo '<td>' . $value['apellido1'] . '</td>';
        echo '<td>' . $value['apellido2'] . '</td>';
        echo '</tr>';
        $i++;
    }
?>
</table>