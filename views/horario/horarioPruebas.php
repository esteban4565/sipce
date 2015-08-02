
<form method="post" action="<?php echo URL;?>horario/ingresarHorario/<?php echo $this->horario[0]['ced_docente']; ?>" class="form-horizontal">
<div class="container">
    <div class="row">
        <div class="col-xs-2">
            Lección / Hora
        </div>
        <div class="col-xs-2">
            Lunes
        </div>
        <div class="col-xs-2">
            Martes
        </div>
        <div class="col-xs-2">
            Miércoles
        </div>
        <div class="col-xs-2">
            Jueves
        </div>
        <div class="col-xs-2">
            Viernes
        </div>
    </div>
    <div class="row">
        <div class="col-xs-2">
            1 / 7:00-7:40
        </div>
        <div class="col-xs-2">
            <select class="form-control input-sm" name="cod_seccion_L1">
                        <option value="">Seleccione</option>
                        <?php
                        for ($i = 1; $i <= 12; $i++) {
                            ?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php
                        }
                        ?>  
            </select> 
        </div>
        <div class="col-xs-2">
            Martes
        </div>
        <div class="col-xs-2">
            Miércoles
        </div>
        <div class="col-xs-2">
            Jueves
        </div>
        <div class="col-xs-2">
            Viernes
        </div>
    </div>
</div>

</form>