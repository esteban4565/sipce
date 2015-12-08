$(function()
{
    //Carga los Estudiantes dependiendo del Nivel//
    $("#sl_Nivel").change(function() {
        $("#edadReferencia").empty();
        $("#proyeccionNivel").empty();
        $("#proyeccionTodos").empty();
        $("#sl_Especialidad").val("");
        
        var nivelSeleccionado = $("#sl_Nivel").val();
        if(nivelSeleccionado <= 12){
            $.getJSON('cargaProyeccion/' + nivelSeleccionado, function(datos) {
                $('#edadReferencia').append("Edad Referencia: " + datos['edadReferencia']);
                
                $('#proyeccionNivel').append('<thead><tr>' +
                        '<th>&nbsp;</th><th class="text-center">Estudiantes</th><th class="text-center">Nacionales</th><th class="text-center">Extrangeros</th>' +
                        '<th class="text-center">Menores</th><th class="text-center">Mayores</th>' +
                        '</tr></thead><tbody>' +
                        '<tr class="text-center"><td>Hombres:</td><td>' + datos['hombres'] + '</td>'+
                        '<td>' + datos['nacionalesHombre'] + '</td><td>' + datos['extrangerosHombre'] + '</td>'+
                        '<td>' + datos['menoresHombre'] + '</td><td>' + datos['mayoresHombre'] + '</td></tr>'+
                        '<tr class="text-center"><td>Mujeres:</td><td>' + datos['mujeres'] + '</td>'+
                        '<td>' + datos['nacionalesMujer'] + '</td><td>' + datos['extrangerosMujer'] + '</td>'+
                        '<td>' + datos['menoresMujer'] + '</td><td>' + datos['mayoresMujer'] + '</td></tr>'+
                        '<tr class="text-center"><td>Totales:</td><td>' + (datos['mujeres'] + datos['hombres']) + '</td>'+
                        '<td>' + (datos['nacionalesHombre'] + datos['nacionalesMujer']) + '</td><td>' + (datos['extrangerosHombre'] + datos['extrangerosMujer']) + '</td>'+
                        '<td>' + (datos['menoresMujer'] + datos['menoresHombre']) + '</td><td>' + (datos['mayoresMujer'] + datos['mayoresHombre']) + '</td></tr>'+
                        
                        '</tbody>');
            });
        }
        
        if(nivelSeleccionado == 13){
            $.getJSON('cargaProyeccionTotal', function(datos) {
                $('#proyeccionTodos').append('<thead><tr>' +
                        '<th class="text-center" colspan="2">Resumen General</th>' +
                        '</tr><tr class="text-center">' +
                        '<th class="text-center">Nivel</th>' +
                        '<th class="text-center">Cantidad Estudiantes</th>' +
                        '</tr></thead><tbody>' +
                        '<tr class="text-center"><td>7°</td>' +
                        '<td>' + datos['totalSetimo'] + '</td><tr class="text-center">' +
                        '<tr class="text-center"><td>8°</td>' +
                        '<td>' + datos['totalOctavo'] + '</td><tr class="text-center">' +
                        '<tr class="text-center"><td>9°</td>' +
                        '<td>' + datos['totalNoveno'] + '</td><tr class="text-center">' +
                        '<tr class="text-center"><td>10°</td>' +
                        '<td>' + datos['totalDecino'] + '</td><tr class="text-center">' +
                        '<tr class="text-center"><td>11°</td>' +
                        '<td>' + datos['totalUndecino'] + '</td><tr class="text-center">' +
                        '<tr class="text-center"><td>12°</td>' +
                        '<td>' + datos['totalDuodecino'] + '</td><tr class="text-center">' +
                        '<tr class="text-center"><td>TOTAL:</td>' +
                        '<td>' + (datos['totalSetimo'] + datos['totalOctavo'] + datos['totalNoveno'] + datos['totalDecino'] + datos['totalUndecino'] + datos['totalDuodecino'] ) + '</td></tr>' +
                        '</tbody>');
            });
        }
    });
    
    
    //Carga los Estudiantes dependiendo del Nivel y Especialidad//
    $("#sl_Especialidad").change(function() {
        if($("#sl_Nivel").val() < 10){
            alert("El nivel seleccionado no posee dicha especialidad");
        }else{
            $("#edadReferencia").empty();
            $("#proyeccionNivel").empty();
            $("#proyeccionTodos").empty();

            var consulta = {nivelSeleccionado: $("#sl_Nivel").val(), especialidad: $("#sl_Especialidad").val()};
            if($("#sl_Nivel").val() < 13 && $("#sl_Especialidad").val() < 10){
                $.post('cargaProyeccionEspecialidad/', consulta, function(datosJSON, success) {
                var datos = JSON.parse(datosJSON);
                $('#edadReferencia').append("Edad Referencia: " + datos['edadReferencia']);
                $('#proyeccionNivel').append('<thead><tr>' +
                        '<th>&nbsp;</th><th class="text-center">Estudiantes</th><th class="text-center">Nacionales</th>'+
                        '<th class="text-center">Extrangeros</th><th class="text-center">Menores</th><th class="text-center">Mayores</th>' +
                        '</tr></thead><tbody>' +
                        '<tr class="text-center"><td>Hombres:</td><td>' + datos['hombres'] + '</td>'+
                        '<td>' + datos['nacionalesHombre'] + '</td><td>' + datos['extrangerosHombre'] + '</td>'+
                        '<td>' + datos['menoresHombre'] + '</td><td>' + datos['mayoresHombre'] + '</td></tr>'+
                        '<tr class="text-center"><td>Mujeres:</td><td>' + datos['mujeres'] + '</td>'+
                        '<td>' + datos['nacionalesMujer'] + '</td><td>' + datos['extrangerosMujer'] + '</td>'+
                        '<td>' + datos['menoresMujer'] + '</td><td>' + datos['mayoresMujer'] + '</td></tr>'+
                        '<tr class="text-center"><td>Totales:</td><td>' + (datos['mujeres'] + datos['hombres']) + '</td>'+
                        '<td>' + (datos['nacionalesHombre'] + datos['nacionalesMujer']) + '</td><td>' + (datos['extrangerosHombre'] + datos['extrangerosMujer']) + '</td>'+
                        '<td>' + (datos['menoresMujer'] + datos['menoresHombre']) + '</td><td>' + (datos['mayoresMujer'] + datos['mayoresHombre']) + '</td></tr>'+
                        '</tbody>');
                });
                }
                if($("#sl_Nivel").val() == 13 && $("#sl_Especialidad").val() < 10){
                $.post('cargaProyeccionTotalEspecialidad/', consulta, function(datosJSON, success) {
                var datos = JSON.parse(datosJSON);
                $('#proyeccionTodos').append('<thead>' +
                        '<tr><th class="text-center" colspan="2">Resumen General de</th></tr>' +
                        '<tr><th class="text-center" colspan="2">' + $("#sl_Especialidad option:selected").text() + '</th></tr>' +
                        '<tr>' +
                        '<th class="text-center">Nivel</th>' +
                        '<th class="text-center">Cantidad Estudiantes</th>' +
                        '</tr></thead><tbody>' +
                        '<tr class="text-center"><td>10°</td>' +
                        '<td>' + datos['totalDecino'] + '</td><tr>' +
                        '<tr class="text-center"><td>11°</td>' +
                        '<td>' + datos['totalUndecino'] + '</td><tr>' +
                        '<tr class="text-center"><td>12°</td>' +
                        '<td>' + datos['totalDuodecino'] + '</td><tr>' +
                        '<tr class="text-center"><td>TOTAL:</td>' +
                        '<td>' + (datos['totalDecino'] + datos['totalUndecino'] + datos['totalDuodecino'] ) + '</td><tr>' +
                        '</tbody>');
                });    
                }
                if($("#sl_Nivel").val() == 13 && $("#sl_Especialidad").val() == 10){
                $.post('cargaProyeccionTotalTodasLasEspecialidad/', consulta, function(datosJSON, success) {
                var datos = JSON.parse(datosJSON);
                $('#proyeccionTodos').append('<thead><tr>' +
                        '<th class="text-center" colspan="5">Resumen General de Especialidades</th>' +
                        '</tr><tr>' +
                        '<th class="text-center">Especialidad</th>' +
                        '<th>Total</th>' +
                        '<th>10°</th>' +
                        '<th>11°</th>' +
                        '<th>12°</th>' +
                        '</tr></thead><tbody><tr">' +
                        '<td>Administración y operaciones aduaneras</td>' +
                        '<td>' + (datos['aduanasDecino'] + datos['aduanasUndecino'] + datos['aduanasDuodecino']) + '</td>' +
                        '<td>' + datos['aduanasDecino'] + '</td>' +
                        '<td>' + datos['aduanasUndecino'] + '</td>' +
                        '<td>' + datos['aduanasDuodecino'] + '</td>' +
                        '</tr><tr>' +
                        '<td>Ejecutivo para centro de servicio</td>' +
                        '<td>' + (datos['ejecutivoDecino'] + datos['ejecutivoUndecino'] + datos['ejecutivoDuodecino']) + '</td>' +
                        '<td>' + datos['ejecutivoDecino'] + '</td>' +
                        '<td>' + datos['ejecutivoUndecino'] + '</td>' +
                        '<td>' + datos['ejecutivoDuodecino'] + '</td>' +
                        '</tr><tr>' +
                        '<td>Contabilidad General</td>' +
                        '<td>' + (datos['contaDecino'] + datos['contaUndecino'] + datos['contaDuodecino']) + '</td>' +
                        '<td>' + datos['contaDecino'] + '</td>' +
                        '<td>' + datos['contaUndecino'] + '</td>' +
                        '<td>' + datos['contaDuodecino'] + '</td>' +
                        '</tr><tr>' +
                        '<td>Banca y Finanzas</td>' +
                        '<td>' + (datos['bancaDecino'] + datos['bancaUndecino'] + datos['bancaDuodecino']) + '</td>' +
                        '<td>' + datos['bancaDecino'] + '</td>' +
                        '<td>' + datos['bancaUndecino'] + '</td>' +
                        '<td>' + datos['bancaDuodecino'] + '</td>' +
                        '</tr><tr>' +
                        '<td>Informática en desarrollo de software</td>' +
                        '<td>' + (datos['softwareDecino'] + datos['softwareUndecino'] + datos['softwareDuodecino']) + '</td>' +
                        '<td>' + datos['softwareDecino'] + '</td>' +
                        '<td>' + datos['softwareUndecino'] + '</td>' +
                        '<td>' + datos['softwareDuodecino'] + '</td>' +
                        '</tr><tr>' +
                        '<td>Dibujo Técnico</td>' +
                        '<td>' + (datos['dibujoDecino'] + datos['dibujoUndecino'] + datos['dibujoDuodecino']) + '</td>' +
                        '<td>' + datos['dibujoDecino'] + '</td>' +
                        '<td>' + datos['dibujoUndecino'] + '</td>' +
                        '<td>' + datos['dibujoDuodecino'] + '</td>' +
                        '</tr><tr>' +
                        '<td>Agrojardinería</td>' +
                        '<td>' + (datos['agroDecino'] + datos['agroUndecino'] + datos['agroDuodecino']) + '</td>' +
                        '<td>' + datos['agroDecino'] + '</td>' +
                        '<td>' + datos['agroUndecino'] + '</td>' +
                        '<td>' + datos['agroDuodecino'] + '</td>' +
                        '</tr><tr>' +
                        '<td>Turismo en alimento y bebidas</td>' +
                        '<td>' + (datos['turismoDecino'] + datos['turismoUndecino'] + datos['turismoDuodecino']) + '</td>' +
                        '<td>' + datos['turismoDecino'] + '</td>' +
                        '<td>' + datos['turismoUndecino'] + '</td>' +
                        '<td>' + datos['turismoDuodecino'] + '</td>' +
                        '</tr><tr>' +
                        '<td>Electrónica Industrial</td>' +
                        '<td>' + (datos['electroDecino'] + datos['electroUndecino'] + datos['electroDuodecino']) + '</td>' +
                        '<td>' + datos['electroDecino'] + '</td>' +
                        '<td>' + datos['electroUndecino'] + '</td>' +
                        '<td>' + datos['electroDuodecino'] + '</td>' +
                        '</tr><tr>' +
                        '<td class="text-center">TOTAL =></td>' +
                        '<td>' + (datos['totalDecino'] + datos['totalUndecino'] + datos['totalDuodecino']) + '</td>' +
                        '<td>' + datos['totalDecino'] + '</td>' +
                        '<td>' + datos['totalUndecino'] + '</td>' +
                        '<td>' + datos['totalDuodecino'] + '</td>' +
                        '</tr></tbody>');
                });    
                }
        }
    });
    
    
    //Carga la Lista de Estudiantes dependiendo del Nivel y Especialidad//
    $("#sl_EspecialidadlListaEstudiante").change(function() {
        if($("#sl_NivelListaEstudiante").val() < 10){
            alert("El nivel seleccionado no posee dicha especialidad");
        }else{
            $("#listaEstudiantes").empty();

            if($("#sl_NivelListaEstudiante").val() < 13 && $("#sl_EspecialidadlListaEstudiante").val() < 10){
                var consulta = {nivelSeleccionado: $("#sl_NivelListaEstudiante").val(), especialidad: $("#sl_EspecialidadlListaEstudiante").val()};
            
                $.post('cargaListaEstudiantesEspecialidad/', consulta, function(datos, success) {
                $('#listaEstudiantes').append('<thead><tr>' +
                        '<th class="text-center">Nº</th><th class="text-center">Cédula</th><th class="text-center">Estudiantes</th><th class="text-center">Telef. Casa</th><th class="text-center">Telef. Celular</th>' +
                        '</tr></thead><tbody>');
                        for (var linea = 0; linea < datos.length; linea++) {
                        $('#listaEstudiantes').append('<tr><td>' + (linea+1) + '</td><td>' + datos[linea].cedula + '</td><td>' + datos[linea].apellido1 + ' ' + datos[linea].apellido2 + ' ' + datos[linea].nombre + '</td><td>' + datos[linea].telefonoCasa + '</td><td>' + datos[linea].telefonoCelular + '</td></tr>');
                        
                        }
                        $('#listaEstudiantes').append('</tbody>');
                }, "json");
            }
        }
    });
    
    
    //Carga la Lista de Estudiantes dependiendo del Nivel//
    $("#sl_NivelListaEstudiante").change(function() {
            $("#listaEstudiantes").empty();
                var consulta = {nivelSeleccionado: $("#sl_NivelListaEstudiante").val(), especialidad: $("#sl_EspecialidadlListaEstudiante").val()};
            
                $.post('cargaListaEstudiantesMatriculados/', consulta, function(datos, success) {
                $('#listaEstudiantes').append('<thead><tr>' +
                        '<th class="text-center">Nº</th><th class="text-center">Cédula</th><th class="text-center">Estudiantes</th>' +
                        '</tr></thead><tbody>');
                        for (var linea = 0; linea < datos.length; linea++) {
                        $('#listaEstudiantes').append('<tr><td>' + (linea+1) + '</td><td>' + datos[linea].cedula + '</td><td>' + datos[linea].apellido1 + ' ' + datos[linea].apellido2 + ' ' + datos[linea].nombre + '</td></tr>');
                        
                        }
                        $('#listaEstudiantes').append('</tbody>');
                }, "json");
    });
});