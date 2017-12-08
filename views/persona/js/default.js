$.datepicker.regional['es'] = {
    closeText: 'Cerrar',
    prevText: '<Ant',
    nextText: 'Sig>',
    currentText: 'Hoy',
    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
    monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
    dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
    dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
    dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
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
        var fechaNacimiento = $("#tf_fnacpersona").val();
        //Consulto año lectivo para realizar la resta y asignar la edad//
        $.getJSON('../datosSistemaJavaScript', function(resul) {
            var edad = resul[0].annio_lectivo - (fechaNacimiento).substring(0, 4);
            console.log("Edad: " + edad);
            $("#tf_edad").val(edad);
        });
    });

    //Carga los cantones//
    $("#tf_provincias").change(function() {
        $("#tf_cantones,#tf_distritos").empty();
        var idP = $("#tf_provincias").val();
        $.getJSON('../persona/cargaCantones/' + idP, function(canton) {
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
        $.getJSON('../persona/cargaDistritos/' + idD, function(distrito) {
            $('#tf_distritos').append('<option value="">Seleccione</option>');
            for (var iD = 0; iD < distrito.length; iD++) {
                $("#tf_distritos").append('<option value="' + distrito[iD].IdDistrito + '">' + distrito[iD].Distrito + '</option>');
            }
        });
    });

    //Carga los cantones para Editar Expediente//
    $("#tf_provinciasExpediente").change(function() {
        $("#tf_cantonesExpediente,#tf_distritosExpediente").empty();
        var idP = $("#tf_provinciasExpediente").val();
        $.getJSON('../cargaCantones/' + idP, function(canton) {
            $('#tf_cantonesExpediente').append('<option value="">Seleccione</option>');
            for (var iP = 0; iP < canton.length; iP++) {
                $("#tf_cantonesExpediente").append('<option value="' + canton[iP].IdCanton + '">' + canton[iP].Canton + '</option>');
            }
        });
    });

    //Carga los distritos para Editar Expediente//
    $("#tf_cantonesExpediente").change(function() {
        $("#tf_distritosExpediente").empty();
        var idD = $("#tf_cantonesExpediente").val();
        //var ids = $(this).attr('rel');
        $.getJSON('../cargaDistritos/' + idD, function(distrito) {
            $('#tf_distritosExpediente').append('<option value="">Seleccione</option>');
            for (var iD = 0; iD < distrito.length; iD++) {
                $("#tf_distritosExpediente").append('<option value="' + distrito[iD].IdDistrito + '">' + distrito[iD].Distrito + '</option>');
            }
        });
    });


//**Cosas de Esteban**//

    //Practica AJAX
    //    $('#nacitatATC').click(function() {
    //    $.ajax({
    //            xhr: function() {
    //
    //                    var xhr = new window.XMLHttpRequest();
    //                    xhr.addEventListener("progress", function(e){
    //                        var p = (e.loaded / e.total)*100;
    //                        var prave = $("#barraProgreso").html();
    //                              $("#barraProgreso").html(prave+"<br>"+p);
    //                    });
    //                return xhr;
    //
    //            }
    //            , type: 'post'
    //            , cache: false
    //            , url: "../persona/cargaGrupos/" + 7});
    //
    //      });



    //Carga los Grupos de un nivel en especifico//
    $("#tf_Niveles").change(function() {
        $("#tf_Grupos").empty();
        var nivelSeleccionado = $("#tf_Niveles").val();
        $.getJSON('../persona/cargaGrupos/' + nivelSeleccionado, function(Gru) {
            $('#tf_Grupos').append('<option value="">Seleccione</option>');
            for (var iP = 0; iP < Gru.length; iP++) {
                $("#tf_Grupos").append('<option value="' + Gru[iP].grupo + '">' + Gru[iP].grupo + '</option>');
            }
        });

        var cantidadColumnas = 3;
        var chk_email = 0;
        var chk_poliza = 0;
        var chk_domicilio = 0;
        var chk_telefonosEstu = 0;
        var chk_telefonosEncargado = 0;
        var chk_fechaNacimiento = 0;
        var chk_genero = 0;
        if ($('#chk_email').prop('checked')) {
            chk_email = 1;
            cantidadColumnas++;
        }
        if ($('#chk_poliza').prop('checked')) {
            chk_poliza = 1;
            cantidadColumnas++;
            cantidadColumnas++;
        }
        if ($('#chk_domicilio').prop('checked')) {
            chk_domicilio = 1;
            cantidadColumnas++;
        }
        if ($('#chk_telefonosEstu').prop('checked')) {
            chk_telefonosEstu = 1;
            cantidadColumnas++;
            cantidadColumnas++;
        }
        if ($('#chk_telefonosEncargado').prop('checked')) {
            chk_telefonosEncargado = 1;
            cantidadColumnas++;
            cantidadColumnas++;
        }
        if ($('#chk_fechaNacimiento').prop('checked')) {
            chk_fechaNacimiento = 1;
            cantidadColumnas++;
        }
        if ($('#chk_genero').prop('checked')) {
            chk_genero = 1;
            cantidadColumnas++;
        }

        var consulta = {nivelSeleccionado: $("#tf_Niveles").val(), grupoSeleccionado: 0, chk_email: chk_email,
            chk_poliza: chk_poliza, chk_domicilio: chk_domicilio, chk_telefonosEstu: chk_telefonosEstu,
            chk_telefonosEncargado: chk_telefonosEncargado, chk_fechaNacimiento: chk_fechaNacimiento, chk_genero: chk_genero};

        var fechaActual = new Date();
        var dd = fechaActual.getDate();
        var mm = fechaActual.getMonth() + 1;
        var yyyy = fechaActual.getFullYear();

        //Activo la Animación para carga de datos
        document.getElementById("carga").style.display = 'block';
        $("#listaEstudiantes").empty();
        $('#listaEstudiantes').append('<tr><th colspan="' + cantidadColumnas + '" class="text-center">Cargando...</th></tr>');

        //Realizo la consulta
        $.post('../persona/cargaSeccion/', consulta, function(seccionElegida, success) {

            //Escondo animación de carga
            document.getElementById("carga").style.display = 'none';
            $("#listaEstudiantes").empty();

            var arraySalida = "";
            arraySalida += '<thead><tr><td colspan="' + cantidadColumnas + '" class="text-center">' + consulta.nivelSeleccionado + '°</td></tr>';
            arraySalida += '<tr><th>N°</th><th>Identificación</th><th>Nombre del Estudiante</th>';
            if (chk_email == 1) {
                arraySalida += '<th>Email</th>';
            }
            if (chk_poliza == 1) {
                arraySalida += '<th>N° de Poliza</th><th>Fecha Vencimiento</th>';
            }
            if (chk_domicilio == 1) {
                arraySalida += '<th>Domicilio</th>';
            }
            if (chk_telefonosEstu == 1) {
                arraySalida += '<th>Tel. Casa</th><th>Cel. Estu</th>';
            }
            if (chk_telefonosEncargado == 1) {
                arraySalida += '<th>Nombre del Encargado</th><th>Tel. Casa Encargado</th><th>Cel. Encargado</th>';
            }
            if (chk_genero == 1) {
                arraySalida += '<th>Genero</th>';
            }
            if (chk_fechaNacimiento == 1) {
                arraySalida += '<th>Fecha Nacimineto</th>';
            }

            arraySalida += '</tr></thead><tbody>';

            for (var linea = 0; linea < seccionElegida.length; linea++) {
                arraySalida += '<tr><td>' + (linea + 1) + '</td><td>' +
                        seccionElegida[linea].cedula + '</td><td>' + seccionElegida[linea].apellido1 + ' ' +
                        seccionElegida[linea].apellido2 + ' ' + seccionElegida[linea].nombre + '</td>';

                if (chk_email == 1) {
                    arraySalida += '<td>' + seccionElegida[linea].email + '</td>';
                }

                if (chk_poliza == 1) {
                    if (seccionElegida[linea].fecha_vence != null) {
                        var mes = seccionElegida[linea].fecha_vence.substring(5, 7);
                        var anio = seccionElegida[linea].fecha_vence.substring(0, 4);
                        if (mes <= mm && anio <= yyyy) {
                            arraySalida += '<td bgcolor="#FF0000">' + seccionElegida[linea].numero_poliza + '</td>';
                            arraySalida += '<td bgcolor="#FF0000">' + seccionElegida[linea].fecha_vence + '</td>';
                        } else {
                            arraySalida += '<td>' + seccionElegida[linea].numero_poliza + '</td>';
                            arraySalida += '<td>' + seccionElegida[linea].fecha_vence + '</td>';
                        }
                    }
                    else {
                        arraySalida += '<td bgcolor="#FF0000"> - </td>';
                        arraySalida += '<td bgcolor="#FF0000"> - </td>';
                    }
                }

                if (chk_domicilio == 1) {
                    arraySalida += '<td>' + seccionElegida[linea].domicilio + ', ' + seccionElegida[linea].Distrito +
                            ', ' + seccionElegida[linea].Canton + ', ' + seccionElegida[linea].nombreProvincia + '</td>';
                }

                if (chk_telefonosEstu == 1) {
                    if (seccionElegida[linea].telefonoCasa != null) {
                        arraySalida += '<td>' + seccionElegida[linea].telefonoCasa.substr(0, 4) + '-' + seccionElegida[linea].telefonoCasa.substr(4) + '</td>';
                    } else {
                        arraySalida += '<td> - </td>';
                    }
                    if (seccionElegida[linea].telefonoCelular != null) {
                        arraySalida += '<td>' + seccionElegida[linea].telefonoCelular.substr(0, 4) + '-' + seccionElegida[linea].telefonoCelular.substr(4) + '</td>';
                    } else {
                        arraySalida += '<td> - </td>';
                    }
                }

                if (chk_telefonosEncargado == 1) {
                    arraySalida += '<td>' + seccionElegida[linea].nombre_encargado + ' ' + seccionElegida[linea].apellido1_encargado + ' ' + seccionElegida[linea].apellido2_encargado + '</td>';
                    if (seccionElegida[linea].telefonoCasaEncargado != null) {
                        arraySalida += '<td>' + seccionElegida[linea].telefonoCasaEncargado.substr(0, 4) + '-' + seccionElegida[linea].telefonoCasaEncargado.substr(4) + '</td>';
                    } else {
                        arraySalida += '<td> - </td>';
                    }
                    if (seccionElegida[linea].telefonoCelularEncargado != null) {
                        arraySalida += '<td>' + seccionElegida[linea].telefonoCelularEncargado.substr(0, 4) + '-' + seccionElegida[linea].telefonoCelularEncargado.substr(4) + '</td>';
                    } else {
                        arraySalida += '<td> - </td>';
                    }
                }

                if (chk_genero == 1) {
                    if (seccionElegida[linea].sexo != null) {
                        if (seccionElegida[linea].sexo == 1) {
                            arraySalida += '<td>Hombre</td>';
                        } else {
                            arraySalida += '<td>Mujer</td>';
                        }
                    } else {
                        arraySalida += '<td> - </td>';
                    }
                }

                if (chk_fechaNacimiento == 1) {
                    if (seccionElegida[linea].fechaNacimiento != null) {

                        var dia = seccionElegida[linea].fechaNacimiento.substring(8, 10);
                        var mes = seccionElegida[linea].fechaNacimiento.substring(5, 7);
                        var anio = seccionElegida[linea].fechaNacimiento.substring(0, 4);
                        arraySalida += '<td>' + dia + '/' + mes + '/' + anio + '</td>';
                    } else {
                        arraySalida += '<td> - </td>';
                    }
                }

                arraySalida += '</tr>';
            }

            arraySalida += '<tr><td colspan="' + cantidadColumnas + '" class="text-center">Ultima Línea</td></tr></tbody>';
            $('#listaEstudiantes').append(arraySalida);
        }, "json");
    });

    //Carga los Estudiantes de una sección en especifico//
    $("#tf_Grupos").change(function() {

        var banderaGrupoB = 0;
        var banderaGrupoC = 0;
        var cantidadColumnas = 3;
        var chk_email = 0;
        var chk_poliza = 0;
        var chk_domicilio = 0;
        var chk_telefonosEstu = 0;
        var chk_telefonosEncargado = 0;
        var chk_fechaNacimiento = 0;
        var chk_genero = 0;

        if ($('#chk_email').prop('checked')) {
            chk_email = 1;
            cantidadColumnas++;
        }
        if ($('#chk_poliza').prop('checked')) {
            chk_poliza = 1;
            cantidadColumnas++;
            cantidadColumnas++;
        }
        if ($('#chk_domicilio').prop('checked')) {
            chk_domicilio = 1;
            cantidadColumnas++;
        }
        if ($('#chk_telefonosEstu').prop('checked')) {
            chk_telefonosEstu = 1;
            cantidadColumnas++;
            cantidadColumnas++;
        }
        if ($('#chk_telefonosEncargado').prop('checked')) {
            chk_telefonosEncargado = 1;
            cantidadColumnas++;
            cantidadColumnas++;
        }
        if ($('#chk_fechaNacimiento').prop('checked')) {
            chk_fechaNacimiento = 1;
            cantidadColumnas++;
        }
        if ($('#chk_genero').prop('checked')) {
            chk_genero = 1;
            cantidadColumnas++;
        }

        var consulta = {nivelSeleccionado: $("#tf_Niveles").val(), grupoSeleccionado: $("#tf_Grupos").val(),
            chk_email: chk_email, chk_poliza: chk_poliza, chk_domicilio: chk_domicilio,
            chk_telefonosEstu: chk_telefonosEstu, chk_telefonosEncargado: chk_telefonosEncargado,
            chk_fechaNacimiento: chk_fechaNacimiento, chk_genero: chk_genero};

        var fechaActual = new Date();
        var dd = fechaActual.getDate();
        var mm = fechaActual.getMonth() + 1;
        var yyyy = fechaActual.getFullYear();

        //Activo la Animación para carga de datos
        document.getElementById("carga").style.display = 'block';
        $("#listaEstudiantes").empty();
        $('#listaEstudiantes').append('<tr><th colspan="' + cantidadColumnas + '" class="text-center">Cargando...</th></tr>');

        //Realizo la consulta
        $.post('../persona/cargaSeccion/', consulta, function(seccionElegida, success) {

            //Escondo animación de carga
            document.getElementById("carga").style.display = 'none';
            $("#listaEstudiantes").empty();

            var arraySalida = "";
            arraySalida += '<thead><tr><td colspan="' + cantidadColumnas + '" class="text-center">' + consulta.nivelSeleccionado + '-' + consulta.grupoSeleccionado + '</td></tr>';
            arraySalida += '<tr><td colspan="' + cantidadColumnas + '" class="text-center">&nbsp;</td></tr><tr><td colspan="' + cantidadColumnas + '" class="text-center">Grupo A</td></tr>';
            arraySalida += '<tr><th>N°</th><th>Identificación</th><th>Nombre del Estudiante</th>';
            if (chk_email == 1) {
                arraySalida += '<th>Email</th>';
            }
            if (chk_poliza == 1) {
                arraySalida += '<th>N° de Poliza</th><th>Fecha Vencimiento</th>';
            }
            if (chk_domicilio == 1) {
                arraySalida += '<th>Domicilio</th>';
            }
            if (chk_telefonosEstu == 1) {
                arraySalida += '<th>Tel. Casa</th><th>Cel. Estu</th>';
            }
            if (chk_telefonosEncargado == 1) {
                arraySalida += '<th>Nombre del Encargado</th><th>Tel. Casa Encargado</th><th>Cel. Encargado</th>';
            }
            if (chk_genero == 1) {
                arraySalida += '<th>Genero</th>';
            }
            if (chk_fechaNacimiento == 1) {
                arraySalida += '<th>Fecha Nacimineto</th>';
            }

            arraySalida += '</tr></thead><tbody>';

            for (var linea = 0; linea < seccionElegida.length; linea++) {
                if (seccionElegida[linea].sub_grupo == 'B' && banderaGrupoB == 0) {
                    arraySalida += '<tr><td colspan="' + cantidadColumnas + '" class="text-center">&nbsp;</td></tr><tr><td colspan="' + cantidadColumnas + '" class="text-center">Grupo B</td></tr>';
                    banderaGrupoB = 1;
                } else if (seccionElegida[linea].sub_grupo == 'C' && banderaGrupoC == 0) {
                    arraySalida += '<tr><td colspan="' + cantidadColumnas + '" class="text-center">&nbsp;</td></tr><tr><td colspan="' + cantidadColumnas + '" class="text-center">Grupo C</td></tr>';
                    banderaGrupoC = 1;
                }
                arraySalida += '<tr><td>' + (linea + 1) + '</td><td>' +
                        seccionElegida[linea].cedula + '</td><td>' + seccionElegida[linea].apellido1 + ' ' +
                        seccionElegida[linea].apellido2 + ' ' + seccionElegida[linea].nombre + '</td>';

                if (chk_email == 1) {
                    arraySalida += '<td>' + seccionElegida[linea].email + '</td>';
                }

                if (chk_poliza == 1) {
                    var mes = seccionElegida[linea].fecha_vence.substring(5, 7);
                    var anio = seccionElegida[linea].fecha_vence.substring(0, 4);
                    if (mes <= mm && anio <= yyyy) {
                        arraySalida += '<td bgcolor="#FF0000">' + seccionElegida[linea].numero_poliza + '</td>';
                        arraySalida += '<td bgcolor="#FF0000">' + seccionElegida[linea].fecha_vence + '</td>';
                    } else {
                        arraySalida += '<td>' + seccionElegida[linea].numero_poliza + '</td>';
                        arraySalida += '<td>' + seccionElegida[linea].fecha_vence + '</td>';
                    }
                }

                if (chk_domicilio == 1) {
                    arraySalida += '<td>' + seccionElegida[linea].domicilio + ', ' + seccionElegida[linea].Distrito +
                            ', ' + seccionElegida[linea].Canton + ', ' + seccionElegida[linea].nombreProvincia + '</td>';
                }

                if (chk_telefonosEstu == 1) {
                    arraySalida += '<td>' + seccionElegida[linea].telefonoCasa.substr(0, 4) + '-' + seccionElegida[linea].telefonoCasa.substr(4) + '</td>';
                    arraySalida += '<td>' + seccionElegida[linea].telefonoCelular.substr(0, 4) + '-' + seccionElegida[linea].telefonoCelular.substr(4) + '</td>';
                }

                if (chk_telefonosEncargado == 1) {
                    arraySalida += '<td>' + seccionElegida[linea].nombre_encargado + ' ' + seccionElegida[linea].apellido1_encargado + ' ' + seccionElegida[linea].apellido2_encargado + '</td>';
                    arraySalida += '<td>' + seccionElegida[linea].telefonoCasaEncargado.substr(0, 4) + '-' + seccionElegida[linea].telefonoCasaEncargado.substr(4) + '</td>';
                    arraySalida += '<td>' + seccionElegida[linea].telefonoCelularEncargado.substr(0, 4) + '-' + seccionElegida[linea].telefonoCelularEncargado.substr(4) + '</td>';
                }

                if (chk_genero == 1) {
                    if (seccionElegida[linea].sexo != null) {
                        if (seccionElegida[linea].sexo == 1) {
                            arraySalida += '<td>Hombre</td>';
                        } else {
                            arraySalida += '<td>Mujer</td>';
                        }
                    } else {
                        arraySalida += '<td> - </td>';
                    }
                }

                if (chk_fechaNacimiento == 1) {
                    if (seccionElegida[linea].fechaNacimiento != null) {

                        var dia = seccionElegida[linea].fechaNacimiento.substring(8, 10);
                        var mes = seccionElegida[linea].fechaNacimiento.substring(5, 7);
                        var anio = seccionElegida[linea].fechaNacimiento.substring(0, 4);
                        arraySalida += '<td>' + dia + '/' + mes + '/' + anio + '</td>';
                    } else {
                        arraySalida += '<td> - </td>';
                    }
                }

                arraySalida += '</tr>';
            }

            arraySalida += '<tr><td colspan="' + cantidadColumnas + '" class="text-center">Ultima Línea</td></tr></tbody>';
            $('#listaEstudiantes').append(arraySalida);
        }, "json");
    });

    //Metodos para Expedientes de Estudiantes//
    $("#tf_NivelesExpedientes").change(function() {
        $("#tf_GruposExpedientes").empty();
        $("#listaEstudiantes").empty();

        var nivelSeleccionado = $("#tf_NivelesExpedientes").val();
        $.getJSON('../persona/cargaGrupos/' + nivelSeleccionado, function(Gru) {
            $('#tf_GruposExpedientes').append('<option value="">Seleccione</option>');
            for (var iP = 0; iP < Gru.length; iP++) {
                $("#tf_GruposExpedientes").append('<option value="' + Gru[iP].grupo + '">' + Gru[iP].grupo + '</option>');
            }
        });

        var cantidadColumnas = 5;
        var chk_email = 0;
        var chk_poliza = 0;
        var chk_domicilio = 0;
        var chk_telefonosEstu = 0;
        var chk_telefonosEncargado = 0;
        var chk_fechaNacimiento = 0;
        var chk_genero = 0;

        var consulta = {nivelSeleccionado: $("#tf_NivelesExpedientes").val(), grupoSeleccionado: 0, chk_email: chk_email,
            chk_poliza: chk_poliza, chk_domicilio: chk_domicilio, chk_telefonosEstu: chk_telefonosEstu,
            chk_telefonosEncargado: chk_telefonosEncargado,
            chk_fechaNacimiento: chk_fechaNacimiento, chk_genero: chk_genero};

        //Activo la Animación para carga de datos
        document.getElementById("carga").style.display = 'block';
        $('#listaEstudiantes').append('<tr><th colspan="' + cantidadColumnas + '" class="text-center">Cargando...</th></tr>');

        //Realizo la consulta
        $.post('../persona/cargaSeccion/', consulta, function(seccionElegida, success) {

            //Escondo animación de carga
            document.getElementById("carga").style.display = 'none';
            $("#listaEstudiantes").empty();

            var arraySalida = "";
            arraySalida += '<thead><tr><td colspan="' + cantidadColumnas + '" class="text-center">' + consulta.nivelSeleccionado + '°</td></tr>';
            arraySalida += '<tr><th>N°</th><th>Identificación</th><th>Nombre del Estudiante</th><th colspan="2" class="text-center">Acciones</th>';

            arraySalida += '</tr></thead><tbody>';

            for (var linea = 0; linea < seccionElegida.length; linea++) {
                arraySalida += '<tr><td>' + (linea + 1) + '</td><td>' +
                        seccionElegida[linea].cedula + '</td><td>' + seccionElegida[linea].apellido1 + ' ' +
                        seccionElegida[linea].apellido2 + ' ' + seccionElegida[linea].nombre + '</td>';

                arraySalida += '<td class="text-right"><a class="btn-sm btn-primary" href="editarExpedienteEstudiante/' + seccionElegida[linea].cedula + '">Editar</a></td>' +
                        '<td><a class="btn-sm btn-warning" href="imprimirExpedienteEstudiante/' + seccionElegida[linea].cedula + '">Imprimir</a></td></tr>';
            }

            arraySalida += '<tr><td colspan="' + cantidadColumnas + '" class="text-center">Ultima Línea</td></tr></tbody>';
            $('#listaEstudiantes').append(arraySalida);
        }, "json");
    });

    //Carga los Estudiantes de una sección en especifico//
    $("#tf_GruposExpedientes").change(function() {

        var banderaGrupoB = 0;
        var banderaGrupoC = 0;

        var cantidadColumnas = 5;
        var chk_email = 0;
        var chk_poliza = 0;
        var chk_domicilio = 0;
        var chk_telefonosEstu = 0;
        var chk_telefonosEncargado = 0;
        var chk_fechaNacimiento = 0;
        var chk_genero = 0;

        var consulta = {nivelSeleccionado: $("#tf_NivelesExpedientes").val(), grupoSeleccionado: $("#tf_GruposExpedientes").val(),
            chk_email: chk_email, chk_poliza: chk_poliza, chk_domicilio: chk_domicilio,
            chk_telefonosEstu: chk_telefonosEstu, chk_telefonosEncargado: chk_telefonosEncargado,
            chk_fechaNacimiento: chk_fechaNacimiento, chk_genero: chk_genero};

        //Activo la Animación para carga de datos
        document.getElementById("carga").style.display = 'block';
        $('#listaEstudiantes').append('<tr><th colspan="' + cantidadColumnas + '" class="text-center">Cargando...</th></tr>');

        //Realizo la consulta
        $.post('../persona/cargaSeccion/', consulta, function(seccionElegida, success) {

            //Escondo animación de carga
            document.getElementById("carga").style.display = 'none';
            $("#listaEstudiantes").empty();

            var arraySalida = "";
            arraySalida += '<thead><tr><td colspan="' + cantidadColumnas + '" class="text-center">' + consulta.nivelSeleccionado + '-' + consulta.grupoSeleccionado + '</td></tr>';
            arraySalida += '<tr><td colspan="' + cantidadColumnas + '" class="text-center">&nbsp;</td></tr><tr><td colspan="' + cantidadColumnas + '" class="text-center">Grupo A</td></tr>';
            arraySalida += '<tr><th>N°</th><th>Identificación</th><th>Nombre del Estudiante</th><th colspan="2" class="text-center">Acciones</th>';

            arraySalida += '</tr></thead><tbody>';

            for (var linea = 0; linea < seccionElegida.length; linea++) {
                if (seccionElegida[linea].sub_grupo == 'B' && banderaGrupoB == 0) {
                    arraySalida += '<tr><td colspan="' + cantidadColumnas + '" class="text-center">&nbsp;</td></tr><tr><td colspan="' + cantidadColumnas + '" class="text-center">Grupo B</td></tr>';
                    banderaGrupoB = 1;
                } else if (seccionElegida[linea].sub_grupo == 'C' && banderaGrupoC == 0) {
                    arraySalida += '<tr><td colspan="' + cantidadColumnas + '" class="text-center">&nbsp;</td></tr><tr><td colspan="' + cantidadColumnas + '" class="text-center">Grupo C</td></tr>';
                    banderaGrupoC = 1;
                }
                arraySalida += '<tr><td>' + (linea + 1) + '</td><td>' +
                        seccionElegida[linea].cedula + '</td><td>' + seccionElegida[linea].apellido1 + ' ' +
                        seccionElegida[linea].apellido2 + ' ' + seccionElegida[linea].nombre + '</td>';

                arraySalida += '<td class="text-right"><a class="btn-sm btn-primary" href="editarExpedienteEstudiante/' + seccionElegida[linea].cedula + '">Editar</a></td>' +
                        '<td><a class="btn-sm btn-warning" href="imprimirExpedienteEstudiante/' + seccionElegida[linea].cedula + '">Imprimir</a></td></tr>';
            }

            arraySalida += '<tr><td colspan="' + cantidadColumnas + '" class="text-center">Ultima Línea</td></tr></tbody>';
            $('#listaEstudiantes').append(arraySalida);
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
            $('#tf_primaria').append('<option value="0">SELECCIONE</option>');
            for (var iD = 0; iD < escuela.length; iD++) {
                $("#tf_primaria").append('<option value="' + escuela[iD].id + '">' + escuela[iD].nombre + '</option>');
            }
            $("#tf_primaria").append('<option value="0">--OTRA--</option>');
        });
    });

    //CARGA CANTONES PARA LA ESCUELA para Editar Expediente//
    $("#slt_provinciaPrimExpe").change(function() {
        $("#slt_cantonPrimExpe,#slt_distritoPrimExpe,#tf_primariaExpe").empty();
        var idP = $("#slt_provinciaPrimExpe").val();
        $.getJSON('../cargaCantones/' + idP, function(canton) {
            $('#slt_cantonPrimExpe').append('<option value="">SELECCIONE</option>');
            for (var iP = 0; iP < canton.length; iP++) {
                $("#slt_cantonPrimExpe").append('<option value="' + canton[iP].IdCanton + '">' + canton[iP].Canton + '</option>');
            }
        });
    });

    //CARGA DISTRITOS PARA LA ESCUELA para Editar Expediente//
    $("#slt_cantonPrimExpe").change(function() {
        $("#slt_distritoPrimExpe,#tf_primariaExpe").empty();
        var idD = $("#slt_cantonPrimExpe").val();
        $.getJSON('../cargaDistritos/' + idD, function(distrito) {
            $('#slt_distritoPrimExpe').append('<option value="">SELECCIONE</option>');
            for (var iD = 0; iD < distrito.length; iD++) {
                $("#slt_distritoPrimExpe").append('<option value="' + distrito[iD].IdDistrito + '">' + distrito[iD].Distrito + '</option>');
            }
        });
    });

    //CARGA LAS ESCUELAS para Editar Expediente//
    $("#slt_distritoPrimExpe").change(function() {
        $("#tf_primariaExpe").empty();

        var idD = $("#slt_distritoPrimExpe").val();
        $.getJSON('../cargaEscuela/' + idD, function(escuela) {
            $('#tf_primariaExpe').append('<option value="0">SELECCIONE</option>');
            for (var iD = 0; iD < escuela.length; iD++) {
                $("#tf_primariaExpe").append('<option value="' + escuela[iD].id + '">' + escuela[iD].nombre + '</option>');
            }
            $("#tf_primariaExpe").append('<option value="0">--OTRA--</option>');
        });
    });

    //Carga los datos del Estudiante//
    $("#buscarEstudiante").click(function(event) {
        var idD = $("#tf_cedulaEstudiante").val();
        if (jQuery.isEmptyObject(idD)) {
            alert("Por favor ingrese el número de identificación.\nEj: 2-0456-0789, 1-1122-0567.\nNota: La Base de Datos esta actualizada al 2013 y solo posee Costarricenses y Nacionalizados");
        } else {
            $.getJSON('buscarEstudiantePadron/' + idD, function(resulBusqueda) {
                if (jQuery.isEmptyObject(resulBusqueda)) {
                    alert("Persona no encontrada, verifique el formato (ceros y guiones) y número de identificación.\nEj: 2-0456-0789, 1-1122-0567.\nNota: La Base de Datos esta actualizada al 2013 y solo posee Costarricenses y Nacionalizados");
                } else {
                    $("#tf_ape1").val(resulBusqueda[0].primerApellido);
                    $("#tf_ape2").val(resulBusqueda[0].segundoApellido);
                    $("#tf_nombre").val(resulBusqueda[0].nombre);
                    $("#tf_fnacpersona").val(resulBusqueda[0].fechaNacimiento);
                    //Consulto año lectivo para realizar la resta y asignar la edad//
                    $.getJSON('datosSistemaJavaScript', function(resul) {
                        var edad = resul[0].annio_lectivo - (resulBusqueda[0].fechaNacimiento).substring(0, 4);
                        $("#tf_edad").val(edad);
                    });
                    $("#tf_genero").val(resulBusqueda[0].sexo);
                }
            });
        }
    });


    //Carga los datos del Encargado Legal//
    $("#buscarEncargado_NI").click(function(event) {
        var idD = $("#tf_cedulaEncargado_NI").val();
        if (jQuery.isEmptyObject(idD)) {
            alert("Por favor ingrese el número de identificación.\nEj: 2-0456-0789, 1-1122-0567.\nNota: La Base de Datos esta actualizada al 2013 y solo posee Costarricenses y Nacionalizados");
        } else {
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
        if (jQuery.isEmptyObject(idD)) {
            alert("Por favor ingrese el número de identificación.\nEj: 2-0456-0789, 1-1122-0567.\nNota: La Base de Datos esta actualizada al 2013 y solo posee Costarricenses y Nacionalizados");
        } else {
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

    //Carga los datos del Padre//
    $("#buscarPadre_NI").click(function(event) {
        var idD = $("#tf_cedulaPadre_NI").val();
        if (jQuery.isEmptyObject(idD)) {
            alert("Por favor ingrese el número de identificación.\nEj: 2-0456-0789, 1-1122-0567.\nNota: La Base de Datos esta actualizada al 2013 y solo posee Costarricenses y Nacionalizados");
        } else {
            $.getJSON('buscarPadre/' + idD, function(resulBusqueda) {
                if (jQuery.isEmptyObject(resulBusqueda)) {
                    alert("Persona no encontrada, verifique el formato (ceros y guiones) y número de identificación.\nEj: 2-0456-0789, 1-1122-0567.\nNota: La Base de Datos esta actualizada al 2013 y solo posee Costarricenses y Nacionalizados");
                } else {
                    $("#tf_ape1Padre_NI").val(resulBusqueda[0].primerApellido);
                    $("#tf_ape2Padre_NI").val(resulBusqueda[0].segundoApellido);
                    $("#tf_nombrePadre_NI").val(resulBusqueda[0].nombre);
                    $("#tf_telCelPadre").val("");
                    $("#tf_ocupacionPadre").val("");
                }
            });
        }
    });

    //Carga los datos de de la Persona En Caso de Emergencia//
    $("#buscarPersonaEmergencia_NI").click(function(event) {
        var idD = $("#tf_cedulaPersonaEmergencia_NI").val();
        if (jQuery.isEmptyObject(idD)) {
            alert("Por favor ingrese el número de identificación.\nEj: 2-0456-0789, 1-1122-0567.\nNota: La Base de Datos esta actualizada al 2013 y solo posee Costarricenses y Nacionalizados");
        } else {
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


    //Carga los datos del Encargado Legal para Editar Expediente//
    $("#buscarEncargadoExpediente").click(function(event) {
        var idD = $("#tf_cedulaEncargado").val();
        if (jQuery.isEmptyObject(idD)) {
            alert("Por favor ingrese el número de identificación.\nEj: 2-0456-0789, 1-1122-0567.\nNota: La Base de Datos esta actualizada al 2013 y solo posee Costarricenses y Nacionalizados");
        } else {
            $.getJSON('../buscarEncargado/' + idD, function(resulBusqueda) {
                if (jQuery.isEmptyObject(resulBusqueda)) {
                    alert("Persona no encontrada, verifique el formato (ceros y guiones) y número de identificación.\nEj: 2-0456-0789, 1-1122-0567.\nNota: La Base de Datos esta actualizada al 2013 y solo posee Costarricenses y Nacionalizados");
                } else {
                    $("#tf_ape1Encargado").val(resulBusqueda[0].primerApellido);
                    $("#tf_ape2Encargado").val(resulBusqueda[0].segundoApellido);
                    $("#tf_nombreEncargado").val(resulBusqueda[0].nombre);
                    $("#tf_telHabitEncargado").val("");
                    $("#tf_telcelularEncargado").val("");
                    $("#tf_ocupacionEncargado").val("");
                    $("#tf_emailEncargado").val("");
                }
            });
        }
    });

    //Carga los datos de la Madre para Editar Expediente//
    $("#buscarMadreExpediente").click(function(event) {
        var idD = $("#tf_cedulaMadre").val();
        if (jQuery.isEmptyObject(idD)) {
            alert("Por favor ingrese el número de identificación.\nEj: 2-0456-0789, 1-1122-0567.\nNota: La Base de Datos esta actualizada al 2013 y solo posee Costarricenses y Nacionalizados");
        } else {
            $.getJSON('../buscarMadre/' + idD, function(resulBusqueda) {
                if (jQuery.isEmptyObject(resulBusqueda)) {
                    alert("Persona no encontrada, verifique el formato (ceros y guiones) y número de identificación.\nEj: 2-0456-0789, 1-1122-0567.\nNota: La Base de Datos esta actualizada al 2013 y solo posee Costarricenses y Nacionalizados");
                } else {
                    $("#tf_ape1Madre").val(resulBusqueda[0].primerApellido);
                    $("#tf_ape2Madre").val(resulBusqueda[0].segundoApellido);
                    $("#tf_nombreMadre").val(resulBusqueda[0].nombre);
                    $("#tf_telCelMadre").val("");
                    $("#tf_ocupacionMadre").val("");
                }
            });
        }
    });

    //Carga los datos del Padre para Editar Expediente//
    $("#buscarPadreExpediente").click(function(event) {
        var idD = $("#tf_cedulaPadre").val();
        if (jQuery.isEmptyObject(idD)) {
            alert("Por favor ingrese el número de identificación.\nEj: 2-0456-0789, 1-1122-0567.\nNota: La Base de Datos esta actualizada al 2013 y solo posee Costarricenses y Nacionalizados");
        } else {
            $.getJSON('../buscarPadre/' + idD, function(resulBusqueda) {
                if (jQuery.isEmptyObject(resulBusqueda)) {
                    alert("Persona no encontrada, verifique el formato (ceros y guiones) y número de identificación.\nEj: 2-0456-0789, 1-1122-0567.\nNota: La Base de Datos esta actualizada al 2013 y solo posee Costarricenses y Nacionalizados");
                } else {
                    $("#tf_ape1Padre").val(resulBusqueda[0].primerApellido);
                    $("#tf_ape2Padre").val(resulBusqueda[0].segundoApellido);
                    $("#tf_nombrePadre").val(resulBusqueda[0].nombre);
                    $("#tf_telCelPadre").val("");
                    $("#tf_ocupacionPadre").val("");
                }
            });
        }
    });

    //Carga los datos de de la Persona En Caso de Emergencia para Editar Expediente//
    $("#buscarPersonaEmergenciaExpediente").click(function(event) {
        var idD = $("#tf_cedulaPersonaEmergencia").val();
        if (jQuery.isEmptyObject(idD)) {
            alert("Por favor ingrese el número de identificación.\nEj: 2-0456-0789, 1-1122-0567.\nNota: La Base de Datos esta actualizada al 2013 y solo posee Costarricenses y Nacionalizados");
        } else {
            $.getJSON('../buscarPersonaEmergencia/' + idD, function(resulBusqueda) {
                if (jQuery.isEmptyObject(resulBusqueda)) {
                    alert("Persona no encontrada, verifique el formato (ceros y guiones) y número de identificación.\nEj: 2-0456-0789, 1-1122-0567.\nNota: La Base de Datos esta actualizada al 2013 y solo posee Costarricenses y Nacionalizados");
                } else {
                    $("#tf_ape1PersonaEmergencia").val(resulBusqueda[0].primerApellido);
                    $("#tf_ape2PersonaEmergencia").val(resulBusqueda[0].segundoApellido);
                    $("#tf_nombrePersonaEmergencia").val(resulBusqueda[0].nombre);
                    $("#tf_telHabitPersonaEmergencia").val("");
                    $("#tf_telcelularPersonaEmergencia").val("");
                }
            });
        }
    });

    //Carga datos de Encargado Legal a Padre o Madre//
    $("#sel_parentesco_NI").change(function() {
        var parentesco = $("#sel_parentesco_NI").val();
        if (parentesco === 'Padre') {
            $("#tf_cedulaEncargado_NI").val($("#tf_cedulaPadre_NI").val());
            $("#tf_ape1Encargado_NI").val($("#tf_ape1Padre_NI").val());
            $("#tf_ape2Encargado_NI").val($("#tf_ape2Padre_NI").val());
            $("#tf_nombreEncargado_NI").val($("#tf_nombrePadre_NI").val());
            $("#tf_telcelularEncargado").val($("#tf_telCelPadre").val());
            $("#tf_ocupacionEncargado").val($("#tf_ocupacionPadre").val());
        } else
        {
            if (parentesco === 'Madre') {
                $("#tf_cedulaEncargado_NI").val($("#tf_cedulaMadre_NI").val());
                $("#tf_ape1Encargado_NI").val($("#tf_ape1Madre_NI").val());
                $("#tf_ape2Encargado_NI").val($("#tf_ape2Madre_NI").val());
                $("#tf_nombreEncargado_NI").val($("#tf_nombreMadre_NI").val());
                $("#tf_telcelularEncargado").val($("#tf_telCelMadre").val());
                $("#tf_ocupacionEncargado").val($("#tf_ocupacionMadre").val());
            }
        }
    });

    //Carga datos de Padre o Madre a PersonaEmergencia//
    $("#sel_parentescoCasoEmergencia_NI").change(function() {
        var parentesco = $("#sel_parentescoCasoEmergencia_NI").val();
        if (parentesco === 'Padre') {
            $("#tf_cedulaPersonaEmergencia_NI").val($("#tf_cedulaPadre_NI").val());
            $("#tf_ape1PersonaEmergencia_NI").val($("#tf_ape1Padre_NI").val());
            $("#tf_ape2PersonaEmergencia_NI").val($("#tf_ape2Padre_NI").val());
            $("#tf_nombrePersonaEmergencia_NI").val($("#tf_nombrePadre_NI").val());
            $("#tf_telcelularPersonaEmergencia").val($("#tf_telCelPadre").val());
        } else
        {
            if (parentesco === 'Madre') {
                $("#tf_cedulaPersonaEmergencia_NI").val($("#tf_cedulaMadre_NI").val());
                $("#tf_ape1PersonaEmergencia_NI").val($("#tf_ape1Madre_NI").val());
                $("#tf_ape2PersonaEmergencia_NI").val($("#tf_ape2Madre_NI").val());
                $("#tf_nombrePersonaEmergencia_NI").val($("#tf_nombreMadre_NI").val());
                $("#tf_telcelularPersonaEmergencia").val($("#tf_telCelMadre").val());
            }
        }
    });

    //Carga datos de Encargado Legal a Padre o Madre para Editar Expediente//
    $("#sel_parentescoExpediente").change(function() {
        var parentesco = $("#sel_parentescoExpediente").val();
        if (parentesco === 'Padre') {
            $("#tf_cedulaEncargado").val($("#tf_cedulaPadre").val());
            $("#tf_ape1Encargado").val($("#tf_ape1Padre").val());
            $("#tf_ape2Encargado").val($("#tf_ape2Padre").val());
            $("#tf_nombreEncargado").val($("#tf_nombrePadre").val());
            $("#tf_telcelularEncargado").val($("#tf_telCelPadre").val());
            $("#tf_ocupacionEncargado").val($("#tf_ocupacionPadre").val());
        } else
        {
            if (parentesco === 'Madre') {
                $("#tf_cedulaEncargado").val($("#tf_cedulaMadre").val());
                $("#tf_ape1Encargado").val($("#tf_ape1Madre").val());
                $("#tf_ape2Encargado").val($("#tf_ape2Madre").val());
                $("#tf_nombreEncargado").val($("#tf_nombreMadre").val());
                $("#tf_telcelularEncargado").val($("#tf_telCelMadre").val());
                $("#tf_ocupacionEncargado").val($("#tf_ocupacionMadre").val());
            }
        }
    });

    //Carga datos de Padre o Madre a PersonaEmergencia para Editar Expediente//
    $("#sel_parentescoCasoEmergenciaExpediente").change(function() {
        var parentesco = $("#sel_parentescoCasoEmergenciaExpediente").val();
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

    //Oculta Imput Enfermedad//
    $("#sel_enfermedad").change(function() {
        var variable = $("#sel_enfermedad").val();
        if (variable == 0) {
            $("#tf_enfermedadDescripcion").val("");
            document.getElementById("tf_enfermedadDescripcion").style.display = 'none';
        }
        else {
            document.getElementById("tf_enfermedadDescripcion").style.display = 'block';
        }
    });


    //Becas 2016
    //Carga los datos del Estudiante para completar el formulario **Insertar Beca Transporte**//
    $("#buscarEstudianteBecas").click(function(event) {
        if ($("#msj").css('display'))
        {
            document.getElementById("msj").style.display = 'none';
        }

        var idD = $("#ced_estudiante").val();
        if (idD == "") {
            alert("Por favor ingrese una identificación");
        } else {
            $.getJSON('buscarEstudianteBecas/' + idD, function(resulBusqueda) {
                if (jQuery.isEmptyObject(resulBusqueda)) {
                    alert("Persona no encontrada, verifique el formato (ceros y guiones) y número de identificación.\nEj: 2-0456-0789, 1-1122-0567.\nNota: La Base de Datos esta actualizada al 2016 y solo posee Costarricenses y Nacionalizados");
                } else {
                    $('#h5_ced_estudiante_encontrada').text(idD);
                    $('#ced_estudiante_encontrada').val(idD);
                    $('#nombre_encontrado').text(resulBusqueda['apellido1'] + ' ' + resulBusqueda['apellido2'] + ' ' + resulBusqueda['nombre']);
                    $('#distrito_encontrado').text(resulBusqueda['Distrito']);
                    $('#nivel_encontrado').text(resulBusqueda['nivel']);
                    $('#especialidad_encontrada').text(resulBusqueda['nombreEspecialidad']);
                    if (resulBusqueda['ced_padre'] != null) {
                        $('#padre_encontrado').val(resulBusqueda['ced_padre'] + ',Padre');
                        $('#h5_padre_encontrado').text(resulBusqueda['apellido1_padre'] + ' ' + resulBusqueda['apellido2_padre'] + ' ' + resulBusqueda['nombre_padre']);
                    } else {
                        $('#h5_padre_encontrado').text('-');
                    }
                    if (resulBusqueda['ced_madre'] != null) {
                        $('#madre_encontrado').val(resulBusqueda['ced_madre'] + ',Madre');
                        $('#h5_madre_encontrado').text(resulBusqueda['apellido1_madre'] + ' ' + resulBusqueda['apellido2_madre'] + ' ' + resulBusqueda['nombre_madre']);
                    } else {
                        $('#h5_madre_encontrado').text('-');
                    }
                    if (resulBusqueda['ced_encargado'] != null) {
                        $('#otro_encontrado').val(resulBusqueda['ced_encargado'] + ',Otro');
                        $('#h5_otro_encontrado').text(resulBusqueda['apellido1_encargado'] + ' ' + resulBusqueda['apellido2_encargado'] + ' ' + resulBusqueda['nombre_encargado']);
                    } else {
                        $('#h5_otro_encontrado').text('-');
                    }
                }
            });
        }
    });


    //Carga los datos del Estudiante para completar el formulario **Insertar Beca Comedor**//
    $("#buscarEstudianteBecasComedor").click(function(event) {
        if ($("#msj").css('display'))
        {
            document.getElementById("msj").style.display = 'none';
        }

        var idD = $("#ced_estudiante").val();
        if (idD == "") {
            alert("Por favor ingrese una identificación");
        } else {
            $.getJSON('buscarEstudianteBecas/' + idD, function(resulBusqueda) {
                if (jQuery.isEmptyObject(resulBusqueda)) {
                    alert("Persona no encontrada, verifique el formato (ceros y guiones) y número de identificación.\nEj: 2-0456-0789, 1-1122-0567.\nNota: La Base de Datos esta actualizada al 2016 y solo posee Costarricenses y Nacionalizados");
                } else {
                    $('#h5_ced_estudiante_encontrada').text(idD);
                    $('#ced_estudiante_encontrada').val(idD);
                    $('#nombre_encontrado').text(resulBusqueda['apellido1'] + ' ' + resulBusqueda['apellido2'] + ' ' + resulBusqueda['nombre']);
                    $('#distrito_encontrado').text(resulBusqueda['Distrito']);
                    $('#nivel_encontrado').text(resulBusqueda['nivel']);
                    $('#especialidad_encontrada').text(resulBusqueda['nombreEspecialidad']);
                }
            });
        }
    });

    //Carga los datos del Estudiante para completar el formulario **Modificar Cédula**//
    $("#buscarEstudianteModifCed").click(function(event) {
        var idD = $("#ced_estudiante").val();
        if (idD == "") {
            alert("Por favor ingrese una identificación");
        } else {
            $.getJSON('buscarEstudianteModifCed/' + idD, function(resulBusqueda) {
                if (jQuery.isEmptyObject(resulBusqueda)) {
                    alert("Persona no encontrada, verifique el formato (ceros y guiones) y número de identificación.\nEj: 2-0456-0789, 1-1122-0567.\nNota: La Base de Datos esta actualizada al 2016 y solo posee Costarricenses y Nacionalizados");
                } else {
                    $('#h5_ced_estudiante_encontrada').text(idD);
                    $('#ced_estudiante_encontrada').val(idD);
                    $('#nombre_encontrado').text(resulBusqueda['apellido1'] + ' ' + resulBusqueda['apellido2'] + ' ' + resulBusqueda['nombre']);
                    $('#distrito_encontrado').text(resulBusqueda['Distrito']);
                    $('#nivel_encontrado').text(resulBusqueda['nivel']);
                    $('#especialidad_encontrada').text(resulBusqueda['nombreEspecialidad']);
                }
            });
        }
    });

    $("#uploadedfile").on("change", function(event) {

        //Obtenemos la imagen del campo "file". 
        var files = event.target.files;
        var ced_Estudiante = $("#tf_cedulaEstudiante").val();
        for (var i = 0, f; f = files[i]; i++) {
            //Solo admitimos imágenes.
            if (!f.type.match('image.*')) {
                continue;
            }

            var reader = new FileReader();

            reader.onload = (function(theFile) {
                return function(e) {
                    // Creamos la imagen.
                    document.getElementById("fotoEstudiante").src = e.target.result;
                    
                    //rutaSitio es una variable JS que esta declarada en editarExpedienteEstudiante.php, su funcion es
                    //capturar la ruta del entorno del sitio web donde se esta ejecutando, utiliza al define URL ubicado en config.php
                    $.ajax({
                        url: rutaSitio + "persona/guardarFotoEstudiante",
                        // Enviar un parámetro post con el nombre base64 y con la imagen en el
                        data: {
                            base64: e.target.result,
                            ced_estudiante: ced_Estudiante
                        },
                        // Método POST
                        type: "post",
                        complete: function() {
                            console.log("Todo en orden");
                        }
                    });
                };
            })(f);
            reader.readAsDataURL(f);
        }
    });

    //Eliminar 2017
    //Carga los datos del Estudiante para completar el formulario **Insertar Beca Transporte**//
    $("#buscarEstudianteEliminar").click(function(event) {
        if ($("#msj").css('display'))
        {
            document.getElementById("msj").style.display = 'none';
        }

        var idD = $("#ced_estudiante").val();
        if (idD == "") {
            alert("Por favor ingrese una identificación");
        } else {
            $.getJSON('buscarEstudianteEliminar/' + idD, function(resulBusqueda) {
                if (jQuery.isEmptyObject(resulBusqueda)) {
                    alert("Persona no encontrada, verifique el formato (ceros y guiones) y número de identificación.\nEj: 2-0456-0789, 1-1122-0567.\nNota: La Base de Datos esta actualizada al 2016 y solo posee Costarricenses y Nacionalizados");
                } else {
                    $('#h5_ced_estudiante_encontrada').text(idD);
                    $('#ced_estudiante_encontrada').val(idD);
                    $('#nombre_encontrado').text(resulBusqueda['apellido1'] + ' ' + resulBusqueda['apellido2'] + ' ' + resulBusqueda['nombre']);
                    $('#distrito_encontrado').text(resulBusqueda['Distrito']);
                    
                }
            });
        }
    });
});