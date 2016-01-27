<div class="row">
    <h2>Distribución Estudiantes por Distrito</h2>
    <h3>Nivel: <?php echo $this->nivel; ?>°</h3>
    <label id="nivel" style="display:none;"><?php echo $this->nivel; ?></label>
</div>
<div class="row">
    <div class="col-xs-6">
    <table class="table table-condensed">
        <thead>
        <tr><th>Dirección Geografica</th><th>Cantidad de Estudiantes</th></tr>
        </thead>
        <tbody>
    <?php
    $totalEstudiantes=0;
    foreach ($this->consultaEstadisticaZona as $key => $value) {
        echo '<tr><td>' .  $value['nombreProvincia'] . ', ' . $value['nombreCanton'] . ', ' . $value['nombreDistrito'] . '</td><td>' . $value['cantidadEstudiantes'] . '</td></tr>';
        $totalEstudiantes=$totalEstudiantes+$value['cantidadEstudiantes'];
    }
    ?>
        <tr><td>Total:</td><td><?php echo $totalEstudiantes; ?></td></tr>
        </tbody>
    </table>
    </div>
</div>
<div class="row">
    <h2>Configuración Conjunto Secciones</h2>
</div>

<?php
//print_r($this->consultaZonasEscuelas);
//die;
?>
<form id="MyForm" action="#" method="POST" class="form-horizontal">
<div class="form-group">
    <label for="tf_Zonas" class="col-xs-3 col-md-1 text-right control-label">Zona:</label>
    <div class="col-xs-3 col-md-2">
        <input type="text" class="form-control input-sm" name="txt_zona" id="txt_zona"/>
    </div>
    <div class="col-xs-3 col-md-2">
        <input type="button" class="btn-sm btn-success" id="agregarZona" value="Agregar Zona"  style="display:block;"/>
    </div>
</div>
<div class="form-group">
    <div class="col-xs-6 col-md-3">
        <table class="table table-condensed" id="zonasGuardadas">
            <?php
                foreach ($this->consultaZonasEscuelas as $value) {
                    ?>
                    <tr><td><?php echo $value['descripcion']; ?></td><td><input type="button" class="btn-sm btn-primary eliminarZona" value="Eliminar" rel="<?php echo $value['id']; ?>" /></td></tr>
                    <?php
                }
                ?>  
        </table>
    </div>
</div>
<div class="row">  
    <h2>Definir Zonas por Escuela o Distrito</h2>
    <input type="radio" name="rb_zona" id="rb_zona" value="Escuela">Escuela<br>
    <input type="radio" name="rb_zona" id="rb_zona" value="Distrito">Distrito<br>
</div> 
<div id="zonasPorEscuela" style="display:none;">
    <div class="row">  
        <h2>Agregar Escuela a Zona Seleccionada</h2>
    </div> 
    <div class="form-group">
        <label for="tf_Zonas" class="col-xs-3 col-md-1 text-right control-label">Zona:</label>
        <div class="col-xs-3 col-md-3">
            <select class="form-control input-sm" name="sl_Zonas" id="sl_Zonas">
                <option value="">Seleccione</option>
                <?php
                foreach ($this->consultaZonasEscuelas as $value) {
                    ?>
                    <option value="<?php echo $value['id']; ?>"><?php echo $value['descripcion']; ?></option>
                    <?php
                }
                ?>  
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="slt_provinciaPrim" class="col-xs-2 col-md-1 text-right control-label">Provincia:</label>
        <div class="col-xs-2 col-md-3 text-left">
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
        <label for="slt_cantonPrim" class="col-xs-2 control-label">Canton:</label>
        <div class="col-xs-2">
            <select class="form-control input-sm validate[required]" name="slt_cantonPrim" id="slt_cantonPrim">

            </select>
        </div>
        <label for="slt_distritoPrim" class="col-xs-2 control-label">Distrito:</label>
        <div class="col-xs-2">
            <select  class="form-control input-sm validate[required]" name="slt_distritoPrim" id="slt_distritoPrim">  

            </select>
        </div>
    </div>

    <div class="form-group">
        <label for="slt_primaria" class="col-xs-2 col-md-1 control-label">Escuela:</label>
        <div class="col-xs-3 col-md-3">
            <select  class="form-control input-sm validate[required]" name="tf_primaria" id="tf_primaria"> 
                <option value="0">Ninguna</option>
            </select>
        </div>
        
        <div class="col-xs-3 col-md-2">
            <input type="button" class="btn-sm btn-success" id="agregarEscuela" value="Agregar Escuela"  style="display:block;"/>
        </div>
    </div>
</div>

<div id="zonasPorDistrito" style="display:none;">
    <div class="row">  
        <h2>Agregar Distrito a Zona Seleccionada</h2>
    </div> 
    <div class="form-group">
        <label for="tf_ZonasDistrito" class="col-xs-3 col-md-1 text-right control-label">Zona:</label>
        <div class="col-xs-3 col-md-3">
            <select class="form-control input-sm" name="sl_ZonasDistrito" id="sl_ZonasDistrito">
                <option value="">Seleccione</option>
                <?php
                foreach ($this->consultaZonasEscuelas as $value) {
                    ?>
                    <option value="<?php echo $value['id']; ?>"><?php echo $value['descripcion']; ?></option>
                    <?php
                }
                ?>  
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="slt_provincia" class="col-xs-2 col-md-1 text-right control-label">Provincia:</label>
        <div class="col-xs-2 col-md-3 text-left">
            <select class="form-control input-sm validate[required]" name="slt_provincia" id="slt_provincia">
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
        <label for="slt_canton" class="col-xs-2 control-label">Canton:</label>
        <div class="col-xs-2">
            <select class="form-control input-sm validate[required]" name="slt_canton" id="slt_canton">

            </select>
        </div>
        <label for="slt_distrito" class="col-xs-2 control-label">Distrito:</label>
        <div class="col-xs-2">
            <select  class="form-control input-sm validate[required]" name="slt_distrito" id="slt_distrito">  

            </select>
        </div>
    </div>

    <div class="form-group">
        <div class="col-xs-3 col-md-2">
            <input type="button" class="btn-sm btn-success" id="agregarDistrito" value="Agregar Distrito"  style="display:block;"/>
        </div>
    </div>
</div>
    
<div class="form-group" id="resumenZonasPorEscuela" style="display:none;">
    <div class="col-xs-6 col-md-3">
        <table class="table table-condensed" id="escuelasZonaGuardadas">
        </table>
    </div>
</div>
    
<div class="form-group" id="resumenZonasPorDistrito" style="display:none;">
    <div class="col-xs-6 col-md-3">
        <table class="table table-condensed" id="distritosZonaGuardadas">
        </table>
    </div>
</div>
<div class="row">  
    <h2>Seleccione la cantidad de secciones por Zona</h2>
    <div class="form-group">
        <label for="sl_ZonasSecciones" class="col-xs-3 col-md-1 text-right control-label">Zona:</label>
        <div class="col-xs-3 col-md-3">
            <select class="form-control input-sm" name="sl_ZonasSecciones" id="sl_ZonasSecciones">
                <option value="">Seleccione</option>
                <?php
                foreach ($this->consultaZonasEscuelas as $value) {
                    ?>
                    <option value="<?php echo $value['id']; ?>"><?php echo $value['descripcion']; ?></option>
                    <?php
                }
                ?>  
            </select>
        </div>
        <div class="col-xs-3 col-md-3">
            <select class="form-control input-sm" name="sl_CantidadSecciones" id="sl_CantidadSecciones">
                <option value="">Seleccione</option>
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

    <div class="form-group">
        <div class="col-xs-3 col-md-2">
            <input type="button" class="btn-sm btn-success" id="agregarCantidadSecciones" value="Agregar/Modificar Cantidad Secciones"/>
        </div>
    </div>

    <div class="form-group">
        <div class="col-xs-3 col-md-2">
            <table class="table table-condensed" id="cantidadSeccionesGuardadas">
                <thead>
                <tr><th colspan="2">Estado Actual</th></tr>
                </thead>
                <tbody>
                <?php
                foreach ($this->consultaSeccionesZona as $key => $value) {
                    echo '<tr><td>' .  $value['descripcion'] . '</td><td>' . $value['cantidadSecciones'] . '</td></tr>';
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="form-group">
        <div class="col-xs-6">
            <input type="button" class="btn-sm btn-danger" id="proyectarSeccionesOpcionB" value="Proyectar Secciones"/>
        </div>
    </div>
    
<div class="form-group col-xs-8" id="resumenSecciones" >
</div>
</div> 
</form>