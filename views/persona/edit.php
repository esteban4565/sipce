<center>
<h2>Editar Persona</h2>
<div id="boxtable"> 
    <form id="" action="<?php echo URL;?>persona/editSave/<?php echo $this->persona['cedula'];?>" method="POST">
        <table class="vistaDetalle" WIDTH="650">
            <tr>
                <td>
                    <label class="labeltitulo">Identificacion:</label></br>
                    <input type="text" name="tf_cedula" value="<?php echo $this->persona['cedula'];?>" class="validate[required]" onkeyup="mayusculas(this)"/>
                </td>
                <td>
                </td>
                <td>
                </td>
            </tr>
            <tr>
                <td>
                    <label class="labeltitulo">1.er Apellido:</label></br>
                    <input type="text" name="tf_ape1" value="<?php echo $this->persona['ape1'];?>" class="validate[required]" onkeyup="mayusculas(this)"/>
                </td>
                <td>
                    <label class="labeltitulo">2.dor Apellido:</label></br>
                    <input type="text" name="tf_ape2" value="<?php echo $this->persona['ape2'];?>" class="validate[required]" onkeyup="mayusculas(this)"/>
                </td>
                <td>
                    <label class="labeltitulo">Nombre completo:</label></br>
                    <input type="text" name="tf_nombre" value="<?php echo $this->persona['nombre'];?>" class="validate[required]" onkeyup="mayusculas(this)"/>
                </td>
            </tr>            
            <tr>
                <td colspa="3">
                    <label class="labeltitulo">Sexo:</label> </br>
                    <select name="tf_sexo">
                        <option value="F"<?php if($this->persona['sexo']== 'F') echo 'selected';?>>FEMENINO</option>
                        <option value="M"<?php if($this->persona['sexo']== 'M') echo 'selected';?>>MASCULINO</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <label class="labeltitulo">Nombre Usuario:</label> </br>
                    <input type="text" name="tf_usuario" value="<?php echo $this->persona['username'];?>" class="validate[required]"/>
                </td>
                <td>
                    <label class="labeltitulo">Clave:</label></br>
                    <input type="text" name="tf_clave" value="" class="validate[required]"/> 
                </td>
                <td>
                    <label class="labeltitulo">Rol:</label> </br>
                    <select name="tf_role">
                        <option value="default"<?php if($this->persona['role']== 'default') echo 'selected';?>>DEFAULT</option>
                        <option value="admin"<?php if($this->persona['role']== 'admin') echo 'selected';?>>ADMIN</option>
                        <option value="owner"<?php if($this->persona['role']== 'owner') echo 'selected';?>>OWNER</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <label class="labeltitulo">Correo electronico:</label> </br>
                    <input type="text" name="tf_email" value="<?php echo $this->persona['email'];?>" class="validate[required]"/>
                </td>
            </tr>
        </table>   
        <br/>
        <br/>
        <input type="submit" value="Actualizar"/>
    </form>
</div>
</center>