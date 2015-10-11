//DATOS DE LA INSTITUCION//



//FUNCION PARA CARGAR IMAGENES DE FOTOS
$(window).load(function() {
    $(function() {
        $('#imagen').change(function(e) {
            addImage(e);
        });
        function addImage(e) {
            var file = e.target.files[0],imageType = /image.*/;
            /*Si es una imagen y ademas menor a 1MB*/
            if (file.type.match(imageType) && file.size <= 1000000) {
                var reader = new FileReader();
                reader.onload = fileOnload;
                reader.readAsDataURL(file);
            } else {
                alert("Lo Sentimos debe seleccionar un formato de imagen y un tamaño menor a 1 MB !!!");
                return;
            }
        }
        function fileOnload(e) {
            var result = e.target.result;
            $('#imgSalida').attr("src", result);
        }
    });
});

//METODO PARA LA FECHA Y HORA EN LA IMPRESION DEL COMPROBANTE//
var indexSeleccionado;
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
//FUNCION PRINCIPAL//
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
            $('#myModal-blank').modal({
                    show: 'false'
                });
        }else{
        $.getJSON('buscarEstudiante/' + idD, function(resulBusqueda) {
            if (jQuery.isEmptyObject(resulBusqueda)) {
                $('#myModal-noExiste').modal({
                    show: 'false'
                });
            } else {
                $("#txt_apellido1").val(resulBusqueda[0].primerApellido);
                $("#txt_apellido1").attr('disabled','disabled');
                $("#txt_apellido2").val(resulBusqueda[0].segundoApellido);
                $("#txt_apellido2").attr('disabled','disabled');
                $("#txt_nombre").val(resulBusqueda[0].nombre);
                $("#txt_nombre").attr('disabled','disabled');
                $("#txt_fnacpersona").val(resulBusqueda[0].fechaNacimiento);
                $("#txt_fnacpersona").attr('disabled','disabled');
                var anioNacimiento = 2015 - (resulBusqueda[0].fechaNacimiento).substring(0, 4);
                $("#txt_edad").val(anioNacimiento);
                $("#slt_genero").val(resulBusqueda[0].sexo);
                $("#slt_genero").attr('disabled','disabled');
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
    //ASIGNA LA DIRECION TIEMPO CLASES//
    $("#slt_otroDomicilioClases").change(function() {
        var variable = $("#slt_otroDomicilioClases").val();
        if (variable == 0) {
            $("#txta_domicilioClases").val("");
        }
        else {
            $("#txta_domicilioClases").val($("#txta_domicilio").val());
            
            $("#slt_provinciaClases").val($("#slt_provinciaDom").val());
            $("#slt_cantonClases").val($("#slt_cantonDom").val());
            $("#slt_distritoClases").val($("#slt_distritoDom").val());
        }
    });
    
    //OCULTA INPUT ENFERMEDAD//
    $("#slt_enfermedad").change(function() {
        var variable = $("#slt_enfermedad").val();
        if (variable == 0) {
            $("#txt_enfermedadDesc").val("");
            document.getElementById("enfermedadDesc").style.display = 'none';
            document.getElementById("txt_enfermedadDesc").style.display = 'none';
        }
        else {
            document.getElementById("enfermedadDesc").style.display = 'block';
            document.getElementById("txt_enfermedadDesc").style.display = 'block';
        }
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
    //CARGAR LOS DATOS DE LA PERSONA EN CASO DE EMERGENCIA//
    $("#btnBuscarPersonaEmergencia").click(function(event) {
        var idD = $("#txt_cedulaPersonaEmergencia").val();
        if (jQuery.isEmptyObject(idD)){
            $('#myModal-blank').modal({
                    show: 'false'
                });
        }else{
        $.getJSON('buscarPersonaEmergencia/' + idD, function(resulBusqueda) {
            if (jQuery.isEmptyObject(resulBusqueda)) {
               $('#myModal-noExiste').modal({
                    show: 'false'
                });
            } else {
            $("#txt_apellido1PersonaEmergencia").val(resulBusqueda[0].primerApellido);
            $("#txt_apellido2PersonaEmergencia").val(resulBusqueda[0].segundoApellido);
            $("#txt_nombrePersonaEmergencia").val(resulBusqueda[0].nombre);
            $("#txt_telHabPersonaEmergencia").val("");
            $("#txt_telcelPersonaEmergencia").val("");
            }
        });
        }
    });
    //AGREGA UNA NUEVA LINEA PARA UNIVERSIDAD AL DAR CLIC EN ACEPTAR//
    $("#btnAgregarUniversidad").on("click", nuevaUniversidad); 
});//CIERRE DE FUNCION PRINCIPAL

//AGREGAR MAS UNIVERSIDADES A UNA TABLA//
function nuevaUniversidad()
{
    //clona el primer tr que contiene los controles o nomberes de encabezaados
    var eClonado = $("#tablaUniversidades tr:nth-child(2)").clone();
    //limpiar los controles select, input
    eClonado.find("select[name='slt_nombreUniversidad']").val(0);
    eClonado.find("select[name='slt_gradoAcademico']").val(0);
    eClonado.find("input[name='txt_nombreTitulo']").val("");
    eClonado.find("input[name='txt_anoFinaliza']").val("");
    
    //agrega a la tabla el el segundo tr clonado//
    $("#tablaUniversidades").append(eClonado);
    //agregar el evento onclick al link eliminar
    asignaEventoRemove();
    //volver a asignarle los eventos de validacion
    //$("#MyForm").validationEngine();
}
//elimina el click para que no lo duplique y luego se lo agrega
function asignaEventoRemove() {
        $(".btn-eliminar-univ").on("click", function(){
            if ($(".btn-eliminar-univ").closest("tr").length  > 1 ) {
                //closest busca hacia arriba(padres de td) pra removerlo
                //http://api.jquery.com/closest/
                $(this).closest("tr").remove();
            }else {
                $('#myModal').modal({
                    show: 'false'
                });
                //alert('Minimo una Universidad');
                }
        });
    }