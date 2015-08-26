<h4>En Caso de Emergencia Llamar a:</h4>
                <!--L19 Cedula Persona En Caso de Emergencia (Formulario Hugo)-->
                <div class="form-group"> 
                    <label for="slt_parentescoCasoEmergencia" class="col-xs-2 control-label">Parentesco:</label>
                    <div class="col-xs-2">
                        <select  class="form-control input-sm validate[required]" name="sel_parentescoCasoEmergencia" id="sel_parentescoCasoEmergencia"> 
                            <option value="">Seleccione</option>
                            <option value="Padre">Padre</option>
                            <option value="Madre">Madre</option>
                            <option value="Otro">Otro</option>
                        </select>
                    </div>
                    <label for="txt_cedulaPersonaEmergencia" class="col-xs-2 control-label">Identificación:</label>
                    <div class="col-xs-2">
                        <input type="text" class="text-uppercase form-control input-sm validate[required]" name="txt_cedulaPersonaEmergencia" id="txt_cedulaPersonaEmergencia"/>
                    </div>
                    <div class="col-xs-2">
                        <input type="button" class="btn-sm btn-success" id="btnBuscarPersonaEmergencia" value="Buscar" />
                    </div>
                </div> 
                <!--L20 Nombre de la Persona En Caso de Emergencia (Formulario Hugo)-->
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
                <!--L21 Telefonos de la Persona En Caso de Emergencia (Formulario Hugo)-->
                <div class="form-group">
                    <label for="txt_telHabPersonaEmergencia" class="col-xs-2 control-label">Tel. Habit:</label>
                    <div class="col-xs-2">
                        <input type="text" class="form-control input-sm validate[custom[number]]" name="txt_telHabPersonaEmergencia" id="txt_telHabPersonaEmergencia"/>
                    </div>
                    <label for="txt_telcelPersonaEmergencia" class="col-xs-2 control-label">Tel. Celular:</label>
                    <div class="col-xs-2">
                        <input type="text" class="form-control input-sm validate[custom[number]]" name="txt_telcelPersonaEmergencia" id="txt_telcelPersonaEmergencia"/>
                    </div>
                </div>
                <br><br>
                <legend class="text-center">DATOS ACADEMICOS</legend>
                <!--L9 Cedula y parentesco* del encargado legal (Formulario Hugo)-->
                <div class="form-group"> 
                    <label for="tf_UltimogradoAcademico" class="col-xs-2 control-label">Último grado academico:</label>
                    <div class="col-xs-2">
                        <input type="text" class="text-uppercase form-control input-sm validate[required]" name="tf_UltimogradoAcademico" id="tf_UltimogradoAcademico"/>
                    </div>
                    <label for="tf_GrupoProfesional" class="col-xs-2 control-label">Grupo profesional:</label>
                    <div class="col-xs-2">
                        <select  class="form-control input-sm validate[required]" name="tf_distritos_NI" id="tf_distritos_NI">  
                            <option value="">Seleccione</option>
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
                            <option value="">Seleccione</option>
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
                <!--L10 Primaria secundarias--> 
                <div class="form-group">
                    <label for="sel_Anualidades" class="col-xs-2 control-label">Primaria:</label>
                    <div class="col-xs-2">
                        <select  class="form-control input-sm validate[required]" name="sel_Anualidades" id="sel_Anualidades"> 
                            <option value="">Seleccione</option>
                            <?php
                            foreach ($this->escuelas as $value) {
                            ?>
                            <option value="<?php echo $value['id'];?>"><?php echo $value['nombre'];?></option>
                            <?php
                            }
                            ?>
                         </select>
                    </div>
                    <label for="slt_Secundaria" class="col-xs-2 control-label">Secundaria:</label>
                    <div class="col-xs-2">
                        <select  class="form-control input-sm validate[required]" name="slt_Secundaria" id="slt_Secundaria"> 
                            <option value="">Seleccione</option>
                            <?php
                            foreach ($this->colegios as $value) {
                            ?>
                            <option value="<?php echo $value['id'];?>"><?php echo $value['nombre'];?></option>
                            <?php
                            }
                            ?>
                         </select>
                    </div>
                </div>
                <br><br>
                <!--L10 Estudios universitarios-->
                <h4>Estudios Universitarios</h4>
                <div class="form-group">
                    <label for="slt_nombreUniversidad" class="col-xs-2 control-label">Nombre Universidad:</label>
                    <div class="col-xs-2">
                        <select class="form-control input-sm validate[required]" name="slt_nombreUniversidad" id="slt_nombreUniversidad">
                            <option value="">Seleccione</option>
                            <?php
                            foreach ($this->universidad as $value) {
                                ?>
                                <option value="<?php echo $value['id']; ?>"><?php echo $value['nombre']; ?></option>
                                <?php
                            }
                            ?>  
                        </select>
                    </div>
                    <label for="tf_anoFinaliza" class="col-xs-2 control-label">Año Finaliza:</label>
                    <div class="col-xs-2">
                        <input type="text" class="form-control input-sm"  id="tf_anoFinaliza" name="tf_anoFinaliza"/>
                    </div>
                    <div class="col-xs-2">
                        <input type="button" class="btn-sm btn-success" id="AddUniversidad" value="Agregar más"/>
                   </div>
                </div>
                <div id="AddU">
                    
                </div>
                <br><br>
                <!--L11 Centros educativos donde ha laborado-->
                <h4>Centros Donde Ha Laborado:</h4>                
                <div class="form-group">
                    <label for="tf_CentrosLaborados" class="col-xs-2 control-label">Nombre Institución:</label>
                    <div class="col-xs-2">
                        <input type="text" class="form-control input-sm validate[custom[number]]" name="tf_CentrosLaborados" id="tf_CentrosLaborados"/>
                    </div>
                </div>  
                <br><br>
                <legend class="text-center">DATOS DE LA INSTITUCIÓN</legend>
                <!--L22 Nivel a Matricular, Condicion, Adelanto (Formulario Hugo)-->
                <div class="form-group"> 
                    <label for="tf_area" class="col-xs-2 control-label">Area:</label>
                    <div class="col-xs-2">
                        <select class="form-control input-sm validate[required]" name="tf_area" id="tf_area">
                            <option value="">Seleccione</option>
                            <option value="1">Area Administrativa</option>
                            <option value="2">Area de Servicios</option>
                            <option value="3">Area Academica</option>
                        </select> 
                    </div>
                    <label for="tf_puesto" class="col-xs-2 control-label">Puesto:</label>
                    <div class="col-xs-2">
                        <select class="form-control input-sm validate[required]" name="tf_puesto" id="tf_puesto">
                            <option value="">Seleccione</option>
                            <option value="1">Area Administrativa</option>
                            <option value="2">Area de Servicios</option>
                            <option value="3">Area Academica</option>
                        </select> 
                    </div>
                    <label for="tf_condicion" class="col-xs-2 control-label">Condición:</label>
                    <div class="col-xs-2">
                        <select class="form-control input-sm validate[required]" name="sl_condicion" id="sl_condicion">
                            <option value="">Seleccione</option>
                            <option value="Regular">Interino</option>
                            <option value="Repite">Propietario</option>
                            <option value="Repite">Contratado</option>
                        </select> 
                    </div>
                </div>
                <!--L23 Año ingreso-->
                <div class="form-group"> 
                    <label for="tf_anoIngreso" class="col-xs-2 control-label">Año Ingreso:</label>
                    <div class="col-xs-2">
                        <input type="text" class="form-control input-sm validate[required]"  id="tf_anoIngreso" name="tf_anoIngreso"/>
                    </div>
                    
  
                    <label for="tf_NombradoPor" class="col-xs-2 control-label">Nombrado Por:</label>
                    <div class="col-xs-2">
                        <select class="form-control input-sm validate[required]" name="tf_NombradoPor" id="tf_NombradoPor">
                            <option value="">Seleccione</option>
                            <option value="0">MEP</option>
                            <option value="1">Junta Administrativa</option>
                            <option value="Otro">Contratado</option>
                        </select> 
                    </div>
                </div>
                <!--L24 Poliza (Formulario Hugo)-->
                <div class="form-group"> 
                    <label for="tf_LeccionesInterinas" class="col-xs-2 control-label">N° Lecciones Interinas:</label>
                    <div class="col-xs-2">
                        <input type="text" class="form-control input-sm" name="tf_LeccionesInterinas" id="tf_LeccionesInterinas"/>
                    </div>
                    <label for="tf_LeccionesPropiedad" class="col-xs-2 control-label">N° Lecciones Propiedad:</label>
                    <div class="col-xs-2">
                        <input type="text" class="form-control input-sm" name="tf_LeccionesPropiedad" id="tf_LeccionesPropiedad"/>
                    </div>
                     <div class="col-xs-2">
                    </div>
                </div>
                <div class="form-group"> 
                    <label for="tf_HorasContrato" class="col-xs-2 control-label">N° Horas Contrato:</label>
                    <div class="col-xs-2">
                        <input type="text" class="form-control input-sm" name="tf_HorasContrato" id="tf_HorasContrato"/>
                    </div>
                    <label for="tf_Contrato" class="col-xs-2 control-label">N° Contrato:</label>
                    <div class="col-xs-2">
                        <input type="text" class="form-control input-sm" name="tf_Contrato" id="tf_Contrato"/>
                    </div>
                     <div class="col-xs-2">
                    </div>
                </div>
                <div class="form-group"> 
                    <label for="tf_RigeNombramiento" class="col-xs-2 control-label">Rige Nombramiento:</label>
                    <div class="col-xs-2">
                        <input type="text" class="form-control input-sm" name="tf_RigeNombramiento" id="tf_RigeNombramiento"/>
                    </div>
                    <label for="tf_VenceNombramiento" class="col-xs-2 control-label">Vence Nombramiento:</label>
                    <div class="col-xs-2">
                        <input type="text" class="form-control input-sm" name="tf_VenceNombramiento" id="tf_VenceNombramiento"/>
                    </div>
                     <div class="col-xs-2">
                    </div>
                </div>