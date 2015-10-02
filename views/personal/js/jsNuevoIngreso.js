$(document).ready(function(){
  $('#time').jTime();
});
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

//ESTE ARRAY CONTENDRA TODOS LOS OBJETOS (UNIVERSIDAD) QUE CREE EL USUARIO//
var listaPersonas = new Array();

$(function(){
    //FECHA NACIMIENTO//
    $("#txt_fnacpersona").datepicker({dateFormat: 'yy-mm-dd',
                                    changeMonth: true,
                                    changeYear: true,
                                    yearRange: "1930:2000"
                                    });
    //EDAD DEL FUNCIONARIO AL CAMBIAR LA FECHA//
    $("#txt_fnacpersona").change(function() {
        $("#txt_edad").empty();
        var fechaNacimiento=$("#txt_fnacpersona").val();
        var anioNacimiento = 2015 - (fechaNacimiento).substring(0, 4);
        $("#txt_edad").val(anioNacimiento);
        });
    //ESTA FUNCION OCULTA BOTON BUSCAR SI ES EXTRANGERO//
    $("#slt_nacionalidad").change(function() {
        var codigoPais = $("#slt_nacionalidad").val();
        if (codigoPais !== "506") {
            document.getElementById("buscarEstudiante").style.display = 'none';
        }
        else {
            document.getElementById("buscarEstudiante").style.display = 'block';
        }
    });
    //CARGA LOS DATOS DEL PERSONAL//
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
    //CARGA CANTONES PARA DOMICILIO PRINCIPAL//
    $("#slt_provinciaDom").change(function() {
        $("#slt_cantonDom,#slt_distritoDom").empty();
        var idP = $("#slt_provinciaDom").val();
        $.getJSON('cargaCantones/' + idP, function(canton) {
            $('#slt_cantonDom').append('<option value="">SELECCIONE</option>');
            for (var iP = 0; iP < canton.length; iP++) {
                $("#slt_cantonDom").append('<option value="' + canton[iP].IdCanton + '">' + canton[iP].Canton + '</option>');
            }
        });
    });
    //CARGA DISTRITO PARA DOMICILIO PRINCIPAL//
    $("#slt_cantonDom").change(function() {
        $("#slt_distritoDom").empty();
        var idD = $("#slt_cantonDom").val();
        //var ids = $(this).attr('rel');
        $.getJSON('cargaDistritos/' + idD, function(distrito) {
            $('#slt_distritoDom').append('<option value="">SELECCIONE</option>');
            for (var iD = 0; iD < distrito.length; iD++) {
                $("#slt_distritoDom").append('<option value="' + distrito[iD].IdDistrito + '">' + distrito[iD].Distrito + '</option>');
            }
        });
    });
    //CARGA CANTONES PARA DOMICILIO CLASES//
    $("#slt_provinciaClases").change(function() {
        $("#slt_cantonClases,#slt_distritoClases").empty();
        var idP = $("#slt_provinciaClases").val();
        $.getJSON('cargaCantones/' + idP, function(canton) {
            $('#slt_cantonClases').append('<option value="">SELECCIONE</option>');
            for (var iP = 0; iP < canton.length; iP++) {
                $("#slt_cantonClases").append('<option value="' + canton[iP].IdCanton + '">' + canton[iP].Canton + '</option>');
            }
        });
    });
    //CARGA DISTRITO PARA DOMICILIO CLASES//
    $("#slt_cantonClases").change(function() {
        $("#slt_distritoClases").empty();
        var idD = $("#slt_cantonClases").val();
        //var ids = $(this).attr('rel');
        $.getJSON('cargaDistritos/' + idD, function(distrito) {
            $('#slt_distritoClases').append('<option value="">SELECCIONE</option>');
            for (var iD = 0; iD < distrito.length; iD++) {
                $("#slt_distritoClases").append('<option value="' + distrito[iD].IdDistrito + '">' + distrito[iD].Distrito + '</option>');
            }
        });
    });
    //CARGA CANTONES PARA LA ESCUELA//
    $("#slt_provinciaPrim").change(function() {
        $("#slt_cantonPrim,#slt_distritoPrim,#slt_primaria").empty();
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
        $("#slt_distritoPrim,#slt_primaria").empty();
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
        $("#slt_primaria").empty();
        
        var idD = $("#slt_distritoPrim").val();
        
        //var ids = $(this).attr('rel');
        $.getJSON('cargaEscuela/' + idD, function(escuela) {
            $('#slt_primaria').append('<option value="">SELECCIONE</option>');
            for (var iD = 0; iD < escuela.length; iD++) {
              $("#slt_primaria").append('<option value="' + escuela[iD].IdDistrito + '">' + escuela[iD].nombre + '</option>');
            }
        });
    });
    //CARGA CANTONES PARA LOS COLEGIOS//
    $("#slt_provinciaSec").change(function() {
        $("#slt_cantonSec,#slt_distritoSec,#slt_secundaria").empty();
        var idP = $("#slt_provinciaSec").val();
        $.getJSON('cargaCantones/' + idP, function(canton) {
            $('#slt_cantonSec').append('<option value="">SELECCIONE</option>');
            for (var iP = 0; iP < canton.length; iP++) {
                $("#slt_cantonSec").append('<option value="' + canton[iP].IdCanton + '">' + canton[iP].Canton + '</option>');
            }
        });
    });
    //CARGA DISTRITOS PARA LOS COLEGIOS//
    $("#slt_cantonSec").change(function() {
        $("#slt_distritoSec,#slt_secundaria").empty();
        var idD = $("#slt_cantonSec").val();
        //var ids = $(this).attr('rel');
        $.getJSON('cargaDistritos/' + idD, function(distrito) {
            $('#slt_distritoSec').append('<option value="">SELECCIONE</option>');
            for (var iD = 0; iD < distrito.length; iD++) {
                $("#slt_distritoSec").append('<option value="' + distrito[iD].IdDistrito + '">' + distrito[iD].Distrito + '</option>');
            }
        });
    });
    //CARGA LOS COLEGIOS DE ESOS DISTRITOS//
    $("#slt_distritoSec").change(function() {
        $("#slt_secundaria").empty();
        
        var idD = $("#slt_distritoSec").val();
        
        //var ids = $(this).attr('rel');
        $.getJSON('cargaColegio/' + idD, function(escuela) {
            $('#slt_secundaria').append('<option value="">SELECCIONE</option>');
            for (var iD = 0; iD < escuela.length; iD++) {
              $("#slt_secundaria").append('<option value="' + escuela[iD].IdDistrito + '">' + escuela[iD].nombre + '</option>');
            }
        });
    });
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
    $("#btnAgregarUniversidad").on("click", nuevaUniversidad); 
    $("body").on("click", ".delette", eliminarUniversidad);
});//Cierre de funcion principal

//AGREGAR MAS UNIVERSIDADES A UNA TABLA//

function nuevaUniversidad()
{
    $("#tablaUniversidades").append("<tr><td><select class='form-control input-sm validate[required]' name='nombreUniversidad' id='nombreUniversidad'><option value=''>SELECCIONE</option></select></td></tr>");
    $.getJSON('Universidades/', function(univ) {
            for (var iP = 0; iP < univ.length; iP++) {
                $("#nombreUniversidad").append('<option value="' + univ[iP].id + '">' + univ[iP].nombre + '</option>');
            }
     });
    
    //Cuando le dan clic al boton, creo un objeto con 3 atributos (id,nombre y año) de la Universidad
    var universidad = new Object();
    var idUniversidad = $("#slt_nombreUniversidad").val();
    var nombreUniversidad = $("#slt_nombreUniversidad option:selected").text();
    var idGradoacademico = $("#slt_gradoAcademico").val();
    var nombreGradoAcademico = $("#slt_gradoAcademico option:selected").text();
    var tituloUniversidad = $("#txtnombreTitulo").val();    
    var annio = $("#tf_anoFinaliza").val();
    
    universidad.idUniversidad = idUniversidad;
    universidad.nombreUniversidad = nombreUniversidad;
    universidad.idGradoacademico = idGradoacademico;
    universidad.nombreGradoAcademico = nombreGradoAcademico;
    universidad.tituloUniversidad = tituloUniversidad;
    universidad.annio=annio;   
    
    //Una vez inicializado el objeto, lo guardo en el array listaPersonas
    listaPersonas.push(universidad);
    
    //AGREGO LA NUEVA LINEA EN LA TABLA
    //$('#tablaUniversidades').append('<tr><td>' + listaPersonas[linea].nombreUniversidad + '</td><td>' + listaPersonas[linea].nombreGradoAcademico + '</td><td>' + listaPersonas[linea].tituloUniversidad + '</td><td>' + listaPersonas[linea].annio + '</td><td><input type="button" class="delette btn-xs btn-primary" name="' + listaPersonas[linea].idUniversidad + '" value="Eliminar"/></td></tr>');
   
        
    
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