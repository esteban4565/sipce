<?php
//print_r($this->infoEstudiante);
//die;
?>
<div class="row">
    <form id="formRatificacion" action="<?php echo URL; ?>matricula/guardarRatificacion" method="POST" enctype="multipart/form-data" class="form-horizontal">
        <fieldset>
            <legend class="text-center">DATOS DEL ESTUDIANTE</legend>
            <!--L1 Cedula y Genero (Formulario Hugo)-->
            <div class="form-group"> 
                <label for="tf_cedulaEstudiante" class="col-lg-2 control-label">Identificación:</label>
                <div class="col-lg-2">
                    <input type="text" class="form-control input-sm" name="tf_cedulaEstudiante" id="tf_cedulaEstudiante" value='<?php echo $this->infoEstudiante[0]['cedula']; ?>'/>
                </div>
                <label for="tf_genero" class="col-lg-2 control-label">Genero:</label>
                <div class="col-lg-2">
                    <select class="form-control input-sm" name="tf_genero" id="tf_genero">
                        <option value="">Seleccione</option>
                        <?php
                        if ($this->infoEstudiante[0]['sexo'] == 0) {
                            ?>
                            <option value="0" selected>Femenino</option>
                            <option value="1" >Masculino</option>
                            <?php
                        } else {
                            ?>
                            <option value="1" selected>Masculino</option>
                            <option value="0" >Femenino</option>
                            <?php
                        }
                        ?>
                    </select> 
                </div>
            </div> 
            <!--L2 Nombre Estudiante (Formulario Hugo)-->
            <div class="form-group">
                <label for="tf_ape1" class="col-lg-2 control-label">1er Apellido:</label>
                <div class="col-lg-2">
                    <input type="text" class="form-control input-sm"  id="tf_ape1" name="tf_ape1" value='<?php echo $this->infoEstudiante[0]['apellido1']; ?>' onkeyup="mayusculas(this)"/>
                </div>
                <label for="tf_ape2" class="col-lg-2 control-label">2do Apellido:</label>
                <div class="col-lg-2">
                    <input type="text" class="form-control input-sm"  id="tf_ape2" name="tf_ape2" value='<?php echo $this->infoEstudiante[0]['apellido2']; ?>' onkeyup="mayusculas(this)"/>
                </div>
                <label for="tf_nombre" class="col-lg-2 control-label">Nombre completo:</label>
                <div class="col-lg-2">
                    <input type="text" class="form-control input-sm"  id="tf_nombre" name="tf_nombre" value='<?php echo $this->infoEstudiante[0]['nombre']; ?>' onkeyup="mayusculas(this)"/>
                </div> 
            </div> 
            <!--L3 Fecha Nacimiento (Formulario Hugo)-->
            <div class="form-group">
                <label for="tf_fnacpersona" class="col-lg-2 control-label">Fecha de Nacimiento (Año-Mes-Día):</label>
                <div class="col-lg-2">
                    <input type="text" class="form-control input-sm"  id="tf_fnacpersona" name="tf_fnacpersona" value='<?php if ($this->infoEstudiante != null) echo $this->infoEstudiante[0]['fechaNacimiento']; ?>'/>
                </div>
                <label for="tf_edad" class="col-lg-2 control-label">Edad:</label>
                <div class="col-lg-2">
                    <input type="text" class="form-control input-sm"  id="tf_edad" name="tf_edad" value='<?php echo 2015 - (date(substr($this->infoEstudiante[0]['fechaNacimiento'], 0, 4))); ?>' onkeyup="mayusculas(this)"/>
                </div>
            </div>
            <!--L4 Telefono y email (Formulario Hugo)-->
            <div class="form-group">
                <label for="tf_telcelular" class="col-lg-2 control-label">Tel. Celular:</label>
                <div class="col-lg-2">
                    <input type="text" class="form-control input-sm" name="tf_telcelular" id="tf_telcelular" value='<?php echo $this->infoEstudiante[0]['telefonoCelular']; ?>'>
                </div>
                <label for="tf_email" class="col-lg-2 control-label">Email:</label>
                <div class="col-lg-2">
                    <input class="form-control input-sm" type="text" name="tf_email" id="tf_email" value='<?php echo $this->infoEstudiante[0]['email']; ?>'>
                </div>
            </div>
            <!--L5 Domicilio (Formulario Hugo)-->
            <div class="form-group">
                <label for="tf_domicilio" class="col-lg-2 control-label">Domicilio:</label>
                <div class="col-lg-10">
                    <textarea class="form-control" rows="1" name="tf_domicilio" id="tf_domicilio"><?php echo $this->infoEstudiante[0]['domicilio']; ?></textarea>
                </div>
                <div class="col-lg-4"></div>
            </div>
            <!--L6 Provincia, Canton, Distrito (Formulario Hugo)-->
            <div class="form-group">
                <label for="tf_provincias" class="col-lg-2 control-label">Provincia:</label>
                <div class="col-lg-2">
                    <select class="form-control input-sm" name="tf_provincias" id="tf_provincias">
                        <option value="">Seleccione</option>
                        <?php
                        foreach ($this->consultaProvincias as $value) {
                            ?>
                            <option value="<?php echo $value['IdProvincia']; ?>"<?php if ($value['IdProvincia'] == $this->infoEstudiante[0]['IdProvincia']) echo ' selected'; ?>><?php echo $value['nombreProvincia']; ?></option>
                            <?php
                        }
                        ?>  
                    </select>
                </div>
                <label for="tf_cantones" class="col-lg-2 control-label">Canton:</label>
                <div class="col-lg-2">
                    <select class="form-control input-sm" name="tf_cantones" id="tf_cantones">
                        <option value="">Seleccione</option>
                        <?php
                        foreach ($this->consultaCantones as $value) {
                            ?>
                            <option value="<?php echo $value['IdCanton']; ?>"<?php if ($value['IdCanton'] == $this->infoEstudiante[0]['IdCanton']) echo ' selected'; ?>><?php echo $value['Canton']; ?></option>
                            <?php
                        }
                        ?>  
                    </select>
                </div>
                <label for="tf_distritos" class="col-lg-2 control-label">Distrito:</label>
                <div class="col-lg-2">
                    <select  class="form-control input-sm" name="tf_distritos" id="tf_distritos">  
                        <option value="">Seleccione</option>
                        <?php
                        foreach ($this->consultaDistritos as $value) {
                            ?>
                            <option value="<?php echo $value['IdDistrito']; ?>"<?php if ($value['IdDistrito'] == $this->infoEstudiante[0]['IdDistrito']) echo ' selected'; ?>><?php echo $value['Distrito']; ?></option>
                            <?php
                        }
                        ?>    
                    </select>
                </div>
            </div>
            <!--L7 Primaria y Colegio (Formulario Hugo)-->
            <div class="form-group">
                <label for="tf_primaria" class="col-lg-2 control-label">Primaria:</label>
                <div class="col-lg-2">
                    <input type="text" class="form-control input-sm" name="tf_primaria" id="tf_primaria" value='<?php echo $this->infoEstudiante[0]['escuela_procedencia']; ?>'>
                </div>
            </div>
            <!--L8 Enfermedad (Formulario Hugo)-->
            <div class="form-group">
                <label for="tf_enfermedad" class="col-lg-2 control-label">¿Poseé alguna enfermedad?</label>
                <div class="col-lg-2">
                    <select  class="form-control input-sm" name="sel_enfermedad" id="sel_enfermedad"> 
                        <?php if ($this->enfermedadEstudiante == null) { ?>
                            <option value="0" selected>No</option> 
                            <option value="1">Si</option>
                        <?php } else { ?>
                            <option value="0">No</option> 
                            <option value="1" selected>Si</option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-lg-2">

                    <?php
                    if ($this->enfermedadEstudiante != null) {
                        echo '<input type="text" class="form-control input-sm" name="tf_enfermedadDescripcion" id="tf_enfermedadDescripcion" value="' . $this->enfermedadEstudiante[0]['descripcion'] . '"/>';
                    } else {
                        echo '<input type="text" class="form-control input-sm" name="tf_enfermedadDescripcion" id="tf_enfermedadDescripcion" value="No presenta" />';
                    }
                    ?>
                </div>
            </div>
            <br><br>
            <legend class="text-center">DATOS DEL HOGAR</legend>
            <h4>Encargado Legal</h4>
            <!--L9 Cedula y parentesco* del encargado legal (Formulario Hugo)-->
            <div class="form-group"> 
                <label for="tf_cedulaEncargado" class="col-lg-2 control-label">Identificación:</label>
                <div class="col-lg-2">
                    <input type="text" class="form-control input-sm " name="tf_cedulaEncargado" id="tf_cedulaEncargado" value='<?php if ($this->encargadoLegal != null) echo $this->encargadoLegal[0]['ced_encargado']; ?>'/>
                </div>
                <div class="col-lg-2">
                    <input type="button" class="btn-sm btn-success" id="buscarEncargado" value="Buscar" />
                </div>
            </div> 
            <!--L10 Nombre del encargado legal (Formulario Hugo)-->
            <div class="form-group">
                <label for="tf_ape1Encargado" class="col-lg-2 control-label">1er Apellido:</label>
                <div class="col-lg-2">
                    <input type="text" class="form-control input-sm"  id="tf_ape1Encargado" name="tf_ape1Encargado" value='<?php if ($this->encargadoLegal != null) echo $this->encargadoLegal[0]['apellido1_encargado']; ?>' onkeyup="mayusculas(this)"/>
                </div>
                <label for="tf_ape2Encargado" class="col-lg-2 control-label">2do Apellido:</label>
                <div class="col-lg-2">
                    <input type="text" class="form-control input-sm"  id="tf_ape2Encargado" name="tf_ape2Encargado" value='<?php if ($this->encargadoLegal != null) echo $this->encargadoLegal[0]['apellido2_encargado']; ?>' onkeyup="mayusculas(this)"/>
                </div>
                <label for="tf_nombreEncargado" class="col-lg-2 control-label">Nombre completo:</label>
                <div class="col-lg-2">
                    <input type="text" class="form-control input-sm"  id="tf_nombreEncargado" name="tf_nombreEncargado" value='<?php if ($this->encargadoLegal != null) echo $this->encargadoLegal[0]['nombre_encargado']; ?>' onkeyup="mayusculas(this)"/>
                </div> 
            </div> 
            <!--L11 Telefono Habitacion y celular (Formulario Hugo)-->
            <div class="form-group">
                <label for="tf_telHabitEncargado" class="col-lg-2 control-label">Tel. Habitación:</label>
                <div class="col-lg-2">
                    <input type="text" class="form-control input-sm" name="tf_telHabitEncargado" id="tf_telHabitEncargado" value='<?php if ($this->encargadoLegal != null) echo $this->encargadoLegal[0]['telefonoCasaEncargado']; ?>'/>
                </div>
                <label for="tf_telcelularEncargado" class="col-lg-2 control-label">Tel. Celular:</label>
                <div class="col-lg-2">
                    <input type="text" class="form-control input-sm" name="tf_telcelularEncargado" id="tf_telcelularEncargado" value='<?php if ($this->encargadoLegal != null) echo $this->encargadoLegal[0]['telefonoCelularEncargado']; ?>'/>
                </div>
            </div>
            <!--L12 Ocupación y email (Formulario Hugo)-->
            <div class="form-group">
                <label for="tf_ocupacionEncargado" class="col-lg-2 control-label">Ocupación:</label>
                <div class="col-lg-2">
                    <input type="text" class="form-control input-sm" name="tf_ocupacionEncargado" id="tf_ocupacionEncargado" value='<?php if ($this->encargadoLegal != null) echo $this->encargadoLegal[0]['ocupacionEncargado']; ?>'/>
                </div>
                <label for="tf_emailEncargado" class="col-lg-2 control-label">Email:</label>
                <div class="col-lg-2">
                    <input class="form-control input-sm" type="text" name="tf_emailEncargado" id="tf_emailEncargado" value='<?php if ($this->encargadoLegal != null) echo $this->encargadoLegal[0]['emailEncargado']; ?>'/>
                </div>

                <label for="tf_parentesco" class="col-lg-2 control-label">Parentesco:</label>
                <div class="col-lg-2">
                    <select  class="form-control input-sm" name="sel_parentesco" id="sel_parentesco"> 
                        <?php if ($this->encargadoLegal[0]['parentesco'] == 'Padre') { ?>
                            <option value="Padre" selected>Padre</option> 
                            <option value="Madre">Madre</option>
                            <option value="Otro">Otro</option>
                        <?php } elseif ($this->encargadoLegal[0]['parentesco'] == 'Madre') { ?>
                            <option value="Padre">Padre</option> 
                            <option value="Madre" selected>Madre</option>
                            <option value="Otro">Otro</option>
                        <?php } else { ?>
                            <option value="Padre">Padre</option> 
                            <option value="Madre">Madre</option>
                            <option value="Otro" selected>Otro</option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <h4>Madre</h4>
            <!--L13 Cedula de la Madre (Formulario Hugo)-->
            <div class="form-group"> 
                <label for="tf_cedulaMadre" class="col-lg-2 control-label">Identificación:</label>
                <div class="col-lg-2">
                    <input type="text" class="form-control input-sm " name="tf_cedulaMadre" id="tf_cedulaMadre" value='<?php if ($this->madreEstudiante != null) echo $this->madreEstudiante[0]['ced_madre']; ?>'/>
                </div>
                <div class="col-lg-2">
                    <input type="button" class="btn-sm btn-success" id="buscarMadre" value="Buscar" />
                </div>
            </div> 
            <!--L14 Nombre de la Madre (Formulario Hugo)-->
            <div class="form-group">
                <label for="tf_ape1Madre" class="col-lg-2 control-label">1er Apellido:</label>
                <div class="col-lg-2">
                    <input type="text" class="form-control input-sm"  id="tf_ape1Madre" name="tf_ape1Madre" value='<?php if ($this->madreEstudiante != null) echo $this->madreEstudiante[0]['apellido1_madre']; ?>' onkeyup="mayusculas(this)"/>
                </div>
                <label for="tf_ape2Madre" class="col-lg-2 control-label">2do Apellido:</label>
                <div class="col-lg-2">
                    <input type="text" class="form-control input-sm"  id="tf_ape2Madre" name="tf_ape2Madre" value='<?php if ($this->madreEstudiante != null) echo $this->madreEstudiante[0]['apellido2_madre']; ?>' onkeyup="mayusculas(this)"/>
                </div>
                <label for="tf_nombreMadre" class="col-lg-2 control-label">Nombre completo:</label>
                <div class="col-lg-2">
                    <input type="text" class="form-control input-sm"  id="tf_nombreMadre" name="tf_nombreMadre" value='<?php if ($this->madreEstudiante != null) echo $this->madreEstudiante[0]['nombre_madre']; ?>' onkeyup="mayusculas(this)"/>
                </div> 
            </div> 
            <!--L15 Telefonos y Ocupación de la Madre (Formulario Hugo)-->
            <div class="form-group">
                <label for="tf_telHabitMadre" class="col-lg-2 control-label">Tel. Habit/Cel:</label>
                <div class="col-lg-2">
                    <input type="text" class="form-control input-sm" name="tf_telHabitMadre" id="tf_telHabitMadre" value='<?php if ($this->madreEstudiante != null) echo $this->madreEstudiante[0]['telefonoCasaMadre']; ?>'/>
                </div>
                <label for="tf_ocupacionMadre" class="col-lg-2 control-label">Ocupación:</label>
                <div class="col-lg-2">
                    <input type="text" class="form-control input-sm" name="tf_ocupacionMadre" id="tf_ocupacionMadre" value='<?php if ($this->madreEstudiante != null) echo $this->madreEstudiante[0]['ocupacionMadre']; ?>'/>
                </div> 
            </div>

            <h4>Padre</h4>
            <!--L16 Cedula del Padre (Formulario Hugo)-->
            <div class="form-group"> 
                <label for="tf_cedulaPadre" class="col-lg-2 control-label">Identificación:</label>
                <div class="col-lg-2">
                    <input type="text" class="form-control input-sm " name="tf_cedulaPadre" id="tf_cedulaPadre" value='<?php if ($this->padreEstudiante != null) echo $this->padreEstudiante[0]['ced_padre']; ?>'/>
                </div>
                <div class="col-lg-2">
                    <input type="button" class="btn-sm btn-success" id="buscarPadre" value="Buscar" />
                </div>
            </div> 
            <!--L17 Nombre del Padre (Formulario Hugo)-->
            <div class="form-group">
                <label for="tf_ape1Padre" class="col-lg-2 control-label">1er Apellido:</label>
                <div class="col-lg-2">
                    <input type="text" class="form-control input-sm"  id="tf_ape1Padre" name="tf_ape1Padre" value='<?php if ($this->padreEstudiante != null) echo $this->padreEstudiante[0]['apellido1_padre']; ?>' onkeyup="mayusculas(this)"/>
                </div>
                <label for="tf_ape2Padre" class="col-lg-2 control-label">2do Apellido:</label>
                <div class="col-lg-2">
                    <input type="text" class="form-control input-sm"  id="tf_ape2Padre" name="tf_ape2Padre" value='<?php if ($this->padreEstudiante != null) echo $this->padreEstudiante[0]['apellido2_padre']; ?>' onkeyup="mayusculas(this)"/>
                </div>
                <label for="tf_nombrePadre" class="col-lg-2 control-label">Nombre completo:</label>
                <div class="col-lg-2">
                    <input type="text" class="form-control input-sm"  id="tf_nombrePadre" name="tf_nombrePadre" value='<?php if ($this->padreEstudiante != null) echo $this->padreEstudiante[0]['nombre_padre']; ?>' onkeyup="mayusculas(this)"/>
                </div> 
            </div> 
            <!--L18 Telefonos y Ocupación del Padre (Formulario Hugo)-->
            <div class="form-group">
                <label for="tf_telHabitPadre" class="col-lg-2 control-label">Tel. Habit/Cel:</label>
                <div class="col-lg-2">
                    <input type="text" class="form-control input-sm" name="tf_telHabitPadre" id="tf_telHabitPadre" value='<?php if ($this->padreEstudiante != null) echo $this->padreEstudiante[0]['telefonoCasaPadre']; ?>'/>
                </div>
                <label for="tf_ocupacionPadre" class="col-lg-2 control-label">Ocupación:</label>
                <div class="col-lg-2">
                    <input type="text" class="form-control input-sm" name="tf_ocupacionPadre" id="tf_ocupacionPadre" value='<?php if ($this->padreEstudiante != null) echo $this->padreEstudiante[0]['ocupacionPadre']; ?>'/>
                </div> 
            </div>

            <h4>En Caso de Emergencia Llamar a:</h4>
            <!--L19 Cedula Persona En Caso de Emergencia (Formulario Hugo)-->
            <div class="form-group"> 
                <label for="tf_cedulaPersonaEmergencia" class="col-lg-2 control-label">Identificación:</label>
                <div class="col-lg-2">
                    <input type="text" class="form-control input-sm " name="tf_cedulaPersonaEmergencia" id="tf_cedulaPersonaEmergencia" value='<?php if ($this->personaEmergenciaEstudiante != null) echo $this->personaEmergenciaEstudiante[0]['ced_personaEmergencia']; ?>'/>
                </div>
                <div class="col-lg-2">
                    <input type="button" class="btn-sm btn-success" id="buscarPersonaEmergencia" value="Buscar" />
                </div>
            </div> 
            <!--L20 Nombre de la Persona En Caso de Emergencia (Formulario Hugo)-->
            <div class="form-group">
                <label for="tf_ape1PersonaEmergencia" class="col-lg-2 control-label">1er Apellido:</label>
                <div class="col-lg-2">
                    <input type="text" class="form-control input-sm"  id="tf_ape1PersonaEmergencia" name="tf_ape1PersonaEmergencia" value='<?php if ($this->personaEmergenciaEstudiante != null) echo $this->personaEmergenciaEstudiante[0]['apellido1_personaEmergencia']; ?>' onkeyup="mayusculas(this)"/>
                </div>
                <label for="tf_ape2PersonaEmergencia" class="col-lg-2 control-label">2do Apellido:</label>
                <div class="col-lg-2">
                    <input type="text" class="form-control input-sm"  id="tf_ape2PersonaEmergencia" name="tf_ape2PersonaEmergencia" value='<?php if ($this->personaEmergenciaEstudiante != null) echo $this->personaEmergenciaEstudiante[0]['apellido2_personaEmergencia']; ?>' onkeyup="mayusculas(this)"/>
                </div>
                <label for="tf_nombrePersonaEmergencia" class="col-lg-2 control-label">Nombre completo:</label>
                <div class="col-lg-2">
                    <input type="text" class="form-control input-sm"  id="tf_nombrePersonaEmergencia" name="tf_nombrePersonaEmergencia" value='<?php if ($this->personaEmergenciaEstudiante != null) echo $this->personaEmergenciaEstudiante[0]['nombre_personaEmergencia']; ?>' onkeyup="mayusculas(this)"/>
                </div> 
            </div> 
            <!--L21 Telefonos de la Persona En Caso de Emergencia (Formulario Hugo)-->
            <div class="form-group">
                <label for="tf_telHabitPersonaEmergencia" class="col-lg-2 control-label">Tel. Habit:</label>
                <div class="col-lg-2">
                    <input type="text" class="form-control input-sm" name="tf_telHabitPersonaEmergencia" id="tf_telHabitPersonaEmergencia" value='<?php if ($this->personaEmergenciaEstudiante != null) echo $this->personaEmergenciaEstudiante[0]['telefonoCasaPersonaEmergencia']; ?>'/>
                </div>
                <label for="tf_telcelularPersonaEmergencia" class="col-lg-2 control-label">Tel. Celular:</label>
                <div class="col-lg-2">
                    <input type="text" class="form-control input-sm" name="tf_telcelularPersonaEmergencia" id="tf_telcelularPersonaEmergencia" value='<?php if ($this->personaEmergenciaEstudiante != null) echo $this->personaEmergenciaEstudiante[0]['telefonoCelularPersonaEmergencia']; ?>'/>
                </div>
            </div>
            <br><br>
            <legend class="text-center">DATOS DE LA INSTITUCIÓN</legend>
            <!--L22 Nivel a Matricular, Condicion, Adelanto (Formulario Hugo)-->
            <div class="form-group"> 
                <label for="tf_nivelMatricular" class="col-lg-2 control-label">Nivel a Matricular:</label>
                <div class="col-lg-2">
                    <select class="form-control input-sm" name="sl_nivelMatricular" id="sl_nivelMatricular">
                        <option value="<?php echo $this->infoEstudiante[0]['nivel'] + 1; ?>"><?php echo $this->infoEstudiante[0]['nivel'] + 1; ?></option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                    </select> 
                </div>
                <label for="tf_condicion" class="col-lg-2 control-label">Condición:</label>
                <div class="col-lg-2">
                    <select class="form-control input-sm" name="sl_condicion" id="sl_condicion">
                        <option value="">Seleccione</option>
                        <option value="Regular" <?php if ($this->infoCondicionMatricula[0]['condicion'] == 'Regular') echo 'selected'; ?>>Regular</option>
                        <option value="Repite" <?php if ($this->infoCondicionMatricula[0]['condicion'] == 'Repite') echo 'selected'; ?>>Repite</option>
                    </select> 
                </div>
                <label for="tf_adelanta" class="col-lg-2 control-label">Adelanta:</label>
                <div class="col-lg-2">
                    <select class="form-control input-sm" name="sl_adelanta" id="sl_adelanta">
                        <option value="si" <?php if ($this->infoAdelanta != null) echo 'selected'; ?>>Si</option>
                        <option value="no" <?php if ($this->infoAdelanta == null) echo 'selected'; ?>>No</option>
                    </select> 
                </div>
            </div>
            <!--L23 Adecuacion y Becas (Formulario Hugo)-->
            <div class="form-group"> 
                <label for="tf_adecuacion" class="col-lg-2 control-label">Adecuación Curricular:</label>
                <div class="col-lg-2">
                    <select class="form-control input-sm" name="sl_adecuacion" id="sl_adecuacion">
                        <option value="No">No</option>
                        <option value="NoSignificativa">No Significativa</option>
                        <option value="Acceso">Acceso</option>
                        <option value="Significativa">Significativa</option>
                    </select> 
                </div>
                <label for="tf_becaAvancemos" class="col-lg-2 control-label">Beca Avancemos:</label>
                <div class="col-lg-2">
                    <select class="form-control input-sm" name="sl_becaAvancemos" id="sl_becaAvancemos">
                        <option value="No">No</option>
                        <option value="Si">Si</option>
                    </select> 
                </div>
                <label for="tf_becaComedor" class="col-lg-2 control-label">Beca Comedor:</label>
                <div class="col-lg-2">
                    <select class="form-control input-sm" name="sl_becaComedor" id="sl_becaComedor">
                        <option value="No">No</option>
                        <option value="Si">Si</option>
                    </select> 
                </div>
            </div>
            <!--L24 Poliza (Formulario Hugo)-->
            <div class="form-group"> 
                <label for="tf_poliza" class="col-lg-2 control-label">N° de póliza:</label>
                <div class="col-lg-2">
                    <input type="text" class="form-control input-sm" name="tf_poliza" id="tf_poliza" value='<?php if ($this->polizaEstudiante != null) echo $this->polizaEstudiante[0]['numero_poliza']; ?>'/>
                </div>
                <label for="tf_polizaVence" class="col-lg-2 control-label">Fecha Vencimiento:</label>
                <div class="col-lg-2">
                    <input type="text" class="form-control input-sm" name="tf_polizaVence" id="tf_polizaVence" value='<?php if ($this->polizaEstudiante != null) echo $this->polizaEstudiante[0]['fecha_vence']; ?>'/>
                </div>
            </div>
            <br><br>
            <!--L25 Imprimir y Guardar (Formulario Hugo)-->
            <div class="form-group"> 
                <div class="col-lg-12 text-center">
                    <input type="submit" class="btn-lg btn-primary" id="guardar" value="Guardar e Imprimir" />
                </div>
            </div>
        </fieldset>
    </form>
</div>