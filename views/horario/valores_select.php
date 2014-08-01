<?php
function llenar_grupos($cantidad_Secciones, $matrizGrupos){
$contador3=$cantidad_Secciones;
//este proceso lee la matriz y asigna el codigo del grupo al "value" del option e imprime el nombre de esa seccion
while($contador3>=0)
    {
        $contador4=0;
        echo '<option value="'.$matrizGrupos[$contador3][$contador4].'">';
        $contador4++;
        echo $matrizGrupos[$contador3][$contador4].'</option>';
        $contador3--;
    }
}

function llenar_grupos2($cantidad_Secciones, $matrizGrupos, $grupo){
$contador3=$cantidad_Secciones;
//este proceso lee la matriz y asigna el codigo del grupo al "value" del option e imprime el nombre de esa seccion
while($contador3>=0)
    {
        $contador4=0;
        echo '<option value="'.$matrizGrupos[$contador3][$contador4].'"';
        if($matrizGrupos[$contador3][$contador4]==$grupo)
        {
        echo ' selected>';
        }
        else
        {
       echo ' >';
        }
        $contador4++;
        echo $matrizGrupos[$contador3][$contador4].'</option>';
        $contador3--;
    }
}

function llenar_asignaturas($cantidad_Asignaturas, $matriz){
 $contador1=$cantidad_Asignaturas;
 //este proceso lee la matriz y asigna el codigo de materia al "value" del option e imprime el nombre de esa materia
while($contador1>=0)
    {
    $contador2=0;
    echo '<option value="'.$matriz[$contador1][$contador2].'">';
    $contador2++;
    echo $matriz[$contador1][$contador2].'</option>';
    $contador1--;
    }
}

function llenar_asignaturas2($cantidad_Asignaturas, $matriz, $asignatura){
 $contador1=$cantidad_Asignaturas;
 //este proceso lee la matriz y asigna el codigo de materia al "value" del option e imprime el nombre de esa materia
while($contador1>=0)
    {
    $contador2=0;
    echo '<option value="'.$matriz[$contador1][$contador2].'"';
        if($matriz[$contador1][$contador2]==$asignatura)
        {
        echo ' selected>';
        }
        else
        {
       echo ' >';
        }
    $contador2++;
    echo $matriz[$contador1][$contador2].'</option>';
    $contador1--;
    }
}