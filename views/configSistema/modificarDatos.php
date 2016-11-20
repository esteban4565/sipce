<div class="row">
    <form id="MyForm" action="<?php echo URL; ?>configSistema/guardarDatosSistema" method="POST" enctype="multipart/form-data" class="form-horizontal">
        <fieldset>
            <legend class="text-center">Modificar datos del sistema</legend>
            <div class="form-group"> 
                <label for="annio_lectivo" class="col-xs-2 control-label">Año Lectivo:</label>
                <div class="col-xs-2">
                    <input type="text" class="form-control input-sm validate[required]" name="annio_lectivo" id="annio_lectivo" value="<?php echo $this->datosSistema[0]['annio_lectivo']; ?>"/>
                </div>
            </div>
            <div class="form-group"> 
                <label for="director" class="col-xs-2 control-label">Director:</label>
                <div class="col-xs-2">
                    <input type="text" class="form-control input-sm validate[required]" name="director" id="director" value="<?php echo $this->datosSistema[0]['director']; ?>"/>
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