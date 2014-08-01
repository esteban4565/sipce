<center>
<h2>Modulo Personas</h2>
<div id="boxtable"> 
    <form id="" action="<?php echo URL;?>persona/create" method="POST">
        <table class="vistaDetalle" WIDTH="700">
            <tr>
                <td>
                    <label class="labeltitulo">Identificacion:</label></br>
                    <input type="text" name="tf_cedula" placeholder="Ejemplo: 2-0565-0898" class="validate[required]" onkeyup="mayusculas(this)"/>
                </td>
                <td>
                </td>
                <td>
                </td>
            </tr>
            <tr>
                <td>
                    <label class="labeltitulo">1.er Apellido:</label></br>
                    <input type="text" name="tf_ape1" class="validate[required]" onkeyup="mayusculas(this)"/>
                </td>
                <td>
                    <label class="labeltitulo">2.do Apellido:</label></br>
                    <input type="text" name="tf_ape2" class="validate[required]" onkeyup="mayusculas(this)"/>
                </td>
                <td>
                    <label class="labeltitulo">Nombre completo:</label></br>
                    <input type="text" name="tf_nombre" class="validate[required]" onkeyup="mayusculas(this)"/>
                </td>
            </tr>            
            <tr>
                <td>
                    <label class="labeltitulo">Fecha Nacimiento:</label></br>
                    <input type="text" name="tf_date" class="validate[required]"/>
                </td>
                    
                <td>
                    <label class="labeltitulo">Sexo:</label> </br>
                    <select name="tf_sexo">
                        <option value="F">FEMENINO</option>
                        <option value="M">MASCULINO</option>
                    </select>
                </td>
                <td></td>
            </tr>
            <tr>
                <td>
                    <label class="labeltitulo">Nombre Usuario:</label> </br>
                    <input type="text" name="tf_usuario" class="validate[required]"/>
                </td>
                <td>
                    <label class="labeltitulo">Clave:</label></br>
                    <input type="password" name="tf_clave" class="validate[required]"/> 
                </td>
                <td>
                    <label class="labeltitulo">Rol:</label> </br>
                    <select name="tf_role">
                        <option value="INV">INV</option>
                        <option value="EST">EST</option>
                        <option value="DOC">DOC</option>
                        <option value="ADMIN">ADMIN</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <label class="labeltitulo">Estado:</label> </br>
                    <select name="tf_estado">
                        <option value="A">ACTIVO</option>
                        <option value="I">INACTIVO</option>
                    </select>
                </td>
            </tr>
        </table>   
        <br/>
        <br/>
        <input type="submit" value="Guardar"/>
        <input type="reset" value="Cancelar"/>
    </form>
</div>
<br>
<br>
<hr/>
<br>
<br>
<table class="Lista">
    <tr>
        <td colspan="9" class="nombreTabla">LISTA DE USUARIOS</td>
    </tr>
    <tr>
        <th>CEDULA</th>
        <th>PRIMER APELLIDO</th>
        <th>SEGUNDO APELLIDO</th>
        <th>NOMBRE</th>
        <th>SEXO</th>
        <th>NOMBRE USUARIO</th>
        <th>ROL</th>
        <th>EMAIL</th>
        <th>ACCION</th>

    </tr>
    <?php
    foreach ($this->personaList as $lista => $value){
        echo '<tr>';
            echo '<td>';
                echo $value['cedula'];
            echo '</td>';
            echo '<td>';
                echo $value['ape1'];
            echo '</td>';
            echo '<td>';
                echo $value['ape2'];
            echo '</td>';
            echo '<td>';
                echo $value['nombre'];
            echo '</td>';
            echo '<td>';
                echo $value['sexo'];
            echo '</td>';
            echo '<td>';
                echo $value['username'];
            echo '</td>';
            echo '<td>';
                echo $value['role'];
            echo '</td>';
            echo '<td>';
                echo $value['email'];
            echo '</td>';
            echo '<td>';
                echo '<a href="'.URL.'/persona/edit/'.$value['cedula'].'">Editar</a> | 
                      <a href="'.URL.'/persona/delete/'.$value['cedula'].'">Eliminar</a>';
            echo '</td>';
        echo '</tr>';
    }
    //print_r($this->personaList);
?>
    <tr>
        <td colspan='9' class="lineaFin"></td>
    </tr>
    <tr>
        <td colspan='9'>Ultima linea</td>
    </tr>
</table>
</center>