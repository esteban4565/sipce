<?php

function encabezado_tabla(){
echo '<table class="table table-bordered table-striped table-condensed">';
    echo '<thead>';
    echo '<tr>';
            echo '<th>';
            echo 'Leccion';
            echo '</th>';

            echo '<th>';
            echo 'Hora';
            echo '</th>';

            echo '<th>';
            echo 'Lunes';
            echo '</th>';

            echo '<th>';
            echo 'Martes';
            echo '</th>';

            echo '<th>';
            echo 'Miercoles';
            echo '</th>';

            echo '<th>';
            echo 'Jueves';
            echo '</th>';

            echo '<th>';
            echo 'Viernes';
            echo '</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    echo '<tr>';
            echo '<td>';
            echo '1';
            echo '</td>';

            echo '<td>';
            echo '7:00 - 7:40';
            echo '</td>';
}

function segunda_linea(){
    echo '</tr>';
    echo '<tr>';
        echo '<td>';
            echo '2';
        echo '</td>';

        echo '<td>';
            echo '7:40 - 8:20';
        echo '</td>';
}

function tercera_linea(){
    echo '</tr>';
    echo '<tr>';
        echo '<td>';
            echo '3';
        echo '</td>';

        echo '<td>';
            echo '8:20 - 9:00';
        echo '</td>';
}

function cuarta_linea(){
    echo '</tr>';
    echo '<tr>';
        echo '<td>';
            echo '4';
        echo '</td>';

        echo '<td>';
            echo '9:20 - 10:00';
        echo '</td>';
}

function quinta_linea(){
    echo '</tr>';
    echo '<tr>';
        echo '<td>';
            echo '5';
        echo '</td>';

        echo '<td>';
            echo '10:00 - 10:40';
        echo '</td>';
}

function sexta_linea(){
    echo '</tr>';
    echo '<tr>';
        echo '<td>';
            echo '6';
        echo '</td>';

        echo '<td>';
            echo '10:40 - 11:20';
        echo '</td>';
}

function setima_linea(){
    echo '</tr>';
    echo '<tr>';
        echo '<td>';
            echo '7';
        echo '</td>';

        echo '<td>';
            echo '12:00 - 12:40';
        echo '</td>';
}

function octava_linea(){
    echo '</tr>';
    echo '<tr>';
        echo '<td>';
            echo '8';
        echo '</td>';

        echo '<td>';
            echo '12:40 - 1:20';
        echo '</td>';
}

function novena_linea(){
    echo '</tr>';
    echo '<tr>';
        echo '<td>';
            echo '9';
        echo '</td>';

        echo '<td>';
            echo '1:20 - 2:00';
        echo '</td>';
}

function decima_linea(){
    echo '</tr>';
    echo '<tr>';
        echo '<td>';
            echo '10';
        echo '</td>';

        echo '<td>';
            echo '2:20 - 3:00';
        echo '</td>';
}

function undecima_linea(){
    echo '</tr>';
    echo '<tr>';
        echo '<td>';
            echo '11';
        echo '</td>';

        echo '<td>';
            echo '3:00 - 3:40';
        echo '</td>';
}

function duodecima_linea(){
    echo '</tr>';
    echo '<tr>';
        echo '<td>';
            echo '12';
        echo '</td>';

        echo '<td>';
            echo '3:40 - 4:20';
        echo '</td>';
}

function pie_tabla(){
    echo '</tr>';
    echo '</tbody>';
echo '</table>';
echo '<br/><br/>';
}