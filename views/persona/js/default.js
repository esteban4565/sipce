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
}); 