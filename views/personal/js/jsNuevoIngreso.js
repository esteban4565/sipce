$(function(){
    $("#slt_nacionalidad").change(function() {
        var codigoPais = $("#slt_nacionalidad").val();
        if (codigoPais !== "506") {
            document.getElementById("buscarEstudiante").style.display = 'none';
        }
        else {
            document.getElementById("buscarEstudiante").style.display = 'block';
        }
    });
    ////////////////////////////////////////////////////////////////////////////
    //Carga los datos del personal//
    $("#buscarEstudiante").click(function(event) {
        var idD = $("#txt_cedulaPersonal").val();
        if (jQuery.isEmptyObject(idD)){
            alert("Por favor ingrese el número de identificación.\nEj: 2-0456-0789, 1-1122-0567.\nNota: La Base de Datos esta actualizada al 2013 y solo posee Costarricenses y Nacionalizados");
        }else{
        $.getJSON('buscarEstudiante/' + idD, function(resulBusqueda) {
            if (jQuery.isEmptyObject(resulBusqueda)) {
                alert("Persona no encontrada, verifique el formato (ceros y guiones) y número de identificación.\nEj: 2-0456-0789, 1-1122-0567.\nNota: La Base de Datos esta actualizada al 2013 y solo posee Costarricenses y Nacionalizados");
            } else {
                $("#txt_apellido1").val(resulBusqueda[0].primerApellido);
                $("#txt_apellido2").val(resulBusqueda[0].segundoApellido);
                $("#txt_nombre").val(resulBusqueda[0].nombre);
                $("#txt_fnacpersona").val(resulBusqueda[0].fechaNacimiento);
                var anioNacimiento = 2015 - (resulBusqueda[0].fechaNacimiento).substring(0, 4);
                $("#txt_edad").val(anioNacimiento);
                $("#slt_genero").val(resulBusqueda[0].sexo);
            }
        });
        }
    });
    ////////////////////////////////////////////////////////////////////////////
    //Carga los cantones para domicilio//
    $("#slt_provinciaDom").change(function() {
        $("#slt_cantonDom,#slt_distritoDom").empty();
        var idP = $("#slt_provinciaDom").val();
        $.getJSON('cargaCantones/' + idP, function(canton) {
            $('#slt_cantonDom').append('<option value="">Seleccione</option>');
            for (var iP = 0; iP < canton.length; iP++) {
                $("#slt_cantonDom").append('<option value="' + canton[iP].IdCanton + '">' + canton[iP].Canton + '</option>');
            }
        });
    });
    //Carga los distritos para domicilio//
    $("#slt_cantonDom").change(function() {
        $("#slt_distritoDom").empty();
        var idD = $("#slt_cantonDom").val();
        //var ids = $(this).attr('rel');
        $.getJSON('cargaDistritos/' + idD, function(distrito) {
            $('#slt_distritoDom').append('<option value="">Seleccione</option>');
            for (var iD = 0; iD < distrito.length; iD++) {
                $("#slt_distritoDom").append('<option value="' + distrito[iD].IdDistrito + '">' + distrito[iD].Distrito + '</option>');
            }
        });
    });
    ////////////////////////////////////////////////////////////////////////////
    //Carga los cantones para domicilio clases//
    $("#slt_provinciaClases").change(function() {
        $("#slt_cantonClases,#slt_distritoClases").empty();
        var idP = $("#slt_provinciaClases").val();
        $.getJSON('cargaCantones/' + idP, function(canton) {
            $('#slt_cantonClases').append('<option value="">Seleccione</option>');
            for (var iP = 0; iP < canton.length; iP++) {
                $("#slt_cantonClases").append('<option value="' + canton[iP].IdCanton + '">' + canton[iP].Canton + '</option>');
            }
        });
    });
    //Carga los distritos para domicilio//
    $("#slt_cantonClases").change(function() {
        $("#slt_distritoClases").empty();
        var idD = $("#slt_cantonClases").val();
        //var ids = $(this).attr('rel');
        $.getJSON('cargaDistritos/' + idD, function(distrito) {
            $('#slt_distritoClases').append('<option value="">Seleccione</option>');
            for (var iD = 0; iD < distrito.length; iD++) {
                $("#slt_distritoClases").append('<option value="' + distrito[iD].IdDistrito + '">' + distrito[iD].Distrito + '</option>');
            }
        });
    });
    ////////////////////////////////////////////////////////////////////////////
    //Carga los datos de de la Persona En Caso de Emergencia//
    $("#btnBuscarPersonaEmergencia").click(function(event) {
        var idD = $("#slt_parentescoCasoEmergencia").val();
        if (jQuery.isEmptyObject(idD)){
            alert("Por favor ingrese el número de identificación.\nEj: 2-0456-0789, 1-1122-0567.\nNota: La Base de Datos esta actualizada al 2013 y solo posee Costarricenses y Nacionalizados");
        }else{
        $.getJSON('buscarPersonaEmergencia/' + idD, function(resulBusqueda) {
            if (jQuery.isEmptyObject(resulBusqueda)) {
                alert("Persona no encontrada, verifique el formato (ceros y guiones) y número de identificación.\nEj: 2-0456-0789, 1-1122-0567.\nNota: La Base de Datos esta actualizada al 2013 y solo posee Costarricenses y Nacionalizados");
            } else {
            $("#tf_ape1PersonaEmergencia_NI").val(resulBusqueda[0].primerApellido);
            $("#tf_ape2PersonaEmergencia_NI").val(resulBusqueda[0].segundoApellido);
            $("#tf_nombrePersonaEmergencia_NI").val(resulBusqueda[0].nombre);
            $("#tf_telHabitPersonaEmergencia").val("");
            $("#tf_telcelularPersonaEmergencia").val("");
            }
        });
        }
    });
    ////////////////////////////////////////////////////////////////////////////
});//Cierre de funcion principal

//Agregar mas universidades//
$(document).on("ready",Universidades);

function Universidades()
{
    $("#btnAgregarUniversidad").on("click", nuevaUniversidad);
    $("body").on("click", ".delette", eliminarUniversidad);
}
function nuevaUniversidad()
{
       
    $("#AgregarUniversidad")
        .append
        (
                $('<div class="form-group">')
                .append
                    (
                        $('<label for="slt_nombreUniversidad[]" class="col-xs-2 control-label">Nombre Universidad:</label>')
                    )
                .append
                    ($('<div class="col-xs-2">')
                        .append
                            (
                                    
                            $('<select class="form-control input-sm validate[required]" name="slt_nombreUniversidad[]"><option value="">Seleccione</option>')
                            
                            )
                    )
                .append
                    ($('</div>'))
                    
                ////////////////////////////////////////////////////////////////
                
                .append
                    (
                        $('<label for="tf_nombreUniversidad" class="col-xs-2 control-label">Año Finaliza:</label>')
                    )
                .append
                    ($('<div class="col-xs-2">')
                        .append
                            ($('<input type="text" class="form-control input-sm validate[required]" id="tf_anoFinaliza[]" name="tf_anoFinaliza[]"/>'))
                    )
                .append
                    ($('</div>'))
                ///////////////////////////////////////////////////////////////
                .append
                    ($('<div class="col-xs-2">')
                        .append
                            ($('<input type="button" class="delette btn-xs btn-primary" id="delette[]" name="delette[]" value="Eliminar"/>'))
                    )
                .append
                    ($('</div>'))
        )
        .append
        (
                ($('</div>'))
        );
}
function eliminarUniversidad(){
    $(this).parent().parent().fadeOut("slow", function(){$(this).remove();});
}

////////////////////////////////////////////////////////////////////////////////
//Oculta Boton Buscar si es extrangero//
    
////////////////////////////////////////////////////////////////////////////////
$.datepicker.regional['es'] = {
 closeText: 'Cerrar',
 prevText: '<Ant',
 nextText: 'Sig>',
 currentText: 'Hoy',
 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
 dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
 weekHeader: 'Sm',
 dateFormat: 'dd/mm/yy',
 firstDay: 1,
 isRTL: false,
 showMonthAfterYear: false,
 yearSuffix: ''
 };
 $.datepicker.setDefaults($.datepicker.regional['es']);
 
$(function()
{
    //Fecha Nacimiento//
    $("#tf_fnacpersona").datepicker({dateFormat: 'yy-mm-dd',
                                    changeMonth: true,
                                    changeYear: true
                                    });
    //Fecha Vence Poliza//
    $("#tf_polizaVence").datepicker({dateFormat: 'yy-mm-dd',
                                    changeMonth: true,
                                    changeYear: true
                                    });
                                    
    //Edad Estudiante al cambiar fecha//
    $("#tf_fnacpersona").change(function() {
        $("#tf_edad").empty();
        var fechaNacimiento=$("#tf_fnacpersona").val();
        var anioNacimiento = 2015 - (fechaNacimiento).substring(0, 4);
        $("#tf_edad").val(anioNacimiento);
        });

    //Carga los datos del Encargado Legal//
    $("#buscarEncargado_NI").click(function(event) {
        var idD = $("#tf_cedulaEncargado_NI").val();
        if (jQuery.isEmptyObject(idD)){
            alert("Por favor ingrese el número de identificación.\nEj: 2-0456-0789, 1-1122-0567.\nNota: La Base de Datos esta actualizada al 2013 y solo posee Costarricenses y Nacionalizados");
        }else{
        $.getJSON('buscarEncargado/' + idD, function(resulBusqueda) {
            if (jQuery.isEmptyObject(resulBusqueda)) {
                alert("Persona no encontrada, verifique el formato (ceros y guiones) y número de identificación.\nEj: 2-0456-0789, 1-1122-0567.\nNota: La Base de Datos esta actualizada al 2013 y solo posee Costarricenses y Nacionalizados");
            } else {
                $("#tf_ape1Encargado_NI").val(resulBusqueda[0].primerApellido);
                $("#tf_ape2Encargado_NI").val(resulBusqueda[0].segundoApellido);
                $("#tf_nombreEncargado_NI").val(resulBusqueda[0].nombre);
                $("#tf_telHabitEncargado").val("");
                $("#tf_telcelularEncargado").val("");
                $("#tf_ocupacionEncargado").val("");
                $("#tf_emailEncargado").val("");
            }
        });
        }
    });

    //Carga los datos de la Madre//
    $("#buscarMadre_NI").click(function(event) {
        var idD = $("#tf_cedulaMadre_NI").val();
        if (jQuery.isEmptyObject(idD)){
            alert("Por favor ingrese el número de identificación.\nEj: 2-0456-0789, 1-1122-0567.\nNota: La Base de Datos esta actualizada al 2013 y solo posee Costarricenses y Nacionalizados");
        }else{
        $.getJSON('buscarMadre/' + idD, function(resulBusqueda) {
            if (jQuery.isEmptyObject(resulBusqueda)) {
                alert("Persona no encontrada, verifique el formato (ceros y guiones) y número de identificación.\nEj: 2-0456-0789, 1-1122-0567.\nNota: La Base de Datos esta actualizada al 2013 y solo posee Costarricenses y Nacionalizados");
            } else {
                $("#tf_ape1Madre_NI").val(resulBusqueda[0].primerApellido);
                $("#tf_ape2Madre_NI").val(resulBusqueda[0].segundoApellido);
                $("#tf_nombreMadre_NI").val(resulBusqueda[0].nombre);
                $("#tf_telCelMadre").val("");
                $("#tf_ocupacionMadre").val("");
            }
        });
        }
    });

    //Carga datos de Padre o Madre a PersonaEmergencia//
    $("#sel_parentescoCasoEmergencia").change(function() {
        var parentesco = $("#sel_parentescoCasoEmergencia").val();
        if (parentesco === 'Padre') {
            $("#tf_cedulaPersonaEmergencia").val($("#tf_cedulaPadre").val());
            $("#tf_ape1PersonaEmergencia").val($("#tf_ape1Padre").val());
            $("#tf_ape2PersonaEmergencia").val($("#tf_ape2Padre").val());
            $("#tf_nombrePersonaEmergencia").val($("#tf_nombrePadre").val());
            $("#tf_telcelularPersonaEmergencia").val($("#tf_telCelPadre").val());
        } else
        {
            if (parentesco === 'Madre') {
                $("#tf_cedulaPersonaEmergencia").val($("#tf_cedulaMadre").val());
                $("#tf_ape1PersonaEmergencia").val($("#tf_ape1Madre").val());
                $("#tf_ape2PersonaEmergencia").val($("#tf_ape2Madre").val());
                $("#tf_nombrePersonaEmergencia").val($("#tf_nombreMadre").val());
                $("#tf_telcelularPersonaEmergencia").val($("#tf_telCelMadre").val());
            }
        }
    });

    //Muestra casilla especialidad si nivel es > a 9//
    $("#sl_nivelMatricular").change(function() {
        var nivel = $("#sl_nivelMatricular").val();
        if (nivel > 9) {
            document.getElementById("especialidadLabel").style.display = 'block';
            document.getElementById("especialidad").style.display = 'block';
        }
        else {
            document.getElementById("especialidadLabel").style.display = 'none';
            document.getElementById("especialidad").style.display = 'none';
        }
    });

    //Muestra casilla Adelanta si el estudiante Repite//
    $("#sl_condicion").change(function() {
        var condicion = $("#sl_condicion").val();
        if (condicion === "Repite") {
            document.getElementById("sl_adelantaLabel").style.display = 'block';
            document.getElementById("sl_adelanta").style.display = 'block';
        }
        else {
            document.getElementById("sl_adelantaLabel").style.display = 'none';
            document.getElementById("sl_adelanta").style.display = 'none';
        }
    });

    //Oculta Boton Buscar si es extrangero//
    $("#tf_nacionalidad").change(function() {
        var codigoPais = $("#tf_nacionalidad").val();
        if (codigoPais !== "506") {
            document.getElementById("buscarEstudiante").style.display = 'none';
        }
        else {
            document.getElementById("buscarEstudiante").style.display = 'block';
        }
    });
}); 