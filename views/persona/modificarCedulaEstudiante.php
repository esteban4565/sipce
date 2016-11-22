<div class="row">
    <div class="col-xs-12 text-center">
        <h2>Módulo Administrador</h2>
    </div>
</div>

<div class="row">
    <div class="col-xs-3">
        Búsqueda por identificación:
    </div>
    <div class="col-xs-2">
        <input type="text" class="input-sm" name="ced_estudiante" id="ced_estudiante" />
    </div>
    <div class="col-xs-2">
        <input type="button" class="btn-sm btn-success" id="buscarEstudianteModifCed" value="Buscar" />
    </div>
    <div class="col-xs-offset-5"></div>
    <div class="col-xs-12"><br></div>
    <div class="col-xs-12" id="formularioModifCed"></div>
</div>
<?php if($this->mensaje != ''){ ?>
<div class="row">
    <div class="alert alert-success" role="alert">
        <div class="container"><?php echo $this->mensaje; ?></div>
    </div>
</div>

<?php }else{ ?>
<div class="row">
    <div class="alert alert-success" role="alert" style="display:none;">
        <div class="container"><?php echo $this->mensaje; ?></div>
    </div>
</div>
<?php } ?>

<script type="text/javascript">
    var rutaSitio = '<?php echo URL; ?>';
</script>