<center>
<h2>Modulo Usuarios</h2>
<br/>
<form id="myForm" action="<?php echo URL;?>persona/create" method="POST">
        
        <table class="vistaDetalle" WIDTH="80%">
            <tr>
                <th class="nombreFormulario" colspan="6">REGISTRO USUARIOS</th>
            </tr>
            <tr>
                <td>Identificacion:</td>
                <td><input type="text" name="tf_cedula" placeholder="Ejemplo: 2-0565-0898" class="validate[required]" value='<?php echo $this->personaList[0]['cedula']?>'/></td>
                <td>Sexo:</td>
                <td colspan="3">
                    <select name="tf_sexo" id="tf_sexo">
                        <option value="">Seleccione</option>
                        <option value="F" <?php if($this->personaList[0]['sexo']=='0') echo 'selected';?>>Femenino</option>
                        <option value="M" <?php if($this->personaList[0]['sexo']=='1') echo 'selected';?>>Masculino</option>
                    </select>
                </td>
            </tr>
                <td>1.er Apellido:</td>
                <td><input type="text" name="tf_ape1" class="validate[required]" value='<?php echo $this->personaList[0]['apellido1']?>'/></td>
                <td>2.do Apellido:</td>
                <td><input type="text" name="tf_ape2" class="validate[required]" value='<?php echo $this->personaList[0]['apellido2']?>'/></td>
                <td>Nombre completo:</td>
                <td><input type="text" name="tf_nombre" class="validate[required]" value='<?php echo $this->personaList[0]['nombre']?>'/></td>
            <tr>
                <td>F. Nacimiento (año/mes/dia):</td>
                <td><input type="text" value='<?php echo substr($this->personaList[0]['fechaNacimiento'],0,10)?>' class="datepicker validate[required]" name="tf_fnacpersona"/></td>
                <td>Nacionalidad:</td>
                <td>
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
                <td>Estado civil:</td>
                <td>
                    <select name="tf_estadocivil" >
                        <option value="">Seleccione</option>
                    <?php
                    foreach ($this->estadoCivilList as $value){
                    ?>
                      <option value="<?php echo $value['codCivil'];?>" <?php if($value['codCivil'] == $this->personaList[0]['estadoCivil']) echo 'selected';?>><?php echo $value['nombreCivil'];?></option>
                    <?php
                    } 
                    ?>  
                    </select>
                </td>
            </tr>
            <tr>
                <td>Tel. Celular:</td>
                <td><input type="text" value='<?php echo $this->personaList[0]['telefonoCelular']?>' name="tf_telcelular" class="validate[required]"/></td>
                <td>Tel. Casa:</td>
                <td colspan="3"><input type="text" value='<?php echo $this->personaList[0]['telefonoCasa']?>'name="tf_telcasa" class="validate[required]"/></td>
            </tr>
            <tr>
                <td>Domicilio:</td>
                <td colspan="5">
                    <textarea name="tf_domicilio" class="validate[required]">
                     <?php echo $this->personaList[0]['domicilio'];?>   
                    </textarea>
            </tr>
            <tr>
                <td>Provincia:</td>
                <td>
                     <select name="provincias" id="provincias">
                        <option value="">Seleccione</option>
                        <?php
                            foreach ($this->consultaProvincias as $value){
                        ?>
                            <option value="<?php echo $value['IdProvincia'];?>" <?php if($value['IdProvincia'] == $this->personaList[0]['IdProvincia']) echo 'selected';?>><?php echo $value['nombreProvincia'];?></option>
                        <?php
                        } 
                        ?>  
                    </select>
                </td>
                <td>Canton:</td>
                <td>
                    <select name="cantones" id="cantones" rel="27">
                    </select>
                </td>
                <td>Distrito:</td>
                <td colspan="3">
                    <select id="distritos" name="distritos">    
                    </select>
                </td>
            </tr>
            <tr>
                <td>Email:</td>
                <td colspan="5"><input type="text" name="tf_email" class="validate[required]"/></td>
            </tr>
            <tr>
                <td>Nombre Usuario:</td>
                <td><input type="text" name="tf_usuario" class="validate[required]" value='<?php echo $this->personaList[0]['nomUsuario']?>'/></td>
                <td>Clave:</td>
                <td colspan="3"><input type="password" name="tf_clave" class="validate[required]"/></td>
            </tr>
            <tr>
                <td>Rol:</td>
                <td>
                    <select name="tf_role" >
                        <option value="">Seleccione</option>
                    <?php
                    foreach ($this->permisos as $value){
                    ?>
                      <option value="<?php echo $value['idPermiso'];?>" <?php if($value['idPermiso'] == $this->personaList[0]['tipoUsuario']) echo 'selected';?>><?php echo $value['nomPermiso'];?></option>
                    <?php
                    } 
                    ?>  
                    </select>
                </td>
                <td>Estado Actual:</td>
                <td colspan="3">
                    <select name="tf_estadoactual">
                        <option value="">Seleccione</option>
                        <option value="A" <?php if($this->personaList[0]['estadoActual']=='A') echo 'selected';?>>Activo</option>
                        <option value="I" <?php if($this->personaList[0]['estadoActual']=='I') echo 'selected';?>>Inactivo</option>
                    </select></td>
            </tr>
        </table>  
        <br/>
        <br/>
        <input type="submit" value="Guardar"/>
        <input type="reset" value="Cancelar"/>
</form>
<br>
<br>
</center>