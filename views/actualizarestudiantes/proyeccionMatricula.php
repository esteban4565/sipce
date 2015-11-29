<div class="row">
    <div class="col-xs-12">
        <h1>Estudiantes Matriculados del C.t.p de Carrizal</h1>
        <p>El siguiente cuadro muestra una proyección estadística de los estudiantes 
            matriculados para el curso 2016, por favor seleccione un nivel...</p>
    </div>

        <div class="form-group">
            <label for="sl_Nivel" class="col-xs-2 control-label">Nivel:</label>
            <div class="col-xs-2">
                <select class="form-control input-sm" name="sl_Nivel" id="sl_Nivel">
                    <option value="">Seleccione</option>
                    <option value="7">7°</option>
                    <option value="8">8°</option>
                    <option value="9">9°</option>
                    <option value="10">10°</option>
                    <option value="11">11°</option>
                    <option value="12">12°</option>
                    <option value="13">Todos</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="edadReferencia" class="col-xs-2 control-label text-right">Edad Referencia:</label>
            <div class="col-xs-2 control-label text-left" id="edadReferencia"></div>
        </div>
</div>

<div class="row">
    <br>
    <br>
    <div class="col-md-8 col-xs-12">
    <table class="table table-condensed">
        <tr>
            <th>&nbsp;</th>
            <th class="text-center">Estudiantes</th>
            <th class="text-center">Nacionales</th>
            <th class="text-center">Extrangeros</th>
            <th class="text-center">Menores</th>
            <th class="text-center">Mayores</th>
        </tr>
        <tr>
            <td>Hombres:</td>
            <td><div class="text-center" id="hombres"></div></td>
            <td><div class="text-center" id="nacionalesHombre"></div></td>
            <td><div class="text-center" id="extrangerosHombre"></div></td>
            <td><div class="text-center" id="menoresHombre"></div></td>
            <td><div class="text-center" id="mayoresHombre"></div></td>
        </tr>
        <tr>
            <td>Mujeres:</td>
            <td><div class="text-center" id="mujeres"></div></td>
            <td><div class="text-center" id="nacionalesMujer"></div></td>
            <td><div class="text-center" id="extrangerosMujer"></div></td>
            <td><div class="text-center" id="menoresMujer"></div></td>
            <td><div class="text-center" id="mayoresMujer"></div></td>
        </tr>
        <tr>
            <td>Totales:</td>
            <td><div class="text-center" id="totalEstudiantes"></div></td>
            <td><div class="text-center" id="totalNacionales"></div></td>
            <td><div class="text-center" id="totalExtrangeros"></div></td>
            <td><div class="text-center" id="totalMenores"></div></td>
            <td><div class="text-center" id="totalMayores"></div></td>
        </tr>
    </table>
    </div>
</div>

<div class="row">
    <div class="col-md-4 col-xs-12">
        <table class="table table-condensed" id="proyeccionTodos"></table>
    </div>
</div>