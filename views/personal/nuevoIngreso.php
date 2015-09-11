<?php
//print_r($this->especialidadEstudiante);
//die;
?>
<h4>DATOS DEL PERSONAL</h4>
<hr>
<div class="row">
    <form id="MyForm" action="<?php echo URL; ?>personal/guardarNuevoIngreso" method="POST" enctype="multipart/form-data" class="form-horizontal">
        <fieldset>
            <legend class="text-center">DATOS DEL PERSONAL</legend>
            <!--L1 Cedula y Genero *Nacionalidad (Nuevo)(Formulario Hugo)-->
            <div class="form-group"> 
                <label for="slt_nacionalidad" class="col-xs-2 control-label">Nacionalidad:</label>
                <div class="col-xs-2">
                    <select class="form-control input-sm" name="slt_nacionalidad" id="slt_nacionalidad">
                        <option value="506">Costa Rica</option>
                        <?php
                        foreach ($this->consultaPaises as $value) {
                            echo "<option value='" . $value['codigoPais'] . "'>";
                            echo $value['nombrePais']."</option>";
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
                            <option value="">Seleccione</option>
                                <option value="0">Femenino</option>
                                <option value="1" >Masculino</option>
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
                <!--L5 Domicilio (Formulario Hugo)-->
                <div class="form-group">
                    <label for="txta_domicilio" class="col-xs-2 control-label">Domicilio:</label>
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
                <!--Domicilio durante el periodo lectivo-->
                <div class="form-group">
                    <label for="txta_domicilioClases" class="col-xs-2 control-label">Domicilio durante periodo lectivo:</label>
                    <div class="col-xs-10">
                        <textarea class="form-control validate[required]" rows="1" name="txta_domicilioClases" id="txta_domicilioClases"></textarea>
                    </div>
                    <div class="col-xs-4"></div>
                </div>
                <!--L6 Provincia, Canton, Distrito (Formulario Hugo)-->
                <div class="form-group">
                    <label for="slt_provinciaClases" class="col-xs-2 control-label">Provincia:</label>
                    <div class="col-xs-2">
                        <select class="form-control input-sm validate[required]" name="slt_provinciaClases" id="slt_provinciaClases">
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
                <!--L7 Primaria y Colegio (Formulario Hugo)
                <div class="form-group">
                    <label for="tf_primaria" class="col-xs-2 control-label">Primaria:</label>
                    <div class="col-xs-2">
                        <input type="text" class="form-control input-sm validate[required]" name="tf_primaria" id="tf_primaria" />
                    </div>
                </div>
                -->
                <!--L8 Enfermedad (Formulario Hugo)-->
                <div class="form-group">
                    <label for="slt_enfermedad" class="col-xs-2 control-label">¿Padece alguna enfermedad?</label>
                    <div class="col-xs-2">
                        <select  class="form-control input-sm" name="slt_enfermedad" id="slt_enfermedad"> 
                            <option value="0" selected>No</option> 
                            <option value="1">Si</option>
                        </select>
                    </div>
                    <label for="txt_enfermedadDesc" class="col-xs-2 control-label">Especifique</label>
                    <div class="col-xs-2">
                        <input type="text" class="form-control input-sm" name="txt_enfermedadDesc" id="txt_enfermedadDesc"/>
                    </div>
                </div>
                <br><br>
                <!--/////////////////////////////////////////////////////////-->
                <legend class="text-center">DATOS ACADEMICOS</legend>
                
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
                <!--///////////////////////////////////////////////////////////-->
                <h4>Primaria</h4>
                <!--L10 Primaria secundarias--> 
                <div class="form-group">
                    <label for="slt_provinciaPrim" class="col-xs-1 control-label">Provincia:</label>
                    <div class="col-xs-2">
                        <select class="form-control input-sm validate[required]" name="slt_provinciaPrim" id="slt_provinciaPrim">
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
                <!--///////////////////////////////////////////////////////////-->
                <h4>Secundaria</h4>
                <!--L10 Primaria secundarias--> 
                <div class="form-group">
                    <label for="slt_provinciaSec" class="col-xs-1 control-label">Provincia:</label>
                    <div class="col-xs-2">
                        <select class="form-control input-sm validate[required]" name="slt_provinciaSec" id="slt_provinciaSec">
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
                <br>
                <!--///////////////////////////////////////////////////////////-->
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
                    <label for="txtnombreTitulo" class="col-xs-2 control-label">Nombre Titulo:</label>
                    <div class="col-xs-2">
                        <input type="text" class="text-uppercase form-control input-sm validate[required]" name="txtnombreTitulo" id="txtnombreTitulo"/>
                    </div>
                    <label for="tf_anoFinaliza" class="col-xs-2 control-label">Año Finaliza:</label>
                    <div class="col-xs-2">
                        <input type="text" class="form-control input-sm"  id="tf_anoFinaliza" name="tf_anoFinaliza"/>
                    </div>
                    <div class="col-xs-2"></div>
                </div>
                <div id="AgregarUniversidad"></div>
                <div class="form-group">
                    <div class="col-xs-2"></div>
                    <div class="col-xs-2">
                        <input type="button" class="btn-sm btn-success" id="btnAgregarUniversidad" name="btnAgregarUniversidad" value="Agregar más"/>
                    </div>
                    <div class="col-xs-8"></div>
                </div>
                <br>
                <div class="col-xs-12">
                        <table class="table table-condensed table-striped" id="tablaUniversidades"></table>
                </div>
                <!--////////////////////////////////////////////////////////////////-->
                <br><br>
                <div class="form-group"> 
                    <label for="tf_AtendidoPor" class="col-xs-2 control-label">Atendido Por:</label>
                    <label for="tf_AtendidoPor" class="col-xs-3 control-label"><?php echo $_SESSION['nombre'];?></label>                  
                </div>
            <br><br>
            <!--L25 Imprimir y Guardar (Formulario Hugo)-->
            <div class="form-group"> 
                <div class="col-xs-12 text-center">
                    <input type="submit" class="btn-sm btn-success" id="btnguardar" value="Guardar e Imprimir" />
                </div>
            </div>
        </fieldset>
        <hr>
    </form>
</div>