$(function()
{
    //Carga los Grupos//
    $("#sl_Nivel").change(function() {
        $("#edadReferencia").empty();
        $("#hombres").empty();
        $("#menoresHombre").empty();
        $("#mayoresHombre").empty();
        $("#nacionalesHombre").empty();
        $("#extrangerosHombre").empty();
        
        $("#mujeres").empty();
        $("#menoresMujer").empty();
        $("#mayoresMujer").empty();
        $("#nacionalesMujer").empty();
        $("#extrangerosMujer").empty();
        
        $("#totalMenores").empty();
        $("#totalMayores").empty();
        $("#totalNacionales").empty();
        $("#totalExtrangeros").empty();
        $("#totalEstudiantes").empty();
        $("#proyeccionTodos").empty();
        
        var nivelSeleccionado = $("#sl_Nivel").val();
        if(nivelSeleccionado <= 12){
            $.getJSON('cargaProyeccion/' + nivelSeleccionado, function(datos) {
                $('#edadReferencia').append(datos['edadReferencia']);
                $('#hombres').append(datos['hombres']);
                $('#menoresHombre').append(datos['menoresHombre']);
                $('#mayoresHombre').append(datos['mayoresHombre']);
                $('#nacionalesHombre').append(datos['nacionalesHombre']);
                $('#extrangerosHombre').append(datos['extrangerosHombre']);

                $('#mujeres').append(datos['mujeres']);
                $('#menoresMujer').append(datos['menoresMujer']);
                $('#mayoresMujer').append(datos['mayoresMujer']);
                $('#nacionalesMujer').append(datos['nacionalesMujer']);
                $('#extrangerosMujer').append(datos['extrangerosMujer']);

                $('#totalMenores').append(datos['menoresMujer'] + datos['menoresHombre']);
                $('#totalMayores').append(datos['mayoresMujer'] + datos['mayoresHombre']);
                $('#totalNacionales').append(datos['nacionalesHombre'] + datos['nacionalesMujer']);
                $('#totalExtrangeros').append(datos['extrangerosHombre'] + datos['extrangerosMujer']);
                $('#totalEstudiantes').append(datos['mujeres'] + datos['hombres']);
            });
        }
        
        if(nivelSeleccionado == 13){
            $.getJSON('cargaProyeccionTotal', function(datos) {
                $('#proyeccionTodos').append('<thead><tr>' +
                        '<th colspan="2">Resumen General</th>' +
                        '</tr><tr>' +
                        '<th>Nivel</th>' +
                        '<th>Cantidad Estudiantes</th>' +
                        '</tr></thead><tbody>' +
                        '<tr><td>7°</td>' +
                        '<td>' + datos['totalSetimo'] + '</td><tr>' +
                        '<tr><td>8°</td>' +
                        '<td>' + datos['totalOctavo'] + '</td><tr>' +
                        '<tr><td>9°</td>' +
                        '<td>' + datos['totalNoveno'] + '</td><tr>' +
                        '<tr><td>10°</td>' +
                        '<td>' + datos['totalDecino'] + '</td><tr>' +
                        '<tr><td>11°</td>' +
                        '<td>' + datos['totalUndecino'] + '</td><tr>' +
                        '<tr><td>12°</td>' +
                        '<td>' + datos['totalDuodecino'] + '</td><tr>' +
                        '<tr><td>TOTAL:</td>' +
                        '<td>' + (datos['totalSetimo'] + datos['totalOctavo'] + datos['totalNoveno'] + datos['totalDecino'] + datos['totalUndecino'] + datos['totalDuodecino'] ) + '</td><tr>' +
                        '</tbody>');
            });
        }
    });
});