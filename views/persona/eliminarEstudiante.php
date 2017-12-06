<div class="row">
    <div class="col-xs-3">
        Búsqueda por identificación:
    </div>
    <div class="col-xs-2">
        <input type="text" class="input-sm" name="ced_estudiante" id="ced_estudiante" />
    </div>
    <div class="col-xs-2">
        <input type="button" class="btn btn-success" id="buscarEstudianteEliminar" value="Buscar" />
    </div>
    <div class="col-xs-offset-7"></div>
    <div class="col-xs-12"><br></div>
</div>
<?php if ($this->mensaje != '') { ?>
    <div class="row">
        <div class="alert alert-success" role="alert" id="msj">
            <div class="container"><?php echo $this->mensaje; ?></div>
        </div>
    </div>

<?php } else { ?>
    <div class="row">
        <div class="alert alert-success" role="alert" style="display:none;" id="msj">
            <div class="container"><?php echo $this->mensaje; ?></div>
        </div>
    </div>
<?php } ?>
<div class="row">
    <div class="col-xs-12 text-center">
        <h2>Módulo becas estudiantiles</h2>
    </div>
</div>
<div class="row">
    <form id="MyForm" action="<?php echo URL; ?>persona/eliminarEstudiante" method="POST" enctype="multipart/form-data" class="form-horizontal">
        <fieldset>
            <legend class="text-center">Eliminar estudiante</legend>
            <div class="form-group">
                <label class="col-xs-2 control-label">Identificación:</label>
                <div class="col-xs-2">
                    <h5 id="h5_ced_estudiante_encontrada" style="color:red;"></h5>
                    <input type="hidden" class="form-control input-sm" name="ced_estudiante_encontrada" id="ced_estudiante_encontrada"/>
                </div>
                <label class="col-xs-2 control-label">Nombre:</label>
                <div class="col-xs-3">
                    <h5 id="nombre_encontrado" style="color:red;"></h5>
                </div>
                <label class="col-xs-1 control-label">Distrito:</label>
                <div class="col-xs-2">
                    <h5 id="distrito_encontrado" style="color:red;"></h5>
                </div>
            </div>
            
            <div class="form-group">
                <input type="submit" class="btn btn-primary" id="eliminar" value="Eliminar" />
            </div>
        </fieldset>
    </form>
</div>