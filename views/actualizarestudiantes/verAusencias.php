<script type='text/javascript'>
  var userName = "<?php echo Session::get('tipoUsuario') ?>";
</script>
<div class="col-xs-12">
        <h2>Ausencias de Estudiantes</h2>
        <div class="form-group">
            <label for="sl_NivelesAusencias" class="col-xs-2 control-label">Nivel:</label>
            <div class="col-xs-2">
                <select class="form-control input-sm" name="sl_NivelesAusencias" id="sl_NivelesAusencias">
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
            <label for="sl_GruposAusencias" class="col-xs-2 control-label">Grupo:</label>
            <div class="col-xs-2">
                <select class="form-control input-sm" name="sl_GruposAusencias" id="sl_GruposAusencias">
                </select>
            </div>
            <br />
            <br />
        </div>
    </div>
</div>

<div class="row">
    <div id="carga" style="display:none;">
        <img src="<?php echo URL; ?>public/img/animacionCargando.svg" alt="Gif Cargando" class="img-rounded center-block img-responsive"/>
    </div>
    <table class="table table-condensed" id="listaEstudiantes"></table>
</div>