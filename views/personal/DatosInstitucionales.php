<br><br>
<!--JUMBOTRON3 PARA DATOS DE LA INSTITUCION-->

<form id="MyFormS" action="<?php echo URL; ?>personal/GuardarNuevoIngreso" method="POST" enctype="multipart/form-data" class="form-horizontal">
    <fieldset>
        <div class="jumbotron">
            <h4>DATOS DE LA INSTITUCION</h4>
            <hr>
            <!-----------1-------------->
            <div class="form-group">
                <label for="slt_areaPertenece" class="col-xs-2 control-label">Area Pertenece:</label>
                <div class="col-xs-2">
                    <select  class="form-control input-sm validate[required]" name="slt_areaPertenece" id="slt_areaPertenece"> 
                        <option value="">SELECCIONE</option>
                        <option value="0">Tecnico Docente</option>
                        <option value="1">Docente Academico</option>
                        <option value="2">Administrativa</option>
                        <option value="3">Servicios</option>
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
            <!-----------2-------------->
            <div class="form-group">
                <label for="slt_puesto" class="col-xs-2 control-label">Puesto:</label>
                <div class="col-xs-2">
                    <select  class="form-control input-sm validate[required]" name="slt_areaPertenece" id="slt_areaPertenece"> 
                        <option value="">SELECCIONE</option>
                        <option value="0">Tecnico Docente</option>
                        <option value="1">Docente Academico</option>
                        <option value="2">Administrativa</option>
                        <option value="3">Servicios</option>
                    </select>
                </div>
                <label for="tf_NombradoPor" class="col-xs-2 control-label">Nombrado Por:</label>
                <div class="col-xs-2">
                    <select class="form-control input-sm validate[required]" name="tf_NombradoPor" id="tf_NombradoPor">
                        <option value="">SELECCIONE</option>
                        <option value="0">Mep</option>
                        <option value="1">Junta Administrativa</option>
                        <option value="2">Contrato</option>
                    </select> 
                </div>
                <label for="slt_condicion" class="col-xs-2 control-label">Condición:</label>
                <div class="col-xs-2">
                    <select  class="form-control input-sm validate[required]" name="slt_condicion" id="slt_condicion"> 
                        <option value="">SELECCIONE</option>
                        <option value="0">Interino(a)</option>
                        <option value="1">Propietario(a)</option>
                        <option value="2">Contrato</option>
                    </select>
                </div>
            </div>
            <!-----------3-------------->
            <div class="form-group">
                <label for="txt_lecciones" class="col-xs-2 control-label">Total Lecciones:</label>
                <div class="col-xs-2">
                    <input type="text" class="form-control input-sm validate[required]"  name="txt_lecciones"/>
                </div>
                <div class="col-xs-8"></div>
            </div>    
            <!-----------4-------------->
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
            <!-----------5-------------->
            <div class="form-group">
                <label for="txt_frigenombramiento" class="col-xs-2 control-label">Rige Nombramiento (Año-Mes-Día):</label>
                <div class="col-xs-2">
                    <input type="text" class="form-control input-sm validate[required]"  id="txt_frigenombramiento" name="txt_frigenombramiento"/>
                </div>
                <label for="txt_fvencenombramiento" class="col-xs-2 control-label">Vence Nombramiento (Año-Mes-Día):</label>
                <div class="col-xs-2">
                    <input type="text" class="form-control input-sm validate[required]"  id="txt_fvencenombramiento" name="txt_fvencenombramiento"/>
                </div>
                <div class="col-xs-4"></div>
            </div>
            <!-----------6-------------->
            <br><br>
            <!--CENTROS EDUCATIVOS DONDE HA LABORADO-->
            <h4>Último Centro Educativo Donde Ha Laborado:</h4>                
            <div class="form-group">
                <label for="txt_CentroLaborado" class="col-xs-2 control-label">Nombre:</label>        
                <div class="col-xs-2">            
                    <input type="text" class="form-control input-sm validate[required]" name="txt_CentroLaborado" id="txt_CentroLaborado"/>              
                </div>
                <div class="col-xs-8">
                </div>
            </div>
    </fieldset>
    <!--IMPRIMIR Y GUARDAR REGISTRO-->
    <div class="form-group"> 
        
        <div class="col-xs-12 text-center">
            <input type="submit" class="btn-sm btn-success" id="btnComprobante" value="Imprimir Comprobante"/>
            <input type="submit" class="btn-sm btn-primary" id="btnSalir" value="Salir Inicio"/>
        </div>
    </div>
    <br><br>
    </div><!--Cierre de jumbotron-->       
</form>
