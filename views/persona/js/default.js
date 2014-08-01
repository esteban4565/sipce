$(function() 
{
    //Carga los cantones//
    $("#provincias").change(function(){
        $("#cantones,#distritos").empty();
        var idP = $("#provincias").val();
        $.getJSON('../persona/cargaCantones/'+ idP,function(canton){
            $('#cantones').append('<option value="">Seleccione</option>');
            for (var iP = 0; iP < canton.length; iP++){
                $("#cantones").append('<option value="' + canton[iP].IdCanton + '">' + canton[iP].Canton + '</option>');
            }
        });
    });
    
    //Carga los distritos//
    $("#cantones").change(function(){
        $("#distritos").empty();
        var idD = $("#cantones").val();
        //var ids = $(this).attr('rel');
        $.getJSON('../persona/cargaDistritos/'+ idD,function(distrito){
            $('#distritos').append('<option value="">Seleccione</option>');
            for (var iD = 0; iD < distrito.length; iD++){
                $("#distritos").append('<option value="' + distrito[iD].IdDistrito + '">' + distrito[iD].Distrito + '</option>');
            }
        });
    }); 
}); 