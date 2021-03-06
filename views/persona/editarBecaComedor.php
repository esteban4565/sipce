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
                    <h5><?php echo $this->datosEstudiante[0]['cedula']; ?></h5>
                    <input type="hidden" name="ced_estudiante_encontrada" value="<?php echo $this->datosEstudiante[0]['cedula']; ?>">
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
                <div class="col-xs-offset-5"></div>
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
                <div class="col-xs-offset-3"></div>
                <label for="totalMiembros" class="col-xs-2 control-label">Cantidad de miembros:</label>
                <div class="col-xs-1">
                    <input type="text" class="form-control input-sm validate[required,custom[integer],min[1]]" name="totalMiembros" id="totalMiembros" value='<?php echo $this->datosEstudiante[0]['totalMiembros']; ?>'/>
                </div>
                <div class="col-xs-offset-6"></div>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" id="guardar" value="Guardar" />
            </div>
        </fieldset>
    </form>
</div>