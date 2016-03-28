<div class="row">
    <div class="col-xs-12">
        <h2>Datos de Estudiantes</h2>

        <h3>Defina los datos que desea visualizar</h3>
        <input type="checkbox" name="chk_email" id="chk_email" value="chk_email">Email<br>
        <input type="checkbox" name="chk_poliza" id="chk_poliza" value="chk_poliza">Póliza<br>
        <input type="checkbox" name="chk_domicilio" id="chk_domicilio" value="chk_domicilio">Domicilio<br>
        <input type="checkbox" name="chk_telefonosEstu" id="chk_telefonosEstu" value="chk_telefonosEstu">Telefonos Estudiante<br>
        <input type="checkbox" name="chk_telefonosEncargado" id="chk_telefonosEncargado" value="chk_telefonosEncargado">Telefonos Encargado Legal<br>
        <br>
        <br>

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
    <table class="table table-condensed" id="listaEstudiantes"></table>
</div>