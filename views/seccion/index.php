<div class="row">
    <div class="col-xs-12">
        <h2>Módulo secciones</h2>

        <?php
        //print_r($this->consultaNiveles);
        ?>

        <div class="form-group">
            <label for="tf_Niveles" class="col-xs-2 control-label">Nivel:</label>
            <div class="col-xs-2">
                <select class="form-control input-sm" name="tf_Niveles" id="tf_Niveles">
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
            <label for="tf_Grupos" class="col-xs-2 control-label">Grupo:</label>
            <div class="col-xs-2">
                <select class="form-control input-sm" name="tf_Grupos" id="tf_Grupos">
                </select>
            </div>
            <br />
            <br />
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-7 col-xs-12" id="carga" style="display:none;">
        <img src="<?php echo URL; ?>public/img/animacionCargando.svg" alt="Gif Cargando" class="img-rounded center-block img-responsive"/>
    </div>
    <div class="col-lg-7 col-xs-12">
        <table class="table table-condensed" id="listaEstudiantes"></table>
    </div>
</div>