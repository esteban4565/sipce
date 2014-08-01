<center>
    <table>
        <tr>
            <td>
            </td>
            <td aling="center">
              <h1>Iniciar Sesión</h1>  
            </td>
        </tr>
        <tr>
            <td>
                <img src="<?php echo URL; ?>public/images/inicionsesion.png" width="150px"/>
            </td>
            <td>
                <form id="MyForm" class="loginForm" action="login/run" method="POST" enctype="multipart/form-data">
                    <fieldset id="body">
                        <fieldset>
                            <label for="tf_usuario">Nombre Usuario</label>
                            <input type="text" name="tf_usuario" id="tf_usuario" placeholder="número de cédula" class="validate[required]"/>
                            <div id="b2" class="boton"><img src="<?php echo URL; ?>public/images/menu/ayuda.png"/></div>
                        </fieldset>
                        <fieldset>
                            <label for="tf_clave">Password</label>
                            <input type="password" name="tf_clave" id="tf_clave" class="validate[required]" />
                        </fieldset>
                        <input type="submit" value="Ingresar" class="entrar"/>
                    </fieldset>
                    <span><a href="#">Olvidó su clave?</a></span>
                </form>
            </td>
        </tr>
    </table>
    <div id="dialogo2" class="ventana"  title="Ayuda Ingreso">
        <p>Huelga jajajaja....</p>
        <img src="<?php echo URL; ?>public/images/lapa.jpg" width="450"/>
    </div>
</center>
