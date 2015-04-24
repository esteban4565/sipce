<h1>Estudiantes no encontrados...</h1>
Las siguientes cedulas no existen el BD_Padron de Registro Civil (2013), favor verificar datos... 
<br/><hr />

<table>
    <tr>
        <th># Registro</th>
        <th>Cedula Estudiante</th>
        <th>Nombre Estudiante</th>
        <th>Primer Apellido</th>
        <th>Segundo Apellido</th>
    </tr>
<?php
//Al cargar la pagina de "Horario", lo primero que hace es recorrer el Array "profeLista"
//este fue creado en la funcion "Index" del Controller "Horario", su funcion es recopilar todos
//los docentes que se encuentren el tabla persona de la BD
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



Actualizar Estudiantes...
<br />
<form id="randomInsert" action="<?php echo URL;?>actualizarestudiantes/actuEstu" method="post">
    <input type="submit" />
</form>