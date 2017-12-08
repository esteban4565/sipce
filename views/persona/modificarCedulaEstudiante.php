<div class="row">
    <div class="col-xs-12 text-center">
        <h2>Módulo Administrador</h2>
    </div>
</div>

<div class="row">
    <div class="col-xs-3">
        Búsqueda por identificación:
    </div>
    <div class="col-xs-2">
        <input type="text" class="input-sm" name="ced_estudiante" id="ced_estudiante" />
    </div>
    <div class="col-xs-2">
        <input type="button" class="btn-sm btn-success" id="buscarEstudianteModifCed" value="Buscar" />
    </div>
    <div class="col-xs-offset-5"></div>
    <div class="col-xs-12"><br></div>
    <div class="col-xs-12" id="formularioModifCed"></div>
</div>
<?php if($this->mensaje != ''){ ?>
<div class="row">
    <div class="alert alert-success" role="alert">
        <div class="container"><?php echo $this->mensaje; ?></div>
    </div>
</div>

<?php }else{ ?>
<div class="row">
    <div class="alert alert-success" role="alert" style="display:none;">
        <div class="container"><?php echo $this->mensaje; ?></div>
    </div>
</div>
<?php } ?>
<div class="row">
    <form id="MyForm" action="<?php echo URL; ?>persona/guardarCedulaNueva" method="POST" enctype="multipart/form-data" class="form-horizontal">
        <fieldset>
            <legend class="text-center">Formulario modificar cédula estudiantil</legend>
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
                <label class="col-xs-2 control-label">Grado Académico:</label>
                <div class="col-xs-1">
                    <h5 id="nivel_encontrado" style="color:red;"></h5>
                </div>
                <label class="col-xs-1 control-label">Especialidad:</label>
                <div class="col-xs-3">
                    <h5 id="especialidad_encontrada" style="color:red;"></h5>
                </div>
            </div>
            <div class="form-group">
                <label for="ingreso1" class="col-xs-1 control-label">Cédula Nueva:</label>
                <div class="col-xs-2">
                    <input type="text" class="form-control input-sm validate[required]" name="ced_nueva" id="ced_nueva"/>
                </div>
            </div>
            
            <div class="form-group">
                <input type="submit" class="btn btn-primary" id="guardar" value="Guardar" />
            </div>
        </fieldset>
    </form>
</div>
<script type="text/javascript">
    var rutaSitio = '<?php echo URL; ?>';
</script>