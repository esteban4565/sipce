<?php
print_r($this->infoEstudiante);
?>
<div class="row">
    <form id="MyForm" action="saveDocenteEstudiante" method="POST" enctype="multipart/form-data" class="form-horizontal">
        <fieldset>
            <legend>DATOS DEL ESTUDIANTE</legend>
            <!--linea1 Formulario Hugo-->
            <div class="form-group"> 
                <label for="tf_cedula" class="col-lg-2 control-label">Identificación:</label>
                <div class="col-lg-2">
                    <input type="text" class="form-control input-sm" name="tf_cedula" id="tf_cedula" value='<?php echo $this->infoEstudiante[0]['cedula'] ?>' disabled/>
                </div>
                <label for="tf_genero" class="col-lg-2 control-label">Genero:</label>
                <div class="col-lg-2">
                    <select class="form-control input-sm" name="tf_genero" id="tf_genero">
                        <option value="">Seleccione</option>
                        <?php
                        if ($this->infoEstudiante[0]['sexo'] == 0) {
                            ?>
                            <option value="0" selected>Femenino</option>
                            <option value="1" >Masculino</option>
                            <?php
                        } else {
                            ?>
                            <option value="1" selected>Masculino</option>
                            <option value="0" >Femenino</option>
                            <?php
                        }
                        ?>
                    </select> 
                </div>
            </div> 
            <!--linea2 Formulario Hugo-->
        </fieldset>
    </form>

</div>