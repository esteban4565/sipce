<center>
<h2>Modulo Estudiantes - Buscar Estudiante</h2>
<br/>
<form id="myForm" action="<?php echo URL; ?>persona/resultadoBuscarEstudiante" method="post">
    <table class="vistaDetalle" WIDTH="40%">
        <tr>
            <th colspan="2">DATO A BUSCAR</th>
        </tr>
        <tr>
            <td>Identificacion:</td>
            <td><input type="text" name="tf_cedula" placeholder="EJE: 2-0565-0898" class="validate[required]"/>
            <input type="submit" value="Buscar"/>
            </td>
        </tr>
    </table>  
    <br/>
    <br/>
</form>
</center>