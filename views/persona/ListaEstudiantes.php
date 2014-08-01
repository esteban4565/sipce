<center>
<h2>Modulo Estudiantes</h2>

<form id="myForm" action="<?php echo URL;?>persona/create" method="POST">
        
        <table class="vistaDetalle" WIDTH="30%">
            <tr>
                <th class="nombreFormulario" colspan="2">BUSCAR ESTUDIANTES</th>
            </tr>
            <tr>
                <td>Identificacion:</td>
                <td>
                    <input type="text" name="tf_cedula" placeholder="Ejemplo: 2-0565-0898" class="validate[required]" onkeyup="mayusculas(this)"/>
                    <input type="submit" value="Buscar"/>
                </td>
            </tr>
        </table>  
        <br/>
        <br/>
<table class="Lista">
    <tr>
        <td colspan="8" class="nombreTabla">LISTA DE ESTUDIANTES</td>
    </tr>
    <tr>
        <th>N°</th>
        <th>IDENTIFICACION</th>
        <th>1.ER APELLIDO</th>
        <th>2.DO APELLIDO</th>
        <th>NOMBRE</th>
        <th>USUARIO</th>
        <th>ROL</th>
        <th>ACCION</th>

    </tr>
    <?php
    $con = 1;
    foreach ($this->ListaEstudiantes as $lista => $value){
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
                echo $value['nomUsuario'];
            echo '</td>';
            echo '<td>';
                echo $value['tipoUsuario'];
            echo '</td>';
            echo '<td>';
                echo '<a href="'.URL.'/persona/edit/'.$value['cedula'].'">Editar</a> | 
                      <a href="'.URL.'/persona/delete/'.$value['cedula'].'">Eliminar</a>';
            echo '</td>';
        echo '</tr>';
        $con++;
    }
    
    //print_r($this->personaList);
?>
    <tr>
        <td colspan='8' class="lineaFin"></td>
    </tr>
    <tr>
        <td colspan='8'>Ultima linea</td>
    </tr>
</table>
</center>