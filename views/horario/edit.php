<h3>Modulo Horario - Modificar</h3>
<hr>

<form method="post" action="<?php echo URL;?>horario/ingresarHorario/<?php echo $this->horario[0]['ced_docente']; ?>">
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
//if($this->estado==1){
//    echo '<pre>';
//    print_r($this->horario);
//    echo '</pre>';
//}
//echo '<br/><br/><br/>';
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
                echo 'Sec: <select name="cod_seccion_L'.$i.'">'; 
                //esta funcion se encarga de cargar todas las secciones de la institucion a los "Options" del "Selectc"
                llenar_grupos($cantidad_Secciones, $matrizGrupos);
                echo '</select>';
                echo '<br>';

                echo 'Asig: <select name="asignatura_L'.$i.'">';
                 //esta funcion se encarga de cargar todas las asignaciones del procesor a los "Options" del "Selectc"
                llenar_asignaturas($cantidad_Asignaturas, $matriz);
                echo '</select>';
                echo '</td>';

                echo '<td>';
                //k1= Martes leccion n°1
                echo 'Sec: <select name="cod_seccion_K'.$i.'">';
                llenar_grupos($cantidad_Secciones, $matrizGrupos);
                echo '</select>';
                echo '<br>';

                echo 'Asig:  <select name="asignatura_K'.$i.'">';
                llenar_asignaturas($cantidad_Asignaturas, $matriz);
                echo '</select>';
                echo '</td>';

                echo '<td>';
                //M1= Miercoles leccion n°1
                echo 'Sec: <select name="cod_seccion_M'.$i.'">';
                llenar_grupos($cantidad_Secciones, $matrizGrupos);
                echo '</select>';
                echo '<br>';

                echo 'Asig: <select name="asignatura_M'.$i.'">';
                llenar_asignaturas($cantidad_Asignaturas, $matriz);
                echo '</select>';
                echo '</td>';

                echo '<td>';
                //J1= Jueves leccion n°1
                echo 'Sec: <select name="cod_seccion_J'.$i.'">';
                llenar_grupos($cantidad_Secciones, $matrizGrupos);
                echo '</select>';
                echo '<br>';

                echo 'Asig: <select name="asignatura_J'.$i.'">';
                llenar_asignaturas($cantidad_Asignaturas, $matriz);
                echo '</select>';
                echo '</td>';

                echo '<td>';
                //V1= Viernes leccion n°1
                echo 'Sec: <select name="cod_seccion_V'.$i.'">';
                llenar_grupos($cantidad_Secciones, $matrizGrupos);
                echo '</select>';
                echo '<br>';

                echo 'Asig: <select name="asignatura_V'.$i.'">';
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
else
    {
    for ($i = 1; $i <=12; $i++) 
                {
    
                echo '<td>';
                //L1= Lunes leccion n°1
                echo 'Sec: <select name="cod_seccion_L'.$i.'">'; 
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

                echo 'Asig: <select name="asignatura_L'.$i.'">';
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
                echo 'Sec: <select name="cod_seccion_K'.$i.'">';
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

                echo 'Asig:  <select name="asignatura_K'.$i.'">';
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
                echo 'Sec: <select name="cod_seccion_M'.$i.'">';
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

                echo 'Asig: <select name="asignatura_M'.$i.'">';
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
                echo 'Sec: <select name="cod_seccion_J'.$i.'">';
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

                echo 'Asig: <select name="asignatura_J'.$i.'">';
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
                echo 'Sec: <select name="cod_seccion_V'.$i.'">';
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

                echo 'Asig: <select name="asignatura_V'.$i.'">';
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

//Dependiendo del estado (Edicion/Nuevo) asi se presentaran los botones
if($this->estado==0)
    {
    echo '<input type="hidden" name="ced_docente" value="'.$this->horario[0]['ced_docente'].'">';
    echo '<input type="submit" name="guardarHorario" value="Guardar Horario">';  
    echo '</form>';  
    }
else 
    {
    echo '<input type="hidden" name="ced_docente" value="'.$this->horario[0]['ced_docente'].'">';
    echo '<button type="submit" name="modificarHorario" class="btn btn-success">Modificar Horario</button>';  
    echo '</form>';
    }

echo '<br/><br/>';