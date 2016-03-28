function cargaZonasActualizadas(zonasActualizas) {
    $("#txt_zona").val("");
    $("#sl_Zonas").empty();
    $("#sl_ZonasDistrito").empty();
    $("#sl_ZonasSecciones").empty();
    
    $('#sl_Zonas').append('<option value="">SELECCIONE</option>');
    for (var iD = 0; iD < zonasActualizas.length; iD++) {
      $("#sl_Zonas").append('<option value="' + zonasActualizas[iD].id + '">' + zonasActualizas[iD].descripcion + '</option>');
    }
    $('#sl_ZonasDistrito').append('<option value="">SELECCIONE</option>');
    for (var iD = 0; iD < zonasActualizas.length; iD++) {
      $("#sl_ZonasDistrito").append('<option value="' + zonasActualizas[iD].id + '">' + zonasActualizas[iD].descripcion + '</option>');
    }
    $('#sl_ZonasSecciones').append('<option value="">SELECCIONE</option>');
    for (var iD = 0; iD < zonasActualizas.length; iD++) {
      $("#sl_ZonasSecciones").append('<option value="' + zonasActualizas[iD].id + '">' + zonasActualizas[iD].descripcion + '</option>');
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
    
function cargaDistritosActualizados(distritosZonaActualiza) {
    //Tabla
    $("#distritosZonaGuardadas").empty();
    for (var iD = 0; iD < distritosZonaActualiza.length; iD++) {
      $("#distritosZonaGuardadas").append('<tr><td>' + distritosZonaActualiza[iD].Distrito +
                                  '</td><td><input type="button" class="btn-sm btn-primary eliminarDistrito" value="Eliminar" rel="' + 
                                  distritosZonaActualiza[iD].IdDistrito + '" /></td></tr>');
    }
    
}
    
function cargaCantidadSecciones(cantidadSeccionesActualizas) {
    //Tabla
    $("#cantidadSeccionesGuardadas").empty();
    $("#cantidadSeccionesGuardadas").append('<thead><tr><th colspan="2">Estado Actual</th></tr></thead><tbody>');
    for (var iD = 0; iD < cantidadSeccionesActualizas.length; iD++) {
      $("#cantidadSeccionesGuardadas").append('<tr><td>' + cantidadSeccionesActualizas[iD].descripcion +
                                  '</td><td>' + cantidadSeccionesActualizas[iD].cantidadSecciones + '</td></tr></tbody>');
    }
    
}

$(function()
{
    //Carga los Grupos//
    $("#tf_Niveles").change(function() {
        $("#listaEstudiantes").empty();
        $("#tf_Grupos").empty();
        var nivelSeleccionado = $("#tf_Niveles").val();
        $.getJSON('../seccion/cargaGrupos/' + nivelSeleccionado, function(Gru) {
            $('#tf_Grupos').append('<option value="">Seleccione</option>');
            for (var iP = 0; iP < Gru.length; iP++) {
                $("#tf_Grupos").append('<option value="' + Gru[iP].grupo + '">' + Gru[iP].grupo + '</option>');
            }
        });
    });

    //Carga los Estudiantes de una sección en especifico//
    $("#tf_Grupos").change(function() {
        $("#listaEstudiantes").empty();

        var banderaGrupoB=0;
        var banderaGrupoC=0;
        var consulta = {nivelSeleccionado: $("#tf_Niveles").val(), grupoSeleccionado: $("#tf_Grupos").val()};
        
        $.post('../seccion/cargaSeccion/', consulta, function(seccionElegida, success) {
            var arraySalida="";
            arraySalida+='<thead><tr><td colspan="4" class="text-center">' + consulta.nivelSeleccionado + '-' + consulta.grupoSeleccionado + '</td></tr>';
            arraySalida+='<tr><td colspan="4" class="text-center">&nbsp;</td></tr><tr><td colspan="4" class="text-center">Grupo A</td></tr>';
            arraySalida+='<tr><th>N°</th><th>Identificación</th><th>Nombre del Estudiante</th><th>Condición</th></tr></thead><tbody>';
            
            for (var linea = 0; linea < seccionElegida.length; linea++) {
                if(seccionElegida[linea].sub_grupo=='B' && banderaGrupoB==0){
                    arraySalida+='<tr><td colspan="4" class="text-center">&nbsp;</td></tr><tr><td colspan="4" class="text-center">Grupo B</td></tr>';
                    banderaGrupoB=1;
                }else if(seccionElegida[linea].sub_grupo=='C' && banderaGrupoC==0){
                    arraySalida+='<tr><td colspan="4" class="text-center">&nbsp;</td></tr><tr><td colspan="4" class="text-center">Grupo C</td></tr>';
                    banderaGrupoC=1;
                }
                
                arraySalida+='<tr><td>' + (linea + 1) + '</td><td>' +
                        seccionElegida[linea].cedula + '</td><td>' + seccionElegida[linea].apellido1 + ' ' +
                        seccionElegida[linea].apellido2 + ' ' + seccionElegida[linea].nombre + '</td><td>' +
                        seccionElegida[linea].condicion + '</td></tr>';
            }
            
            arraySalida+='<tr><td colspan="4" class="text-center">Ultima Línea</td></tr></tbody>';
            $('#listaEstudiantes').append(arraySalida);
        }, "json");
    });
    
    //CARGA CANTONES PARA LA ESCUELA//
    $("#slt_provinciaPrim").change(function() {
        $("#slt_cantonPrim,#slt_distritoPrim,#tf_primaria").empty();
        var idP = $("#slt_provinciaPrim").val();
        $.getJSON('../cargaCantones/' + idP, function(canton) {
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
        $.getJSON('../cargaDistritos/' + idD, function(distrito) {
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
        $.getJSON('../cargaEscuela/' + idD, function(escuela) {
            $('#tf_primaria').append('<option value="">SELECCIONE</option>');
            for (var iD = 0; iD < escuela.length; iD++) {
              $("#tf_primaria").append('<option value="' + escuela[iD].id + '">' + escuela[iD].nombre + '</option>');
            }
        });
    });

    //Agrego Zona a la BD y luego Carga las Zonas Actualizadas//
    $("#agregarZona").click(function(event) {
        var consulta = {txt_zona: $("#txt_zona").val(), nivel: $("#nivel").text()};
        var txt_zona = $("#txt_zona").val();
        if (jQuery.isEmptyObject(txt_zona)){
            alert("Por favor ingrese alguna descripción para la Zona.\nEj: Zona 01, Carrizal.");
        }else{
        $.post('../agregarZona/', consulta, function(zonasActualizas) {
            if (jQuery.isEmptyObject(zonasActualizas)) {
                alert("No hay Zonas");
                $("#zonasGuardadas").empty();
            } else {
                cargaZonasActualizadas(zonasActualizas);
            }
        }, "json");
        }
    });

    //Elimino Zona de la BD y luego Carga las Zonas Actualizadas//
    $(".eliminarZona").live('click', function(event) {
        var consulta = {id: $(this).attr('rel'), nivel: $("#nivel").text()};
            
        $.post('../eliminarZona/',consulta, function(zonasActualizas) {
            if (jQuery.isEmptyObject(zonasActualizas)) {
                alert("No hay Zonas");
                $("#zonasGuardadas").empty();
            } else {
                cargaZonasActualizadas(zonasActualizas);
            }
        }, "json");
    });

    //Agrego Escuela a la Zona en la BD y luego Carga las Escuelas de la Zona Actualizada//
    $("#agregarEscuela").click(function(event) {
        var consulta = {id_escuela: $("#tf_primaria").val(), id_zona: $("#sl_Zonas").val(), nivel: $("#nivel").text()};
        var id_escuela = $("#tf_primaria").val();
        if (jQuery.isEmptyObject(id_escuela)){
            alert("Por favor seleccione una Escuela para la Zona.\nEj: Leon Cortes, Esc. Cinco Esquinas.");
        }else{
        $.post('../agregarEscuela/', consulta, function(escuelasZonaActualizas, success) {
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

    //Elimino la Escuela de la BD y luego Carga las Escuelas Actualizadas//
    $(".eliminarEscuela").live('click', function(event) {
        var consulta = {id_escuela: $(this).attr('rel'), id_zona: $("#sl_Zonas").val()};
            
        $.post('../eliminarEscuela/', consulta, function(escuelasActualizas, success) {
            if (jQuery.isEmptyObject(escuelasActualizas)) {
                alert("No hay Escuela");
                $("#escuelasZonaGuardadas").empty();
            } else {
                cargaEscuelasActualizadas(escuelasActualizas);
            }
        }, "json");
    });
    
    //Carga las Escuelas de la Zona Seleccionada//
    $("#sl_Zonas").change(function() {
        var id_zona = $("#sl_Zonas").val();
        $("#escuelasZonaGuardadas").empty();
        $.getJSON('../consultaEscuelaZona/' + id_zona, function(escuelasZonaActualizas) {
            cargaEscuelasActualizadas(escuelasZonaActualizas);
        });
    });
    
    //Verifico cual RadioButton fue elegido, para cargar Escuelas o Distritos
    $("input[name=rb_zona]").click(function () {    
        var tipoZona = $('input:radio[name=rb_zona]:checked').val();
        if (tipoZona=="Distrito"){
             document.getElementById("zonasPorDistrito").style.display = 'block';
             document.getElementById("resumenZonasPorDistrito").style.display = 'block';
             document.getElementById("zonasPorEscuela").style.display = 'none';
             document.getElementById("resumenZonasPorEscuela").style.display = 'none';
        }else{
             document.getElementById("zonasPorEscuela").style.display = 'block';
             document.getElementById("resumenZonasPorEscuela").style.display = 'block';
             document.getElementById("zonasPorDistrito").style.display = 'none';
             document.getElementById("resumenZonasPorDistrito").style.display = 'none';
        }
        
    });
    
    
    
    //Zonas por distrito
    //CARGA CANTONES//
    $("#slt_provincia").change(function() {
        $("#slt_canton,#slt_distrito").empty();
        var idP = $("#slt_provincia").val();
        $.getJSON('../cargaCantones/' + idP, function(canton) {
            $('#slt_canton').append('<option value="">SELECCIONE</option>');
            for (var iP = 0; iP < canton.length; iP++) {
                $("#slt_canton").append('<option value="' + canton[iP].IdCanton + '">' + canton[iP].Canton + '</option>');
            }
        });
    });
    //CARGA DISTRITOS//
    $("#slt_canton").change(function() {
        $("#slt_distrito").empty();
        var idD = $("#slt_canton").val();
        $.getJSON('../cargaDistritos/' + idD, function(distrito) {
            $('#slt_distrito').append('<option value="">SELECCIONE</option>');
            for (var iD = 0; iD < distrito.length; iD++) {
                $("#slt_distrito").append('<option value="' + distrito[iD].IdDistrito + '">' + distrito[iD].Distrito + '</option>');
            }
        });
    });

    //Agrego Distrito a la Zona en la BD y luego Carga los Distrito de la Zona Actualizada//
    $("#agregarDistrito").click(function(event) {
        var consulta = {id_distrito: $("#slt_distrito").val(), id_zona: $("#sl_ZonasDistrito").val(), nivel: $("#nivel").text()};
        var id_distrito = $("#slt_distrito").val();
        if (jQuery.isEmptyObject(id_distrito)){
            alert("Por favor seleccione un Distrito para la Zona.\nEj: Carrizal, Barva");
        }else{
        $.post('../agregarDistrito/', consulta, function(distritosZonaActualiza, success) {
                $("#distritosZonaGuardadas").empty();
                for (var linea = 0; linea < distritosZonaActualiza.length; linea++) {
                    $('#distritosZonaGuardadas').append('<tr><td>' +
                            distritosZonaActualiza[linea].Distrito +
                            '</td><td><input type="button" class="btn-sm btn-primary eliminarDistrito" value="Eliminar" rel="' + 
                            distritosZonaActualiza[linea].IdDistrito + '" /></td></tr>'
                    );
                }
        }, "json");
        }
    });

    //Elimino el Distrito de la BD y luego Carga los rDistrito Actualizados//
    $(".eliminarDistrito").live('click', function(event) {
        var consulta = {id_distrito: $(this).attr('rel'), id_zona: $("#sl_ZonasDistrito").val()};
            
        $.post('../eliminarDistrito/', consulta, function(distritosActualizas, success) {
            if (jQuery.isEmptyObject(distritosActualizas)) {
                alert("No hay Distrito");
                $("#distritosZonaGuardadas").empty();
            } else {
                cargaDistritosActualizados(distritosActualizas);
            }
        }, "json");
    });
    
    //Carga los Distrito de la Zona Seleccionada//
    $("#sl_ZonasDistrito").change(function() {
        var id_zona = $("#sl_ZonasDistrito").val();
        $("#distritosZonaGuardadas").empty();
        $.getJSON('../consultaDistritoZona/' + id_zona, function(distritosZonaActualiza) {
            cargaDistritosActualizados(distritosZonaActualiza);
        });
    });

    //Agrego cantidad de secciones por la Zonas//
    $("#agregarCantidadSecciones").click(function(event) {
        var consulta = {id_zona: $("#sl_ZonasSecciones").val(), cantidadSecciones: $("#sl_CantidadSecciones").val(), nivel: $("#nivel").text()};
        if (jQuery.isEmptyObject(consulta['id_zona']) || jQuery.isEmptyObject(consulta['cantidadSecciones'])){
            alert("Por favor seleccione una Zona y un N° de Secciones");
        }else{$.post('../guardarCantidadSecciones/', consulta, function(cantidadSeccionesActualizas, success) {
            if (jQuery.isEmptyObject(cantidadSeccionesActualizas)) {
                alert("No hay Distrito");
                $("#cantidadSeccionesGuardadas").empty();
            } else {
                cargaCantidadSecciones(cantidadSeccionesActualizas);
            }
        }, "json");
        }
    });

    //Carga las Secciones//
    $("#proyectarSeccionesOpcionB").click(function(event) {
        document.getElementById("resumenSecciones").style.display = 'block';
        //envio el nivel al model y me devuelve un string que agrego a un div
        $.getJSON('../consultaZonasOpcionB/' + $("#nivel").text(), function() {
        }).done(function(estudiantes) {
            $("#resumenSecciones").empty();
            $('#resumenSecciones').append(estudiantes);
	}).fail(function() {
		alert("Se produjo un error, verifique que la(s) zona(s) del nivel seleccionado posee algun(os) Distrito(s) y que esos Distrito(s) poseean estudiantes");
	});
    });
});