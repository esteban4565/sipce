<center>
<h2>REGISTRO INSTITUCIONAL</h2>
    <?php
    switch ($this->estado){
        case "0":{
        ?>
            <table class="ListaDetalle" WIDTH="80%">
                <tr>
                    <th>CEDULA</th>
                    <th>NOMBRE COMPLETO</th>
                    <th>FECHA NACIMIENTO</th>
                    <th>GENERO</th>
                    <th>ROL</th>
                </tr>
                <tr>
                    <td><?php echo $this->personaList[0]['cedulaP']?></td>
                    <td><?php echo $this->personaList[0]['ape1P'].'  '.$this->personaList[0]['ape2P'].'  '.$this->personaList[0]['nombreP'];?></td>
                    <td><?php echo $this->personaList[0]['fnacimientoP']?></td>
                    <td><?php echo $this->personaList[0]['sexoP']?></td>
                    <td><?php echo $this->personaList[0]['roleP']?></td>
                </tr>
            </table>
            <form id="myForm" action="<?php echo URL; ?>persona/create" method="POST">

                <table class="vistaDetalle" WIDTH="80%">
                    <tr>
                        <th colspan="6"><div id='infoDiv' class='paso1 mesages'>DATOS ACADEMICOS</div>
                        </th>
                    </tr>
                    <tr>
                        <td colspan="6"></td>
                    </tr>
                    <tr>
                        <td>Estudios realizados:</td>
                        <td>
                            <select name="tf_estudios">
                                <option value="">Seleccione nivel</option>
                                <option value="P">Primara</option>
                                <option value="S">Secundaria</option>
                                <option value="U">Universidad</option>
                                <option value="N">Ninguno</option>
                            </select>
                        </td>
                        <td>Grupo profesional:</td>
                        <td colspan="3">
                            <select name="tf_grupoprofesional">
                                <option value="">Seleccione grupo</option>
                                <option value="ASP">Aspirante</option>
                                <option value="VAU-1">VAU-1</option>
                                <option value="VAU-2">VAU-2</option>
                                <option value="MT1">MT-1</option>
                                <option value="MT2">MT-2</option>
                                <option value="MT3">MT-3</option>
                                <option value="MT4">MT-4</option>
                                <option value="MT5">MT-5</option>
                                <option value="MT6">MT-6</option>
                                <option value="VT-1">VT-1</option>
                                <option value="VT-2">VT-2</option>
                                <option value="VT-3">VT-3</option>
                                <option value="VT-4">VT-4</option>
                                <option value="VT-5">VT-5</option>
                                <option value="VT-6">VT-6</option>
                                <option value="N">Ninguno</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Ultimo grado academico:</td>
                        <td>
                           <select name="tf_ugradoacademico">
                                    <option value="">Seleccione nivel</option>
                                    <option value="1">Profesorado</option>
                                    <option value="2">Bachillerato</option>
                                    <option value="3">Licenciatura</option>
                                    <option value="4">Maestria</option>
                                    <option value="5">Doctorado</option>
                                    <option value="6">Ninguno</option>
                           </select> 
                        </td>
                        <td>Anualidades:</td>
                        <td colspan="3">
                           <select name="tf_anualidades">
                                    <option value="">Seleccione anualidad</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="1">7</option>
                                    <option value="2">8</option>
                                    <option value="3">9</option>
                                    <option value="4">10</option>
                                    <option value="5">11</option>
                                    <option value="6">12</option>
                                    <option value="1">13</option>
                                    <option value="2">14</option>
                                    <option value="3">15</option>
                                    <option value="4">16</option>
                                    <option value="5">17</option>
                                    <option value="6">18</option>
                                    <option value="1">19</option>
                                    <option value="2">20</option>
                                    <option value="2">21</option>
                                    <option value="2">22</option>
                                    <option value="2">23</option>
                                    <option value="2">24</option>
                                    <option value="2">25</option>
                                    <option value="2">26</option>
                                    <option value="2">27</option>
                                    <option value="2">28</option>
                                    <option value="2">29</option>
                                    <option value="2">30</option>
                                    <option value="2">31</option>                         
                           </select> 
                        </td>
                    </tr>
                    <tr>
                        <td>Primaria realizada en:</td>
                        <td><input type="text" name="tf_primariahecha" class="validate[required]"/></td>
                        <td>Año:</td>
                        <td colspan="3"><input type="text" name="tf_secundariaano" class="validate[required]"/></td>
                    </tr>
                    <tr>
                        <td>Secundaria realizada en:</td>
                        <td><input type="text" name="tf_secundariahecha" class="validate[required]"/></td>
                        <td>Año:</td>
                        <td colspan="3"><input type="text" name="tf_secundariaano" class="validate[required]"/></td>
                    </tr>
                    <tr>
                        <td>Tel. Celular:</td>
                        <td><input type="text" name="tf_telcelular" class="validate[required]"/></td>
                        <td>Tel. Casa:</td>
                        <td colspan="3"><input type="text" name="tf_telcasa" class="validate[required]"/></td>
                    </tr>
                    <tr>
                        <td>Domicilio durante tiempo lectivo:</td>
                        <td colspan="5">
                            <textarea name="tf_domicilio" class="validate[required]"></textarea>
                    </tr>
                    <tr>
                        <td>Provincia:</td>
                        <td><input type="text" name="tf_provincia" class="validate[required]"/></td>
                        <td>Canton:</td>
                        <td><input type="text" name="tf_canton" class="validate[required]"/></td>
                        <td>Distrito:</td>
                        <td><input type="text" name="tf_distrito" class="validate[required]"/></td>
                    </tr>
                    <tr>
                        <td>Correo electronico MEP:</td>
                        <td><input type="text" name="tf_provincia" class="validate[required]"/></td>
                        <td>Correo electronico personal:</td>
                        <td colspan="3"><input type="text" name="tf_canton" class="validate[required]"/></td>
                    </tr>
                </table>
                <br>
                <br>
                <br>
                <!-------------------------DATOS DE EXPERIENCIA--------------------------------->
                <table class="vistaDetalle" WIDTH="80%">
                    <tr>
                        <th colspan="6"><div id='infoDiv' class='paso2 mesages'>CENTROS EDUCATIVOS DONDE HA LABORADO</div></th>
                    </tr>
                </table>
                <br>
                <br>
                <br>
                <!-------------------------DATOS DE LA INSTITUCION------------------------------>
                
                <table class="vistaDetalle" WIDTH="80%">
                    <tr>
                        <th colspan="6"><div id='infoDiv' class='paso3 mesages'>DATOS DE LA INSTITUCION</div></th>
                    </tr>
                    <tr>
                        <td colspan="6"></td>
                    </tr>
                    <tr>
                        <td>Departamento:</td>
                        <td>
                            <select name="tf_estudios">
                                <option value="">Seleccione departamento</option>
                                <option value="1">Administrativos</option>
                                <option value="S">Docentes academicos</option>
                                <option value="U">Docentes tecnicos</option>
                                <option value="N">Junta administrativa</option>
                            </select>
                        </td>
                        <td>Puesto:</td>
                        <td>
                            <select name="tf_grupoprofesional">
                                <option value="">Seleccione puesto</option>
                                <option value="1">Direccion</option>
                                <option value="2">Sub-Direccion</option>
                                <option value="3">Coordinador tecnico</option>
                                <option value="4">Coordinador con la empresa</option>
                                <option value="5">Coordinador academico</option>
                                <option value="6">Auxiliar administrativo</option>
                                <option value="7">Secretaria</option>
                                <option value="8">Biblioteca</option>
                                <option value="9">Orientacion</option>
                                <option value="10">Miscelaneos</option>
                                <option value="11">Direccion</option>
                            </select>
                        </td>
                        <td>Condicion:</td>
                        <td>
                           <select name="tf_condicion">
                                    <option value="">Seleccione condicion</option>
                                    <option value="1">Interino</option>
                                    <option value="2">Propiedad</option>
                                    <option value="3">Contratado</option>
                           </select> 
                        </td>
                    </tr>
                    <tr>
                        <td>Año de ingreso:</td>
                        <td>
                            <select name="tf_anualidades">
                                    <option value="">Seleccione anualidad</option>
                                    <option value="">2014</option>
                                    <option value="">2013</option>
                                    <option value="">2012</option>
                                    <option value="">2011</option>
                            </select> 
                        </td>
                        <td>Nombrado por:</td>
                        <td colspan="3">
                            <select name="tf_nombradopor">
                                <option value="">Seleccione nombramiento</option>
                                <option value="">M.E.P</option>
                                <option value="">Junta Administrativa</option>
                                <option value="">Cooperativa</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Horas contrato:</td>
                        <td><input type="text" name="tf_hcontrato" class="validate[required]"/></td>
                        <td>Año:</td>
                        <td><input type="text" name="tf_secundariaano" class="validate[required]"/></td>
                        <td>Contrato N°:</td>
                        <td><input type="text" name="tf_ncontrato" class="validate[required]"/></td>
                    </tr>
                    <tr>
                        <td>Funcionario:</td>
                        <td>
                            <input type="text" name="tf_secundariahecha" class="validate[required]"/>
                        </td>
                        <td>Firma:</td>
                        <td colspan="3">
                            <input type="text" name="tf_secundariaano" class="validate[required]"/>
                        </td>
                    </tr>
                    <tr>
                        <td>Atendido por:</td>
                        <td><input type="text" name="tf_atenpor" class="validate[required]"/></td>
                        <td>Firma:</td>
                        <td colspan="3"><input type="text" name="tf_telcasa" class="validate[required]"/></td>
                    </tr>
                    <tr>
                        <td>Fecha:</td>
                        <td colspan="5"><input type="text" name="tf_telcasa" class="validate[required]"/></td>
                    </tr>
                </table>
                <br/>
                <br/>
                <input type="submit" value="Guardar"/>
                <input type="reset" value="Cancelar"/>
            </form>
            <?php    
        }
             
        break;
        case "1":
            echo "<div id='infoDiv' class='alerta mesages'>".$this->msg."</div>";  
        break;
        case "2":
            echo "<div id='infoDiv' class='error mesages'>".$this->msg."</div>";
        break;
        case "3":
            echo "<div id='infoDiv' class='error mesages'>".$this->msg."</div>";
        break;
    }
    ?>
<br>
<br>
<hr/>
<br>
<br>
</center>