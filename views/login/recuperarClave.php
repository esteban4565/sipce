<center>
    <p class="text-success">Importante!</p>
    <p>Usuario de SIPCE, la solicitud del password o contraseña será enviada al correo electrónico asociado a la cuenta.</p>
    <br/>
</center>
    <h2>Solicitud del Password o Contraseña</h2>
    <hr>
    <br/>
    <div class="row">
    <div class="col-lg-3"></div>
    <div class="col-lg-6">
        <form id="MyForm" action="login/run" method="POST" enctype="multipart/form-data" class="form-horizontal">
            <fieldset>
                <div class="form-group">
                    <label for="tf_usuario" class="col-lg-4 control-label">Correo electrónico:</label>
                    <div class="col-lg-8"> 
                        <input class="form-control" name="tf_usuario" id="tf_usuario" placeholder="Email" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-8 col-lg-offset-4">
                        <button class="btn btn-default">Cancelar</button>
                        <button type="submit" class="btn btn-success">Enviar Solicitud</button>
                    </div>
                </div>
            </fieldset>
        </form>
    </div><!--Cierre de col-lg-6-->
    <div class="col-lg-3"></div>
</div>

