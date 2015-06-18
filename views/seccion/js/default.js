$(function()
{
    //Carga los Grupos//
    $("#tf_Niveles").change(function() {
        $("#tf_Grupos").empty();
        $("#SecElegGrupA").empty();
        $("#SecElegGrupB").empty();
        $("#SecElegGrupC").empty();
        var nivelSeleccionado = $("#tf_Niveles").val();
        $.getJSON('../seccion/cargaGrupos/' + nivelSeleccionado, function(Gru) {
            $('#tf_Grupos').append('<option value="">Seleccione</option>');
            for (var iP = 0; iP < Gru.length; iP++) {
                $("#tf_Grupos").append('<option value="' + Gru[iP].grupo + '">' + Gru[iP].grupo + '</option>');
            }
        });
    });

    //Carga los SubGrupos//
    $("#tf_Grupos").change(function() {
        $("#tf_SubGrupos").empty();
        $("#SecElegGrupA").empty();
        $("#SecElegGrupB").empty();
        $("#SecElegGrupC").empty();
        var grupoSeleccionado = $("#tf_Grupos").val();

        //Codigo para SubGrupo en analisis de relevancia
//          var ids = $(this).attr('rel');
//          $.getJSON('../seccion/cargaSubGrupos/' + grupoSeleccionado, function(subGru) {
//          $('#tf_SubGrupos').append('<option value="">Seleccione</option>');
//          for (var iD = 0; iD < subGru.length; iD++) {
//                $("#tf_SubGrupos").append('<option value="' + subGru[iD].sub_grupo + '">' + 
//                subGru[iD].sub_grupo + '</option>');
//          }
//        });

        $("#SecEleg").empty();
        var consulta = {nivelSeleccionado: $("#tf_Niveles").val(), grupoSeleccionado: $("#tf_Grupos").val()};
        $.post('../seccion/xhrSeccion2/', consulta, function(seccionElegida, success) {
            $('#SecElegGrupA').append('<thead><tr>' +
                    '<th colspan="5">' + consulta.nivelSeleccionado + '-' + consulta.grupoSeleccionado + ' A' + '</th>' +
                    '</tr><tr>' +
                    '<th>N°</th>' +
                    '<th>Identificación</th>' +
                    '<th>1º Apellido</th>' +
                    '<th>2º Apellido</th>' +
                    '<th>Nombre</th>' +
                    '</tr></thead><tbody>');
            $('#SecElegGrupB').append('<thead><tr>' +
                    '<th colspan="5">' + consulta.nivelSeleccionado + '-' + consulta.grupoSeleccionado + ' B' + '</th>' +
                    '</tr><tr>' +
                    '<th>N°</th>' +
                    '<th>Identificación</th>' +
                    '<th>1º Apellido</th>' +
                    '<th>2º Apellido</th>' +
                    '<th>Nombre</th>' +
                    '</tr></thead><tbody>');
            $('#SecElegGrupC').append('<thead><tr>' +
                    '<th colspan="5">' + consulta.nivelSeleccionado + '-' + consulta.grupoSeleccionado + ' C' + '</th>' +
                    '</tr><tr>' +
                    '<th>N°</th>' +
                    '<th>Identificación</th>' +
                    '<th>1º Apellido</th>' +
                    '<th>2º Apellido</th>' +
                    '<th>Nombre</th>' +
                    '</tr></thead><tbody>');
            for (var linea = 0; linea < seccionElegida.length; linea++) {
                if (seccionElegida[linea].sub_grupo === 'A') {
                    $('#SecElegGrupA').append('<tr><td>' +
                            (linea + 1) +
                            '</td><td>' +
                            seccionElegida[linea].cedula +
                            '</td><td>' +
                            seccionElegida[linea].apellido1 +
                            '</td><td>' +
                            seccionElegida[linea].apellido2 +
                            '</td><td>' +
                            seccionElegida[linea].nombre +
                            '</td></tr>');
                }
                if (seccionElegida[linea].sub_grupo === 'B') {
                    $('#SecElegGrupB').append('<tr><td>' +
                            (linea + 1) +
                            '</td><td>' +
                            seccionElegida[linea].cedula +
                            '</td><td>' +
                            seccionElegida[linea].apellido1 +
                            '</td><td>' +
                            seccionElegida[linea].apellido2 +
                            '</td><td>' +
                            seccionElegida[linea].nombre +
                            '</td></tr>');
                }
                if (seccionElegida[linea].sub_grupo === 'C') {
                    $('#SecElegGrupC').append('<tr><td>' +
                            (linea + 1) +
                            '</td><td>' +
                            seccionElegida[linea].cedula +
                            '</td><td>' +
                            seccionElegida[linea].apellido1 +
                            '</td><td>' +
                            seccionElegida[linea].apellido2 +
                            '</td><td>' +
                            seccionElegida[linea].nombre +
                            '</td></tr>');
                }
            }
            $('#SecElegGrupA').append('<tr><td colspan="5">Ultima linea</td></tr></tbody>');
            $('#SecElegGrupB').append('<tr><td colspan="5">Ultima linea</td></tr></tbody>');
            $('#SecElegGrupC').append('<tr><td colspan="5">Ultima linea</td></tr></tbody>');
        }, "json");
    });
});