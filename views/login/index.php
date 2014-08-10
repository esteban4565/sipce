<h2>Iniciar Sesión</h2>
<hr>
<div class="row">
    <div class="col-lg-2">
        <img src="public/img/inicionsesion.png" alt="Logo Sipce" class="img-rounded pull-left">
    </div>
    <div class="col-lg-5">
        <form id="MyForm" action="login/run" method="POST" enctype="multipart/form-data" class="form-horizontal">
            <fieldset>
                <div class="form-group">
                    <label for="tf_usuario" class="col-lg-4 control-label">Nombre Usuario:</label>
                    <div class="col-lg-8">
                        <input class="form-control input-sm validate[required]" name="tf_usuario" id="tf_usuario" placeholder="Nombre usuario" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label for="tf_clave" class="col-lg-4 control-label">Password:</label>
                    <div class="col-lg-8">
                        <input class="form-control input-sm validate[required]" name="tf_clave" id="tf_clave" placeholder="Password" type="password">
                        <a href="<?php echo URL; ?>login/recuperarClave">Olvidó su password?</a>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-8 col-lg-offset-4">
                        <button class="btn btn-default">Cancelar</button>
                        <button type="submit" class="btn btn-success">Iniciar Sesión</button>
                    </div>
                </div>
            </fieldset>
        </form>
    </div><!--Cierre de col-lg-5-->
    <div class="col-lg-5"></div>
</div>
