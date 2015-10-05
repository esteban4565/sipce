<?php
//print_r($this->especialidadEstudiante);
//die;
?>
<br><br>
    <form id="MyForm" action="<?php echo URL; ?>personal/guardarNuevoIngreso" method="POST" enctype="multipart/form-data" class="form-horizontal">
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
                    <input type="button" class="btn-sm btn-success" id="buscarEstudiante" value="Buscar"  style="display:block;"/>
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
<!--DATOS ACADEMICOS-->
<div class="jumbotron">
            
            <h4>DATOS ACADEMICOS</h4>
            <hr>
            <!--PRIMARIA REALIZADA-->
            <h4>Primaria</h4>
            <div class="form-group">
                <div class="col-xs-12">
                    <table class="table table-bordered table-hover" id="tablaEscuelas">
                        <tr>
                            <th class="col-xs-2">PROVINCIA</th>
                            <th class="col-xs-3">CANTON</th>
                            <th class="col-xs-3">DISTRITO</th>
                            <th class="col-xs-4">NOMBRE ESCUELA</th>
                        </tr>
                        <tr>
                            <td>
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
                            </td>
                            <td>
                                <select class="form-control input-sm validate[required]" name="slt_cantonPrim" id="slt_cantonPrim">
                                </select>
                            </td>
                            <td>
                                <select  class="form-control input-sm validate[required]" name="slt_distritoPrim" id="slt_distritoPrim">  
                                </select>
                            </td>
                            <td>
                                <select  class="form-control input-sm validate[required]" name="slt_primaria" id="slt_primaria"> 
                                </select>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <!--SECUNDARIA REALIZADA-->
            <h4>Secundaria</h4>
            <div class="form-group">
                <div class="col-xs-12">
                    <table class="table table-bordered table-hover" id="tablaColegios">
                        <tr>
                            <th class="col-xs-2">PROVINCIA</th>
                            <th class="col-xs-3">CANTON</th>
                            <th class="col-xs-3">DISTRITO</th>
                            <th class="col-xs-4">NOMBRE COLEGIO</th>
                        </tr>
                        <tr>
                            <td>
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
                            </td>
                            <td>
                                <select class="form-control input-sm validate[required]" name="slt_cantonSec" id="slt_cantonSec">
                                </select>
                            </td>
                            <td>
                                <select  class="form-control input-sm validate[required]" name="slt_distritoSec" id="slt_distritoSec">  
                                </select>
                            </td>
                            <td>
                                <select  class="form-control input-sm validate[required]" name="slt_secundaria" id="slt_secundaria"> 
                                </select>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <!--ESTUDIOS UNIVERSITARIOS-->
            <h4>Estudios Universitarios :</h4>
            <div class="form-group">
                <div class="col-xs-12">
                    <table class="table table-bordered table-hover" id="tablaUniversidades">
                        <tr>
                            <th class="col-xs-3">NOMBRE UNIVERSIDAD</th>
                            <th class="col-xs-2">GRADO ACADEMICO</th>
                            <th class="col-xs-5">NOMBRE TITULO</th>
                            <th class="col-xs-1">AÑO FIN.</th>
                            <th class="col-xs-1"></th>
                        </tr>
                        <tr>
                            <td>
                                <select class="form-control input-sm validate[required]" name="slt_nombreUniversidad">
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
                                <select class="form-control input-sm validate[required]" name="slt_gradoAcademico">
                                    <option value="0">SELECCIONE</option>
                                    <option value="1">Bachilleraato</option>
                                    <option value="2">Licenciatura</option>
                                    <option value="3">Maestria</option>
                                    <option value="4">Doctorado</option>
                                </select>
                            </td>
                            <td>
                                <input type="text" class="text-uppercase form-control input-sm validate[required]" name="txt_nombreTitulo"/>
                            </td>
                            <td>
                                <input type="text" class="form-control input-sm"  name="txt_anoFinaliza"/>
                            </td>
                            <td>
                                <!--<a href="javascript:void(0)" class="btn-eliminar-univ">Eliminar</a>-->
                                <input type="button" class="btn-sm btn-primary btn-eliminar-univ" value="Eliminar"/>
                            </td>
                        </tr>
                    </table>
                </div> 
            </div>
            <div class="form-group">
                <label class="col-xs-3 control-label">Agregar Otra Universidad ?</label>
                <div class="col-xs-2">
                    <input type="button" class="btn-sm btn-success" id="btnAgregarUniversidad" name="btnAgregarUniversidad" value="Aceptar"/>
                </div>
                <div class="col-xs-7"></div>
            </div>
            </div><!--CIERRE DE JUMBOTRON-->
            <!--JUMBOTRON3 PARA DATOS DE LA INSTITUCION-->
            <br><br>
            <h4>DATOS DE LA INSTITUCION</h4>
            <div class="jumbotron">
                <h4>DATOS DE LA INSTITUCION</h4>
                <hr>
                <div class="form-group">
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
                            <option value="11">11</option>
                            <option value="12">12</option>
                            <option value="13">13</option>
                            <option value="14">14</option>
                            <option value="15">15</option>
                            <option value="16">16</option>
                            <option value="17">17</option>
                            <option value="18">18</option>
                            <option value="19">19</option>
                            <option value="20">20</option>
                            <option value="21">21</option>
                            <option value="22">22</option>
                            <option value="23">23</option>
                            <option value="24">24</option>
                            <option value="25">25</option>
                            <option value="26">26</option>
                            <option value="27">27</option>
                            <option value="28">28</option>
                            <option value="29">29</option>
                            <option value="30">30</option>
                            <option value="31">31</option>
                            <option value="32">32</option>
                            <option value="33">33</option>
                            <option value="34">34</option>
                            <option value="35">35</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                <div class="col-xs-12">
                    <table class="table table-bordered table-hover" id="tablaPuestos">
                        <tr>
                            <th class="col-xs-2">AREA PERTENECE</th>
                            <th class="col-xs-4">PUESTO</th>
                            <th class="col-xs-1">CONDICION</th>
                            <th class="col-xs-1"></th>
                        </tr>
                        <tr>
                            <td>
                                <select  class="form-control input-sm validate[required]" name="slt_areapertenece"> 
                                    <option value="">SELECCIONE</option>
                                    <option value="0">Academica</option>
                                    <option value="1">Administrativa</option>
                                    <option value="2">Servicios</option>
                                </select>
                            </td>
                            <td>
                                <input type="text" class="form-control input-sm validate[required]"  id="txt_puesto" name="txt_puesto"/>
                            </td>
                            <td>CONDICION</td>
                            <td><input type="button" class="btn-sm btn-primary btn-eliminar-centroeducativo" value="Eliminar"/></td>
                        </tr>
                    </table>
                </div>
                <div class="form-group">
                    
                    <label for="txt_condicion" class="col-xs-2 control-label">Condición:</label>
                    <div class="col-xs-2">
                        <select  class="form-control input-sm validate[required]" name="sel_condicion" id="sel_condicion"> 
                            <option value="">SELECCIONE</option>
                            <option value="0">Interino(a)</option>
                            <option value="1">Propietario(a)</option>
                            <option value="2">Contrato</option>
                        </select>
                    </div>
                </div>
                
                <!--L23 Año ingreso-->
                <div class="form-group"> 
                    <label for="tf_NombradoPor" class="col-xs-2 control-label">Nombrado Por:</label>
                    <div class="col-xs-2">
                        <select class="form-control input-sm validate[required]" name="tf_NombradoPor" id="tf_NombradoPor">
                            <option value="">SELECCIONE</option>
                            <option value="0">Mep</option>
                            <option value="1">Junta Administrativa</option>
                            <option value="2">Contrato</option>
                        </select> 
                    </div>
                    <label for="txt_lecciones" class="col-xs-2 control-label">Total Lecciones:</label>
                    <div class="col-xs-2">
                        <input type="text" class="form-control input-sm validate[required]"  name="txt_lecciones"/>
                    </div>
                    <div class="col-xs-4"></div>
                </div>
                <div class="form-group">
                    <label for="txt_horasContrato" class="col-xs-2 control-label">N° Horas Contrato:</label>
                    <div class="col-xs-2">
                        <input type="text" class="form-control input-sm validate[required]"  name="txt_horasContrato"/>
                    </div>
                    <label for="txt_numerocontrato" class="col-xs-2 control-label">N° Contrato:</label>
                    <div class="col-xs-2">
                        <input type="text" class="form-control input-sm validate[required]"  name="txt_horasContrato"/>
                    </div>
                    <div class="col-xs-4"></div>
                </div>
                <div class="form-group">
                    <label for="txt_frigenombramiento" class="col-xs-2 control-label">Rige Nombramiento (Año-Mes-Día):</label>
                    <div class="col-xs-2">
                        <input type="text" class="form-control input-sm validate[required]"  id="txt_frigenombramiento" name="txt_frigenombramiento"/>
                    </div>
                    <label for="txt_fvencenombramiento" class="col-xs-2 control-label">Vence Nombramiento (Año-Mes-Día):</label>
                    <div class="col-xs-2">
                        <input type="text" class="form-control input-sm validate[required]"  id="txt_fvencenombramiento" name="txt_fvencenombramiento"/>
                    </div>
                    <div class="col-xs-2"></div>
                </div>
                <br>
                <!--CENTROS EDUCATIVOS DONDE HA LABORADO-->
            <h4>Centros Educativos donde ha Laborado:</h4>                
            <div class="form-group">
                <div class="col-xs-12">
                    <table class="table table-bordered table-hover" id="tablaCentros">
                        <tr>
                            <th class="col-xs-10">NOMBRE CENTRO EDUCATIVO</th>
                            <th class="col-xs-2"></th>
                        </tr>
                        <tr>
                            <td><input type="text" class="form-control input-sm validate[required]" name="txt_CentrosLaborados"/></td>
                            <td><input type="button" class="btn-sm btn-primary btn-eliminar-centroeducativo" value="Eliminar"/></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-3 control-label">Agregar Otro Centro ?</label>
                <div class="col-xs-2">
                    <input type="button" class="btn-sm btn-success" id="btnAgregarCentro" name="btnAgregarUniversidad" value="Aceptar"/>
                </div>
                <div class="col-xs-7"></div>
            </div>
            </div><!--CIERRE DE JUMBOTRON3-->
        </fieldset>
        <!--USUARIO QUE ATENDIO AL FUNCIONARIO-->
        <div class="form-group"> 
            <label class="col-xs-2 control-label">NOMBRE FUNCIONARIO:</label>
            <div class="col-xs-4">
                <label class="control-label"><?php echo $_SESSION['nombre']; ?></label>
            </div>
            <label class="col-xs-2 control-label">FIRMA:</label>
            <div class="col-xs-4">
                <label class="control-label">______________________________</label>
            </div>
        </div>
        <div class="form-group"> 
            <label for="tf_AtendidoPor" class="col-xs-2 control-label">ATENDIDO POR:</label>
            <div class="col-xs-4">
                <label class="control-label"><?php echo $_SESSION['nombre']; ?></label>
            </div>
            <label for="tf_AtendidoPor" class="col-xs-2 control-label">FIRMA:</label>
            <div class="col-xs-4">
                <label class="control-label">______________________________</label>
            </div>
        </div>
        <div class="form-group"> 
            <label for="tf_AtendidoPor" class="col-xs-2 control-label">FECHA:</label>
            <div class="col-xs-4">
                <!--<label class="control-label"><?php echo Date("d/m/Y") ?></label>-->
                <label id="time" class="control-label"></label>
            </div>
            <label for="tf_AtendidoPor" class="col-xs-6 control-label">(NULO SIN SELLO RESPECTIVO)</label>
        </div>
        <br><br>
        <!--IMPRIMIR Y GUARDAR REGISTRO-->
        <div class="form-group"> 
            <div class="col-xs-12 text-center">
                <input type="submit" class="btn-sm btn-success" id="btnguardar" value="Guardar e Imprimir Comprobante"/>
            </div>
        </div>
        <br><br>
    </form>
<!--///////////////////////////////////////////////////////////////////////////////-->
<!-- Modal -->
<div id="myModal" class="modal face" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Error</h4>
            </div>
            <div class="modal-body">
                <p>Debe ingresar como minimo un titulo universitario...</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-sm btn-success" data-dismiss="modal">Cerrar</button>
            </div>
        </div>

    </div>
</div>