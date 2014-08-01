function Buscador(){
    var xmlhttp=false;
    try {
    xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
    try {
    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    } catch (E) {
    xmlhttp = false;
    }
    }

    if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
    xmlhttp = new XMLHttpRequest();
    }
    return xmlhttp;
    } 
function ListarPersonas(){
    
    var texto = document.getElementById('tf_cedula').value;
    var resultado = document.getElementById('resultado');
    ajax = Buscador();
    ajax.open("POST","persona/resultadoBuscarPersona/");
    ajax.onreadystatechange = function(){
    
        if(ajax.readyState == 4){
            resutado.innerHTML = ajax.responseText;
        }
    }
    ajax.send(null);    
    }

    

