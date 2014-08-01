<center>
<h2>Modulo Docentes - Buscar Docente</h2>
<br/>
<form id="myForm" action="<?php echo URL; ?>persona/resultadoBuscarDocente" method="post">
    <table class="vistaDetalle" WIDTH="auto">
        <tr>
            <th colspan="2">DATO A BUSCAR</th>
        </tr>
        <tr>
            <td><label>Identificación:</label></td>
            <td><input type="text" name="tf_cedula" placeholder="EJE: 2-0565-0898" class="validate[required]"/>
            <input type="submit" value="Buscar" class="buscar"/>
            </td>
        </tr>
    </table>  
    <br/>
    <br/>
</form>
</center>