$(function()
{
    //Fecha Nacimiento//
    $("#tf_fnacpersona").datepicker({dateFormat: 'yy-mm-dd'});
    //Fecha Vence Poliza//
    $("#tf_polizaVence").datepicker({dateFormat: 'yy-mm-dd'});

    //Carga los cantones//
    $("#tf_provincias").change(function() {
        $("#tf_cantones,#tf_distritos").empty();
        var idP = $("#tf_provincias").val();
        $.getJSON('../cargaCantones/' + idP, function(canton) {
            $('#tf_cantones').append('<option value="">Seleccione</option>');
            for (var iP = 0; iP < canton.length; iP++) {
                $("#tf_cantones").append('<option value="' + canton[iP].IdCanton + '">' + canton[iP].Canton + '</option>');
            }
        });
    });

    //Carga los distritos//
    $("#tf_cantones").change(function() {
        $("#tf_distritos").empty();
        var idD = $("#tf_cantones").val();
        //var ids = $(this).attr('rel');
        $.getJSON('../cargaDistritos/' + idD, function(distrito) {
            $('#tf_distritos').append('<option value="">Seleccione</option>');
            for (var iD = 0; iD < distrito.length; iD++) {
                $("#tf_distritos").append('<option value="' + distrito[iD].IdDistrito + '">' + distrito[iD].Distrito + '</option>');
            }
        });
    });

    //Carga los datos del Encargado Legal//
    $("#buscarEncargado").click(function(event) {
        var idD = $("#tf_cedulaEncargado").val();
        $.getJSON('../buscarEncargado/' + idD, function(resulBusqueda) {
            $("#tf_ape1Encargado").val(resulBusqueda[0].primerApellido);
            $("#tf_ape2Encargado").val(resulBusqueda[0].segundoApellido);
            $("#tf_nombreEncargado").val(resulBusqueda[0].nombre);
            $("#tf_telHabitEncargado").val("");
            $("#tf_telcelularEncargado").val("");
            $("#tf_ocupacionEncargado").val("");
            $("#tf_emailEncargado").val("");
        });
    });

    //Carga los datos de la Madre//
    $("#buscarMadre").click(function(event) {
        var idD = $("#tf_cedulaMadre").val();
        $.getJSON('../buscarMadre/' + idD, function(resulBusqueda) {
            $("#tf_ape1Madre").val(resulBusqueda[0].primerApellido);
            $("#tf_ape2Madre").val(resulBusqueda[0].segundoApellido);
            $("#tf_nombreMadre").val(resulBusqueda[0].nombre);
            $("#tf_telCelMadre").val("");
            $("#tf_ocupacionMadre").val("");
        });
    });

    //Carga los datos del Padre//
    $("#buscarPadre").click(function(event) {
        var idD = $("#tf_cedulaPadre").val();
        $.getJSON('../buscarPadre/' + idD, function(resulBusqueda) {
            $("#tf_ape1Padre").val(resulBusqueda[0].primerApellido);
            $("#tf_ape2Padre").val(resulBusqueda[0].segundoApellido);
            $("#tf_nombrePadre").val(resulBusqueda[0].nombre);
            $("#tf_telCelPadre").val("");
            $("#tf_ocupacionPadre").val("");
        });
    });


    //Carga datos de Encargado Legal a Padre o Madre//
    $("#sel_parentesco").change(function() {
        var parentesco = $("#sel_parentesco").val();
        if (parentesco === 'Padre') {
            $("#tf_cedulaPadre").val($("#tf_cedulaEncargado").val());
            $("#tf_ape1Padre").val($("#tf_ape1Encargado").val());
            $("#tf_ape2Padre").val($("#tf_ape2Encargado").val());
            $("#tf_nombrePadre").val($("#tf_nombreEncargado").val());
            $("#tf_telCelPadre").val($("#tf_telcelularEncargado").val());
            $("#tf_ocupacionPadre").val($("#tf_ocupacionEncargado").val());
        } else
        {
            if (parentesco === 'Madre') {
                $("#tf_cedulaMadre").val($("#tf_cedulaEncargado").val());
                $("#tf_ape1Madre").val($("#tf_ape1Encargado").val());
                $("#tf_ape2Madre").val($("#tf_ape2Encargado").val());
                $("#tf_nombreMadre").val($("#tf_nombreEncargado").val());
                $("#tf_telCelMadre").val($("#tf_telcelularEncargado").val());
                $("#tf_ocupacionMadre").val($("#tf_ocupacionEncargado").val());
            }
        }
    });

    //Carga los datos de de la Persona En Caso de Emergencia//
    $("#buscarPersonaEmergencia").click(function(event) {
        var idD = $("#tf_cedulaPersonaEmergencia").val();
        $.getJSON('../buscarPersonaEmergencia/' + idD, function(resulBusqueda) {
            $("#tf_ape1PersonaEmergencia").val(resulBusqueda[0].primerApellido);
            $("#tf_ape2PersonaEmergencia").val(resulBusqueda[0].segundoApellido);
            $("#tf_nombrePersonaEmergencia").val(resulBusqueda[0].nombre);
            $("#tf_telHabitPersonaEmergencia").val("");
            $("#tf_telcelularPersonaEmergencia").val("");
        });
    });
}); 