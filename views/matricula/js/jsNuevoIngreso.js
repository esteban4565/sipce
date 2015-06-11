$(function()
{
    //Fecha Nacimiento//
    $("#tf_fnacpersona").datepicker({dateFormat: 'yy-mm-dd'});
    //Fecha Vence Poliza//
    $("#tf_polizaVence").datepicker({dateFormat: 'yy-mm-dd'});

    //Carga los cantones//
    $("#tf_provincias_NI").change(function() {
        $("#tf_cantones_NI,#tf_distritos_NI").empty();
        var idP = $("#tf_provincias_NI").val();
        $.getJSON('cargaCantones/' + idP, function(canton) {
            $('#tf_cantones_NI').append('<option value="">Seleccione</option>');
            for (var iP = 0; iP < canton.length; iP++) {
                $("#tf_cantones_NI").append('<option value="' + canton[iP].IdCanton + '">' + canton[iP].Canton + '</option>');
            }
        });
    });

    //Carga los distritos//
    $("#tf_cantones_NI").change(function() {
        $("#tf_distritos_NI").empty();
        var idD = $("#tf_cantones_NI").val();
        //var ids = $(this).attr('rel');
        $.getJSON('cargaDistritos/' + idD, function(distrito) {
            $('#tf_distritos_NI').append('<option value="">Seleccione</option>');
            for (var iD = 0; iD < distrito.length; iD++) {
                $("#tf_distritos_NI").append('<option value="' + distrito[iD].IdDistrito + '">' + distrito[iD].Distrito + '</option>');
            }
        });
    });

    //Carga los datos del Estudiante//
    $("#buscarEstudiante").click(function(event) {
        var idD = $("#tf_cedulaEstudiante").val();
        $.getJSON('buscarEstudiante/' + idD, function(resulBusqueda) {
            $("#tf_ape1").val(resulBusqueda[0].primerApellido);
            $("#tf_ape2").val(resulBusqueda[0].segundoApellido);
            $("#tf_nombre").val(resulBusqueda[0].nombre);
            $("#tf_fnacpersona").val(resulBusqueda[0].fechaNacimiento);
            var anioNacimiento = 2015 - (resulBusqueda[0].fechaNacimiento).substring(0, 4);
            $("#tf_edad").val(anioNacimiento);
            $("#tf_genero").val(resulBusqueda[0].sexo);
        });
    });

    //Carga los datos del Encargado Legal//
    $("#buscarEncargado_NI").click(function(event) {
        var idD = $("#tf_cedulaEncargado_NI").val();
        $.getJSON('buscarEncargado/' + idD, function(resulBusqueda) {
            $("#tf_ape1Encargado_NI").val(resulBusqueda[0].primerApellido);
            $("#tf_ape2Encargado_NI").val(resulBusqueda[0].segundoApellido);
            $("#tf_nombreEncargado_NI").val(resulBusqueda[0].nombre);
            $("#tf_telHabitEncargado").val("");
            $("#tf_telcelularEncargado").val("");
            $("#tf_ocupacionEncargado").val("");
            $("#tf_emailEncargado").val("");
        });
    });

    //Carga los datos de la Madre//
    $("#buscarMadre_NI").click(function(event) {
        var idD = $("#tf_cedulaMadre_NI").val();
        $.getJSON('buscarMadre/' + idD, function(resulBusqueda) {
            $("#tf_ape1Madre_NI").val(resulBusqueda[0].primerApellido);
            $("#tf_ape2Madre_NI").val(resulBusqueda[0].segundoApellido);
            $("#tf_nombreMadre_NI").val(resulBusqueda[0].nombre);
            $("#tf_telCelMadre").val("");
            $("#tf_ocupacionMadre").val("");
        });
    });

    //Carga los datos del Padre//
    $("#buscarPadre_NI").click(function(event) {
        var idD = $("#tf_cedulaPadre_NI").val();
        $.getJSON('buscarPadre/' + idD, function(resulBusqueda) {
            $("#tf_ape1Padre_NI").val(resulBusqueda[0].primerApellido);
            $("#tf_ape2Padre_NI").val(resulBusqueda[0].segundoApellido);
            $("#tf_nombrePadre_NI").val(resulBusqueda[0].nombre);
            $("#tf_telCelPadre").val("");
            $("#tf_ocupacionPadre").val("");
        });
    });


    //Carga datos de Encargado Legal a Padre o Madre//
    $("#sel_parentesco").change(function() {
        var parentesco = $("#sel_parentesco").val();
        if (parentesco === 'Padre') {
            $("#tf_cedulaPadre_NI").val($("#tf_cedulaEncargado_NI").val());
            $("#tf_ape1Padre_NI").val($("#tf_ape1Encargado_NI").val());
            $("#tf_ape2Padre_NI").val($("#tf_ape2Encargado_NI").val());
            $("#tf_nombrePadre_NI").val($("#tf_nombreEncargado_NI").val());
            $("#tf_telCelPadre").val($("#tf_telcelularEncargado").val());
            $("#tf_ocupacionPadre").val($("#tf_ocupacionEncargado").val());
        } else
        {
            if (parentesco === 'Madre') {
                $("#tf_cedulaMadre_NI").val($("#tf_cedulaEncargado_NI").val());
                $("#tf_ape1Madre_NI").val($("#tf_ape1Encargado_NI").val());
                $("#tf_ape2Madre_NI").val($("#tf_ape2Encargado_NI").val());
                $("#tf_nombreMadre_NI").val($("#tf_nombreEncargado_NI").val());
                $("#tf_telCelMadre").val($("#tf_telcelularEncargado").val());
                $("#tf_ocupacionMadre").val($("#tf_ocupacionEncargado").val());
            }
        }
    });

    //Carga los datos de de la Persona En Caso de Emergencia//
    $("#buscarPersonaEmergencia_NI").click(function(event) {
        var idD = $("#tf_cedulaPersonaEmergencia_NI").val();
        $.getJSON('buscarPersonaEmergencia/' + idD, function(resulBusqueda) {
            $("#tf_ape1PersonaEmergencia_NI").val(resulBusqueda[0].primerApellido);
            $("#tf_ape2PersonaEmergencia_NI").val(resulBusqueda[0].segundoApellido);
            $("#tf_nombrePersonaEmergencia_NI").val(resulBusqueda[0].nombre);
            $("#tf_telHabitPersonaEmergencia").val("");
            $("#tf_telcelularPersonaEmergencia").val("");
        });
    });

    //Muestra casilla especialidad si nivel es > a 9//
    $("#sl_nivelMatricular").change(function() {
        var nivel = $("#sl_nivelMatricular").val();
        if (nivel > 9) {
            document.getElementById("especialidadLabel").style.display = 'block';
            document.getElementById("especialidad").style.display = 'block';
        } 
        else{
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
        else{
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
        else{
            document.getElementById("buscarEstudiante").style.display = 'block';
        }
    });
}); 