<h3>Modulo Usuarios - Registro</h3>
<hr>
<div class="row">
    <form id="MyForm" action="saveDocenteEstudiante" method="POST" enctype="multipart/form-data" class="form-horizontal">
        <fieldset>
            <legend>Datos Personales</legend>
            <!--linea1-->
            <div class="form-group"> 
                <label for="imagen" class="col-lg-2 control-label">Foto perfil:</label>
                <div class="col-lg-2">
                    <input type="file" name="imagen" id="imagen"/>
                    </br>
                    <img id="imgSalida" width="130px" height="130px" src="<?php echo URL; ?>public/img/people.png" class="img-rounded"/>
                </div>
                <div class="col-lg-8"></div>
            </div> 
            <!--linea2-->
            <div class="form-group"> 
                <label for="tf_cedula" class="col-lg-2 control-label">Cédula:</label>
                <div class="col-lg-2">
                    <input type="text" class="form-control input-sm" name="tf_cedula" id="tf_cedula" value='<?php echo $this->personaNueva[0]['cedula'] ?>' onkeyup="mayusculas(this)" placeholder="Eje:"/>
                </div>
                <label for="tf_nacionalidad" class="col-lg-2 control-label">Nacionalidad:</label>
                <div class="col-lg-2">
                    <select class="form-control input-sm" name="tf_nacionalidad" id="tf_nacionalidad">
                        <option value="">Seleccione</option>
                        <?php
                        foreach ($this->paisesList as $value) {
                            ?>
                            <option value="<?php echo $value['codigoPais']; ?>"<?php if ($value['codigoPais'] == '506') echo 'selected'; ?>><?php echo $value['nombrePais']; ?></option>
                            <?php
                        }
                        ?>
                    </select> 
                </div>
                <div class="col-lg-4"></div>
            </div> 
            <!--linea3-->
            <div class="form-group">
                <label for="tf_ape1" class="col-lg-2 control-label">1.er Apellido:</label>
                <div class="col-lg-2">
                    <input type="text" class="form-control input-sm"  id="tf_ape1" name="tf_ape1" value='<?php echo $this->personaNueva[0]['primerApellido'] ?>' onkeyup="mayusculas(this)"/>
                </div>
                <label for="tf_ape2" class="col-lg-2 control-label">2.do Apellido:</label>
                <div class="col-lg-2">
                    <input type="text" class="form-control input-sm"  id="tf_ape2" name="tf_ape2" value='<?php echo $this->personaNueva[0]['segundoApellido'] ?>' onkeyup="mayusculas(this)"/>
                </div>
                <label for="tf_nombre" class="col-lg-2 control-label">Nombre completo:</label>
                <div class="col-lg-2">
                    <input type="text" class="form-control input-sm"  id="tf_nombre" name="tf_nombre" value='<?php echo $this->personaNueva[0]['nombre'] ?>' onkeyup="mayusculas(this)"/>
                </div> 
            </div> 
            <!--linea4-->
            <div class="form-group">
                <label class="col-lg-2 control-label">Género:</label>
                <div class="col-lg-2">
                    <div class="radio">
                        <label>
                            <input type="radio" name="tf_sexo" id="tf_sexo1" value="0" <?php if ($this->personaNueva[0]['sexo'] == '0') echo 'checked'; ?>>
                            Femenino
                        </label>
                        <label>
                            <input type="radio" name="tf_sexo" id="tf_sexo2" value="1" <?php if ($this->personaNueva[0]['sexo'] == '1') echo 'checked'; ?> >
                            Masculino
                        </label>
                    </div>
                </div>
                <label for="tf_fnacpersona" class="col-lg-2 control-label">F. Nacimiento (Año-Mes-Día):</label>
                <div class="col-lg-2">
                    <input type="text" class="form-control input-sm"  id="tf_fnacpersona" name="tf_fnacpersona" value='<?php echo date(substr($this->personaNueva[0]['fechaNacimiento'], 0, 10)); ?>' onkeyup="mayusculas(this)"/>
                </div>
                <label for="tf_estadocivil" class="col-lg-2 control-label">Estado civil:</label>
                <div class="col-lg-2">
                    <select class="form-control input-sm" name="tf_estadocivil">
                        <option value="">Seleccione</option>
                        <?php
                        foreach ($this->estadoCivilList as $value) {
                            ?>
                            <option value="<?php echo $value['codCivil']; ?>"><?php echo $value['nombreCivil']; ?></option>
                            <?php
                        }
                        ?>  
                    </select> 
                </div> 
            </div>
            <!--linea5-->
            <div class="form-group">
                <label for="tf_telcelular" class="col-lg-2 control-label">Tel. Celular:</label>
                <div class="col-lg-2">
                    <input type="text" class="form-control input-sm" name="tf_telcelular" id="tf_telcelular">
                </div>
                <label for="tf_telcasa" class="col-lg-2 control-label">Tel. Casa:</label>
                <div class="col-lg-2">
                    <input type="text" class="form-control input-sm" name="tf_telcasa" id="tf_telcasa">
                </div>
                <label for="tf_email" class="col-lg-2 control-label">Email:</label>
                <div class="col-lg-2">
                    <input class="form-control input-sm" type="text" name="tf_email" id="tf_email">
                </div>
            </div>
            <!--linea6-->
            <div class="form-group">
                <label for="tf_domicilio" class="col-lg-2 control-label">Domicilio:</label>
                <div class="col-lg-6">
                    <textarea class="form-control" rows="1" name="tf_domicilio" id="tf_domicilio"></textarea>
                </div>
                <div class="col-lg-4"></div>
            </div>
            <!--linea7-->
            <div class="form-group">
                <label for="tf_provincias" class="col-lg-2 control-label">Provincia:</label>
                <div class="col-lg-2">
                    <select class="form-control input-sm" name="tf_provincias" id="tf_provincias">
                        <option value="">Seleccione</option>
                        <?php
                        foreach ($this->consultaProvincias as $value) {
                            ?>
                            <option value="<?php echo $value['IdProvincia']; ?>"><?php echo $value['nombreProvincia']; ?></option>
                            <?php
                        }
                        ?>  
                    </select>
                </div>
                <label for="tf_cantones" class="col-lg-2 control-label">Canton:</label>
                <div class="col-lg-2">
                    <select class="form-control input-sm" name="tf_cantones" id="tf_cantones">
                    </select>
                </div>
                <label for="tf_distritos" class="col-lg-2 control-label">Distrito:</label>
                <div class="col-lg-2">
                    <select  class="form-control input-sm" name="tf_distritos" id="tf_distritos">    
                    </select>
                </div>
            </div>
            <!--linea8-->
            <div class="form-group">
                <label for="tf_role" class="col-lg-2 control-label">Rol:</label>
                <div class="col-lg-2">
                    <select class="form-control input-sm" name="tf_role" id="tf_role">
                        <option value="">Seleccione</option>
                        <?php
                        foreach ($this->permisos as $value) {
                            ?>
                            <option value="<?php echo $value['idPermiso']; ?>"><?php echo $value['nomPermiso']; ?></option>
                            <?php
                        }
                        ?>  
                    </select>
                </div>
                <label for="tf_email" class="col-lg-2 control-label">Estado Actual:</label>
                <div class="col-lg-2">
                    <select class="form-control input-sm" name="tf_estadoactual" id="tf_estadoactual">
                        <option value="">Seleccione</option>
                        <option value="A">Activo</option>
                        <option value="I">Inactivo</option>
                    </select>
                </div>
                <div class="col-lg-4"></div>
            </div>
            <!--linea9-->
            <div class="form-group">
                <div class="col-lg-4"></div>
                <div class="col-lg-4">
                    <button class="btn btn-default">Cancelar</button>
                    <button type="submit" class="btn btn-success">Guardar Registro</button>
                </div>
                <div class="col-lg-4"></div>
            </div>
        </fieldset>
    </form>
    <!--<a href="<?php echo URL; ?>/dashboard/index"><input type="button" name="boton" value="Inicio" class="inicio"/></a> -->
</div>