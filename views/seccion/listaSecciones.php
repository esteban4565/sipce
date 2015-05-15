<center>
    <h2>Modulo Secciones</h2>

    <?php
    //print_r($this->consultaNiveles);
    ?>

    <div class="form-group">
        <label for="tf_Niveles" class="col-lg-2 control-label">Nivel:</label>
        <div class="col-lg-2">
            <select class="form-control input-sm" name="tf_Niveles" id="tf_Niveles">
                <option value="">Seleccione</option>
                <?php
                foreach ($this->consultaNiveles as $value) {
                    ?>
                    <option value="<?php echo $value['nivel']; ?>"><?php echo $value['nivel']; ?></option>
                    <?php
                }
                ?>  
            </select>
        </div>
        <label for="tf_Grupos" class="col-lg-2 control-label">Grupo:</label>
        <div class="col-lg-2">
            <select class="form-control input-sm" name="tf_Grupos" id="tf_Grupos">
            </select>
        </div>
        <label for="tf_SubGrupos" class="col-lg-2 control-label">SubGrupos:</label>
        <div class="col-lg-2">
            <select  class="form-control input-sm" name="tf_SubGrupos" id="tf_SubGrupos">    
            </select>
        </div>
    </div>
    <?php
//print_r($this->listaEstudiantes);
    ?>
    <table class="table">
        <tr>
            <td colspan="5" class="nombreTabla">Lista Secciones</td>
        </tr>
        <tr>
            <th>N°</th>
            <th>Cedula</th>
            <th>1º Apellido</th>
            <th>2º Apellido</th>
            <th>Nombre</th>
            <th>Fecha Nacimiento</th>
        </tr>
        <?php
        $con = 1;
        foreach ($this->listaSecciones as $lista => $value) {
            echo '<tr>';
            echo '<td>';
            echo $con;
            echo '</td>';
            echo '<td>';
            echo $value['cedula'];
            echo '</td>';
            echo '<td>';
            echo $value['apellido1'];
            echo '</td>';
            echo '<td>';
            echo $value['apellido2'];
            echo '</td>';
            echo '<td>';
            echo $value['nombre'];
            echo '</td>';
            echo '<td>';
            echo $value['fechaNacimiento'];
            echo '</td>';
            echo '</tr>';
            $con++;
        }

        //print_r($this->personaList);
        ?>
        <tr>
            <td colspan='5' class="lineaFin"></td>
        </tr>
        <tr>
            <td colspan='5'>Ultima linea</td>
        </tr>
    </table>
</center>