<div class="row">
    <div class="col-xs-12">
        <h2>Expedientes de Estudiantes</h2>
        <div class="form-group">
            <label for="tf_NivelesExpedientes" class="col-xs-2 control-label">Nivel:</label>
            <div class="col-xs-2">
                <select class="form-control input-sm" name="tf_NivelesExpedientes" id="tf_NivelesExpedientes">
                    <option value="">Seleccione</option>
                    <?php
                    foreach ($this->consultaNiveles as $value) {
                        ?>
                        <option value="<?php echo $value['nivel']; ?>"><?php echo $value['nivel']; ?></option>
                        <?php
                    }
                    ?>  
                </select>
            </div>
            <label for="tf_GruposExpedientes" class="col-xs-2 control-label">Grupo:</label>
            <div class="col-xs-2">
                <select class="form-control input-sm" name="tf_GruposExpedientes" id="tf_GruposExpedientes">
                </select>
            </div>
            <br />
            <br />
        </div>
    </div>
</div>

<div class="row">
    <table class="table table-condensed" id="listaEstudiantes"></table>
</div>