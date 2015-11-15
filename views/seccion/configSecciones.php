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
    
<div class="form-group">
    <div class="col-xs-6 col-md-3">
        <table class="table table-condensed" id="escuelasZonaGuardadas">
        </table>
    </div>
</div>
</form>