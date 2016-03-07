<div class="row">
    <form id="MyForm" action="<?php echo URL; ?>actualizarestudiantes/guardarIngresarPersonal" method="POST" enctype="multipart/form-data" class="form-horizontal">
        <fieldset>
            <legend class="text-center">Ingreso Rápido de Personal</legend>
            <div class="form-group"> 
                <label for="tf_nacionalidad" class="col-xs-2 control-label">Nacionalidad:</label>
                <div class="col-xs-2">
                    <select class="form-control input-sm" name="tf_nacionalidad" id="tf_nacionalidad">
                        <option value="506">COSTA RICA</option>
                        <?php
                        foreach ($this->consultaPaises as $value) {
                            echo "<option value='" . $value['codigoPais'] . "'>";
                            echo $value['nombrePais']."</option>";
                        }
                            ?>
                        </select> 
                </div>
                <label for="tf_cedula" class="col-xs-2 control-label">Identificación:</label>
                <div class="col-xs-2">
                    <input type="text" class="text-uppercase form-control input-sm validate[required]" name="tf_cedula" id="tf_cedula"/>
                </div>
                <div class="col-xs-2">
                    <input type="button" class="btn-sm btn-success" id="buscarPersona" value="Buscar"  style="display:block;"/>
                </div>
            </div>
            <div class="form-group">
                    <label for="tf_ape1" class="col-xs-2 control-label">1er apellido:</label>
                    <div class="col-xs-2">
                        <input type="text" class="text-uppercase form-control input-sm validate[required]"  id="tf_ape1" name="tf_ape1"/>
                    </div>
                    <label for="tf_ape2" class="col-xs-2 control-label">2do apellido:</label>
                    <div class="col-xs-2">
                        <input type="text" class="text-uppercase form-control input-sm"  id="tf_ape2" name="tf_ape2"/>
                    </div>
                    <label for="tf_nombre" class="col-xs-2 control-label">Nombre completo:</label>
                    <div class="col-xs-2">
                        <input type="text" class="text-uppercase form-control input-sm validate[required]"  id="tf_nombre" name="tf_nombre"/>
                    </div> 
            </div>
            <div class="form-group">
                    <label for="tf_fnacpersona" class="col-xs-2 control-label">Fecha de Nacimiento (Año-Mes-Día):</label>
                    <div class="col-xs-2">
                        <input type="text" class="form-control input-sm validate[required]"  id="tf_fnacpersona" name="tf_fnacpersona"/>
                    </div>
                    <label for="tf_genero" class="col-xs-2 control-label">Género:</label>
                    <div class="col-xs-2">
                        <select class="form-control input-sm validate[required]" name="tf_genero" id="tf_genero">
                            <option value="">Seleccione</option>
                                <option value="0">Femenino</option>
                                <option value="1" >Masculino</option>
                        </select> 
                    </div>
                    <label for="tf_rol" class="col-xs-2 control-label">Rol:</label>
                    <div class="col-xs-2">
                        <select class="form-control input-sm validate[required]" name="tf_rol" id="tf_rol">
                            <option value="">Seleccione</option>
                                <option value="2">Administrativo</option>
                                <option value="3" >Docente</option>
                        </select> 
                    </div>
            </div>
            <div class="form-group"> 
                <div class="col-xs-12 text-center">
                    <input type="submit" class="btn btn-primary" id="guardar" value="Guardar" />
                </div>
            </div>
        </fieldset>
    </form>
</div>