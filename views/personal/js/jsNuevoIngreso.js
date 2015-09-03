//Este array contendra todos los objetos (Universidades) que cree el usuario
var listaPersonas = new Array();
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
    //Carga los cantones para las escuelas//
    $("#slt_provinciaPrim").change(function() {
        $("#slt_cantonPrim,#slt_distritoPrim,#slt_primaria").empty();
        var idP = $("#slt_provinciaPrim").val();
        $.getJSON('cargaCantones/' + idP, function(canton) {
            $('#slt_cantonPrim').append('<option value="">Seleccione</option>');
            for (var iP = 0; iP < canton.length; iP++) {
                $("#slt_cantonPrim").append('<option value="' + canton[iP].IdCanton + '">' + canton[iP].Canton + '</option>');
            }
        });
    });
    //Carga los distritos para las escuelas//
    $("#slt_cantonPrim").change(function() {
        $("#slt_distritoPrim,#slt_primaria").empty();
        var idD = $("#slt_cantonPrim").val();
        //var ids = $(this).attr('rel');
        $.getJSON('cargaDistritos/' + idD, function(distrito) {
            $('#slt_distritoPrim').append('<option value="">Seleccione</option>');
            for (var iD = 0; iD < distrito.length; iD++) {
                $("#slt_distritoPrim").append('<option value="' + distrito[iD].IdDistrito + '">' + distrito[iD].Distrito + '</option>');
            }
        });
    });
    //Carga las escuelas de esos distritos//
    $("#slt_distritoPrim").change(function() {
        $("#slt_primaria").empty();
        
        var idD = $("#slt_distritoPrim").val();
        
        //var ids = $(this).attr('rel');
        $.getJSON('cargaEscuela/' + idD, function(escuela) {
            $('#slt_primaria').append('<option value="">Seleccione</option>');
            for (var iD = 0; iD < escuela.length; iD++) {
              $("#slt_primaria").append('<option value="' + escuela[iD].IdDistrito + '">' + escuela[iD].nombre + '</option>');
            }
        });
    });
    ////////////////////////////////////////////////////////////////////////////
    //Carga los cantones para los colegios//
    $("#slt_provinciaSec").change(function() {
        $("#slt_cantonSec,#slt_distritoSec,#slt_secundaria").empty();
        var idP = $("#slt_provinciaSec").val();
        $.getJSON('cargaCantones/' + idP, function(canton) {
            $('#slt_cantonSec').append('<option value="">Seleccione</option>');
            for (var iP = 0; iP < canton.length; iP++) {
                $("#slt_cantonSec").append('<option value="' + canton[iP].IdCanton + '">' + canton[iP].Canton + '</option>');
            }
        });
    });
    //Carga los distritos para los colegios//
    $("#slt_cantonSec").change(function() {
        $("#slt_distritoSec,#slt_secundaria").empty();
        var idD = $("#slt_cantonSec").val();
        //var ids = $(this).attr('rel');
        $.getJSON('cargaDistritos/' + idD, function(distrito) {
            $('#slt_distritoSec').append('<option value="">Seleccione</option>');
            for (var iD = 0; iD < distrito.length; iD++) {
                $("#slt_distritoSec").append('<option value="' + distrito[iD].IdDistrito + '">' + distrito[iD].Distrito + '</option>');
            }
        });
    });
    //Carga los colegios de esos distritos//
    $("#slt_distritoSec").change(function() {
        $("#slt_secundaria").empty();
        
        var idD = $("#slt_distritoSec").val();
        
        //var ids = $(this).attr('rel');
        $.getJSON('cargaColegio/' + idD, function(escuela) {
            $('#slt_secundaria').append('<option value="">Seleccione</option>');
            for (var iD = 0; iD < escuela.length; iD++) {
              $("#slt_secundaria").append('<option value="' + escuela[iD].IdDistrito + '">' + escuela[iD].nombre + '</option>');
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
    //Cuando le dan clic al boton, creo un objeto con 3 atributos (id,nombre y año) de la Universidad
    var persona = new Object();
    var idUniversidad = $("#slt_nombreUniversidad").val();
    var nombreUniversidad = $("#slt_nombreUniversidad option:selected").text();
    var tituloUniversidad = $("#txtnombreTitulo").val();    
    var annio = $("#tf_anoFinaliza").val();
    persona.idUniversidad = idUniversidad;
    persona.nombreUniversidad = nombreUniversidad;
    persona.tituloUniversidad = tituloUniversidad;
    persona.annio=annio;   
    
    //Una vez inicializado el objeto, lo guardo en el array listaPersonas
    listaPersonas.push(persona);
    
    //Procedo a borrar la tabla y pinto de nuevo todos los objetos que se encuentran en el array
    $("#tablaUniversidades").empty();
    $('#tablaUniversidades').append('<thead><tr><th>Nombre Universidad</th><th>Nombre Titulo</th><th>Año Finalizado</th><th>Oprecion</th></tr></thead><tbody>');
    
    for (var linea = 0; linea < listaPersonas.length; linea++) {
        $('#tablaUniversidades').append('<tr><td>' + listaPersonas[linea].nombreUniversidad + '</td><td>' + listaPersonas[linea].tituloUniversidad + '</td><td>' + listaPersonas[linea].annio + '</td><td><input type="button" class="delette btn-xs btn-primary" name="' + listaPersonas[linea].idUniversidad + '" value="Eliminar"/></td></tr>');
            }
        $('#tablaUniversidades').append('<tr><td colspan="4" align="center">Última línea</td></tr></tbody>');
    
    //Agrego un input oculto al formulario, este contendra un array con el id de la Universidad agregada
        $('<input type="hidden">').attr({
            name: 'universidades[]',
            value: persona.idUniversidad
        }).appendTo('#MyForm');
    //Agrego un input oculto al formulario, este contendra un array con el "titulo" de la Universidad agregada
        $('<input type="hidden">').attr({
            name: 'titulo[]',
            value: persona.tituloUniversidad
        }).appendTo('#MyForm');    
        //Agrego un input oculto al formulario, este contendra un array con el "Año Finalizado" de la Universidad agregada
        $('<input type="hidden">').attr({
            name: 'annios[]',
            value: persona.annio
        }).appendTo('#MyForm');
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