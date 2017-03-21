<div class="row">
    <div class="col-xs-12">
        <h2>Cargar Secciones de estudiantes</h2>
    </div>
    
    <div class="col-xs-12">
        <form id="MyForm" action="<?php echo URL; ?>actualizarestudiantes/guardarSeccionesEstudiantes" method="POST" enctype="multipart/form-data" class="form-horizontal">
            <div class="form-group">
            <input class="validate[required]" type="file" name="archivo" id="archivo">
            </div>
            
            <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Subir archivo">
            </div>
        </form>
    </div>
</div>