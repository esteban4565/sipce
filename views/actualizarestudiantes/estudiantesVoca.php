<div class="row">
    <div class="col-xs-12">
        <h1>Estudiantes regulares del C.t.p de Carrizal</h1>
        <p>Los siguientes estudiantes del C.t.p Carrizal estan pre-seleccionadas en el Vocacional de Alajuela, favor verificar datos...</p>
    </div>
</div>

<div class="row">
    <div class="col-md-8 col-xs-12">
    <table class="table table-condensed">
        <tr>
            <th># Registro</th>
            <th>Cédula Estudiante</th>
            <th>Primer Apellido</th>
            <th>Segundo Apellido</th>
            <th>Nombre Estudiante</th>
            <th>Especialidad Voca Alajuela</th>
        </tr>
    <?php
    //Al cargar la pagina de "Horario", lo primero que hace es recorrer el Array "profeLista"
    //este fue creado en la funcion "Index" del Controller "Horario", su funcion es recopilar todos
    //los docentes que se encuentren el tabla persona de la BD
        $i=1;
        foreach($this->estudiantesCedulaVoca as $key => $value) {
            echo '<tr>';
            echo '<td>' . $i . '</td>';
            echo '<td>' . $value['cedula'] . '</td>';
            echo '<td>' . $value['apellido1'] . '</td>';
            echo '<td>' . $value['apellido2'] . '</td>';
            echo '<td>' . $value['nombre'] . '</td>';
            echo '<td>' . $value['especialidad'] . '</td>';
            echo '</tr>';
            $i++;
        }
    ?>
    </table>
    </div>
</div>

<br>

<div class="row">
    <div class="col-xs-12">
        <h1>Estudiantes Nuevos que solicitaron Especialidad en Carrizal</h1>
        <p>Los siguientes estudiantes son de otros colegios, los cuales solicitaron 
            una especialidad en eldel C.t.p Carrizal, los cuales estan pre-seleccionadas
            en el Vocacional de Alajuela, favor verificar datos...</p>
    </div>
</div>

<div class="row">
    <div class="col-md-11 col-xs-12">
    <table class="table table-condensed">
        <tr>
            <th># Registro</th>
            <th>Cédula Estudiante</th>
            <th>Primer Apellido</th>
            <th>Segundo Apellido</th>
            <th>Nombre Estudiante</th>
            <th>Especialidad Carrizal</th>
            <th>Especialidad Voca</th>
        </tr>
    <?php
    //Al cargar la pagina de "Horario", lo primero que hace es recorrer el Array "profeLista"
    //este fue creado en la funcion "Index" del Controller "Horario", su funcion es recopilar todos
    //los docentes que se encuentren el tabla persona de la BD
        $i=1;
        foreach($this->estudiantesNuevosSolicitudEspecialidad as $key => $value) {
            echo '<tr>';
            echo '<td>' . $i . '</td>';
            echo '<td>' . $value['ced_estudiante'] . '</td>';
            echo '<td>' . $value['primerApellido'] . '</td>';
            echo '<td>' . $value['segundoApellido'] . '</td>';
            echo '<td>' . $value['nombre'] . '</td>';
            echo '<td>' . $value['Espe_Carrizal'] . '</td>';
            echo '<td>' . $value['Espe_Voca'] . '</td>';
            echo '</tr>';
            $i++;
        }
    ?>
    </table>
    </div>
</div>