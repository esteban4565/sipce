<div class="row">
    <div class="col-xs-12 text-center">
        <h2>Módulo becas estudiantiles</h2>
    </div>
</div>
<div class="row">
    <form id="MyForm" action="<?php echo URL; ?>persona/guardarDatosBeca" method="POST" enctype="multipart/form-data" class="form-horizontal">
        <fieldset>
            <legend class="text-center">Formulario becas estudiantiles</legend>
            <div class="form-group">
                <label class="col-xs-2 control-label">Identificación:</label>
                <div class="col-xs-2">
                    <h5><?php echo $this->datosEstudiante[0]['cedula']; ?></h5>
                    <input type="hidden" name="ced_estudiante" value="<?php echo $this->datosEstudiante[0]['cedula']; ?>">
                </div>
                <label class="col-xs-2 control-label">Nombre:</label>
                <div class="col-xs-3">
                    <h5><?php echo $this->datosEstudiante[0]['apellido1'] . ' ' . $this->datosEstudiante[0]['apellido2'] . ' ' . $this->datosEstudiante[0]['nombre']; ?></h5>                           
                </div>
                <label class="col-xs-1 control-label">Distrito:</label>
                <div class="col-xs-2">
                    <h5><?php echo $this->datosEstudiante[0]['Distrito']; ?></h5>
                </div>
            </div>
            <div class="form-group">
                <label for="distancia" class="col-xs-1 control-label">Distancia:(km)</label>
                <div class="col-xs-1">
                    <input type="text" class="form-control input-sm validate[required]" name="distancia" id="distancia" value='<?php echo $this->datosEstudiante[0]['distancia']; ?>'/>
                </div>
                <label for="numeroRuta" class="col-xs-1 control-label">Ruta:</label>
                <div class="col-xs-2">
                    <select class="form-control input-sm validate[required]" name="numeroRuta" id="numeroRuta">
                        <option value="">Seleccione</option>
                        <?php
                        if ($this->datosEstudiante[0]['numeroRuta'] == '40165') {
                            echo '<option value="40165" selected>Heredia</option>';
                            echo '<option value="5931">Alajuela</option>';
                        } else {
                            echo '<option value="5931"selected>Alajuela</option>';
                            echo '<option value="40165">Heredia</option>';
                        }
                        ?>
                    </select> 
                </div>
                <label class="col-xs-2 control-label">Grado Académico:</label>
                <div class="col-xs-1">
                    <h5><?php echo $this->datosEstudiante[0]['nivel']; ?></h5>
                </div>
                <label class="col-xs-1 control-label">Especialidad:</label>
                <div class="col-xs-3">
                    <h5>
                        <?php
                        if (isset($this->datosEstudiante[0]['nombreEspecialidad'])) {
                            echo $this->datosEstudiante[0]['nombreEspecialidad'];
                        } else {
                            echo '-';
                        }
                        ?>
                    </h5>
                </div>
            </div>
            <div class="form-group">
                <label for="ingreso1" class="col-xs-1 control-label">Ingreso #1:</label>
                <div class="col-xs-2">
                    <input type="text" class="form-control input-sm validate[required]" name="ingreso1" id="ingreso1" value='<?php echo $this->datosEstudiante[0]['ingreso1']; ?>'/>
                </div>
                <label for="ingreso2" class="col-xs-1 control-label">Ingreso #2:</label>
                <div class="col-xs-2">
                    <input type="text" class="form-control input-sm validate[required]" name="ingreso2" id="ingreso2" value='<?php echo $this->datosEstudiante[0]['ingreso2']; ?>'/>
                </div>
                <label for="ingreso3" class="col-xs-1 control-label">Ingreso #3:</label>
                <div class="col-xs-2">
                    <input type="text" class="form-control input-sm validate[required]" name="ingreso3" id="ingreso3" value='<?php echo $this->datosEstudiante[0]['ingreso3']; ?>'/>
                </div>
                <label for="ingreso4" class="col-xs-1 control-label">Ingreso #4:</label>
                <div class="col-xs-2">
                    <input type="text" class="form-control input-sm validate[required]" name="ingreso4" id="ingreso4" value='<?php echo $this->datosEstudiante[0]['ingreso4']; ?>'/>
                </div>
            </div>
            <div class="form-group">
                <label for="totalIngreso" class="col-xs-2 control-label">Cantidad de ingresos:</label>
                <div class="col-xs-1">
                    <input type="text" class="form-control input-sm validate[required]" name="totalIngreso" id="totalIngreso" value='<?php echo $this->datosEstudiante[0]['totalIngreso']; ?>'/>
                </div>
                <label for="totalMiembros" class="col-xs-2 control-label">Cantidad de miembros:</label>
                <div class="col-xs-1">
                    <input type="text" class="form-control input-sm validate[required,custom[integer],min[1]]" name="totalMiembros" id="totalMiembros" value='<?php echo $this->datosEstudiante[0]['totalMiembros']; ?>'/>
                </div>
                <div class="col-xs-2 text-center">
                    <input type="submit" class="btn btn-primary" id="guardar" value="Guardar" />
                </div>
                <div class="col-xs-2 text-center">
                    <a class="btn btn-warning" href="<?php echo URL; ?>persona/listaBecas">Ver Lista Becados</a>
                </div>
            </div>
        </fieldset>
    </form>
</div>