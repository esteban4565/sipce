$(function() 
{
    //Carga los cantones//
    $("#tf_provincias").change(function(){
        $("#tf_cantones,tf_#distritos").empty();
        var idP = $("#tf_provincias").val();
        $.getJSON('../persona/cargaCantones/'+ idP,function(canton){
            $('#tf_cantones').append('<option value="">Seleccione</option>');
            for (var iP = 0; iP < canton.length; iP++){
                $("#tf_cantones").append('<option value="' + canton[iP].IdCanton + '">' + canton[iP].Canton + '</option>');
            }
        });
    });
    
    //Carga los distritos//
    $("#tf_cantones").change(function(){
        $("#tf_distritos").empty();
        var idD = $("#tf_cantones").val();
        //var ids = $(this).attr('rel');
        $.getJSON('../persona/cargaDistritos/'+ idD,function(distrito){
            $('#tf_distritos').append('<option value="">Seleccione</option>');
            for (var iD = 0; iD < distrito.length; iD++){
                $("#tf_distritos").append('<option value="' + distrito[iD].IdDistrito + '">' + distrito[iD].Distrito + '</option>');
            }
        });
    }); 
    
    
//**Cosas de Esteban**//
    
    //Carga los Grupos de un nivel en especifico//
    $("#tf_Niveles").change(function() {
        $("#tf_Grupos").empty();
        $("#listaEstudiantes").empty();
        
        var nivelSeleccionado = $("#tf_Niveles").val();
        $.getJSON('../persona/cargaGrupos/' + nivelSeleccionado, function(Gru) {
            $('#tf_Grupos').append('<option value="">Seleccione</option>');
            for (var iP = 0; iP < Gru.length; iP++) {
                $("#tf_Grupos").append('<option value="' + Gru[iP].grupo + '">' + Gru[iP].grupo + '</option>');
            }
        });
        
        var cantidadColumnas=5;
        var chk_email=0;
        var chk_poliza=0;
        var chk_domicilio=0;
        var chk_telefonosEstu=0;
        var chk_telefonosEncargado=0;
        if( $('#chk_email').prop('checked') ) {
            chk_email=1;
            cantidadColumnas++;
        }
        if( $('#chk_poliza').prop('checked') ) {
            chk_poliza=1;
            cantidadColumnas++;
            cantidadColumnas++;
        }
        if( $('#chk_domicilio').prop('checked') ) {
            chk_domicilio=1;
            cantidadColumnas++;
        }
        if( $('#chk_telefonosEstu').prop('checked') ) {
            chk_telefonosEstu=1;
            cantidadColumnas++;
            cantidadColumnas++;
        }
        if( $('#chk_telefonosEncargado').prop('checked') ) {
            chk_telefonosEncargado=1;
            cantidadColumnas++;
            cantidadColumnas++;
        }
            
        var consulta = {nivelSeleccionado: $("#tf_Niveles").val(), grupoSeleccionado: 0, chk_email: chk_email, 
                        chk_poliza: chk_poliza, chk_domicilio: chk_domicilio, chk_telefonosEstu: chk_telefonosEstu,
                        chk_telefonosEncargado: chk_telefonosEncargado};
        $.post('../persona/cargaSeccion/', consulta, function(seccionElegida, success) {
            
            var arraySalida="";
            arraySalida+='<thead><tr><td colspan="' + cantidadColumnas +'" class="text-center">' + consulta.nivelSeleccionado + '°</td></tr>';
            arraySalida+='<tr><th>N°</th><th>Identificación</th><th>Nombre del Estudiante</th>';
            if(chk_email==1){
                arraySalida+='<th>Email</th>';
            }
            if(chk_poliza==1){
                arraySalida+='<th>N° de Poliza</th><th>Fecha Vencimiento</th>';
            }
            if(chk_domicilio==1){
                arraySalida+='<th>Domicilio</th>';
            }
            if(chk_telefonosEstu==1){
                arraySalida+='<th>Tel. Casa</th><th>Cel. Estu</th>';
            }
            if(chk_telefonosEncargado==1){
                arraySalida+='<th>Nombre del Encargado</th><th>Tel. Casa Encargado</th><th>Cel. Encargado</th>';
            }
            
            arraySalida+='</tr></thead><tbody>';
            
            for (var linea = 0; linea < seccionElegida.length; linea++) {
                arraySalida+='<tr><td>' + (linea + 1) + '</td><td>' +
                        seccionElegida[linea].cedula + '</td><td>' + seccionElegida[linea].apellido1 + ' ' +
                        seccionElegida[linea].apellido2 + ' ' + seccionElegida[linea].nombre + '</td>';
                
                        if(chk_email==1){
                        arraySalida+='<td>' + seccionElegida[linea].email + '</td>';
                        }
                
                        if(chk_poliza==1){
                        arraySalida+='<td>' + seccionElegida[linea].numero_poliza + '</td>';
                        arraySalida+='<td>' + seccionElegida[linea].fecha_vence + '</td>';
                        }
                
                        if(chk_domicilio==1){
                        arraySalida+='<td>' + seccionElegida[linea].domicilio + ', ' + seccionElegida[linea].Distrito + 
                                     ', ' + seccionElegida[linea].Canton  + ', ' + seccionElegida[linea].nombreProvincia  + '</td>';
                        }
                
                        if(chk_telefonosEstu==1){
                        arraySalida+='<td>' + seccionElegida[linea].telefonoCasa.substr(0, 4) + '-' + seccionElegida[linea].telefonoCasa.substr(4) + '</td>';
                        arraySalida+='<td>' + seccionElegida[linea].telefonoCelular.substr(0, 4) + '-' + seccionElegida[linea].telefonoCelular.substr(4) + '</td>';
                        }
                
                        if(chk_telefonosEncargado==1){
                        arraySalida+='<td>' + seccionElegida[linea].nombre_encargado + ' ' + seccionElegida[linea].apellido1_encargado + ' ' + seccionElegida[linea].apellido2_encargado + '</td>';
                        arraySalida+='<td>' + seccionElegida[linea].telefonoCasaEncargado.substr(0, 4) + '-' + seccionElegida[linea].telefonoCasaEncargado.substr(4) + '</td>';
                        arraySalida+='<td>' + seccionElegida[linea].telefonoCelularEncargado.substr(0, 4) + '-' + seccionElegida[linea].telefonoCelularEncargado.substr(4) + '</td>';
                        }
                        
                        arraySalida+='</tr>';
            }
            
            arraySalida+='<tr><td colspan="' + cantidadColumnas +'" class="text-center">Ultima Línea</td></tr></tbody>';
            $('#listaEstudiantes').append(arraySalida);
        }, "json");
    });

    //Carga los Estudiantes de una sección en especifico//
    $("#tf_Grupos").change(function() {
        $("#listaEstudiantes").empty();
        
        var banderaGrupoB=0;
        var banderaGrupoC=0;
        var cantidadColumnas=3;
        var chk_email=0;
        var chk_poliza=0;
        var chk_domicilio=0;
        var chk_telefonosEstu=0;
        var chk_telefonosEncargado=0;
        
        if( $('#chk_email').prop('checked') ) {
            chk_email=1;
            cantidadColumnas++;
        }
        if( $('#chk_poliza').prop('checked') ) {
            chk_poliza=1;
            cantidadColumnas++;
            cantidadColumnas++;
        }
        if( $('#chk_domicilio').prop('checked') ) {
            chk_domicilio=1;
            cantidadColumnas++;
        }
        if( $('#chk_telefonosEstu').prop('checked') ) {
            chk_telefonosEstu=1;
            cantidadColumnas++;
            cantidadColumnas++;
        }
        if( $('#chk_telefonosEncargado').prop('checked') ) {
            chk_telefonosEncargado=1;
            cantidadColumnas++;
            cantidadColumnas++;
        }
            
        var consulta = {nivelSeleccionado: $("#tf_Niveles").val(), grupoSeleccionado: $("#tf_Grupos").val(),
                        chk_email: chk_email, chk_poliza: chk_poliza, chk_domicilio: chk_domicilio,
                        chk_telefonosEstu: chk_telefonosEstu, chk_telefonosEncargado: chk_telefonosEncargado};
                    
        $.post('../persona/cargaSeccion/', consulta, function(seccionElegida, success) {
            var arraySalida="";
            arraySalida+='<thead><tr><td colspan="' + cantidadColumnas +'" class="text-center">' + consulta.nivelSeleccionado + '-' + consulta.grupoSeleccionado + '</td></tr>';
            arraySalida+='<tr><td colspan="' + cantidadColumnas +'" class="text-center">&nbsp;</td></tr><tr><td colspan="' + cantidadColumnas +'" class="text-center">Grupo A</td></tr>';
            arraySalida+='<tr><th>N°</th><th>Identificación</th><th>Nombre del Estudiante</th>';
            if(chk_email==1){
                arraySalida+='<th>Email</th>';
            }
            if(chk_poliza==1){
                arraySalida+='<th>N° de Poliza</th><th>Fecha Vencimiento</th>';
            }
            if(chk_domicilio==1){
                arraySalida+='<th>Domicilio</th>';
            }
            if(chk_telefonosEstu==1){
                arraySalida+='<th>Tel. Casa</th><th>Cel. Estu</th>';
            }
            if(chk_telefonosEncargado==1){
                arraySalida+='<th>Nombre del Encargado</th><th>Tel. Casa Encargado</th><th>Cel. Encargado</th>';
            }
            
            arraySalida+='</tr></thead><tbody>';
            
            for (var linea = 0; linea < seccionElegida.length; linea++) {
                if(seccionElegida[linea].sub_grupo=='B' && banderaGrupoB==0){
                    arraySalida+='<tr><td colspan="' + cantidadColumnas +'" class="text-center">&nbsp;</td></tr><tr><td colspan="' + cantidadColumnas +'" class="text-center">Grupo B</td></tr>';
                    banderaGrupoB=1;
                }else if(seccionElegida[linea].sub_grupo=='C' && banderaGrupoC==0){
                    arraySalida+='<tr><td colspan="' + cantidadColumnas +'" class="text-center">&nbsp;</td></tr><tr><td colspan="' + cantidadColumnas +'" class="text-center">Grupo C</td></tr>';
                    banderaGrupoC=1;
                }
                arraySalida+='<tr><td>' + (linea + 1) + '</td><td>' +
                        seccionElegida[linea].cedula + '</td><td>' + seccionElegida[linea].apellido1 + ' ' +
                        seccionElegida[linea].apellido2 + ' ' + seccionElegida[linea].nombre + '</td>';
                
                if(chk_email==1){
                    arraySalida+='<td>' + seccionElegida[linea].email + '</td>';
                    }

                if(chk_poliza==1){
                    arraySalida+='<td>' + seccionElegida[linea].numero_poliza + '</td>';
                    arraySalida+='<td>' + seccionElegida[linea].fecha_vence + '</td>';
                    }

                if(chk_domicilio==1){
                    arraySalida+='<td>' + seccionElegida[linea].domicilio + ', ' + seccionElegida[linea].Distrito + 
                                 ', ' + seccionElegida[linea].Canton  + ', ' + seccionElegida[linea].nombreProvincia  + '</td>';
                    }

                if(chk_telefonosEstu==1){
                    arraySalida+='<td>' + seccionElegida[linea].telefonoCasa.substr(0, 4) + '-' + seccionElegida[linea].telefonoCasa.substr(4) + '</td>';
                    arraySalida+='<td>' + seccionElegida[linea].telefonoCelular.substr(0, 4) + '-' + seccionElegida[linea].telefonoCelular.substr(4) + '</td>';
                    }

                if(chk_telefonosEncargado==1){
                    arraySalida+='<td>' + seccionElegida[linea].nombre_encargado + ' ' + seccionElegida[linea].apellido1_encargado + ' ' + seccionElegida[linea].apellido2_encargado + '</td>';
                    arraySalida+='<td>' + seccionElegida[linea].telefonoCasaEncargado.substr(0, 4) + '-' + seccionElegida[linea].telefonoCasaEncargado.substr(4) + '</td>';
                    arraySalida+='<td>' + seccionElegida[linea].telefonoCelularEncargado.substr(0, 4) + '-' + seccionElegida[linea].telefonoCelularEncargado.substr(4) + '</td>';
                    }

                arraySalida+='</tr>';
            }
            
            arraySalida+='<tr><td colspan="' + cantidadColumnas +'" class="text-center">Ultima Línea</td></tr></tbody>';
            $('#listaEstudiantes').append(arraySalida);
        }, "json");
    });

    
}); 