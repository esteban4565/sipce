<div class="row">
    <div class="col-xs-3">
        Búsqueda por identificación:
    </div>
    <div class="col-xs-2">
        <input type="text" class="input-sm" name="ced_estudiante" id="ced_estudiante" />
    </div>
    <div class="col-xs-2">
        <input type="button" class="btn btn-success" id="buscarEstudianteBecasComedor" value="Buscar" />
    </div>
    <div class="col-xs-2">
        <a class="btn btn-warning" href="<?php echo URL; ?>persona/listaBecasComedor">Ver Lista Becados Comedor</a>
    </div>
    <div class="col-xs-offset-5"></div>
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
    <form id="MyForm" action="<?php echo URL; ?>persona/guardarDatosBecaComedor" method="POST" enctype="multipart/form-data" class="form-horizontal">
        <fieldset>
            <legend class="text-center">Formulario becas estudiantiles</legend>
            <div class="form-group">
                <label class="col-xs-2 control-label">Identificación:</label>
                <div class="col-xs-2">
                    <h5 id="h5_ced_estudiante_encontrada"></h5>
                    <input type="hidden" class="form-control input-sm" name="ced_estudiante_encontrada" id="ced_estudiante_encontrada"/>
                </div>
                <label class="col-xs-2 control-label">Nombre:</label>
                <div class="col-xs-3">
                    <h5 id="nombre_encontrado"></h5>
                </div>
                <label class="col-xs-1 control-label">Distrito:</label>
                <div class="col-xs-2">
                    <h5 id="distrito_encontrado"></h5>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-offset-5"></div>
                <label class="col-xs-2 control-label">Grado Académico:</label>
                <div class="col-xs-1">
                    <h5 id="nivel_encontrado"></h5>
                </div>
                <label class="col-xs-1 control-label">Especialidad:</label>
                <div class="col-xs-3">
                    <h5 id="especialidad_encontrada"></h5>
                </div>
            </div>
            <div class="form-group">
                <label for="ingreso1" class="col-xs-1 control-label">Ingreso #1:</label>
                <div class="col-xs-2">
                    <input type="text" class="form-control input-sm validate[required,custom[integer],min[0]]" name="ingreso1" id="ingreso1" value="0"/>
                </div>
                <label for="ingreso2" class="col-xs-1 control-label">Ingreso #2:</label>
                <div class="col-xs-2">
                    <input type="text" class="form-control input-sm validate[custom[integer],min[0]" name="ingreso2" id="ingreso2" value="0"/>
                </div>
                <label for="ingreso3" class="col-xs-1 control-label">Ingreso #3:</label>
                <div class="col-xs-2">
                    <input type="text" class="form-control input-sm validate[custom[integer],min[0]" name="ingreso3" id="ingreso3" value="0"/>
                </div>
                <label for="ingreso4" class="col-xs-1 control-label">Ingreso #4:</label>
                <div class="col-xs-2">
                    <input type="text" class="form-control input-sm validate[custom[integer],min[0]" name="ingreso4" id="ingreso4" value="0"/>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-offset-3"></div>
                <label for="totalMiembros" class="col-xs-2 control-label">Cantidad de miembros:</label>
                <div class="col-xs-1">
                    <input type="text" class="form-control input-sm validate[required,custom[integer],min[1]]" name="totalMiembros" id="totalMiembros"/>
                </div>
                <div class="col-xs-offset-6"></div>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" id="guardar" value="Guardar" />
            </div>
        </fieldset>
    </form>
</div>