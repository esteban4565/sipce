<h2>Buscar Docente</h2>
<hr>
    <div class="row">
    <div class="col-lg-3"></div>
    <div class="col-lg-6">
        <form id="MyForm" action="<?php echo URL; ?>persona/resultadoBuscarDocente" method="POST" enctype="multipart/form-data" class="form-horizontal">
            <fieldset>
                <div class="form-group">
                    <label for="tf_cedula" class="col-lg-4 control-label">Cédula:</label>
                    <div class="col-lg-8"> 
                        <input class="form-control" name="tf_cedula" id="tf_cedula" placeholder="EJE: 2-0565-0898" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-8 col-lg-offset-4">
                        <button class="btn btn-default">Cancelar</button>
                        <button type="submit" class="btn btn-success">Buscar Usuario</button>
                    </div>
                </div>
            </fieldset>
        </form>
    </div><!--Cierre de col-lg-6-->
    <div class="col-lg-3"></div>
</center>