<br><br>
<!--DATOS PERSONALES-->
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

<!----------------------------------------------------------------------------------------->
<!--JUMBOTRON3 PARA DATOS DE LA INSTITUCION-->
<br><br>
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
    <br><br>
    <!--CENTROS EDUCATIVOS DONDE HA LABORADO-->
    <h4>Último Centro Educativo Donde Ha Laborado:</h4>                
    <div class="form-group">
        <label for="txt_CentroLaborado" class="col-xs-2 control-label">Nombre:</label>        
        <div class="col-xs-2">            
            <input type="text" class="form-control input-sm validate[required]" name="txt_CentroLaborado" id="txt_CentroLaborado"/>              
        </div>
    </div>
    
</div><!--Cierre de jumbotron