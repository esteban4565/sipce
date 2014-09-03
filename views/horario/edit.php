<h3>Modulo Horario - Modificar</h3>
<hr>
<form method="post" action="<?php echo URL;?>horario/ingresarHorario/<?php echo $this->horario[0]['ced_docente']; ?>" class="form-horizontal">
<?php
//invoco procedimientos y funciones requeridas para el proceso
require 'valores_tabla.php';      
require 'valores_select.php';
        
//consulto los grupos
$matrizGrupos=$this->grupos;

//constante para recorrer la matriz ($contador3)
$cantidad_Secciones=count($matrizGrupos)-1;

//esta consulta me devuelve el codigo y nombre de las materias asignadas al usuario que inicio sesion
$matriz=$this->asignaturasDocente;

//constante para recorrer la matriz ($contador3)
$cantidad_Asignaturas=count($matriz)-1;

//Ver arreglo
if($this->estado==1){
    echo '<pre>';
    print_r($this->horario);
    echo '</pre>';
}
echo '<br/><br/><br/>';
encabezado_tabla();


//Verifico si esta en modo de Edicion (1) o es Nuevo (0)==No tiene horario definido
if($this->estado==0)
    {
        //Utilizo un for para recorrer las doce lecciones de cada dia, le asigna un "name" diferente a cada "Selectc" (leccion de la semana)
        //de este modo puedo identificarla a la hora de ingresar/leer de la BD
        for ($i = 1; $i <= 12; $i++) 
                {
                echo '<td>';
                //L1= Lunes leccion n°1
                echo 'Sec: <select class="form-control" name="cod_seccion_L'.$i.'">'; 
                //esta funcion se encarga de cargar todas las secciones de la institucion a los "Options" del "Selectc"
                llenar_grupos($cantidad_Secciones, $matrizGrupos);
                echo '</select>';
                echo '<br>';

                echo 'Asig: <select class="form-control" name="asignatura_L'.$i.'">';
                 //esta funcion se encarga de cargar todas las asignaciones del procesor a los "Options" del "Selectc"
                llenar_asignaturas($cantidad_Asignaturas, $matriz);
                echo '</select>';
                echo '</td>';

                echo '<td>';
                //k1= Martes leccion n°1
                echo 'Sec: <select class="form-control" name="cod_seccion_K'.$i.'">';
                llenar_grupos($cantidad_Secciones, $matrizGrupos);
                echo '</select>';
                echo '<br>';

                echo 'Asig:  <select class="form-control" name="asignatura_K'.$i.'">';
                llenar_asignaturas($cantidad_Asignaturas, $matriz);
                echo '</select>';
                echo '</td>';

                echo '<td>';
                //M1= Miercoles leccion n°1
                echo 'Sec: <select class="form-control" name="cod_seccion_M'.$i.'">';
                llenar_grupos($cantidad_Secciones, $matrizGrupos);
                echo '</select>';
                echo '<br>';

                echo 'Asig: <select class="form-control" name="asignatura_M'.$i.'">';
                llenar_asignaturas($cantidad_Asignaturas, $matriz);
                echo '</select>';
                echo '</td>';

                echo '<td>';
                //J1= Jueves leccion n°1
                echo 'Sec: <select class="form-control" name="cod_seccion_J'.$i.'">';
                llenar_grupos($cantidad_Secciones, $matrizGrupos);
                echo '</select>';
                echo '<br>';

                echo 'Asig: <select class="form-control" name="asignatura_J'.$i.'">';
                llenar_asignaturas($cantidad_Asignaturas, $matriz);
                echo '</select>';
                echo '</td>';

                echo '<td>';
                //V1= Viernes leccion n°1
                echo 'Sec: <select class="form-control" name="cod_seccion_V'.$i.'">';
                llenar_grupos($cantidad_Secciones, $matrizGrupos);
                echo '</select>';
                echo '<br>';

                echo 'Asig: <select class="form-control" name="asignatura_V'.$i.'">';
                llenar_asignaturas($cantidad_Asignaturas, $matriz);
                echo '</select>';
                echo '</td>';

                //Este switch me permite invocar a la funcion correcta dependiendo del ciclo, se encarga de pintar en la primer columna
                //los datos administrativos (Leccion, hora)
                switch ($i) 
                        {
                        case 1:
                        ////////Leccion 2 (7:40 - 8:20)//////////////
                        segunda_linea();
                        break;

                        case 2:
                        ////////Leccion 3 (8:20 - 9:00)//////////////
                        tercera_linea();
                        break;

                        case 3:

                        ////////Leccion 4 (9:20 - 10:00)//////////////
                        cuarta_linea();
                        break;

                        case 4:
                        ////////Leccion 5 (10:00 - 10:40)//////////////
                        quinta_linea();
                        break;

                        case 5:
                        ////////Leccion 6 (10:40 - 11:20)//////////////
                        sexta_linea();
                        break;

                        case 6:
                        ////////Leccion 7 (12:00 - 12:40)//////////////
                        setima_linea();
                        break;

                        case 7:
                        ////////Leccion 8 (12:40 - 1:20)//////////////
                        octava_linea();
                        break;

                        case 8:
                        ////////Leccion 9 (1:20 - 2:00)//////////////
                        novena_linea();
                        break;

                        case 9:
                        ////////Leccion 10 (2:20 - 3:00)//////////////
                        decima_linea();
                        break;

                        case 10:
                        ////////Leccion 11 (3:00 - 3:40)//////////////
                        undecima_linea(); 
                        break;

                        case 11:
                        ////////Leccion 12 (3:40 - 4:20)//////////////
                        duodecima_linea(); 
                        break;

                        case 12:
                        pie_tabla();
                        break;
                        default:
                        echo '-------------';
                        break;
                        }
                }
    }
//si el profe ya tiene horario en la BD, se abre la Edicion, el array "horario" trae cuantos y cuales campos ya estan llenos, simplemente
//recorro el array, pregunto en que dia estoy, en que leccion estoy, y si tiene algo se selecciona, sino se llama a las funciones de carga
else{
    //Modo1
    $i=0;
        for($leccion = 1; $leccion <= 12; $leccion++) {
                echo '<td>';
                //L1= Lunes leccion n°1
                echo 'Sec: <select class="form-control" name="cod_seccion_L'.$leccion.'">'; 
                //pregunto si ese registro pertenece al dia lunes, si tiene algo lo seleccion (Grupo) por medio de una funcion
                if($this->horario[$i]['cod_grupo']!=0)
                    {
                        llenar_grupos2($cantidad_Secciones, $matrizGrupos, $this->horario[$i]['cod_grupo']);
                    }
                //si no tiene nada o no coincide llamo a la funcion de carga normal
                else
                    {
                        llenar_grupos($cantidad_Secciones, $matrizGrupos);
                    }
                echo '</select>';
                echo '<br>';

                echo 'Asig: <select class="form-control" name="asignatura_L'.$leccion.'">';
                //pregunto si ese registro pertenece al dia lunes, si tiene algo lo seleccion (Asignatura) por medio de una funcion
                if($this->horario[$i]['cod_asignatura']!=0)
                    {
                        llenar_asignaturas2($cantidad_Asignaturas, $matriz, $this->horario[$i]['cod_asignatura']);
                    }
                else
                    {
                    llenar_asignaturas($cantidad_Asignaturas, $matriz);
                    }
                echo '</select>';
                echo '</td>';
                echo '<td>';
                
                $i++;
                
                //M1= Martes leccion n°1
                echo 'Sec: <select class="form-control" name="cod_seccion_K'.$leccion.'">'; 
                //pregunto si ese registro pertenece al dia lunes, si tiene algo lo seleccion (Grupo) por medio de una funcion
                if($this->horario[$i]['cod_grupo']!=0)
                    {
                        llenar_grupos2($cantidad_Secciones, $matrizGrupos, $this->horario[$i]['cod_grupo']);
                    }
                //si no tiene nada o no coincide llamo a la funcion de carga normal
                else
                    {
                        llenar_grupos($cantidad_Secciones, $matrizGrupos);
                    }
                echo '</select>';
                echo '<br>';

                echo 'Asig: <select class="form-control" name="asignatura_K'.$leccion.'">';
                //pregunto si ese registro pertenece al dia lunes, si tiene algo lo seleccion (Asignatura) por medio de una funcion
                if($this->horario[$i]['cod_asignatura']!=0)
                    {
                        llenar_asignaturas2($cantidad_Asignaturas, $matriz, $this->horario[$i]['cod_asignatura']);
                    }
                else
                    {
                    llenar_asignaturas($cantidad_Asignaturas, $matriz);
                    }
                echo '</select>';
                echo '</td>';
                
                $i++;
                
                echo '<td>';
                //L1= Lunes leccion n°1
                echo 'Sec: <select class="form-control" name="cod_seccion_M'.$leccion.'">'; 
                //pregunto si ese registro pertenece al dia lunes, si tiene algo lo seleccion (Grupo) por medio de una funcion
                if($this->horario[$i]['cod_grupo']!=0)
                    {
                        llenar_grupos2($cantidad_Secciones, $matrizGrupos, $this->horario[$i]['cod_grupo']);
                    }
                //si no tiene nada o no coincide llamo a la funcion de carga normal
                else
                    {
                        llenar_grupos($cantidad_Secciones, $matrizGrupos);
                    }
                echo '</select>';
                echo '<br>';

                echo 'Asig: <select class="form-control" name="asignatura_M'.$leccion.'">';
                //pregunto si ese registro pertenece al dia lunes, si tiene algo lo seleccion (Asignatura) por medio de una funcion
                if($this->horario[$i]['cod_asignatura']!=0)
                    {
                        llenar_asignaturas2($cantidad_Asignaturas, $matriz, $this->horario[$i]['cod_asignatura']);
                    }
                else
                    {
                    llenar_asignaturas($cantidad_Asignaturas, $matriz);
                    }
                echo '</select>';
                echo '</td>';
                echo '<td>';
                
                $i++;
                
                //M1= Martes leccion n°1
                echo 'Sec: <select class="form-control" name="cod_seccion_J'.$leccion.'">'; 
                //pregunto si ese registro pertenece al dia lunes, si tiene algo lo seleccion (Grupo) por medio de una funcion
                if($this->horario[$i]['cod_grupo']!=0)
                    {
                        llenar_grupos2($cantidad_Secciones, $matrizGrupos, $this->horario[$i]['cod_grupo']);
                    }
                //si no tiene nada o no coincide llamo a la funcion de carga normal
                else
                    {
                        llenar_grupos($cantidad_Secciones, $matrizGrupos);
                    }
                echo '</select>';
                echo '<br>';

                echo 'Asig: <select class="form-control" name="asignatura_J'.$leccion.'">';
                //pregunto si ese registro pertenece al dia lunes, si tiene algo lo seleccion (Asignatura) por medio de una funcion
                if($this->horario[$i]['cod_asignatura']!=0)
                    {
                        llenar_asignaturas2($cantidad_Asignaturas, $matriz, $this->horario[$i]['cod_asignatura']);
                    }
                else
                    {
                    llenar_asignaturas($cantidad_Asignaturas, $matriz);
                    }
                echo '</select>';
                echo '</td>';
                echo '<td>';
                
                $i++;
                
                //M1= Martes leccion n°1
                echo 'Sec: <select class="form-control" name="cod_seccion_V'.$leccion.'">'; 
                //pregunto si ese registro pertenece al dia lunes, si tiene algo lo seleccion (Grupo) por medio de una funcion
                if($this->horario[$i]['cod_grupo']!=0)
                    {
                        llenar_grupos2($cantidad_Secciones, $matrizGrupos, $this->horario[$i]['cod_grupo']);
                    }
                //si no tiene nada o no coincide llamo a la funcion de carga normal
                else
                    {
                        llenar_grupos($cantidad_Secciones, $matrizGrupos);
                    }
                echo '</select>';
                echo '<br>';

                echo 'Asig: <select class="form-control" name="asignatura_V'.$leccion.'">';
                //pregunto si ese registro pertenece al dia lunes, si tiene algo lo seleccion (Asignatura) por medio de una funcion
                if($this->horario[$i]['cod_asignatura']!=0)
                    {
                        llenar_asignaturas2($cantidad_Asignaturas, $matriz, $this->horario[$i]['cod_asignatura']);
                    }
                else
                    {
                    llenar_asignaturas($cantidad_Asignaturas, $matriz);
                    }
                echo '</select>';
                echo '</td>';
                
                $i++;
                
                //Este switch me permite invocar a la funcion correcta dependiendo del ciclo, se encarga de pintar en la primer columna
            //los datos administrativos (Leccion, hora)
            switch ($leccion){
                    case 1:
                    ////////Leccion 2 (7:40 - 8:20)//////////////
                    segunda_linea();
                    break;

                    case 2:
                    ////////Leccion 3 (8:20 - 9:00)//////////////
                    tercera_linea();
                    break;

                    case 3:
                    ////////Leccion 4 (9:20 - 10:00)//////////////
                    cuarta_linea();
                    break;

                    case 4:
                    ////////Leccion 5 (10:00 - 10:40)//////////////
                    quinta_linea();
                    break;

                    case 5:
                    ////////Leccion 6 (10:40 - 11:20)//////////////
                    sexta_linea();
                    break;

                    case 6:
                    ////////Leccion 7 (12:00 - 12:40)//////////////
                    setima_linea();
                    break;

                    case 7:
                    ////////Leccion 8 (12:40 - 1:20)//////////////
                    octava_linea();
                    break;

                    case 8:
                    ////////Leccion 9 (1:20 - 2:00)//////////////
                    novena_linea();
                    break;

                    case 9:
                    ////////Leccion 10 (2:20 - 3:00)//////////////
                    decima_linea();
                    break;

                    case 10:
                    ////////Leccion 11 (3:00 - 3:40)//////////////
                    undecima_linea(); 
                    break;

                    case 11:
                    ////////Leccion 12 (3:40 - 4:20)//////////////
                    duodecima_linea(); 
                    break;

                    case 12:
                    pie_tabla();
                    break;
                    default:
                    echo '-------------';
                    break;
                    }
            }
    
    //Modo2
        /*
    for ($i = 1; $i <=60; $i++){
        $leccion=1;
        if($leccion<13){
                echo '<td>';
                //L1= Lunes leccion n°1
                echo 'Sec: <select class="form-control" name="cod_seccion_L'.$leccion.'">'; 
                //pregunto si ese registro pertenece al dia lunes, si tiene algo lo seleccion (Grupo) por medio de una funcion
                if($this->horario[$i-1]['dia']==1)
                    {
                        llenar_grupos2($cantidad_Secciones, $matrizGrupos, $this->horario[$i-1]['cod_grupo']);
                    }
                //si no tiene nada o no coincide llamo a la funcion de carga normal
                else
                    {
                        llenar_grupos($cantidad_Secciones, $matrizGrupos);
                    }
                echo '</select>';
                echo '<br>';

                echo 'Asig: <select class="form-control" name="asignatura_L'.$leccion.'">';
                //pregunto si ese registro pertenece al dia lunes, si tiene algo lo seleccion (Asignatura) por medio de una funcion
                if($this->horario[$i-1]['dia']==1)
                    {
                        llenar_asignaturas2($cantidad_Asignaturas, $matriz, $this->horario[$i-1]['cod_asignatura']);
                    }
                else
                    {
                    llenar_asignaturas($cantidad_Asignaturas, $matriz);
                    }
                echo '</select>';
                echo '</td>';

                echo '<td>';
                //k1= Martes leccion n°1
                echo 'Sec: <select class="form-control" name="cod_seccion_K'.$leccion.'">';
                if($this->horario[$i-1]['dia']==2)
                    {
                        llenar_grupos2($cantidad_Secciones, $matrizGrupos, $this->horario[$i-1]['cod_grupo']);
                    }
                else
                    {
                        llenar_grupos($cantidad_Secciones, $matrizGrupos);
                    }
                echo '</select>';
                echo '<br>';

                echo 'Asig:  <select class="form-control" name="asignatura_K'.$leccion.'">';
                if($this->horario[$i-1]['dia']==2)
                    {
                        llenar_asignaturas2($cantidad_Asignaturas, $matriz, $this->horario[$i-1]['cod_asignatura']);
                    }
                else
                    {
                    llenar_asignaturas($cantidad_Asignaturas, $matriz);
                    }
                echo '</select>';
                echo '</td>';

                echo '<td>';
                //M1= Miercoles leccion n°1
                echo 'Sec: <select class="form-control" name="cod_seccion_M'.$leccion.'">';
                if($this->horario[$i-1]['dia']==3)
                    {
                        llenar_grupos2($cantidad_Secciones, $matrizGrupos, $this->horario[$i-1]['cod_grupo']);
                    }
                else
                    {
                        llenar_grupos($cantidad_Secciones, $matrizGrupos);
                    }
                echo '</select>';
                echo '<br>';

                echo 'Asig: <select class="form-control" name="asignatura_M'.$leccion.'">';
                if($this->horario[$i-1]['dia']==3)
                    {
                        llenar_asignaturas2($cantidad_Asignaturas, $matriz, $this->horario[$i-1]['cod_asignatura']);
                    }
                else
                    {
                    llenar_asignaturas($cantidad_Asignaturas, $matriz);
                    }
                echo '</select>';
                echo '</td>';

                echo '<td>';
                //J1= Jueves leccion n°1
                echo 'Sec: <select class="form-control" name="cod_seccion_J'.$leccion.'">';
                if($this->horario[$i-1]['dia']==4)
                    {
                        llenar_grupos2($cantidad_Secciones, $matrizGrupos, $this->horario[$i-1]['cod_grupo']);
                    }
                else
                    {
                        llenar_grupos($cantidad_Secciones, $matrizGrupos);
                    }
                echo '</select>';
                echo '<br>';

                echo 'Asig: <select class="form-control" name="asignatura_J'.$leccion.'">';
                if($this->horario[$i-1]['dia']==4)
                    {
                        llenar_asignaturas2($cantidad_Asignaturas, $matriz, $this->horario[$i-1]['cod_asignatura']);
                    }
                else
                    {
                    llenar_asignaturas($cantidad_Asignaturas, $matriz);
                    }
                echo '</select>';
                echo '</td>';

                echo '<td>';
                //V1= Viernes leccion n°1
                echo 'Sec: <select class="form-control" name="cod_seccion_V'.$leccion.'">';
                if($this->horario[$i-1]['dia']==5)
                    {
                        llenar_grupos2($cantidad_Secciones, $matrizGrupos, $this->horario[$i-1]['cod_grupo']);
                    }
                else
                    {
                        llenar_grupos($cantidad_Secciones, $matrizGrupos);
                    }
                echo '</select>';
                echo '<br>';

                echo 'Asig: <select class="form-control" name="asignatura_V'.$leccion.'">';
                if($this->horario[$i-1]['dia']==5)
                    {
                        llenar_asignaturas2($cantidad_Asignaturas, $matriz, $this->horario[$i-1]['cod_asignatura']);
                    }
                else
                    {
                    llenar_asignaturas($cantidad_Asignaturas, $matriz);
                    }
                echo '</select>';
                echo '</td>';

                //Este switch me permite invocar a la funcion correcta dependiendo del ciclo, se encarga de pintar en la primer columna
                //los datos administrativos (Leccion, hora)
                switch ($i){
                        case 1:
                        ////////Leccion 2 (7:40 - 8:20)//////////////
                        segunda_linea();
                        break;

                        case 2:
                        ////////Leccion 3 (8:20 - 9:00)//////////////
                        tercera_linea();
                        break;

                        case 3:

                        ////////Leccion 4 (9:20 - 10:00)//////////////
                        cuarta_linea();
                        break;

                        case 4:
                        ////////Leccion 5 (10:00 - 10:40)//////////////
                        quinta_linea();
                        break;

                        case 5:
                        ////////Leccion 6 (10:40 - 11:20)//////////////
                        sexta_linea();
                        break;

                        case 6:
                        ////////Leccion 7 (12:00 - 12:40)//////////////
                        setima_linea();
                        break;

                        case 7:
                        ////////Leccion 8 (12:40 - 1:20)//////////////
                        octava_linea();
                        break;

                        case 8:
                        ////////Leccion 9 (1:20 - 2:00)//////////////
                        novena_linea();
                        break;

                        case 9:
                        ////////Leccion 10 (2:20 - 3:00)//////////////
                        decima_linea();
                        break;

                        case 10:
                        ////////Leccion 11 (3:00 - 3:40)//////////////
                        undecima_linea(); 
                        break;

                        case 11:
                        ////////Leccion 12 (3:40 - 4:20)//////////////
                        duodecima_linea(); 
                        break;

                        case 12:
                        pie_tabla();
                        break;
                        default:
                        echo '-------------';
                        break;
                        }
                }
                else{
                    $leccion=1;
                }
        }
    }
*/
}
//Dependiendo del estado (Edicion/Nuevo) asi se presentaran los botones
if($this->estado==0)
    {
    echo '<input type="hidden" name="estado" value="0">';
    echo '<input type="hidden" name="ced_docente" value="'.$this->horario[0]['ced_docente'].'">';
    echo '<input type="submit" name="guardarHorario" value="Guardar Horario" class="btn btn-success">';  
    echo '</form>';  
    }
else 
    {
    echo '<input type="hidden" name="estado" value="1">';
    echo '<input type="hidden" name="ced_docente" value="'.$this->horario[0]['ced_docente'].'">';
    echo '<input type="submit" name="modificarHorario" value="Modificar Horario" class="btn btn-success">';  
    echo '</form>';
    }

echo '<br/><br/>';