<?php
//print_r($this->especialidadEstudiante);
//die;
?>
<br><br>
<form id="MyFormS" action="<?php echo URL; ?>personal/GuardarPersonal" method="POST" enctype="multipart/form-data" class="form-horizontal">
    <fieldset>
        <!--JUMBOTRON1  DATOS PERSONALES-->
        <div class="jumbotron">
            <h4>DATOS PERSONALES</h4>
            <hr>
            <!--NACIONALIDAD, CEDULA-->
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
                    <input type="button" class="btn-sm btn-success" id="buscarEstudiante" value="Buscar" style="display:block"/>
                </div>
            </div> 
            <!--APELLIDO1, APELLIDO2, NOMBRE-->
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
            <!--FECHA NACIMIENTO, EDAD, GENERO-->
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
                        <option value="0">Femenino</option>
                        <option value="1" >Masculino</option>
                    </select> 
                </div>
            </div>
            <!--TEL HAB, TEL CEL, EMAIL MEP-->
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
            <!--DIRECCION PRINCIPAL-->
            <div class="form-group">
                <label for="txta_domicilio" class="col-xs-2 control-label">Dirección:</label>
                <div class="col-xs-10">
                    <textarea class="form-control validate[required]" rows="1" name="txta_domicilio" id="txta_domicilio"></textarea>
                </div>
                <div class="col-xs-4"></div>
            </div>
            <!--PROVINCIA, CANTON, DISTRITO-->
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
                <label for="slt_otroDomicilioClases" class="col-xs-2 control-label">En tiempo lectivo posee otro domicilio?</label>
                <div class="col-xs-2">
                    <select class="form-control input-sm validate[required]" name="slt_otroDomicilioClases" id="slt_otroDomicilioClases">
                        <option value="0">Si</option>
                        <option value="1">No</option>
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
                        <option value="0">No</option> 
                        <option value="1">Si</option>
                    </select>
                </div>
                <label for="txt_enfermedadDesc" id="enfermedadDesc" class="col-xs-2 control-label" style="display:none;">Especifique</label>
                <div class="col-xs-2">
                    <input type="text" class="form-control input-sm" name="txt_enfermedadDesc" id="txt_enfermedadDesc" style="display:none;"/>
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
                        <option value="0">Padre</option>
                        <option value="1">Madre</option>
                        <option value="3">Otro</option>
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
            <br>         
        </div><!--CIERRE DE JUMBOTRON1-->
        <br><br>
    </fieldset>
    <br><br>
    <!--IMPRIMIR Y GUARDAR REGISTRO-->
    <div class="form-group"> 
        <div class="col-xs-12 text-center">
            <input type="submit" class="btn-sm btn-success" id="btnguardar" value="Guardar Registro"/>
        </div>
    </div>
    <br><br>
</form>
<!--///////////////////////////////////////////////////////////////////////////////-->
<!-- Modal -->
<div id="myModal-Existe" class="modal face" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Error Busquedad</h4>
            </div>
            <div class="modal-body">
                <p>El registro ya existe en la Base de Datos...</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-sm btn-success" data-dismiss="modal">Cerrar</button>
            </div>
        </div>

    </div>
</div>
<div id="myModal-noExiste" class="modal face" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Error Busquedad</h4>
            </div>
            <div class="modal-body">
                <p>El registro no existe...</p>
                <p>La Base de Datos esta actualizada al 2013 y solo posee Costarricenses y Nacionalizados.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-sm btn-success" data-dismiss="modal">Cerrar</button>
            </div>
        </div>

    </div>
</div>
<div id="myModal-blank" class="modal face" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Error Busquedad</h4>
            </div>
            <div class="modal-body">
                <p>Por favor ingrese el número de identificación.</p>
                <p>Ejemplo: 2-0456-0789, 1-1122-0567</p>
                <p>La Base de Datos esta actualizada al 2013 y solo posee Costarricenses y Nacionalizados.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-sm btn-success" data-dismiss="modal">Cerrar</button>
            </div>
        </div>

    </div>
</div>