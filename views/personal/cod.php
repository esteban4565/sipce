                
                
                //Una vez inicializado el objeto, lo guardo en el array listaPersonas
    listaPersonas.push(universidad);
    
    //Procedo a borrar la tabla y pinto de nuevo todos los objetos que se encuentran en el array
    for (var linea = 0; linea < listaPersonas.length; linea++) {
        $('#tablaUniversidades').append('<tr><td>' + listaPersonas[linea].nombreUniversidad + '</td><td>' + listaPersonas[linea].nombreGradoAcademico + '</td><td>' + listaPersonas[linea].tituloUniversidad + '</td><td>' + listaPersonas[linea].annio + '</td><td><input type="button" class="delette btn-xs btn-primary" name="' + listaPersonas[linea].idUniversidad + '" value="Eliminar"/></td></tr>');
    }
                
                
               
                
                <legend class="text-center">DATOS DE LA INSTITUCIÓN</legend>
                <!--L23 Año ingreso-->
                <div class="form-group"> 
                    <label for="tf_anoIngreso" class="col-xs-2 control-label">Año Ingreso:</label>
                    <div class="col-xs-2">
                        <input type="text" class="form-control input-sm validate[required]"  id="tf_anoIngreso" name="tf_anoIngreso"/>
                    </div>
                    <label for="tf_NombradoPor" class="col-xs-2 control-label">Nombrado Por:</label>
                    <div class="col-xs-2">
                        <select class="form-control input-sm validate[required]" name="tf_NombradoPor" id="tf_NombradoPor">
                            <option value="">Seleccione</option>
                            <option value="0">MEP</option>
                            <option value="1">Junta Administrativa</option>
                            <option value="Otro">Contratado</option>
                        </select> 
                    </div>
                </div>
                