<?php
//print_r($this->infoEstudiante);
print_r($this->enfermedadEstudiante);
?>
<div class="row">
    <form id="MyForm" action="saveDocenteEstudiante" method="POST" enctype="multipart/form-data" class="form-horizontal">
        <fieldset>
            <legend>DATOS DEL ESTUDIANTE</legend>
            <!--L1 Cedula y Genero (Formulario Hugo)-->
            <div class="form-group"> 
                <label for="tf_cedula" class="col-lg-2 control-label">Identificación:</label>
                <div class="col-lg-2">
                    <input type="text" class="form-control input-sm" name="tf_cedula" id="tf_cedula" value='<?php echo $this->infoEstudiante[0]['cedula']; ?>' disabled/>
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
                    <input type="text" class="form-control input-sm"  id="tf_fnacpersona" name="tf_fnacpersona" value='<?php echo date(substr($this->infoEstudiante[0]['fechaNacimiento'], 0, 10)); ?>' onkeyup="mayusculas(this)"/>
                </div>
                <label for="tf_fnacpersona" class="col-lg-2 control-label">Edad:</label>
                <div class="col-lg-2">
                    <input type="text" class="form-control input-sm"  id="tf_fnacpersona" name="tf_fnacpersona" value='<?php echo 2015 - (date(substr($this->infoEstudiante[0]['fechaNacimiento'], 0, 4))); ?>' onkeyup="mayusculas(this)"/>
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
                <div class="col-lg-6">
                    <textarea class="form-control" rows="1" name="tf_domicilio" id="tf_domicilio" value='<?php echo $this->infoEstudiante[0]['domicilio']; ?>'></textarea>
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
                    <input type="text" class="form-control input-sm" name="tf_enfermedad" id="tf_enfermedad" 
                    <?php
                    if ($this->enfermedadEstudiante != null) {
                        echo 'value="' . $this->enfermedadEstudiante[0]['descripcion'] . '">';
                    } else {
                        echo 'value="No presenta">';
                    }
                    ?>
                </div>
            </div>
            <br><br>
            <legend>DATOS DEL HOGAR</legend>
            <h4>Encargado Legal</h4>
            <!--L9 Cedula y Nombre del encargado legal (Formulario Hugo)-->
            <div class="form-group"> 
                <label for="tf_cedulaEncargado" class="col-lg-2 control-label">Identificación:</label>
                <div class="col-lg-2">
                    <input type="text" class="form-control input-sm " name="tf_cedulaEncargado" id="tf_cedulaEncargado" value=''/>
                </div>
                <div class="col-lg-2">
<?php
echo '<a class="btn-sm btn-success" href="">Buscar</a>';
?>
                </div>
            </div> 
            <!--L10 Nombre del encargado legal (Formulario Hugo)-->
            <div class="form-group">
                <label for="tf_ape1" class="col-lg-2 control-label">1er Apellido:</label>
                <div class="col-lg-2">
                    <input type="text" class="form-control input-sm"  id="tf_ape1Encargado" name="tf_ape1Encargado" value='' onkeyup="mayusculas(this)"/>
                </div>
                <label for="tf_ape2" class="col-lg-2 control-label">2do Apellido:</label>
                <div class="col-lg-2">
                    <input type="text" class="form-control input-sm"  id="tf_ape2Encargado" name="tf_ape2Encargado" value='' onkeyup="mayusculas(this)"/>
                </div>
                <label for="tf_nombre" class="col-lg-2 control-label">Nombre completo:</label>
                <div class="col-lg-2">
                    <input type="text" class="form-control input-sm"  id="tf_nombreEncargado" name="tf_nombreEncargado" value='' onkeyup="mayusculas(this)"/>
                </div> 
            </div> 
            <!--L11 Telefono Habitacion y celular (Formulario Hugo)-->
            <div class="form-group">
                <label for="tf_telHabitEncargado" class="col-lg-2 control-label">Tel. Habitación:</label>
                <div class="col-lg-2">
                    <input type="text" class="form-control input-sm" name="tf_telHabitEncargado" id="tf_telHabitEncargado" value=''>
                </div>
                <label for="tf_telcelularEncargado" class="col-lg-2 control-label">Tel. Celular:</label>
                <div class="col-lg-2">
                    <input type="text" class="form-control input-sm" name="tf_telcelularEncargado" id="tf_telcelularEncargado" value=''>
                </div>
            </div>
            <!--L12 Ocupación y email (Formulario Hugo)-->
            <div class="form-group">
                <label for="tf_ocupacion" class="col-lg-2 control-label">Ocupación:</label>
                <div class="col-lg-2">
                    <input type="text" class="form-control input-sm" name="tf_ocupacion" id="tf_ocupacion" value=''>
                </div>
                <label for="tf_emailEncargado" class="col-lg-2 control-label">Email:</label>
                <div class="col-lg-2">
                    <input class="form-control input-sm" type="text" name="tf_emailEncargado" id="tf_emailEncargado" value=''>
                </div>
            </div>
            </div>
        </fieldset>
    </form>

</div>