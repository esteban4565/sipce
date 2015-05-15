$(function() 
{
    //Carga los Grupos//
    $("#tf_Niveles").change(function(){
        $("#tf_Grupos").empty();
        var idP = $("#tf_Niveles").val();
        $.getJSON('../seccion/cargaGrupos/'+ idP,function(grupo){
            $('#tf_Grupos').append('<option value="">Seleccione</option>');
            for (var iP = 0; iP < grupo.length; iP++){
                $("#tf_Grupos").append('<option value="' + grupo[iP].Grupo + '">' + grupo[iP].Grupo + '</option>');
            }
        });
    });
    
    //Carga los SubGrupos//
    $("#tf_Grupos").change(function(){
        $("#tf_SubGrupos").empty();
        var idD = $("#tf_Grupos").val();
        //var ids = $(this).attr('rel');
        $.getJSON('../seccion/cargaSubGrupos/'+ idD,function(subGrupos){
            $('#tf_SubGrupos').append('<option value="">Seleccione</option>');
            for (var iD = 0; iD < subGrupos.length; iD++){
                $("#tf_SubGrupos").append('<option value="' + subGrupos[iD].SubGrupo + '">' + subGrupos[iD].SubGrupo + '</option>');
            }
        });
    }); 
}); 