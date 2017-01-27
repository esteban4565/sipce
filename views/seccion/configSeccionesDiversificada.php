<div class="row">
    <div class="text-center">
        <h4>Menú</h4>
        <a class="btn-sm btn-warning" href="<?php echo URL; ?>seccion/configSecciones/7" class="btn-sm btn-danger" >7°</a>
        <a class="btn-sm btn-warning" href="<?php echo URL; ?>seccion/configSecciones/8" class="btn-sm btn-danger" >8°</a>
        <a class="btn-sm btn-warning" href="<?php echo URL; ?>seccion/configSecciones/9" class="btn-sm btn-danger" >9°</a>
        <a class="btn-sm btn-danger" href="<?php echo URL; ?>seccion/configSecciones/10" class="btn-sm btn-danger" >10°</a>
        <a class="btn-sm btn-danger" href="<?php echo URL; ?>seccion/configSecciones/11" class="btn-sm btn-danger" >11°</a>
        <a class="btn-sm btn-danger" href="<?php echo URL; ?>seccion/configSecciones/12" class="btn-sm btn-danger" >12°</a>
    </div>
    <hr>
    <h2>Distribución Estudiantes por Especialidad</h2>
    <h3>Nivel: <?php echo $this->nivel; ?>°</h3>
    <label id="nivel" style="display:none;"><?php echo $this->nivel; ?></label>
</div>
<div class="row">
    <?php
    //print_r($this->consultaEstadisticaEspecialidad);
    ?>
    <div class="col-xs-6">
        <table class="table table-condensed">
            <thead>
                <tr><th>Especialidad</th><th>Cantidad de Estudiantes</th></tr>
            </thead>
            <tbody>
                <?php
                $totalEstudiantes = 0;
                foreach ($this->consultaEstadisticaEspecialidad as $key => $value) {
                    echo '<tr><td>' . $value['nombre_especialidad'] . '</td><td>' . $value['cantidadEstudiantes'] . '</td></tr>';
                    $totalEstudiantes = $totalEstudiantes + $value['cantidadEstudiantes'];
                }
                ?>
                <tr><td>Total:</td><td><?php echo $totalEstudiantes; ?></td></tr>
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <h2>Configuración Conjunto Secciones</h2>
</div>
<div class="row">  
    <h2>Seleccione la cantidad de secciones por nivel</h2>
    <div class="form-group">
        <div class="col-xs-3">
            <select class="form-control input-sm" name="sl_CantidadSeccionesDiversificada" id="sl_CantidadSeccionesDiversificada">
                <option value="">Seleccione</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
            </select>
        </div>
    </div>

    <div class="form-group">
        <div class="col-xs-3">
            <input type="button" class="btn-sm btn-success" id="agregarCantidadSeccionesDiversificada" value="Agregar/Modificar Cantidad Secciones"/>
        </div>
    </div>

    <div class="form-group">
        <div class="col-xs-3">
            <table class="table table-condensed" id="cantidadSeccionesDiversificadaGuardadas">
                <thead>
                    <tr><th>Estado Actual</th></tr>
                </thead>
                <tbody>
                    <?php
                    if ($this->consultaSeccionesDiversificada != null) {
                        echo '<tr><td>' . $this->consultaSeccionesDiversificada[0]['cantidadSecciones'] . '</td></tr>';
                    } else {
                        echo '<tr><td>-</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="row">  
    <h2>Agregar Especialidad a nivel Seleccionado</h2>
</div> 


<div class="row">  
    <div class="form-group">
        <label for="sl_grupo" class="col-xs-1 control-label">Grupo:</label>
        <div class="col-xs-2">
            <select class="form-control input-sm" name="sl_grupo" id="sl_grupo">
                <option value="">Seleccione</option>
                <?php
                for ($i = 1; $i <= $this->consultaSeccionesDiversificada[0]['cantidadSecciones']; $i++) {
                    echo '<option value="' . $i . '">' . $this->nivel . '-' . $i . '</option>';
                }
                ?>
            </select>
        </div>

        <label for="sl_Especialidad" class="col-xs-2 control-label text-right">Especialidad:</label>
        <div class="col-xs-4">
            <select class="form-control input-sm" name="sl_Especialidad" id="sl_Especialidad">
                <option value="">Seleccione</option>
                <option value="1">Administración y operaciones aduaneras</option>
                <option value="2">Ejecutivo para centro de servicio</option>
                <option value="3">Contabilidad General</option>
                <option value="4">Banca y Finanzas</option>
                <option value="5">Informática en desarrollo de software</option>
                <option value="6">Dibujo Técnico</option>
                <option value="7">Agrojardineria</option>
                <option value="8">Turismo en alimento y bebidas</option>
                <option value="9">Electrónica Industrial</option>
            </select>
        </div>
    </div>

    <div class="form-group">
        <div class="col-xs-3 col-md-2">
            <input type="button" class="btn-sm btn-success" id="agregarEspecialidad" value="Agregar Especialidad"/>
        </div>
    </div>

    <div class="form-group">
        <div class="col-xs-3">
            <table class="table table-condensed" id="especialidadesSeccionGuardadas">
                <thead>
                    <tr><th>Estado Actual</th></tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($this->consultaEspecialidadNivel as $key => $value) {
                        echo '<tr><td>' . $value['nombreEspecialidad'] . '</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div> 

<div class="row">  
    <div class="form-group">
        <div class="col-xs-6">
            <input type="button" class="btn-sm btn-danger" id="proyectarSeccionesDiversificada" value="Proyectar Secciones"/>
        </div>
    </div>

    <div class="form-group col-xs-8" id="resumenSeccionesDiversificada" >
    </div>
</div> 