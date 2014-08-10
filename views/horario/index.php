<h1>Horario</h1>
Dale clic al boton "Editar" para modificar/crear el Horario del profesor
<br/><hr />

<table>
<?php
//Al cargar la pagina de "Horario", lo primero que hace es recorrer el Array "profeLista"
//este fue creado en la funcion "Index" del Controller "Horario", su funcion es recopilar todos
//los docentes que se encuentren el tabla persona de la BD
    foreach($this->profeLista as $key => $value) {
        echo '<tr>';
        echo '<td>' . $value['cedula'] . '</td>';
        echo '<td>' . $value['nombre'] . '</td>';
        echo '<td>' . $value['apellido1'] . '</td>';
        echo '<td>' . $value['apellido2'] . '</td>';
        //Al final de cada fila se crean dos referencias hacia el Controller/funcion/(cedula profesor)
        //Se podria decir que si le doy clic estaria mandando por parametro la cedula del profesor hacia
        //el metodo del objeto "Horario". En el caso de "edit" estaria ejecutando todo el procedimiento
        //que se encuentra en la funcion "public function edit($cedula)" del Controller, que a su vez llama
        //a las funciones "public function profeSingleList($cedula)", "public function asignaturasDocente($cedula)" y
        //"public function gruposLista()" del Model_Horario
        echo '<td><a href="'. URL . 'horario/edit/' . $value['cedula'].'">Editar</a></td>';
        echo '<td><a class="" href="'. URL . 'horario/delete/' . $value['cedula'].'">Eliminar</a></td>';
        echo '</tr>';
    }
?>
</table>

<script>
$(function() {
    
    $('.delete').click(function(e) {
        var c = confirm("¿Esta seguro que desea eliminar el Horario?");
        if (c == false) return false;
        
    });
    
});
</script>