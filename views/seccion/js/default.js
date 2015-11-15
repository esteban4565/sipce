function cargaZonasActualizadas(zonasActualizas) {
    $("#txt_zona").val("");
    $("#sl_Zonas").empty();
    $('#sl_Zonas').append('<option value="">SELECCIONE</option>');
    for (var iD = 0; iD < zonasActualizas.length; iD++) {
      $("#sl_Zonas").append('<option value="' + zonasActualizas[iD].id + '">' + zonasActualizas[iD].descripcion + '</option>');
    }
    
    //Tabla
    $("#zonasGuardadas").empty();
    for (var iD = 0; iD < zonasActualizas.length; iD++) {
      $("#zonasGuardadas").append('<tr><td>' + zonasActualizas[iD].descripcion +
                                  '</td><td><input type="button" class="btn-sm btn-primary eliminarZona" value="Eliminar" rel="' + 
                                  zonasActualizas[iD].id + '" /></td></tr>');
    }
    
}
    
function cargaEscuelasActualizadas(escuelasZonaActualizas) {
    //Tabla
    $("#escuelasZonaGuardadas").empty();
    for (var iD = 0; iD < escuelasZonaActualizas.length; iD++) {
      $("#escuelasZonaGuardadas").append('<tr><td>' + escuelasZonaActualizas[iD].nombre +
                                  '</td><td><input type="button" class="btn-sm btn-primary eliminarEscuela" value="Eliminar" rel="' + 
                                  escuelasZonaActualizas[iD].id_escuela + '" /></td></tr>');
    }
    
}

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
                    '<th>1<sup>er</sup> apellido</th>' +
                    '<th>2<sup>do</sup> apellido</th>' +
                    '<th>Nombre</th>' +
                    '</tr></thead><tbody>');
            $('#SecElegGrupB').append('<thead><tr>' +
                    '<th colspan="5">' + consulta.nivelSeleccionado + '-' + consulta.grupoSeleccionado + ' B' + '</th>' +
                    '</tr><tr>' +
                    '<th>N°</th>' +
                    '<th>Identificación</th>' +
                    '<th>1<sup>er</sup> apellido</th>' +
                    '<th>2<sup>do</sup> apellido</th>' +
                    '<th>Nombre</th>' +
                    '</tr></thead><tbody>');
            $('#SecElegGrupC').append('<thead><tr>' +
                    '<th colspan="5">' + consulta.nivelSeleccionado + '-' + consulta.grupoSeleccionado + ' C' + '</th>' +
                    '</tr><tr>' +
                    '<th>N°</th>' +
                    '<th>Identificación</th>' +
                    '<th>1<sup>er</sup> apellido</th>' +
                    '<th>2<sup>do</sup> apellido</th>' +
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
            $('#SecElegGrupA').append('<tr><td colspan="5">Última línea</td></tr></tbody>');
            $('#SecElegGrupB').append('<tr><td colspan="5">Última línea</td></tr></tbody>');
            $('#SecElegGrupC').append('<tr><td colspan="5">Última línea</td></tr></tbody>');
        }, "json");
    });
    
    
    
    
    //CARGA CANTONES PARA LA ESCUELA//
    $("#slt_provinciaPrim").change(function() {
        $("#slt_cantonPrim,#slt_distritoPrim,#tf_primaria").empty();
        var idP = $("#slt_provinciaPrim").val();
        $.getJSON('cargaCantones/' + idP, function(canton) {
            $('#slt_cantonPrim').append('<option value="">SELECCIONE</option>');
            for (var iP = 0; iP < canton.length; iP++) {
                $("#slt_cantonPrim").append('<option value="' + canton[iP].IdCanton + '">' + canton[iP].Canton + '</option>');
            }
        });
    });
    //CARGA DISTRITOS PARA LA ESCUELA//
    $("#slt_cantonPrim").change(function() {
        $("#slt_distritoPrim,#tf_primaria").empty();
        var idD = $("#slt_cantonPrim").val();
        //var ids = $(this).attr('rel');
        $.getJSON('cargaDistritos/' + idD, function(distrito) {
            $('#slt_distritoPrim').append('<option value="">SELECCIONE</option>');
            for (var iD = 0; iD < distrito.length; iD++) {
                $("#slt_distritoPrim").append('<option value="' + distrito[iD].IdDistrito + '">' + distrito[iD].Distrito + '</option>');
            }
        });
    });
    //CARGA LAS ESCUELAS DE ESOS DISTRITOS//
    $("#slt_distritoPrim").change(function() {
        $("#tf_primaria").empty();
        
        var idD = $("#slt_distritoPrim").val();
        
        //var ids = $(this).attr('rel');
        $.getJSON('cargaEscuela/' + idD, function(escuela) {
            $('#tf_primaria').append('<option value="">SELECCIONE</option>');
            for (var iD = 0; iD < escuela.length; iD++) {
              $("#tf_primaria").append('<option value="' + escuela[iD].id + '">' + escuela[iD].nombre + '</option>');
            }
        });
    });

    //Agrego Zona a la BD y luego Carga las Zonas Actualizadas//
    $("#agregarZona").click(function(event) {
        var txt_zona = $("#txt_zona").val();
        if (jQuery.isEmptyObject(txt_zona)){
            alert("Por favor ingrese alguna descripción para la Zona.\nEj: Zona 01, Carrizal.");
        }else{
        $.getJSON('agregarZona/' + txt_zona, function(zonasActualizas) {
            if (jQuery.isEmptyObject(zonasActualizas)) {
                alert("No hay Zonas");
            } else {
                cargaZonasActualizadas(zonasActualizas);
            }
        });
        }
    });

    //Elimino Zona de la BD y luego Carga las Zonas Actualizadas//
    $(".eliminarZona").live('click', function(event) {
            var id = $(this).attr('rel');
            alert(id);
            
        $.getJSON('eliminarZona/' + id, function(zonasActualizas) {
            if (jQuery.isEmptyObject(zonasActualizas)) {
                alert("No hay Zonas");
            } else {
                cargaZonasActualizadas(zonasActualizas);
            }
        });
    });

    //Agrego Escuela a la Zona en la BD y luego Carga las Escuelas de la Zona Actualizada//
    $("#agregarEscuela").click(function(event) {
        var consulta = {id_escuela: $("#tf_primaria").val(), id_zona: $("#sl_Zonas").val()};
        var id_escuela = $("#tf_primaria").val();
        if (jQuery.isEmptyObject(id_escuela)){
            alert("Por favor seleccione una Escuela para la Zona.\nEj: Leon Cortes, Esc. Cinco Esquinas.");
        }else{
        $.post('agregarEscuela/', consulta, function(escuelasZonaActualizas, success) {
                $("#escuelasZonaGuardadas").empty();
                for (var linea = 0; linea < escuelasZonaActualizas.length; linea++) {
                    $('#escuelasZonaGuardadas').append('<tr><td>' +
                            escuelasZonaActualizas[linea].nombre +
                            '</td><td><input type="button" class="btn-sm btn-primary eliminarEscuela" value="Eliminar" rel="' + 
                            escuelasZonaActualizas[linea].id_escuela + '" /></td></tr>'
                    );
                }
        }, "json");
        }
    });
    
    //Carga las Escuelas de la Zona Seleccionada//
    $("#sl_Zonas").change(function() {
        var id_zona = $("#sl_Zonas").val();
        $("#escuelasZonaGuardadas").empty();
        $.getJSON('consultaEscuelaZona/' + id_zona, function(escuelasZonaActualizas) {
            cargaEscuelasActualizadas(escuelasZonaActualizas);
        });
    });
});