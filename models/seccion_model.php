<?php

class Seccion_Model extends Models {

    public function __construct() {
        parent::__construct();
        $this->anioActivo = 2016;
    }

    /* Carga todas los Niveles */

    public function consultaNiveles() {
        return $this->db->select("SELECT DISTINCT nivel "
                                . "FROM sipce_grupos "
                                . "WHERE annio = ".$this->anioActivo." "
                                . "ORDER BY nivel");
    }

    /* Carga todos los Grupos de un Nivel */

    public function cargaGrupos($idNivel) {
        $resultado = $this->db->select("SELECT DISTINCT grupo FROM sipce_grupos "
                                . "WHERE nivel = :nivel "
                                . "AND annio = ".$this->anioActivo." "
                                . "AND grupo <> 0 "
                                . "ORDER BY grupo", array('nivel' => $idNivel));
        echo json_encode($resultado);
    }

    //Carga la lista de los estudiantes de una seccion en especifico
    public function cargaSeccion($consulta) {
        $resultado2 = $this->db->select("SELECT e.cedula,e.nombre,e.apellido1,e.apellido2,g.sub_grupo,r.condicion "
                . "FROM sipce_estudiante as e, sipce_grupos as g, sipce_matricularatificacion as r "
                . "WHERE e.cedula = g.ced_estudiante "
                . "AND e.cedula = r.ced_estudiante "
                . "AND e.tipoUsuario = 4 "
                . "AND g.nivel = " . $consulta['nivelSeleccionado'] . " "
                . "AND g.grupo = " . $consulta['grupoSeleccionado'] . " "
                . "AND g.annio = " . $this->anioActivo . " "
                . "ORDER BY g.sub_grupo,e.apellido1,e.apellido2,e.nombre");
        echo json_encode($resultado2);
    }

    /* Carga todas las Zonas guardadas en la BD */

    public function consultaZonasEscuelas($nivel) {
        return $this->db->select("SELECT * "
                                . "FROM sipce_zona "
                                . "WHERE nivel = " . $nivel);
    }

    /* Carga todas las provincias */

    public function consultaProvincias() {
        return $this->db->select("SELECT * FROM sipce_provincias ORDER BY nombreProvincia", array());
    }

    /* Carga la cantidad de estudiantes por distrito */

    public function consultaEstadisticaZona($nivel) {
        $datos = array();
        $distritos = $this->db->select("SELECT DISTINCT p.IdDistrito, d.Distrito, c.IdCanton, c.Canton, pro.IdProvincia, pro.nombreProvincia "
                . "FROM sipce_estudiante as p,sipce_grupos as g,sipce_distritos as d,sipce_cantones as c,sipce_provincias as pro "
                . "WHERE p.cedula = g.ced_estudiante "
                . "AND d.IdDistrito = p.IdDistrito "
                . "AND c.IdCanton = p.IdCanton "
                . "AND pro.IdProvincia = p.IdProvincia "
                . "AND d.IdCanton = c.IdCanton "
                . "AND c.IdProvincia = pro.IdProvincia "
                . "AND g.nivel = " . $nivel . " "
                . "AND g.annio = " . ($this->anioActivo + 1) . " "
                . "ORDER BY pro.IdProvincia ");
        
         if($distritos!=NULL){
             $i=0;
            foreach ($distritos as $key => $value) {
                $datos[$i]['IdDistrito']=$value['IdDistrito'];
                $datos[$i]['nombreDistrito']=$value['Distrito'];
                $datos[$i]['IdCanton']=$value['IdCanton'];
                $datos[$i]['nombreCanton']=$value['Canton'];
                $datos[$i]['IdProvincia']=$value['IdProvincia'];
                $datos[$i]['nombreProvincia']=$value['nombreProvincia'];
                
                $consul = $this->db->select("SELECT COUNT(idDistrito) AS cantidadDistritos "
                . "FROM sipce_estudiante as p, sipce_grupos as g "
                . "WHERE p.cedula = g.ced_estudiante "
                . "AND g.nivel = " . $nivel . " "
                . "AND g.annio = " . ($this->anioActivo + 1) . " "
                . "AND p.IdDistrito = " . $value['IdDistrito'] . " ");
                foreach ($consul as $key => $value) {
                 $datos[$i]['cantidadEstudiantes'] = $value['cantidadDistritos'];
                }
                $i++;
            }
         }
        return $datos;
    }

    /* Carga la cantidad de secciones de todas las Zonas guardadas en la BD */

    public function consultaSeccionesZona($nivel) {
        return $this->db->select("SELECT z.descripcion, zs.cantidadSecciones "
                                . "FROM sipce_zona_secciones as zs, sipce_zona as z "
                                . "WHERE id_zona = id "
                                . "AND z.nivel = " . $nivel . " "
                                . "ORDER BY z.descripcion");
    }

    /* Carga los cantones de una Provincia en especifico */

    public function cargaCantones($idProvincia) {

        $resultado = $this->db->select("SELECT * FROM sipce_cantones WHERE IdProvincia = :idProvincia ORDER BY Canton", array('idProvincia' => $idProvincia));
        echo json_encode($resultado);
    }

    /* Carga los distritos de un Canton en especifico */

    public function cargaDistritos($idCanton) {

        $resultado = $this->db->select("SELECT * FROM sipce_distritos WHERE IdCanton = :idCanton ORDER BY Distrito", array('idCanton' => $idCanton));
        echo json_encode($resultado);
    }
    
    //Carga las escuela//
    function cargaEscuela($idDistrito){
       $resultado = $this->db->select("SELECT * FROM sipce_escuelas WHERE IdDistrito = :idDistrito ORDER BY nombre", array('idDistrito' => $idDistrito));
        echo json_encode($resultado); 
    }
    
    //Carga las escuela//
    function agregarZona($consulta){
        //Primero Inserto la nueva Zona
        $this->db->insert('sipce_zona', array(
            'descripcion' => $consulta['txt_zona'],
            'nivel' => $consulta['nivel']));
            
       //Luego devuelvo las zonas     
       $zonasActualizas = $this->db->select("SELECT * "
                                . "FROM sipce_zona "
                                . "WHERE nivel = " . $consulta['nivel']);
        echo json_encode($zonasActualizas); 
    }
    
    //Elimina la zona seleccionada//
    function eliminarZona($consulta){
        //Primero Elimino la Zona
        $this->db->delete('sipce_zona', 'id = '.$consulta['id']);
            
       //Luego devuelvo las zonas     
       $zonasActualizas = $this->db->select("SELECT * "
                                . "FROM sipce_zona "
                                . "WHERE nivel = " . $consulta['nivel']);
        echo json_encode($zonasActualizas); 
    }
    
    //Guardo la escuela seleccionada en la Zona elegida//
    function agregarEscuela($consulta){
        //Primero Inserto la nueva Escuela
        $this->db->insert('sipce_zona_escuela', array(
            'id_zona' => $consulta['id_zona'],
            'id_escuela' => $consulta['id_escuela'],
            'nivel' => $consulta['nivel']));
            
       //Luego devuelvo la zona Actualiza
       $escuelasZonaActualizas = $this->db->select("SELECT id_escuela, nombre "
                                . "FROM sipce_zona_escuela, sipce_escuelas "
                                . "WHERE id_zona = " .$consulta['id_zona']. " "
                                . "AND id_escuela = id "
                                . "ORDER BY nombre");
       echo json_encode($escuelasZonaActualizas); 
    }
    
    //Elimina la escuela seleccionada//
    function eliminarEscuela($consulta){
        //Primero Elimino la Escuela
        $this->db->delete('sipce_zona_escuela', 'id_escuela = ' . $consulta['id_escuela'] . ' AND id_zona = ' .$consulta['id_zona']);
            
       //Luego devuelvo la zona Actualizada
       $escuelasActualizas = $this->db->select("SELECT id_escuela, nombre "
                                . "FROM sipce_zona_escuela, sipce_escuelas "
                                . "WHERE id_zona = " .$consulta['id_zona']. " "
                                . "AND id_escuela = id "
                                . "ORDER BY nombre");
        echo json_encode($escuelasActualizas); 
    }
    
    //Guardo el Distrito seleccionado en la Zona elegida//
    function agregarDistrito($consulta){
        //Primero Inserto el Distrito
        $this->db->insert('sipce_zona_distrito', array(
            'id_zona' => $consulta['id_zona'],
            'id_distrito' => $consulta['id_distrito'],
            'nivel' => $consulta['nivel']));
            
       //Luego devuelvo la zona Actualiza
       $distritosZonaActualiza = $this->db->select("SELECT IdDistrito, Distrito "
                                . "FROM sipce_zona_distrito, sipce_distritos "
                                . "WHERE id_zona = " .$consulta['id_zona']. " "
                                . "AND id_distrito = IdDistrito "
                                . "ORDER BY Distrito");
       echo json_encode($distritosZonaActualiza); 
    }
    
    //Elimina el Distrito seleccionado//
    function eliminarDistrito($consulta){
        //Primero Elimino el Distrito
        $this->db->delete('sipce_zona_distrito', 'id_distrito = ' . $consulta['id_distrito'] . ' AND id_zona = ' .$consulta['id_zona']);
            
       //Luego devuelvo la zona Actualizada     
       $distritosZonaActualiza = $this->db->select("SELECT IdDistrito, Distrito "
                                . "FROM sipce_zona_distrito, sipce_distritos "
                                . "WHERE id_zona = " .$consulta['id_zona']. " "
                                . "AND id_distrito = IdDistrito "
                                . "ORDER BY Distrito");
        echo json_encode($distritosZonaActualiza); 
    }
    
    //Guardo la Cantidad de Secciones seleccionado en la Zona elegida//
    function guardarCantidadSecciones($consulta){
        //Primero consulto si el ID de la Zona ya existe
        $consultaExistenciaZona = $this->db->select("SELECT * "
                                                    . "FROM sipce_zona_secciones "
                                                    . "WHERE id_zona = " . $consulta['id_zona']);

        if ($consultaExistenciaZona != null) {
            //Actualizo datos de la Zona Editada
            $posData = array(
                'cantidadSecciones' => $consulta['cantidadSecciones']
                    );
            $this->db->update('sipce_zona_secciones', $posData, "`id_zona` = {$consulta['id_zona']}");
        } else {
            //Sino Inserto la Cantidad de Secciones y ID de la Zona
            $this->db->insert('sipce_zona_secciones', array(
                'id_zona' => $consulta['id_zona'],
                'cantidadSecciones' => $consulta['cantidadSecciones']));
        }
       //Luego devuelvo la Cantidad de Secciones Actualiza
       $cantidadSeccionesActualizas = $this->db->select("SELECT z.descripcion, zs.cantidadSecciones "
                                . "FROM sipce_zona_secciones as zs, sipce_zona as z "
                                . "WHERE zs.id_zona = z.id "
                                . "AND z.nivel = " . $consulta['nivel'] . " "
                                . "ORDER BY z.descripcion");
       echo json_encode($cantidadSeccionesActualizas); 
    }
    
    //Carga las escuelas//
    function consultaEscuelaZona($id_zona){
       $escuelasZonaActualizas = $this->db->select("SELECT id_escuela, nombre "
                                . "FROM sipce_zona_escuela, sipce_escuelas "
                                . "WHERE id_zona = " .$id_zona. " "
                                . "AND id_escuela = id");
        echo json_encode($escuelasZonaActualizas); 
    }
    
    //Carga los Distritos//
    function consultaDistritoZona($id_zona){
       $distritosZonaActualiza = $this->db->select("SELECT IdDistrito, Distrito "
                                . "FROM sipce_zona_distrito, sipce_distritos "
                                . "WHERE id_zona = " .$id_zona. " "
                                . "AND id_distrito = IdDistrito "
                                . "ORDER BY Distrito");
        echo json_encode($distritosZonaActualiza); 
    }
    
    //ETAPA CRUZZZIAL -Opcion B//
    function consultaZonasOpcionB($nivel){
        //array de salida
        $arraySalida="";
        //obtengo las zonas     
        $zonasActualizas = $this->db->select("SELECT * "
                                . "FROM sipce_zona "
                                . "WHERE nivel = " . $nivel . " "
                                . "ORDER BY id");
       if($zonasActualizas!=null){
            //Array que contendra un indice $i + los distritos de esa zona
            $arrayDistritosZona= array();
            //Array que contendra los estudiantes clasificados por zona y distrito
            $arraylistaEstudiantesDistrito= array();
            //variable temporal para el indice del array de las zonas
            $i=0;
            //variable temporal para el # de seccion
            $contadorSecciones=0;
            //este foreach guarda en un array los distritos de cada zona [zona] [Distritos..]
             foreach ($zonasActualizas as $key => $value) {
                 //devuelvo distritos de la zona     
                 $distritosZonaActualiza = $this->db->select("SELECT IdDistrito, Distrito "
                                         . "FROM sipce_zona_distrito, sipce_distritos "
                                         . "WHERE id_zona = " .$value['id']. " "
                                         . "AND id_distrito = IdDistrito "
                                         . "ORDER BY IdDistrito");
                 $arrayDistritosZona[$i]= $distritosZonaActualiza;
                 $i++;
             }

             //esta variable cuanta las zonas
             $zonas=count($arrayDistritosZona);
             //el for avanza entre las zonas y va creando una lista de estudiantes de la zona
             for ($i = 0; $i < $zonas; $i++) {
                     //Array temporal para agrupar estudiantes de diferente distrito pero de la misma zona
                     $arrayTemporal = array();
             //esta variable cuanta los distritos de cada zona
             $distritos=count($arrayDistritosZona[$i]);
                 //consultos los estudiantes de un distrito en especifico que pertenesca a esa zona
                 for ($j = 0; $j < $distritos; $j++) {
                     //devuelvo los Estudiantes del distritos de la zona     
                     $listaEstudiantesDistrito = $this->db->select("SELECT p.cedula, p.nombre, p.apellido1, p.apellido2, p.sexo, p.IdDistrito, m.condicion "
                              . "FROM sipce_estudiante as p,sipce_grupos as g,sipce_matricularatificacion as m "
                              . "WHERE p.cedula = g.ced_estudiante "
                              . "AND p.cedula = m.ced_estudiante "
                              . "AND p.IdDistrito = " . $arrayDistritosZona[$i][$j]['IdDistrito'] . " "
                              . "AND g.nivel = " . $nivel . " "
                              . "AND g.annio = " . ($this->anioActivo + 1) . " "
                              . "ORDER BY p.apellido1, p.apellido2, p.nombre");
                     //si la zona posee varios distritos el array va aumentado de indice
                     $arrayTemporal[$j]=$listaEstudiantesDistrito;
                 }
                 //al final de cada zona guardo la lista total de estudiantes y avanza el indice    
                 $arraylistaEstudiantesDistrito[$i]=$arrayTemporal;
             }

             //Recorro cada zona
             for ($iZ = 0; $iZ < $zonas; $iZ++) {

                 //idDistrito obtiene el idDistrito del primer estudiante de cada zona
                 $idDistrito=$arraylistaEstudiantesDistrito[$iZ][0][0]['IdDistrito'];
                 //array de datos para consulta
                 $datosConsulta['idDistrito']=$idDistrito;
                 $datosConsulta['nivel']=$nivel;
                 //obtengo cantidad de secciones para esa zona
                 $cantidadSecciones=$this->consultaCantidadSeccionesZona($datosConsulta);
                 //obtengo nombre de la zona
                 $nombreZona=$this->consultaNombreZona($datosConsulta);
                 //Agrego el nombre de la zona al array de salida
                 $arraySalida.="<h1>" . $nombreZona[0]['descripcion'] . "</h1>";
                 //Cuenta la cantidad de distritos tiene cada zona
                 $distritos=count($arraylistaEstudiantesDistrito[$iZ]);
                 //variable que cuenta el total de estudiantes de la zona
                 $contador=0;

                 //Array que contendra los estudiantes de genero Masculino
                 $arraylistaEstudiantesHombres = array();
                 $contadorHombres=0;

                 //Array que contendra los estudiantes de genero Femenino
                 $arraylistaEstudiantesMujeres = array();
                 $contadorMujeres=0;

                 for ($iD = 0; $iD < $distritos; $iD++) {
                     //obtiene la cantidad de estudiantes de ese distrito
                     $aux1=count($arraylistaEstudiantesDistrito[$iZ][$iD]);
                     for ($iE = 0; $iE < $aux1; $iE++) {
                         //verifico el genero para separar Hombres de Mujeres
                         if($arraylistaEstudiantesDistrito[$iZ][$iD][$iE]['sexo'] == 1){
                             $arraylistaEstudiantesHombres[$contadorHombres]['sexo'] = "Masculino";
                             $arraylistaEstudiantesHombres[$contadorHombres]['condicion'] = $arraylistaEstudiantesDistrito[$iZ][$iD][$iE]['condicion'];
                             $arraylistaEstudiantesHombres[$contadorHombres]['cedula'] = $arraylistaEstudiantesDistrito[$iZ][$iD][$iE]['cedula'];
                             $arraylistaEstudiantesHombres[$contadorHombres]['nombre'] = $arraylistaEstudiantesDistrito[$iZ][$iD][$iE]['apellido1'] .  
                                                                                         " " . $arraylistaEstudiantesDistrito[$iZ][$iD][$iE]['apellido2'] . 
                                                                                         " " . $arraylistaEstudiantesDistrito[$iZ][$iD][$iE]['nombre'];

                             //contador para incrementar el indice del array, tambien para conocer el final del array
                             $contadorHombres++;
                         }else{
                             $arraylistaEstudiantesMujeres[$contadorMujeres]['sexo'] = "Femenino";
                             $arraylistaEstudiantesMujeres[$contadorMujeres]['condicion'] = $arraylistaEstudiantesDistrito[$iZ][$iD][$iE]['condicion'];
                             $arraylistaEstudiantesMujeres[$contadorMujeres]['cedula'] = $arraylistaEstudiantesDistrito[$iZ][$iD][$iE]['cedula'];
                             $arraylistaEstudiantesMujeres[$contadorMujeres]['nombre'] = $arraylistaEstudiantesDistrito[$iZ][$iD][$iE]['apellido1'] .  
                                                                                         " " . $arraylistaEstudiantesDistrito[$iZ][$iD][$iE]['apellido2'] . 
                                                                                         " " . $arraylistaEstudiantesDistrito[$iZ][$iD][$iE]['nombre']; 

                             //contador para incrementar el indice del array, tambien para conocer el final del array
                             $contadorMujeres++;   
                         }
                         //Este contador me indica el total de estudiantes de una zona en especifico
                         //lo utilizo para dividir los estudiantes equitativamente en la cantidad de secciones establecidas
                         //tambien para conocer el final de la lista, lo utilizare e el siguiente for
                         $contador++;
                     }
                 }
                     
                 $contadorSecciones++;
                 //Variables auxiliares para rotar el genero en cada seccion
                 $contadorLinea=0;
                 $bandera=0;
                 $banderaMujeres=0;
                 $banderaHombres=0;

                 //Agrego el # de seccion al array de salida
                 $arraySalida.="<h2>Seccion: " . $nivel . "-" . $contadorSecciones . "</h2>";
                 //Agrego la tabla al array de salida
                 $arraySalida.='<table class="table table-condensed"><thead><tr><th>#</th><th>Cédula</th><th>Estudiante</th><th>Género</th><th>Condición</th></tr></thead><tbody>';

                 //ciclo finito, su limite es la cantidad total de estudiantes de una zona en especifico
                 for ($iX = 0; $iX < $contador; $iX++) {
                     //la bandera me permite alternar Hombre / Mujer
                     if($bandera==0){
                         //antes pregunto si ya estoy en el limite del cupo de estudiantes de la seccion
                         if($contadorLinea > $contador/$cantidadSecciones[0]['cantidadSecciones']){
                             //si sucede esto aumento el numero de la seccion y agrego el encabezado de una nueva tabla
                             $contadorSecciones++;
                             $arraySalida .= '<tr><td colspan="4">----- Cupo de seccion: ' . $contador/$cantidadSecciones[0]["cantidadSecciones"] . 
                                             '</td></tr></tbody></table><br><h2>Seccion: ' . $nivel . '-'  . $contadorSecciones . 
                                             '</h2><table class="table table-condensed"><thead><tr><th>#</th><th>Cédula</th><th>Estudiante</th><th>Género</th><th>Condición</th></tr></thead><tbody>';
                             //reinicio el contador de linia
                             $contadorLinea=0;
                         }
                         //pinta una linia del array de mujeres siempre y cuando la banderaMujeres sea menor al final del array
                         if($banderaMujeres<$contadorMujeres){
                             $arraySalida .= "<tr><td>" . ($contadorLinea + 1) . "</td><td>" . $arraylistaEstudiantesMujeres[$banderaMujeres]['cedula'] . 
                                         "</td><td>" . $arraylistaEstudiantesMujeres[$banderaMujeres]['nombre'] . 
                                         "</td><td>" . $arraylistaEstudiantesMujeres[$banderaMujeres]['sexo'] . 
                                         "</td><td>" . $arraylistaEstudiantesMujeres[$banderaMujeres]['condicion'] . "</td></tr>";
                             //Aumento la bandera del array de mujeres para moverme un espacio
                             $banderaMujeres++;
                             //aumento la linea # de estudiante
                             $contadorLinea++;
                             }else {
                                 //si ya llegamos al final del array de mujeres, desincremento $iX para cambiar el genero y que el for no se brinque el campo
                                 $iX--;
                             }
                     //cambio la bandera para que salte al array de hombres en la proxima vez del ciclo
                     $bandera=1;
                     }else{
                         if($contadorLinea > $contador/$cantidadSecciones[0]['cantidadSecciones']){
                                 $contadorSecciones++;
                                 $arraySalida .= '<tr><td colspan="4">----- Cupo de seccion: ' . $contador/$cantidadSecciones[0]["cantidadSecciones"] . 
                                                 '</td></tr></tbody></table><br><h2>Seccion: ' . $nivel . '-' . $contadorSecciones . 
                                                 '</h2><table class="table table-condensed"><thead><tr><th>#</th><th>Cédula</th><th>Estudiante</th><th>Género</th><th>Condición</th></tr></thead><tbody>';
                                 $contadorLinea=0;
                             }
                         if($banderaHombres<$contadorHombres){
                                 $arraySalida .= "<tr><td>" . ($contadorLinea + 1) . "</td><td>" . $arraylistaEstudiantesHombres[$banderaHombres]['cedula'] . 
                                             "</td><td>" . $arraylistaEstudiantesHombres[$banderaHombres]['nombre'] . 
                                             "</td><td>" . $arraylistaEstudiantesHombres[$banderaHombres]['sexo'] .
                                             "</td><td>" . $arraylistaEstudiantesHombres[$banderaHombres]['condicion'] . "</td></tr>";
                             $banderaHombres++;
                             //aumento la linea # de estudiante
                             $contadorLinea++;
                             }else {
                                 //si ya llegamos al final del array de mujeres, desincremento $iX para cambiar el genero y que el for no se brinque el campo
                                 $iX--;
                             }
                             $bandera=0;
                     }
                 }
                 $arraySalida.="</tbody></table><br>";
             }
       }else{
           $arraySalida.="<h1>No existen zonas para el nivel seleccionado</h1>";
       }
        echo json_encode($arraySalida);
    }
    
    
    function consultaCantidadSeccionesZona($datosConsulta){
        //devuelvo el id_zona     
       $consultaId_zona = $this->db->select("SELECT id_zona "
                                . "FROM sipce_zona_distrito "
                                . "WHERE id_distrito = " . $datosConsulta['idDistrito'] . " "
                                . "AND nivel = " . $datosConsulta['nivel'] . " ");
       
        //devuelvo el id_zona
       foreach ($consultaId_zona as $key => $value) {
       $cantidadSecciones = $this->db->select("SELECT cantidadSecciones "
                                . "FROM sipce_zona_secciones "
                                . "WHERE id_zona = " . $value['id_zona']);
       }
       return $cantidadSecciones;
    }
    
    
    function consultaNombreZona($datosConsulta){
        //devuelvo el id_zona     
       $consultaId_zona = $this->db->select("SELECT id_zona "
                                . "FROM sipce_zona_distrito "
                                . "WHERE id_distrito = " . $datosConsulta['idDistrito'] . " "
                                . "AND nivel = " . $datosConsulta['nivel'] . " ");
       
        //devuelvo el nombre de la zona
       foreach ($consultaId_zona as $key => $value) {
       $nombreZona = $this->db->select("SELECT descripcion "
                                . "FROM sipce_zona "
                                . "WHERE id = " . $value['id_zona']);
       }
       return $nombreZona;
    }    
    

    /* Retorna la informacion del Estudiante para Asignar Seccion*/

    public function datosEstudiante($cedulaEstudiante) {
        return $this->db->select("SELECT p.cedula,p.nombre,p.apellido1,p.apellido2,p.sexo,p.fechaNacimiento,g.nivel,g.grupo,g.sub_grupo "
                        . "FROM sipce_estudiante as p,sipce_grupos as g "
                        . "WHERE p.cedula = g.ced_estudiante "
                        . "AND g.annio = '" . $this->anioActivo . "' "
                        . "AND p.cedula = '" . $cedulaEstudiante . "' ");
    }

    /* Carga todos los SubGrupos de una Sección */

    public function cargaSubGrupos($consulta) {
        $resultado = $this->db->select("SELECT DISTINCT sub_grupo FROM sipce_grupos "
                                . "WHERE nivel = :nivel "
                                . "AND grupo = :grupo "
                                . "AND annio = ".$this->anioActivo." "
                                . "ORDER BY sub_grupo", array('nivel' => $consulta['nivelSeleccionado'],
                                                          'grupo' => $consulta['grupoSeleccionado']));
        echo json_encode($resultado);
    }

    /* Guardo la nueva seccion del estudiante*/

    public function guardarAsignarSeccion($datos) {
    //Consulto si el estudiante esta asignado a un Nivel, Grupo, Subgrupo
        $consultaExistenciaNivel = $this->db->select("SELECT * FROM `sipce_grupos` "
                                                    ."WHERE `ced_estudiante` = '".$datos['ced_estudiante']."' "
                                                    ."AND `annio` = ".$this->anioActivo);

        if ($consultaExistenciaNivel != null) {
            //Actualizo nivel del Estudiante
            $datosNivel = array(
                'nivel' => $datos['nivel'],
                'grupo' => $datos['grupo'],
                'sub_grupo' => $datos['subGrupo']);

            $this->db->update('sipce_grupos', $datosNivel, "`ced_estudiante` = '{$datos['ced_estudiante']}' AND `annio` = ".$this->anioActivo);
            $msj="Sección de Estudiante actualizada correctamente";
        } else {
            //Sino Inserto datos en sipce_grupos
            $this->db->insert('sipce_grupos', array(
                'ced_estudiante' => $datos['ced_estudiante'],
                'nivel' => $datos['nivel'],
                'grupo' => $datos['grupo'],
                'subGrupo' => $datos['subGrupo'],
                'annio' => $this->anioActivo));
            $msj="Se agrego nueva Sección del Estudiante";
        }
        return $msj;
    }
    
    

    public function xhrSeccion($idGrupo) {
        $resultado2 = $this->db->select("SELECT cedula,nombre,apellido1,apellido2 "
                . "FROM sipce_estudiante, sipce_grupos "
                . "WHERE cedula = ced_estudiante "
                . "AND tipoUsuario = 4 "
                . "AND nivel = 10 "
                . "AND grupo = :grupo "
                . "ORDER BY apellido1,apellido2", array(':grupo' => $idGrupo));
        echo json_encode($resultado2);
    }

    function xhrInsert() {
        $text = $_POST['text'];

        $sth = $this->db->prepare('INSERT INTO data (text) VALUES (:text)');
        $sth->execute(array(':text' => $text));

        $data = array('text' => $text, 'id' => $this->db->lastInsertId());
        echo json_encode($data);
    }

    function xhrGetListings() {
        $sth = $this->db->prepare('SELECT * FROM data');
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute();
        $data = $sth->fetchAll();
        echo json_encode($data);
    }

}

?>