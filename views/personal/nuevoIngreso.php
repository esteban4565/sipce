<?php
//print_r($this->especialidadEstudiante);
//die;
?>
    <form id="MyForm" action="<?php echo URL; ?>personal/guardarNuevoIngreso" method="POST" enctype="multipart/form-data" class="form-horizontal">
        <fieldset>
            <legend class="text-center">DATOS DEL PERSONAL</legend>
            <!--L1 Cedula y Genero *Nacionalidad (Nuevo)(Formulario Hugo)-->
            <div class="form-group"> 
                <label for="slt_nacionalidad" class="col-xs-2 control-label">Nacionalidad:</label>
                <div class="col-xs-2">
                    <select class="form-control input-sm" name="slt_nacionalidad" id="slt_nacionalidad">
                        <?php
                        foreach ($this->consultaPaises as $value) {
                            if ($value['codigoPais'] == "506") {
                                echo "<option value='" . $value['codigoPais'] . "' selected>";
                                echo $value['nombrePais'] . "</option>";
                            }
                            echo "<option value='" . $value['codigoPais'] . "'>";
                            echo $value['nombrePais'] . "</option>";
                        }
                        ?>
                    </select> 
                </div>
                <label for="txt_cedulaPersonal" class="col-xs-2 control-label">Identificación:</label>
                <div class="col-xs-2">
                    <input type="text" class="text-uppercase form-control input-sm validate[required]" name="txt_cedulaPersonal" id="txt_cedulaPersonal"/>
                </div>
                <div class="col-xs-2">
                    <input type="button" class="btn-sm btn-success" id="buscarEstudiante" value="Buscar"  style="display:block;"/>
                </div>
            </div> 
            <!--L2 Nombre Estudiante (Formulario Hugo)-->
            <div class="form-group">
                <label for="txt_apellido1" class="col-xs-2 control-label">1er Apellido:</label>
                <div class="col-xs-2">
                    <input type="text" class="text-uppercase form-control input-sm validate[required]"  id="txt_apellido1" name="txt_apellido1"/>
                </div>
                <label for="txt_apellido2" class="col-xs-2 control-label">2do Apellido:</label>
                <div class="col-xs-2">
                    <input type="text" class="text-uppercase form-control input-sm"  id="txt_apellido2" name="txt_apellido2"/>
                </div>
                <label for="txt_nombre" class="col-xs-2 control-label">Nombre completo:</label>
                <div class="col-xs-2">
                    <input type="text" class="text-uppercase form-control input-sm validate[required]"  id="txt_nombre" name="txt_nombre"/>
                </div> 
            </div> 
            <!--L3 Fecha Nacimiento (Formulario Hugo)-->
            <div class="form-group">
                <label for="txt_fnacpersona" class="col-xs-2 control-label">Fecha de Nacimiento (Año-Mes-Día):</label>
                <div class="col-xs-2">
                    <input type="text" class="form-control input-sm validate[required]"  id="txt_fnacpersona" name="txt_fnacpersona"/>
                </div>
                <!--OJO.. el año axtual esta quemado en el documento javascript, se debe cambiar año a año o buscar solucion -->
                <label for="txt_edad" class="col-xs-2 control-label">Edad:</label>
                <div class="col-xs-2">
                    <input type="text" class="form-control input-sm validate[custom[number]]"  id="txt_edad" name="txt_edad"/>
                </div>
                <label for="slt_genero" class="col-xs-2 control-label">Genero:</label>
                <div class="col-xs-2">
                    <select class="form-control input-sm validate[required]" name="slt_genero" id="slt_genero">
                        <option value="">SELECCIONE</option>
                        <option value="0">FEMENINO</option>
                        <option value="1" >MASCULINO</option>
                    </select> 
                </div>
            </div>
            <!--L4 Telefono y email *Tel.Casa (Nuevo)(Formulario Hugo)-->
            <div class="form-group">
                <label for="txt_telHabPersonal" class="col-xs-2 control-label">Tel. Habitación:</label>
                <div class="col-xs-2">
                    <input type="text" class="form-control input-sm validate[custom[number]]" name="txt_telHabPersonal" id="txt_telHabPersonal"/>
                </div>
                <label for="txt_telCelPersonal" class="col-xs-2 control-label">Tel. Celular:</label>
                <div class="col-xs-2">
                    <input type="text" class="form-control input-sm validate[custom[number]]" name="txt_telCelPersonal" id="txt_telCelPersonal"/>
                </div>
                <label for="txt_email" class="col-xs-2 control-label">Correo del MEP:</label>
                <div class="col-xs-2">
                    <input class="form-control input-sm" type="email" name="txt_email" id="txt_email" data-error="Atención, esta dirección de email es invalida"/>
                </div>
            </div>
            <!--Direccion(Formulario Hugo)-->
            <div class="form-group">
                <label for="txta_domicilio" class="col-xs-2 control-label">Dirección:</label>
                <div class="col-xs-10">
                    <textarea class="form-control validate[required]" rows="1" name="txta_domicilio" id="txta_domicilio"></textarea>
                </div>
                <div class="col-xs-4"></div>
            </div>
            <!--L6 Provincia, Canton, Distrito (Formulario Hugo)-->
            <div class="form-group">
                <label for="slt_provinciaDom" class="col-xs-2 control-label">Provincia:</label>
                <div class="col-xs-2">
                    <select class="form-control input-sm validate[required]" name="slt_provinciaDom" id="slt_provinciaDom">
                        <option value="">SELECCIONE</option>
                        <?php
                        foreach ($this->consultaProvincias as $value) {
                            ?>
                            <option value="<?php echo $value['IdProvincia']; ?>"><?php echo $value['nombreProvincia']; ?></option>
                            <?php
                        }
                        ?>  
                    </select>
                </div>
                <label for="slt_cantonDom" class="col-xs-2 control-label">Canton:</label>
                <div class="col-xs-2">
                    <select class="form-control input-sm validate[required]" name="slt_cantonDom" id="slt_cantonDom">
                    </select>
                </div>
                <label for="slt_distritoDom" class="col-xs-2 control-label">Distrito:</label>
                <div class="col-xs-2">
                    <select  class="form-control input-sm validate[required]" name="slt_distritoDom" id="slt_distritoDom">  
                    </select>
                </div>
            </div>
            <!--DOMICILIO DURANTE TIEMPO LECTIVO-->
            <div class="form-group">
                <label for="txta_domicilioClases" class="col-xs-2 control-label">En tiempo lectivo posee otro domicilio?</label>
                <div class="col-xs-2">
                    <select class="form-control input-sm validate[required]" name="txta_domicilioClases" id="txta_domicilioClases">
                        <option value="0">SI</option>
                        <option value="1">NO</option>
                    </select>    
                </div>
            </div>
            <div class="form-group">
                <label for="txta_domicilioClases" class="col-xs-2 control-label">Dirección:</label>
                <div class="col-xs-10">
                    <textarea class="form-control validate[required]" rows="1" name="txta_domicilioClases" id="txta_domicilioClases"></textarea>
                </div>
                <div class="col-xs-4"></div>
            </div>
            <div class="form-group">
                <label for="slt_provinciaClases" class="col-xs-2 control-label">Provincia:</label>
                <div class="col-xs-2">
                    <select class="form-control input-sm validate[required]" name="slt_provinciaClases" id="slt_provinciaClases">
                        <option value="">SELECCIONE</option>
                        <?php
                        foreach ($this->consultaProvincias as $value) {
                            ?>
                            <option value="<?php echo $value['IdProvincia']; ?>"><?php echo $value['nombreProvincia']; ?></option>
                            <?php
                        }
                        ?>  
                    </select>
                </div>
                <label for="slt_cantonClases" class="col-xs-2 control-label">Canton:</label>
                <div class="col-xs-2">
                    <select class="form-control input-sm validate[required]" name="slt_cantonClases" id="slt_cantonClases">              
                    </select>
                </div>
                <label for="slt_distritoClases" class="col-xs-2 control-label">Distrito:</label>
                <div class="col-xs-2">
                    <select  class="form-control input-sm validate[required]" name="slt_distritoClases" id="slt_distritoClases">
                    </select>
                </div>
            </div>
            <!--PADESE ALGUNA ENFERMEDAD-->
            <div class="form-group">
                <label for="slt_enfermedad" class="col-xs-2 control-label">¿Padece alguna enfermedad?</label>
                <div class="col-xs-2">
                    <select  class="form-control input-sm" name="slt_enfermedad" id="slt_enfermedad"> 
                        <option value="0">NO</option> 
                        <option value="1">SI</option>
                    </select>
                </div>
                <label for="txt_enfermedadDesc" class="col-xs-2 control-label">Especifique</label>
                <div class="col-xs-2">
                    <input type="text" class="form-control input-sm" name="txt_enfermedadDesc" id="txt_enfermedadDesc"/>
                </div>
            </div>
            <br>
            <!--PERSONA EN CASO DE EMERGENCIA-->
            <h4>En Caso de Emergencia Llamar a:</h4>
            <div class="form-group"> 
                <label for="slt_parentescoCasoEmergencia" class="col-xs-2 control-label">Parentesco:</label>
                <div class="col-xs-2">
                    <select  class="form-control input-sm validate[required]" name="slt_parentescoCasoEmergencia" id="slt_parentescoCasoEmergencia"> 
                        <option value="">SELECCIONE</option>
                        <option value="0">PADRE</option>
                        <option value="1">MADRE</option>
                        <option value="3">OTRO</option>
                    </select>
                </div>
                <label for="txt_cedulaPersonaEmergencia" class="col-xs-2 control-label">Identificación:</label>
                <div class="col-xs-2">
                    <input type="text" class="text-uppercase form-control input-sm validate[required]" name="txt_cedulaPersonaEmergencia" id="txt_cedulaPersonaEmergencia"/>
                </div>
                <div class="col-xs-2">
                    <input type="button" class="btn-sm btn-success" id="btnBuscarPersonaEmergencia" value="Buscar"/>
                </div>
            </div> 
            <div class="form-group">
                <label for="txt_apellido1PersonaEmergencia" class="col-xs-2 control-label">1er Apellido:</label>
                <div class="col-xs-2">
                    <input type="text" class="text-uppercase form-control input-sm validate[required]"  id="txt_apellido1PersonaEmergencia" name="txt_apellido1PersonaEmergencia"/>
                </div>
                <label for="txt_apellido2PersonaEmergencia" class="col-xs-2 control-label">2do Apellido:</label>
                <div class="col-xs-2">
                    <input type="text" class="text-uppercase form-control input-sm"  id="txt_apellido2PersonaEmergencia" name="txt_apellido2PersonaEmergencia"/>
                </div>
                <label for="txt_nombrePersonaEmergencia" class="col-xs-2 control-label">Nombre completo:</label>
                <div class="col-xs-2">
                    <input type="text" class="text-uppercase form-control input-sm validate[required]"  id="txt_nombrePersonaEmergencia" name="txt_nombrePersonaEmergencia"/>
                </div> 
            </div> 
            <div class="form-group">
                <label for="txt_telHabPersonaEmergencia" class="col-xs-2 control-label">Tel. Habitación:</label>
                <div class="col-xs-2">
                    <input type="text" class="form-control input-sm validate[custom[number]]" name="txt_telHabPersonaEmergencia" id="txt_telHabPersonaEmergencia"/>
                </div>
                <label for="txt_telcelPersonaEmergencia" class="col-xs-2 control-label">Tel. Celular:</label>
                <div class="col-xs-2">
                    <input type="text" class="form-control input-sm validate[custom[number]]" name="txt_telcelPersonaEmergencia" id="txt_telcelPersonaEmergencia"/>
                </div>
            </div>
            <br><br>
            <!--GUARDAR REGISTRO DATOS PERSONALES-->
            <div class="form-group"> 
                <div class="col-xs-12 text-center">
                    <input type="submit" class="btn-sm btn-success" id="btnguardar" value="GUARDAR DATOS PERSONALES"/>
                </div>
                
            </div>
            <br><br>
</div>
<br><br>
<div class="jumbotron">
            <!--DATOS ACADEMICOS-->
            <legend class="text-center">DATOS ACADEMICOS</legend>
            <div class="form-group"> 
                <label for="txt_telHabPersonaEmergencia" class="col-xs-2 control-label">Area pertenece:</label>
                <div class="col-xs-2">
                    <select  class="form-control input-sm validate[required]" name="sel_Anualidades" id="sel_Anualidades"> 
                        <option value="">SELECCIONE</option>
                        <option value="0">ACADEMICA</option>
                        <option value="1">ADMINISTRATIVA</option>
                        <option value="2">SERVICIOS</option>
                    </select>
                </div>
                <label for="tf_GrupoProfesional" class="col-xs-2 control-label">Grupo profesional:</label>
                <div class="col-xs-2">
                    <select  class="form-control input-sm validate[required]" name="tf_distritos_NI" id="tf_distritos_NI">  
                        <option value="">SELECCIONE</option>
                        <?php
                        foreach ($this->consultaDistritos as $value) {
                            ?>
                            <option value="<?php echo $value['IdDistrito']; ?>"><?php echo $value['Distrito']; ?></option>
                            <?php
                        }
                        ?>    
                    </select>
                </div>
                <label for="sel_Anualidades" class="col-xs-2 control-label">Anualidades:</label>
                <div class="col-xs-2">
                    <select  class="form-control input-sm validate[required]" name="sel_Anualidades" id="sel_Anualidades"> 
                        <option value="">SELECCIONE</option>
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                    </select>
                </div>
            </div> 
            <!--PRIMARIA REALIZADA-->
            <h4>Primaria</h4>
            <div class="form-group">
                <label for="slt_provinciaPrim" class="col-xs-1 control-label">Provincia:</label>
                <div class="col-xs-2">
                    <select class="form-control input-sm validate[required]" name="slt_provinciaPrim" id="slt_provinciaPrim">
                        <option value="">SELECCIONE</option>
                        <?php
                        foreach ($this->consultaProvincias as $value) {
                            ?>
                            <option value="<?php echo $value['IdProvincia']; ?>"><?php echo $value['nombreProvincia']; ?></option>
                            <?php
                        }
                        ?>  
                    </select>
                </div>
                <label for="slt_cantonPrim" class="col-xs-1 control-label">Canton:</label>
                <div class="col-xs-2">
                    <select class="form-control input-sm validate[required]" name="slt_cantonPrim" id="slt_cantonPrim">
                    </select>
                </div>
                <label for="slt_distritoPrim" class="col-xs-1 control-label">Distrito:</label>
                <div class="col-xs-2">
                    <select  class="form-control input-sm validate[required]" name="slt_distritoPrim" id="slt_distritoPrim">  
                    </select>
                </div>
                <label for="slt_primaria" class="col-xs-1 control-label">Escuela:</label>
                <div class="col-xs-2">
                    <select  class="form-control input-sm validate[required]" name="slt_primaria" id="slt_primaria"> 
                    </select>
                </div>
            </div>
            <!--SECUNDARIA REALIZADA-->
            <h4>Secundaria</h4>
            <div class="form-group">
                <label for="slt_provinciaSec" class="col-xs-1 control-label">Provincia:</label>
                <div class="col-xs-2">
                    <select class="form-control input-sm validate[required]" name="slt_provinciaSec" id="slt_provinciaSec">
                        <option value="">SELECCIONE</option>
                        <?php
                        foreach ($this->consultaProvincias as $value) {
                            ?>
                            <option value="<?php echo $value['IdProvincia']; ?>"><?php echo $value['nombreProvincia']; ?></option>
                            <?php
                        }
                        ?>  
                    </select>
                </div>
                <label for="slt_cantonSec" class="col-xs-1 control-label">Canton:</label>
                <div class="col-xs-2">
                    <select class="form-control input-sm validate[required]" name="slt_cantonSec" id="slt_cantonSec">
                    </select>
                </div>
                <label for="slt_distritoSec" class="col-xs-1 control-label">Distrito:</label>
                <div class="col-xs-2">
                    <select  class="form-control input-sm validate[required]" name="slt_distritoSec" id="slt_distritoSec">  
                    </select>
                </div>
                <label for="slt_secundaria" class="col-xs-1 control-label">Colegio:</label>
                <div class="col-xs-2">
                    <select  class="form-control input-sm validate[required]" name="slt_secundaria" id="slt_secundaria"> 
                    </select>
                </div>
            </div>
            <br><br>
            <!--ESTUDIOS UNIVERSITARIOS-->
            <h4>Estudios Universitarios :</h4>
            <div class="form-group">
                <div class="col-xs-12">
                    <table class="table table-bordered table-hover" id="tablaUniversidades">
                        <tr>
                            <th>NOMBRE UNIVERSIDAD</th>
                            <th>GRADO ACADEMICO</th>
                            <th>NOMBRE TITULO</th>
                            <th>AÑO FINALIZA</th>
                            
                        </tr>
                        <tr>
                            <td>
                                <select class="form-control input-sm validate[required]" name="slt_nombreUniversidad" id="slt_nombreUniversidad">
                                    <option value="">SELECCIONE</option>
                                    <?php
                                    foreach ($this->universidad as $value) {
                                        ?>
                                        <option value="<?php echo $value['id']; ?>"><?php echo $value['nombre']; ?></option>
                                        <?php
                                    }
                                    ?>  
                                </select>
                            </td>
                            <td>
                                <select class="form-control input-sm validate[required]" name="slt_gradoAcademico" id="slt_gradoAcademico">
                                    <option value="">SELECCIONE</option>
                                    <option value="0">BACHILLER</option>
                                    <option value="1">LICENCIADO</option>
                                    <option value="2">MAESTRIA</option>
                                    <option value="3">DOCTORADO</option>
                                </select>
                            </td>
                            <td>
                                <input type="text" class="text-uppercase form-control input-sm validate[required]" name="txtnombreTitulo" id="txtnombreTitulo"/>
                            </td>
                            <td>
                                <input type="text" class="form-control input-sm"  id="tf_anoFinaliza" name="tf_anoFinaliza"/>
                            </td>
                            
                        </tr>
                    </table>
                </div> 
            </div>
            <div class="form-group">
                <div class="col-xs-1"></div>
                <div class="col-xs-3">
                    <input type="button" class="btn-sm btn-success" id="btnAgregarUniversidad" name="btnAgregarUniversidad" value="Aceptar"/>
                </div>
                <div class="col-xs-8"></div>
            </div>
            <br><br>
            <!--CENTROS EDUCATIVOS DONDE HA LABORADO-->
            <h4>Centros Educativos donde ha Laborado:</h4>                
                <div class="form-group">
                    <label for="tf_CentrosLaborados" class="col-xs-2 control-label">Nombre Institución:</label>
                    <div class="col-xs-4">
                        <input type="text" class="form-control input-sm validate[required]" name="tf_CentrosLaborados" id="tf_CentrosLaborados"/>
                    </div>
                    <div class="col-xs-6">
                </div>
            <!--USUARIO QUE ATENDIO AL FUNCIONARIO-->
            <br><br><br><br>
            <div class="form-group"> 
                <label for="tf_AtendidoPor" class="col-xs-2 control-label">ATENDIDO POR:</label>
                <div class="col-xs-4">
                    <label class="control-label"><?php echo $_SESSION['nombre']; ?></label>
                </div>
                <label for="tf_AtendidoPor" class="col-xs-2 control-label">FECHA:</label>
                <div class="col-xs-4">
                    <!--<label class="control-label"><?php echo Date("d/m/Y")?></label>-->
                    <label id="time" class="control-label"></label>
                </div>
            </div>
            <br><br><br><br>
            <!--IMPRIMIR Y GUARDAR REGISTRO-->
            <div class="form-group"> 
                <div class="col-xs-12 text-center">
                    <input type="submit" class="btn-sm btn-success" id="btnguardar" value="IMPRIMIR COMPROBANTE"/>
                </div>
                
            </div>
        </fieldset>
    </form>