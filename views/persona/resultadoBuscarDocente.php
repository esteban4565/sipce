<center>
<h2>Modulo Usuarios - Registro</h2>
<br/>
<form id="MyForm" action="<?php echo URL;?>persona/CrearPersona" method="POST">
        <table class="vistaDetalle" WIDTH="90%">
            <tr>
                <th class="nombreFormulario" colspan="3">DATOS PERSONALES</th>
            </tr>
            <tr>
            </tr>
            <tr>
                <td>
                    <label>Identificación:</label></br>
                    <input type="text" name="tf_cedula" class="validate[required]" placeholder="Ejemplo: 2-0565-0898" value='<?php echo $this->personaNueva[0]['cedula']?>' onkeyup="mayusculas(this)"/>
                </td>
                <td>
                    <label>Sexo:</label></br>
                    <select name="tf_sexo" id="tf_sexo">
                        <option value="">Seleccione</option>
                        <option value="0" <?php if($this->personaNueva[0]['sexo']=='0') echo 'selected';?>>Femenino</option>
                        <option value="1" <?php if($this->personaNueva[0]['sexo']=='1') echo 'selected';?>>Masculino</option>
                    </select>
                </td>
                <td>
                </td>
            </tr>
            <tr>
                <td>
                    <label>1.er Apellido:</label></br>
                    <input type="text" name="tf_ape1" class="validate[required]" value='<?php echo $this->personaNueva[0]['primerApellido']?>' onkeyup="mayusculas(this)"/></td>
                <td>
                    <label>2.do Apellido:</label></br>
                    <input type="text" name="tf_ape2" class="validate[required]" value='<?php echo $this->personaNueva[0]['segundoApellido']?>' onkeyup="mayusculas(this)"/></td>
                <td>
                    <label>Nombre completo:</label></br>
                    <input type="text" name="tf_nombre" class="validate[required]" value='<?php echo $this->personaNueva[0]['nombre']?>' onkeyup="mayusculas(this)"/></td>
            </tr>
            <tr>
                <td>
                    <label>F. Nacimiento (Año-Mes-Día):</label></br>
                    <input type="text" name="tf_fnacpersona" class="validate[custom[date]]" value='<?php echo date(substr($this->personaNueva[0]['fechaNacimiento'],0,10));?>'/></td>
                <td>
                    <label>Nacionalidad:</label></br>
                    <select name="tf_nacionalidad" class="validate[required]">
                        <option value="">Seleccione</option>
                    <?php
                    foreach ($this->paisesList as $value){
                    ?>
                      <option value="<?php echo $value['codigoPais'];?>"<?php if($value['codigoPais'] == '506') echo 'selected';?>><?php echo $value['nombrePais'];?></option>
                    <?php
                    }
                    ?>
                    </select>
                    </td>
                <td>
                    <label>Estado civil:</label></br>
                    <select name="tf_estadocivil" class="validate[required]">
                        <option value="">Seleccione</option>
                    <?php
                    foreach ($this->estadoCivilList as $value){
                    ?>
                      <option value="<?php echo $value['codCivil'];?>"><?php echo $value['nombreCivil'];?></option>
                    <?php
                    } 
                    ?>  
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Tel. Celular:</label></br>
                    <input type="text" name="tf_telcelular"/></td>
                <td colspan="2">
                    <label>Tel. Casa:</label></br>
                    <input type="text" name="tf_telcasa"/></td>
            </tr>
            <tr>
                <td>
                    <label>Domicilio:</label></br>
                    <textarea name="tf_domicilio" class="validate[required]" onkeyup="mayusculas(this)"/>Dirección exacta!!!</textarea>
                </td>
                <td colspan="2">
                    <label>Cargar Foto...</label>
                    <input name="imagen" id="imagen" type="file"/>
                    </br>
                    </br>
                    <img id="imgSalida" width="150px" height="140px" src="<?php echo URL; ?>public/images/people.png"/>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Provincia:</label></br>
                     <select name="provincias" id="provincias" class="validate[required]">
                        <option value="">Seleccione</option>
                        <?php
                            foreach ($this->consultaProvincias as $value){
                        ?>
                            <option value="<?php echo $value['IdProvincia'];?>"><?php echo $value['nombreProvincia'];?></option>
                        <?php
                        } 
                        ?>  
                    </select>
                </td>
                <td>
                    <label>Canton:</label></br>
                    <select name="cantones" id="cantones" class="validate[required]">
                    </select>
                </td>
                <td>
                    <label>Distrito:</label></br>
                    <select id="distritos" name="distritos" class="validate[required]">    
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <label>Email:</label></br>
                    <input type="text" name="tf_email" class="validate[custom[email]]"/></td>
            </tr>
            <tr>
                <td>
                    <label>Rol:</label></br>
                    <select name="tf_role" class="validate[required]">
                        <option value="">Seleccione</option>
                    <?php
                    foreach ($this->permisos as $value){
                    ?>
                      <option value="<?php echo $value['idPermiso'];?>"><?php echo $value['nomPermiso'];?></option>
                    <?php
                    } 
                    ?>  
                    </select>
                </td>
                <td>
                    <label>Clave de acceso:</label></br>
                    <input type="password" name="tf_clave" class="validate[required]"/></td>
                <td>
                    <label>Estado Actual:</label></br>
                    <select name="tf_estadoactual" class="validate[required]">
                        <option value="">Seleccione</option>
                        <option value="A">Activo</option>
                        <option value="I">Inactivo</option>
                    </select>
                </td>
            </tr>
        </table>
            </br>
            <br/>
            <input type="submit" value="Guardar" class="save"/>
            <input type="submit" value="Actualizar" class="update"/>
            <input type="submit" value="Eliminar" class="delete"/>
            
            <a href="<?php echo URL;?>/dashboard/index"><input type="button" name="boton" value="Inicio" class="inicio"/></a> 
</form>
<br>
<br>
</center>