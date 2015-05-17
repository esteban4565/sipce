<div class="row">
    <div class="col-lg-12">
        <h2>Modulo Secciones</h2>

        <?php
        //print_r($this->consultaNiveles);
        ?>

        <div class="form-group">
            <label for="tf_Niveles" class="col-lg-2 control-label">Nivel:</label>
            <div class="col-lg-2">
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
            <label for="tf_Grupos" class="col-lg-2 control-label">Grupo:</label>
            <div class="col-lg-2">
                <select class="form-control input-sm" name="tf_Grupos" id="tf_Grupos">
                </select>
            </div>
            <label for="tf_SubGrupos" class="col-lg-2 control-label">SubGrupos:</label>
            <div class="col-lg-2">
                <select  class="form-control input-sm" name="tf_SubGrupos" id="tf_SubGrupos">    
                </select>
            </div>
            <br />
            <br />
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-7">
        <table class="table table-condensed" id="SecElegGrupA"></table>
        <table class="table table-condensed" id="SecElegGrupB"></table>
        <table class="table table-condensed" id="SecElegGrupC"></table>
    </div>
</div>
<?php
//print_r($this->listaEstudiantes);
?>